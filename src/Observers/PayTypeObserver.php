<?php

namespace HRServices\PIM\Observers;

use HRServices\PIM\Eloquent\PayType;

class PayTypeObserver
{
    /**
     * Handle the PayType "created" event.
     *
     * @param  \HRServices\PIM\Eloquent\PayType  $payType
     *
     * @return void
     */
    public function created(PayType $payType): void
    {
        $lastSortOrder = PayType::orderBy('sort_order', 'desc')->first()->sort_order;

        if (is_null($payType->sort_order)) {
            $payType->update(['sort_order' => $lastSortOrder+1]);
        }
    }

    /**
     * Handle the PayType "updated" event.
     *
     * @param  \HRServices\PIM\Eloquent\PayType  $payType
     *
     * @return void
     */
    public function updated(PayType $payType): void
    {
        //
    }

    /**
     * Handle the PayType "deleted" event.
     *
     * @param  \HRServices\PIM\Eloquent\PayType  $payType
     *
     * @return void
     */
    public function deleted(PayType $payType): void
    {
        //
    }

    /**
     * Handle the PayType "forceDeleted" event.
     *
     * @param  \HRServices\PIM\Eloquent\PayType  $payType
     *
     * @return void
     */
    public function forceDeleted(PayType $payType): void
    {
        //
    }
}
