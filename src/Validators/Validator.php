<?php

namespace HRis\PIM\Validators;

class Validator
{
    private static $validators = [
        UniqueFieldValidator::class,
        ExistsFieldValidator::class,
    ];

    public static function registerValidators(): void
    {
        foreach (self::$validators as $validator) {
            (new $validator())->handle();
        }
    }
}
