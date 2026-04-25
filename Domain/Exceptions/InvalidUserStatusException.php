<?php

class InvalidUserStatusException extends InvalidArgumentException
{
    public static function becauseValueIsInvalid($value) { return new self("Estado inválido: $value"); }
}
