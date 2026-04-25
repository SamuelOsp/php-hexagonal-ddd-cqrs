<?php

class DependencyInjection
{
    private static $pdo = null;
    private static $userRepository = null;
    private static $userController = null;

    public static function boot()
    {
        ClassLoader::register();
    }

    public static function getConnection()
    {
        return new Connection('127.0.0.1', 3306, 'crud_usuarios', 'root', '', 'utf8mb4');
    }

    public static function getPdo()
    {
        if (self::$pdo === null) {
            self::$pdo = self::getConnection()->createPdo();
        }
        return self::$pdo;
    }

    public static function getUserPersistenceMapper()
    {
        return new UserPersistenceMapper();
    }

    public static function getUserRepository()
    {
        if (self::$userRepository === null) {
            self::$userRepository = new UserRepositoryMySQL(self::getPdo(), self::getUserPersistenceMapper());
        }
        return self::$userRepository;
    }

    public static function getCreateUserUseCase()
    {
        $repo = self::getUserRepository();
        return new CreateUserService($repo, $repo);
    }

    public static function getUpdateUserUseCase()
    {
        $repo = self::getUserRepository();
        return new UpdateUserService($repo, $repo, $repo);
    }

    public static function getDeleteUserUseCase()
    {
        $repo = self::getUserRepository();
        return new DeleteUserService($repo, $repo);
    }

    public static function getGetUserByIdUseCase()
    {
        $repo = self::getUserRepository();
        return new GetUserByIdService($repo);
    }

    public static function getGetAllUsersUseCase()
    {
        $repo = self::getUserRepository();
        return new GetAllUsersService($repo);
    }

    public static function getLoginUseCase()
    {
        $repo = self::getUserRepository();
        return new LoginService($repo);
    }

    public static function getUserWebMapper()
    {
        return new UserWebMapper();
    }

    public static function getUserController()
    {
        if (self::$userController === null) {
            self::$userController = new UserController(
                self::getCreateUserUseCase(),
                self::getUpdateUserUseCase(),
                self::getGetUserByIdUseCase(),
                self::getGetAllUsersUseCase(),
                self::getDeleteUserUseCase(),
                self::getUserWebMapper()
            );
        }
        return self::$userController;
    }
}
