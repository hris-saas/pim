<?php

namespace HRis\PIM\Observers;

use HRis\PIM\Eloquent\Division;

class DivisionObserver
{
    /**
     * Handle the Division "created" event.
     *
     * @param  \HRis\PIM\Eloquent\Division  $division
     *
     * @return void
     */
    public function created(Division $division): void
    {
        $lastSortOrder = Division::orderBy('sort_order', 'desc')->first()->sort_order;

        if (is_null($division->sort_order)) {
            $division->update(['sort_order' => $lastSortOrder+1]);
        }
    }

    /**
     * Handle the Division "updated" event.
     *
     * @param  \HRis\PIM\Eloquent\Division  $division
     *
     * @return void
     */
    public function updated(Division $division): void
    {
        //
    }

    /**
     * Handle the Division "deleted" event.
     *
     * @param  \HRis\PIM\Eloquent\Division  $division
     *
     * @return void
     */
    public function deleted(Division $division): void
    {
        //
    }

    /**
     * Handle the Division "forceDeleted" event.
     *
     * @param  \HRis\PIM\Eloquent\Division  $division
     *
     * @return void
     */
    public function forceDeleted(Division $division): void
    {
        //
    }
}
