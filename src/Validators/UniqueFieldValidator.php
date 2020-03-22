<?php

namespace HRServices\PIM\Validators;

use Illuminate\Support\Facades\Validator;
use HRServices\Core\Validators\ValidatorInterface;

class UniqueFieldValidator implements ValidatorInterface
{
    public function handle(): void
    {
        $this->extend();

        $this->replacer();
    }

    public function extend(): void
    {
        Validator::extend('unique_field', function ($attribute, $value, $parameters, $validator) {
            [$table, $column] = $parameters;

            $ignoreId = isset($parameters[2]) ? $parameters[2] : null;
            
            $fields = (new $table())::$fields;

            $key = request()->segment(2);
            
            $model = (new $fields[$key]);

            if (is_null($ignoreId)) {
                return ! $model::where($column, $value)->first();
            }

            return ! $model::where($column, $value)->where($model->getKeyName(), '!=', $ignoreId)->first();
        });
    }

    public function replacer(): void
    {
        Validator::replacer('unique_field', function ($message, $attribute, $rule, $parameters, $validator) {
            $message = trans('validation.unique');

            $message = str_replace(':attribute', $attribute, $message);

            return $message;
        });
    }
}
