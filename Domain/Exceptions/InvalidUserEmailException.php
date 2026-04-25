<?php

class InvalidUserEmailException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty() { return new self('El email no puede estar vacío.'); }
    public static function becauseFormatIsInvalid($email) { return new self("Formato de email inválido: $email"); }
}
