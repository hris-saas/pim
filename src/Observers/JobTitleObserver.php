<?php

namespace HRis\PIM\Observers;

use HRis\PIM\Eloquent\JobTitle;

class JobTitleObserver
{
    /**
     * Handle the JobTitle "created" event.
     *
     * @param  \HRis\PIM\Eloquent\JobTitle  $jobTitle
     *
     * @return void
     */
    public function created(JobTitle $jobTitle): void
    {
        $lastSortOrder = JobTitle::orderBy('sort_order', 'desc')->first()->sort_order;

        if (is_null($jobTitle->sort_order)) {
            $jobTitle->update(['sort_order' => $lastSortOrder+1]);
        }
    }

    /**
     * Handle the JobTitle "updated" event.
     *
     * @param  \HRis\PIM\Eloquent\JobTitle  $jobTitle
     *
     * @return void
     */
    public function updated(JobTitle $jobTitle): void
    {
        //
    }

    /**
     * Handle the JobTitle "deleted" event.
     *
     * @param  \HRis\PIM\Eloquent\JobTitle  $jobTitle
     *
     * @return void
     */
    public function deleted(JobTitle $jobTitle): void
    {
        //
    }

    /**
     * Handle the JobTitle "forceDeleted" event.
     *
     * @param  \HRis\PIM\Eloquent\JobTitle  $jobTitle
     *
     * @return void
     */
    public function forceDeleted(JobTitle $jobTitle): void
    {
        //
    }
}
