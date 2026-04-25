<?php
require_once __DIR__ . '/../Exceptions/InvalidUserEmailException.php';

class UserEmail
{
    private $value;

    public function __construct($value)
    {
        $val = trim((string)$value);
        if ($val === '') {
            throw InvalidUserEmailException::becauseValueIsEmpty();
        }
        $val = strtolower($val);
        if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
            throw InvalidUserEmailException::becauseFormatIsInvalid($val);
        }
        $this->value = $val;
    }

    public function value()
    {
        return $this->value;
    }

    public function equals(UserEmail $other)
    {
        return $this->value === $other->value();
    }

    public function __toString()
    {
        return $this->value;
    }
}
