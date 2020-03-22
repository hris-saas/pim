<?php

namespace HRServices\PIM\Observers;

use HRServices\PIM\Eloquent\Department;

class DepartmentObserver
{
    /**
     * Handle the Department "created" event.
     *
     * @param  \HRServices\PIM\Eloquent\Department  $department
     *
     * @return void
     */
    public function created(Department $department): void
    {
        $lastSortOrder = Department::orderBy('sort_order', 'desc')->first()->sort_order;

        if (is_null($department->sort_order)) {
            $department->update(['sort_order' => $lastSortOrder+1]);
        }
    }

    /**
     * Handle the Department "updated" event.
     *
     * @param  \HRServices\PIM\Eloquent\Department  $department
     *
     * @return void
     */
    public function updated(Department $department): void
    {
        //
    }

    /**
     * Handle the Department "deleted" event.
     *
     * @param  \HRServices\PIM\Eloquent\Department  $department
     *
     * @return void
     */
    public function deleted(Department $department): void
    {
        //
    }

    /**
     * Handle the Department "forceDeleted" event.
     *
     * @param  \HRServices\PIM\Eloquent\Department  $department
     *
     * @return void
     */
    public function forceDeleted(Department $department): void
    {
        //
    }
}
