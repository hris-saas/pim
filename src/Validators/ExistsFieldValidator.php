<?php

namespace HRis\PIM\Validators;

use Illuminate\Support\Facades\Validator;
use HRis\Core\Validators\ValidatorInterface;

class ExistsFieldValidator implements ValidatorInterface
{
    public function handle(): void
    {
        $this->extend();

        $this->replacer();
    }

    public function extend(): void
    {
        Validator::extend('exists_field', function ($attribute, $value, $parameters, $validator) {
            [$model, $column] = $parameters;

            return (new $model())::where($column, $value)->first();
        });
    }

    public function replacer(): void
    {
        Validator::replacer('exists_field', function ($message, $attribute, $rule, $parameters, $validator) {
            $message = trans('validation.exists');

            $message = str_replace(':attribute', $attribute, $message);

            return $message;
        });
    }
}
