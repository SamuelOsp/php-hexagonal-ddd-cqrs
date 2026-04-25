<?php

class InvalidUserNameException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty() { return new self('El nombre no puede estar vacío.'); }
    public static function becauseLengthIsTooShort($min) { return new self("El nombre debe tener al menos $min caracteres."); }
}
