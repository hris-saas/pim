<?php

namespace HRis\PIM\Validators;

use Illuminate\Support\Facades\Validator;
use HRis\Core\Validators\ValidatorInterface;

class SortOrderFieldValidator implements ValidatorInterface
{
    public function handle(): void
    {
        $this->extend();

        $this->replacer();
    }

    public function extend(): void
    {
        Validator::extend('sort_order_field', function ($attribute, $value, $parameters, $validator) {
            [$table] = $parameters;

            $fields = (new $table())::$fields;

            $key = request()->segment(2);

            $model = (new $fields[$key]);

            if ($value <= 0 || $value > (new $model)::count()) {
                return false;
            }

            return true;
        });
    }

    public function replacer(): void
    {
        Validator::replacer('sort_order_field', function ($message, $attribute, $rule, $parameters, $validator) {
            return $message;
        });
    }
}
