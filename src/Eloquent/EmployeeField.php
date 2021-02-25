<?php

namespace HRis\PIM\Eloquent;

use Illuminate\Support\Arr;
use HRis\Core\Traits\HasClass;
use HRis\Core\Traits\HasSortOrder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeField extends Model
{
    use HasClass, HasSortOrder, HasTranslations, SoftDeletes;

    public static array $fields = [
        'departments'         => Department::class,
        'divisions'           => Division::class,
        'employment-statuses' => EmploymentStatus::class,
        'job-titles'          => JobTitle::class,
        'locations'           => Location::class,
        'marital-statuses'    => MaritalStatus::class,
        'pay-periods'         => PayPeriod::class,
        'pay-types'           => PayType::class,
        'relationships'       => Relationship::class,
        'termination-reasons' => TerminationReason::class,
    ];

    public $translatable = ['name'];

    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = ['class' => self::class];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'sort_order', 'name', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'employee_fields';

    /**
     * Update the sort order of other records in the database.
     *
     * @param $record
     */
    public static function updateSortOrder($record)
    {
        // check if sort_order is in dirty array
        if (array_key_exists('sort_order', $record->getDirty())) {
            $newSortOrder = $record->sort_order;
            $oldSortOrder = Arr::get($record->getOriginal(), 'sort_order');
            $maxSortOrder = max($newSortOrder, $oldSortOrder);

            $model = get_class($record);

            // query other records in the model
            $records = (new $model)::where('id', '!=', $record->id)->orderBy('sort_order')->get();

            // update the other records without events so it won't repeat the call
            (new $model)::withoutEvents(function () use ($records, $newSortOrder, $maxSortOrder) {
                $sortOrder = 1;

                foreach ($records as $record) {

                    // $maxSortOrder reached, bail out
                    if ($sortOrder == $maxSortOrder) {
                        break;
                    }

                    if ($sortOrder == $newSortOrder) {
                        $sortOrder++;
                    }

                    $record->update(['sort_order' => $sortOrder++]);
                }
            });
        }
    }
}
