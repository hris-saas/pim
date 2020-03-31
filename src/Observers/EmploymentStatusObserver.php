<?php

namespace HRis\PIM\Observers;

use HRis\PIM\Eloquent\EmploymentStatus;

class EmploymentStatusObserver
{
    /**
     * Handle the EmploymentStatus "created" event.
     *
     * @param  \HRis\PIM\Eloquent\EmploymentStatus  $employmentStatus
     *
     * @return void
     */
    public function created(EmploymentStatus $employmentStatus): void
    {
        $lastSortOrder = EmploymentStatus::orderBy('sort_order', 'desc')->first()->sort_order;

        if (is_null($employmentStatus->sort_order)) {
            $employmentStatus->update(['sort_order' => $lastSortOrder+1]);
        }
    }

    /**
     * Handle the EmploymentStatus "updated" event.
     *
     * @param  \HRis\PIM\Eloquent\EmploymentStatus  $employmentStatus
     *
     * @return void
     */
    public function updated(EmploymentStatus $employmentStatus): void
    {
        //
    }

    /**
     * Handle the EmploymentStatus "deleted" event.
     *
     * @param  \HRis\PIM\Eloquent\EmploymentStatus  $employmentStatus
     *
     * @return void
     */
    public function deleted(EmploymentStatus $employmentStatus): void
    {
        //
    }

    /**
     * Handle the EmploymentStatus "forceDeleted" event.
     *
     * @param  \HRis\PIM\Eloquent\EmploymentStatus  $employmentStatus
     *
     * @return void
     */
    public function forceDeleted(EmploymentStatus $employmentStatus): void
    {
        //
    }
}
