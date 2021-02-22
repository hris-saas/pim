<?php

namespace HRis\PIM\Observers;

use HRis\PIM\Eloquent\EmployeeField;

class EmployeeFieldObserver
{
    /**
     * Handle the EmployeeField "created" event.
     *
     * @param  $model
     *
     * @return void
     */
    public function created($model)
    {
        //
    }

    /**
     * Handle the EmployeeField "updating" event.
     *
     * @param  $model
     *
     * @return void
     */
    public function updating($model)
    {
        EmployeeField::updateSortOrder($model);
    }

    /**
     * Handle the EmployeeField "updated" event.
     *
     * @param  $model
     *
     * @return void
     */
    public function updated($model)
    {
        //
    }

    /**
     * Handle the EmployeeField "deleted" event.
     *
     * @param  $model
     *
     * @return void
     */
    public function deleted($model)
    {
        //
    }

    /**
     * Handle the EmployeeField "forceDeleted" event.
     *
     * @param  $model
     *
     * @return void
     */
    public function forceDeleted($model)
    {
        //
    }
}
