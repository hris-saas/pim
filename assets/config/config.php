<?php

use HRis\PIM\Eloquent\PayType;
use HRis\PIM\Eloquent\Division;
use HRis\PIM\Eloquent\JobTitle;
use HRis\PIM\Eloquent\Location;
use HRis\PIM\Eloquent\PayPeriod;
use HRis\PIM\Eloquent\Department;
use HRis\PIM\Eloquent\Relationship;
use HRis\PIM\Eloquent\MaritalStatus;
use HRis\PIM\Eloquent\EmploymentStatus;
use HRis\PIM\Eloquent\TerminationReason;

return [
    'database' => [

        'migrations' => [

            'order' => ['core', 'auth', 'pim'],
        ],
    ],

    'models' => [

        'employee-fields' => [
            'departments'         => Department::class,
            'divisions'           => Division::class,
            'job-titles'          => JobTitle::class,
            'locations'           => Location::class,
            'pay-periods'         => PayPeriod::class,
            'pay-types'           => PayType::class,
            'relationships'       => Relationship::class,
            'termination-reasons' => TerminationReason::class,
        ],

        'statuses' => [
            'employment-statuses' => EmploymentStatus::class,
            'marital-statuses'    => MaritalStatus::class,
        ],
    ],
];
