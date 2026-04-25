<?php
require_once __DIR__ . '/../Exceptions/InvalidUserNameException.php';

class UserName
{
    private $value;

    public function __construct($value)
    {
        $val = trim((string)$value);
        if ($val === '') {
            throw InvalidUserNameException::becauseValueIsEmpty();
        }
        if (strlen($val) < 3) {
            throw InvalidUserNameException::becauseLengthIsTooShort(3);
        }
        $this->value = $val;
    }

    public function value()
    {
        return $this->value;
    }

    public function equals(UserName $other)
    {
        return $this->value === $other->value();
    }

    public function __toString()
    {
        return $this->value;
    }
}
