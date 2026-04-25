<?php

class InvalidUserIdException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty() { return new self('El ID no puede estar vacío.'); }
}
