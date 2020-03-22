<?php

namespace HRServices\PIM\Observers;

use HRServices\PIM\Eloquent\TerminationReason;

class TerminationReasonObserver
{
    /**
     * Handle the TerminationReason "created" event.
     *
     * @param  \HRServices\PIM\Eloquent\TerminationReason  $terminationReason
     *
     * @return void
     */
    public function created(TerminationReason $terminationReason): void
    {
        $lastSortOrder = TerminationReason::orderBy('sort_order', 'desc')->first()->sort_order;

        if (is_null($terminationReason->sort_order)) {
            $terminationReason->update(['sort_order' => $lastSortOrder+1]);
        }
    }

    /**
     * Handle the TerminationReason "updated" event.
     *
     * @param  \HRServices\PIM\Eloquent\TerminationReason  $terminationReason
     *
     * @return void
     */
    public function updated(TerminationReason $terminationReason): void
    {
        //
    }

    /**
     * Handle the TerminationReason "deleted" event.
     *
     * @param  \HRServices\PIM\Eloquent\TerminationReason  $terminationReason
     *
     * @return void
     */
    public function deleted(TerminationReason $terminationReason): void
    {
        //
    }

    /**
     * Handle the TerminationReason "forceDeleted" event.
     *
     * @param  \HRServices\PIM\Eloquent\TerminationReason  $terminationReason
     *
     * @return void
     */
    public function forceDeleted(TerminationReason $terminationReason): void
    {
        //
    }
}
