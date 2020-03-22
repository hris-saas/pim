<?php

namespace HRServices\PIM\Observers;

use HRServices\PIM\Eloquent\JobTitle;

class JobTitleObserver
{
    /**
     * Handle the JobTitle "created" event.
     *
     * @param  \HRServices\PIM\Eloquent\JobTitle  $jobTitle
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
     * @param  \HRServices\PIM\Eloquent\JobTitle  $jobTitle
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
     * @param  \HRServices\PIM\Eloquent\JobTitle  $jobTitle
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
     * @param  \HRServices\PIM\Eloquent\JobTitle  $jobTitle
     *
     * @return void
     */
    public function forceDeleted(JobTitle $jobTitle): void
    {
        //
    }
}
