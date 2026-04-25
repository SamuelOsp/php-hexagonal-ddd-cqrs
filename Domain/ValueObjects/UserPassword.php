<?php
require_once __DIR__ . '/../Exceptions/InvalidUserPasswordException.php';

class UserPassword
{
    private $hash;

    public function __construct($hash)
    {
        if (trim((string)$hash) === '') {
            throw InvalidUserPasswordException::becauseValueIsEmpty();
        }
        $this->hash = (string)$hash;
    }

    public static function fromPlainText($raw)
    {
        $val = (string)$raw;
        if ($val === '') {
            throw InvalidUserPasswordException::becauseValueIsEmpty();
        }
        if (strlen($val) < 8) {
            throw InvalidUserPasswordException::becauseLengthIsTooShort(8);
        }
        $hash = password_hash($val, PASSWORD_BCRYPT);
        return new self($hash);
    }

    public static function fromHash($hash)
    {
        return new self($hash);
    }

    public function verifyPlain($plain)
    {
        return password_verify((string)$plain, $this->hash);
    }

    public function value()
    {
        return $this->hash;
    }

    public function equals(UserPassword $other)
    {
        return $this->hash === $other->value();
    }

    public function __toString()
    {
        return $this->hash;
    }
}
