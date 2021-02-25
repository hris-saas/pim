<?php

namespace HRis\PIM\Validators;

class Validator
{
    private static $validators = [
        ExistsFieldValidator::class,
        SortOrderFieldValidator::class,
        UniqueFieldValidator::class,
    ];

    public static function registerValidators(): void
    {
        foreach (self::$validators as $validator) {
            (new $validator())->handle();
        }
    }
}
