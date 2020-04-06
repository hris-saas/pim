<?php

namespace HRis\PIM\Observers;

use HRis\PIM\Eloquent\Relationship;

class RelationshipObserver
{
    /**
     * Handle the Relationship "created" event.
     *
     * @param  \HRis\PIM\Eloquent\Relationship  $relationship
     *
     * @return void
     */
    public function created(Relationship $relationship): void
    {
        $lastSortOrder = Relationship::orderBy('sort_order', 'desc')->first()->sort_order;

        if (is_null($relationship->sort_order)) {
            $relationship->update(['sort_order' => $lastSortOrder+1]);
        }
    }

    /**
     * Handle the Relationship "updated" event.
     *
     * @param  \HRis\PIM\Eloquent\Relationship  $relationship
     *
     * @return void
     */
    public function updated(Relationship $relationship): void
    {
        //
    }

    /**
     * Handle the Relationship "deleted" event.
     *
     * @param  \HRis\PIM\Eloquent\Relationship  $relationship
     *
     * @return void
     */
    public function deleted(Relationship $relationship): void
    {
        //
    }

    /**
     * Handle the Relationship "forceDeleted" event.
     *
     * @param  \HRis\PIM\Eloquent\Relationship  $relationship
     *
     * @return void
     */
    public function forceDeleted(Relationship $relationship): void
    {
        //
    }
}
