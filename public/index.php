<?php
declare(strict_types=1);

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// 1. GUARDIA DE SEGURIDAD (solo sanea entrada, sin redirecciones automáticas)
if (isset($_GET['route']) && is_array($_GET['route'])) {
    $_GET['route'] = 'home';
}
if (isset($_GET['id']) && is_array($_GET['id'])) {
    $_GET['id'] = '';
}

// 2. BOOTSTRAP
require_once __DIR__ . '/../Common/ClassLoader.php';
require_once __DIR__ . '/../Common/DependencyInjection.php';
require_once __DIR__ . '/../Infrastructure/Entrypoints/Web/Controllers/Config/WebRoutes.php';
require_once __DIR__ . '/../Infrastructure/Entrypoints/Web/Presentation/View.php';
require_once __DIR__ . '/../Infrastructure/Entrypoints/Web/Presentation/Flash.php';
DependencyInjection::boot();
Flash::start();

// 3. AUTH HELPERS
function isLoggedIn(): bool { return isset($_SESSION['auth']['id']); }
function requireAuth(): void {
    if (!isLoggedIn()) {
        Flash::setMessage('Debes iniciar sesión para acceder a esta sección.');
        View::redirect('auth.login');
    }
}

// 4. ROUTING
$route      = isset($_GET['route']) ? trim((string) $_GET['route']) : 'home';
$route      = $route === '' ? 'home' : $route;
$routes     = WebRoutes::routes();
$httpMethod = strtoupper((string) $_SERVER['REQUEST_METHOD']);

if (!isset($routes[$route])) { http_response_code(404); View::render('home', buildHomeViewData('Ruta no encontrada.')); exit; }
$definition = $routes[$route];
if ($httpMethod !== $definition['method']) { http_response_code(405); View::render('home', buildHomeViewData('Método no permitido.')); exit; }

$publicActions = array('home','login','authenticate','logout','forgot','forgot.send','create','store');
if (!in_array($definition['action'], $publicActions, true) && !isLoggedIn()) {
    Flash::setMessage('Debes iniciar sesión para acceder a esta sección.');
    View::redirect('auth.login');
}

