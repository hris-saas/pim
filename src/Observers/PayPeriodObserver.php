<?php

namespace HRis\PIM\Observers;

use HRis\PIM\Eloquent\PayPeriod;

class PayPeriodObserver
{
    /**
     * Handle the PayPeriod "created" event.
     *
     * @param  \HRis\PIM\Eloquent\PayPeriod  $payPeriod
     *
     * @return void
     */
    public function created(PayPeriod $payPeriod): void
    {
        $lastSortOrder = PayPeriod::orderBy('sort_order', 'desc')->first()->sort_order;

        if (is_null($payPeriod->sort_order)) {
            $payPeriod->update(['sort_order' => $lastSortOrder+1]);
        }
    }

    /**
     * Handle the PayPeriod "updated" event.
     *
     * @param  \HRis\PIM\Eloquent\PayPeriod  $payPeriod
     *
     * @return void
     */
    public function updated(PayPeriod $payPeriod): void
    {
        //
    }

    /**
     * Handle the PayPeriod "deleted" event.
     *
     * @param  \HRis\PIM\Eloquent\PayPeriod  $payPeriod
     *
     * @return void
     */
    public function deleted(PayPeriod $payPeriod): void
    {
        //
    }

    /**
     * Handle the PayPeriod "forceDeleted" event.
     *
     * @param  \HRis\PIM\Eloquent\PayPeriod  $payPeriod
     *
     * @return void
     */
    public function forceDeleted(PayPeriod $payPeriod): void
    {
        //
    }
}
