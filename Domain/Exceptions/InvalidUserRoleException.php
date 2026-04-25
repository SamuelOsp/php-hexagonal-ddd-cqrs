<?php

class InvalidUserRoleException extends InvalidArgumentException
{
    public static function becauseValueIsInvalid($value) { return new self("Rol inválido: $value"); }
}
