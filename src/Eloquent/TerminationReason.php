<?php

namespace HRis\PIM\Eloquent;

use Illuminate\Database\Eloquent\Model;

class TerminationReason extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'sort_order', 'name', 'created_at', 'updated_at', 'deleted_at'];
}
