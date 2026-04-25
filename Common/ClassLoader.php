<?php

class ClassLoader
{
    private static $map = [
        // Exceptions
        'InvalidUserIdException' => __DIR__ . '/../Domain/Exceptions/InvalidUserIdException.php',
        'InvalidUserNameException' => __DIR__ . '/../Domain/Exceptions/InvalidUserNameException.php',
        'InvalidUserEmailException' => __DIR__ . '/../Domain/Exceptions/InvalidUserEmailException.php',
        'InvalidUserPasswordException' => __DIR__ . '/../Domain/Exceptions/InvalidUserPasswordException.php',
        'InvalidUserRoleException' => __DIR__ . '/../Domain/Exceptions/InvalidUserRoleException.php',
        'InvalidUserStatusException' => __DIR__ . '/../Domain/Exceptions/InvalidUserStatusException.php',
        'UserAlreadyExistsException' => __DIR__ . '/../Domain/Exceptions/UserAlreadyExistsException.php',
        'UserNotFoundException' => __DIR__ . '/../Domain/Exceptions/UserNotFoundException.php',
        'InvalidCredentialsException' => __DIR__ . '/../Domain/Exceptions/InvalidCredentialsException.php',
        
        // Enums
        'UserRoleEnum' => __DIR__ . '/../Domain/Enums/UserRoleEnum.php',
        'UserStatusEnum' => __DIR__ . '/../Domain/Enums/UserStatusEnum.php',
        
        // Value Objects
        'UserId' => __DIR__ . '/../Domain/ValueObjects/UserId.php',
        'UserName' => __DIR__ . '/../Domain/ValueObjects/UserName.php',
        'UserEmail' => __DIR__ . '/../Domain/ValueObjects/UserEmail.php',
        'UserPassword' => __DIR__ . '/../Domain/ValueObjects/UserPassword.php',
        
        // Models
        'UserModel' => __DIR__ . '/../Domain/Models/UserModel.php',
        
        // Events
        'DomainEvent' => __DIR__ . '/../Domain/Events/DomainEvent.php',
        'UserCreatedDomainEvent' => __DIR__ . '/../Domain/Events/UserCreatedDomainEvent.php',
        'UserUpdatedDomainEvent' => __DIR__ . '/../Domain/Events/UserUpdatedDomainEvent.php',
        'UserDeletedDomainEvent' => __DIR__ . '/../Domain/Events/UserDeletedDomainEvent.php',
        
        // Application Ports
        'CreateUserUseCase' => __DIR__ . '/../Application/Ports/In/CreateUserUseCase.php',
        'UpdateUserUseCase' => __DIR__ . '/../Application/Ports/In/UpdateUserUseCase.php',
        'DeleteUserUseCase' => __DIR__ . '/../Application/Ports/In/DeleteUserUseCase.php',
        'GetUserByIdUseCase' => __DIR__ . '/../Application/Ports/In/GetUserByIdUseCase.php',
        'GetAllUsersUseCase' => __DIR__ . '/../Application/Ports/In/GetAllUsersUseCase.php',
        'LoginUseCase' => __DIR__ . '/../Application/Ports/In/LoginUseCase.php',
        'SaveUserPort' => __DIR__ . '/../Application/Ports/Out/SaveUserPort.php',
        'UpdateUserPort' => __DIR__ . '/../Application/Ports/Out/UpdateUserPort.php',
        'DeleteUserPort' => __DIR__ . '/../Application/Ports/Out/DeleteUserPort.php',
        'GetUserByIdPort' => __DIR__ . '/../Application/Ports/Out/GetUserByIdPort.php',
        'GetUserByEmailPort' => __DIR__ . '/../Application/Ports/Out/GetUserByEmailPort.php',
        'GetAllUsersPort' => __DIR__ . '/../Application/Ports/Out/GetAllUsersPort.php',
        
        // Application Dtos
        'CreateUserCommand' => __DIR__ . '/../Application/Services/Dto/Commands/CreateUserCommand.php',
        'UpdateUserCommand' => __DIR__ . '/../Application/Services/Dto/Commands/UpdateUserCommand.php',
        'DeleteUserCommand' => __DIR__ . '/../Application/Services/Dto/Commands/DeleteUserCommand.php',
        'LoginCommand' => __DIR__ . '/../Application/Services/Dto/Commands/LoginCommand.php',
        'GetUserByIdQuery' => __DIR__ . '/../Application/Services/Dto/Queries/GetUserByIdQuery.php',
        'GetAllUsersQuery' => __DIR__ . '/../Application/Services/Dto/Queries/GetAllUsersQuery.php',
        
        // Application Services
        'UserApplicationMapper' => __DIR__ . '/../Application/Services/Mappers/UserApplicationMapper.php',
        'CreateUserService' => __DIR__ . '/../Application/Services/CreateUserService.php',
        'UpdateUserService' => __DIR__ . '/../Application/Services/UpdateUserService.php',
        'DeleteUserService' => __DIR__ . '/../Application/Services/DeleteUserService.php',
        'GetUserByIdService' => __DIR__ . '/../Application/Services/GetUserByIdService.php',
        'GetAllUsersService' => __DIR__ . '/../Application/Services/GetAllUsersService.php',
        'LoginService' => __DIR__ . '/../Application/Services/LoginService.php',
        
        // Infrastructure MySQL Persistence
        'Connection' => __DIR__ . '/../Infrastructure/Adapters/Persistence/MySQL/Config/Connection.php',
        'UserPersistenceDto' => __DIR__ . '/../Infrastructure/Adapters/Persistence/MySQL/Dto/UserPersistenceDto.php',
        'UserEntity' => __DIR__ . '/../Infrastructure/Adapters/Persistence/MySQL/Entity/UserEntity.php',
        'UserPersistenceMapper' => __DIR__ . '/../Infrastructure/Adapters/Persistence/MySQL/Mapper/UserPersistenceMapper.php',
        'UserRepositoryMySQL' => __DIR__ . '/../Infrastructure/Adapters/Persistence/MySQL/Repository/UserRepositoryMySQL.php',
        
        // Infrastructure Web Entrypoints
        'CreateUserWebRequest' => __DIR__ . '/../Infrastructure/Entrypoints/Web/Controllers/Dto/CreateUserRequest.php',
        'UpdateUserWebRequest' => __DIR__ . '/../Infrastructure/Entrypoints/Web/Controllers/Dto/UpdateUserRequest.php',
        'LoginWebRequest' => __DIR__ . '/../Infrastructure/Entrypoints/Web/Controllers/Dto/LoginWebRequest.php',
        'UserResponse' => __DIR__ . '/../Infrastructure/Entrypoints/Web/Controllers/Dto/UserResponse.php',
        'UserWebMapper' => __DIR__ . '/../Infrastructure/Entrypoints/Web/Controllers/Mapper/UserWebMapper.php',
        'WebRoutes' => __DIR__ . '/../Infrastructure/Entrypoints/Web/Controllers/Config/WebRoutes.php',
        'UserController' => __DIR__ . '/../Infrastructure/Entrypoints/Web/Controllers/UserController.php',
        'Flash' => __DIR__ . '/../Infrastructure/Entrypoints/Web/Presentation/Flash.php',
        'View' => __DIR__ . '/../Infrastructure/Entrypoints/Web/Presentation/View.php',
        
        // Common
        'DependencyInjection' => __DIR__ . '/DependencyInjection.php',
    ];

    public static function register()
    {
        spl_autoload_register(function ($className) {
            if (isset(self::$map[$className])) {
                require_once self::$map[$className];
            }
        });
    }
}