// 5. DISPATCH (try/catch envuelve TODO el switch)
try {
    switch ($definition['action']) {

        case 'home':
            View::render('home', buildHomeViewData());
            break;

        case 'create':
            View::render('users/create', buildCreateUserViewData());
            break;

        case 'store':
            $form = getCreateUserFormData();
            $form['id'] = generateUuid4();
            $errors = validateCreateUserForm($form);
            if (!empty($errors)) {
                Flash::setOld($form); Flash::setErrors($errors);
                Flash::setMessage('Corrige los errores del formulario.');
                View::redirect('users.create');
            }
            $controller = DependencyInjection::getUserController();
            $request = new CreateUserWebRequest($form['id'],$form['name'],$form['email'],$form['password'],$form['role']);
            $controller->store($request);
            Flash::setSuccess('Usuario registrado correctamente.');
            View::redirect('users.index');
            break;

        case 'index':
            $controller = DependencyInjection::getUserController();
            $users = $controller->index();
            View::render('users/list', buildListUsersViewData($users));
            break;

        case 'show':
            $controller = DependencyInjection::getUserController();
            $id = isset($_GET['id']) ? trim((string) $_GET['id']) : '';
            $user = $controller->show($id);
            View::render('users/show', ['pageTitle'=>'Detalle de usuario','user'=>$user,'message'=>Flash::message()]);
            break;

        case 'edit':
            $controller = DependencyInjection::getUserController();
            $id = isset($_GET['id']) ? trim((string) $_GET['id']) : '';
            $user = $controller->show($id);
            View::render('users/edit', buildEditUserViewData($user));
            break;

        case 'update':
            $form = getUpdateUserFormData();
            $errors = validateUpdateUserForm($form);
            if (!empty($errors)) {
                Flash::setOld($form); Flash::setErrors($errors);
                Flash::setMessage('Corrige los errores del formulario.');
                header('Location: ?route=users.edit&id=' . urlencode($form['id'])); exit;
            }
            $controller = DependencyInjection::getUserController();
            $request = new UpdateUserWebRequest($form['id'],$form['name'],$form['email'],$form['password'],$form['role'],$form['status']);
            $controller->update($request);
            Flash::setSuccess('Usuario actualizado correctamente.');
            View::redirect('users.index');
            break;

        case 'delete':
            $controller = DependencyInjection::getUserController();
            $id = isset($_POST['id']) ? trim((string) $_POST['id']) : '';
            $controller->delete($id);
            Flash::setSuccess('Usuario eliminado correctamente.');
            View::redirect('users.index');
            break;

        case 'login':
            if (isLoggedIn()) { View::redirect('home'); }
            View::render('auth/login', ['pageTitle'=>'Iniciar sesión','message'=>Flash::message(),'errors'=>Flash::errors(),'old'=>Flash::old()]);
            break;

        case 'authenticate':
            $email    = trim(strtolower((string)($_POST['email'] ?? '')));
            $password = (string)($_POST['password'] ?? '');
            $authErrors = [];
            if ($email === '')    $authErrors['email']    = 'El correo es obligatorio.';
            if ($password === '') $authErrors['password'] = 'La contraseña es obligatoria.';
            if (!empty($authErrors)) {
                Flash::setErrors($authErrors); Flash::setOld(['email'=>$email]);
                View::redirect('auth.login');
            }
            $loginUseCase = DependencyInjection::getLoginUseCase();
            $user = $loginUseCase->execute(new LoginCommand($email, $password));
            $_SESSION['auth'] = ['id'=>$user->id()->value(),'name'=>$user->name()->value(),'email'=>$user->email()->value(),'role'=>$user->role()];
            Flash::setSuccess('Bienvenido/a, ' . $user->name()->value() . '.');
            View::redirect('home');
            break;

        case 'logout':
            session_destroy();
            header('Location: ?route=auth.login'); exit;

        case 'forgot':
            View::render('auth/forgot-password', ['pageTitle'=>'Recuperar contraseña','message'=>Flash::message(),'success'=>Flash::success(),'errors'=>Flash::errors(),'old'=>Flash::old()]);
            break;

        case 'forgot.send':
            $forgotEmail = trim(strtolower((string)($_POST['email'] ?? '')));
            if ($forgotEmail === '' || !filter_var($forgotEmail, FILTER_VALIDATE_EMAIL)) {
                Flash::setErrors(['email'=>'Introduce un correo válido.']);
                Flash::setOld(['email'=>$forgotEmail]);
                View::redirect('auth.forgot');
            }
            $repository  = DependencyInjection::getUserRepository();
            $foundUser   = $repository->getByEmail(new UserEmail($forgotEmail));
            if ($foundUser !== null && $foundUser->status() === UserStatusEnum::ACTIVE) {
                $tempPassword = bin2hex(random_bytes(5));
                $updatedUser  = $foundUser->changePassword(UserPassword::fromPlainText($tempPassword));
                $repository->update($updatedUser);
                sendPasswordRecoveryEmail($foundUser->email()->value(), $foundUser->name()->value(), $tempPassword);
            }
            Flash::setSuccess('Si el correo está registrado y la cuenta está activa, recibirás un mensaje con tu contraseña temporal.');
            View::redirect('auth.forgot');
            break;

        default:
            throw new RuntimeException('Acción no soportada.');
    }

} catch (Throwable $exception) {
    $msg = $exception->getMessage();
    Flash::setMessage($msg);
    switch ($route) {
        case 'users.store':
            Flash::setOld(getCreateUserFormData()); View::redirect('users.create'); break;
        case 'users.update':
            $updateId = trim((string)($_POST['id'] ?? ''));
            Flash::setOld(getUpdateUserFormData());
            header('Location: ?route=users.edit&id=' . urlencode($updateId)); exit;
        case 'auth.authenticate':
            Flash::setOld(['email'=>trim(strtolower((string)($_POST['email'] ?? '')))]);
            View::redirect('auth.login'); break;
        case 'auth.forgot.send':
            Flash::setOld(['email'=>trim((string)($_POST['email'] ?? ''))]);
            View::redirect('auth.forgot'); break;
        case 'users.show': case 'users.edit': case 'users.delete':
            View::redirect('users.index'); break;
        default:
            View::render('home', buildHomeViewData($msg)); break;
    }
}

