<?php

namespace HRServices\PIM\Observers;

use HRServices\PIM\Eloquent\MaritalStatus;

class MaritalStatusObserver
{
    /**
     * Handle the MaritalStatus "created" event.
     *
     * @param  \HRServices\PIM\Eloquent\MaritalStatus  $maritalStatus
     *
     * @return void
     */
    public function created(MaritalStatus $maritalStatus): void
    {
        $lastSortOrder = MaritalStatus::orderBy('sort_order', 'desc')->first()->sort_order;

        if (is_null($maritalStatus->sort_order)) {
            $maritalStatus->update(['sort_order' => $lastSortOrder+1]);
        }
    }

    /**
     * Handle the MaritalStatus "updated" event.
     *
     * @param  \HRServices\PIM\Eloquent\MaritalStatus  $maritalStatus
     *
     * @return void
     */
    public function updated(MaritalStatus $maritalStatus): void
    {
        //
    }

    /**
     * Handle the MaritalStatus "deleted" event.
     *
     * @param  \HRServices\PIM\Eloquent\MaritalStatus  $maritalStatus
     *
     * @return void
     */
    public function deleted(MaritalStatus $maritalStatus): void
    {
        //
    }

    /**
     * Handle the MaritalStatus "forceDeleted" event.
     *
     * @param  \HRServices\PIM\Eloquent\MaritalStatus  $maritalStatus
     *
     * @return void
     */
    public function forceDeleted(MaritalStatus $maritalStatus): void
    {
        //
    }
}
