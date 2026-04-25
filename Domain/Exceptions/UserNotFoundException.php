<?php

class UserNotFoundException extends DomainException
{
    public static function becauseIdWasNotFound($id) { return new self("No se encontró usuario con ID: $id"); }
}
