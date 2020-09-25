<?php

namespace HRis\PIM\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Relationship extends EmployeeField
{
    use HasFactory;

    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = ['class' => self::class];

    protected static function newFactory()
    {
        return \Database\Factories\RelationshipFactory::new();
    }
}
