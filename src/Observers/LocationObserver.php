<?php

namespace HRis\PIM\Observers;

use HRis\PIM\Eloquent\Location;

class LocationObserver
{
    /**
     * Handle the Location "created" event.
     *
     * @param  \HRis\PIM\Eloquent\Location  $location
     *
     * @return void
     */
    public function created(Location $location): void
    {
        $lastSortOrder = Location::orderBy('sort_order', 'desc')->first()->sort_order;

        if (is_null($location->sort_order)) {
            $location->update(['sort_order' => $lastSortOrder+1]);
        }
    }

    /**
     * Handle the Location "updated" event.
     *
     * @param  \HRis\PIM\Eloquent\Location  $location
     *
     * @return void
     */
    public function updated(Location $location): void
    {
        //
    }

    /**
     * Handle the Location "deleted" event.
     *
     * @param  \HRis\PIM\Eloquent\Location  $location
     *
     * @return void
     */
    public function deleted(Location $location): void
    {
        //
    }

    /**
     * Handle the Location "forceDeleted" event.
     *
     * @param  \HRis\PIM\Eloquent\Location  $location
     *
     * @return void
     */
    public function forceDeleted(Location $location): void
    {
        //
    }
}