// ── HELPER: envío de correo ──────────────────────────────────────────────────
function sendPasswordRecoveryEmail(string $email, string $name, string $tempPassword): void
{
    $templateFile = __DIR__ . '/../Infrastructure/Entrypoints/Web/Presentation/Views/emails/forgot-password.php';
    ob_start();
    extract(['email'=>$email,'name'=>$name,'tempPassword'=>$tempPassword], EXTR_SKIP);
    require $templateFile;
    $htmlBody = (string) ob_get_clean();
    $subject  = '=?UTF-8?B?' . base64_encode('Recuperación de contraseña') . '?=';
    $headers  = implode("\r\n", ['MIME-Version: 1.0','Content-Type: text/html; charset=UTF-8','From: CRUD Usuarios <no-reply@crud-usuarios.local>']);
    mail($email, $subject, $htmlBody, $headers);
}

// ── VIEW DATA BUILDERS ───────────────────────────────────────────────────────
function buildHomeViewData(string $message = ''): array {
    return ['pageTitle'=>'Menú principal','message'=>$message,'success'=>Flash::success()];
}
function buildCreateUserViewData(): array {
    return ['pageTitle'=>'Registrar usuario','roleOptions'=>UserRoleEnum::values(),'message'=>Flash::message(),'success'=>Flash::success(),'errors'=>Flash::errors(),'old'=>Flash::old()];
}
function buildListUsersViewData(array $users): array {
    return ['pageTitle'=>'Lista de usuarios','users'=>$users,'message'=>Flash::message(),'success'=>Flash::success()];
}
function buildEditUserViewData(UserResponse $user): array {
    return ['pageTitle'=>'Editar usuario','user'=>$user,'roleOptions'=>UserRoleEnum::values(),'statusOptions'=>UserStatusEnum::values(),'message'=>Flash::message(),'errors'=>Flash::errors(),'old'=>Flash::old()];
}

// ── FORM DATA ACCESSORS ──────────────────────────────────────────────────────
function getCreateUserFormData(): array {
    return ['name'=>trim((string)($_POST['name'] ?? '')),'email'=>trim((string)($_POST['email'] ?? '')),'password'=>trim((string)($_POST['password'] ?? '')),'role'=>trim((string)($_POST['role'] ?? ''))];
}
function getUpdateUserFormData(): array {
    return ['id'=>trim((string)($_POST['id'] ?? '')),'name'=>trim((string)($_POST['name'] ?? '')),'email'=>trim((string)($_POST['email'] ?? '')),'password'=>(string)($_POST['password'] ?? ''),'role'=>trim((string)($_POST['role'] ?? '')),'status'=>trim((string)($_POST['status'] ?? ''))];
}

// ── VALIDATORS ───────────────────────────────────────────────────────────────
function validateCreateUserForm(array $form): array {
    $errors = [];
    if ($form['name'] === '')     $errors['name']     = 'El nombre es obligatorio.';
    if ($form['email'] === '')    $errors['email']    = 'El correo es obligatorio.';
    elseif (!filter_var($form['email'], FILTER_VALIDATE_EMAIL)) $errors['email'] = 'El correo no tiene un formato válido.';
    if ($form['password'] === '') $errors['password'] = 'La contraseña es obligatoria.';
    elseif (strlen($form['password']) < 8) $errors['password'] = 'La contraseña debe tener al menos 8 caracteres.';
    if ($form['role'] === '')     $errors['role']     = 'El rol es obligatorio.';
    return $errors;
}
function validateUpdateUserForm(array $form): array {
    $errors = [];
    if ($form['name'] === '')  $errors['name']  = 'El nombre es obligatorio.';
    if ($form['email'] === '') $errors['email'] = 'El correo es obligatorio.';
    elseif (!filter_var($form['email'], FILTER_VALIDATE_EMAIL)) $errors['email'] = 'El correo no tiene un formato válido.';
    if ($form['password'] !== '' && strlen($form['password']) < 8) $errors['password'] = 'La contraseña debe tener al menos 8 caracteres si deseas cambiarla.';
    if ($form['role'] === '')   $errors['role']   = 'El rol es obligatorio.';
    if ($form['status'] === '') $errors['status'] = 'El estado es obligatorio.';
    return $errors;
}

// ── UUID GENERATOR ────────────────────────────────────────────────────────────
function generateUuid4(): string {
    $data    = random_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}
