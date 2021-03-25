<?php

use HRis\PIM\Eloquent\Status;
use HRis\PIM\Eloquent\PayType;
use HRis\PIM\Eloquent\Division;
use HRis\PIM\Eloquent\JobTitle;
use HRis\PIM\Eloquent\Location;
use HRis\PIM\Eloquent\PayPeriod;
use HRis\PIM\Eloquent\Department;
use HRis\PIM\Eloquent\ChangeReason;
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
            'change-reasons'      => ChangeReason::class,
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
            'statuses'            => Status::class,
            'employment-statuses' => EmploymentStatus::class,
            'marital-statuses'    => MaritalStatus::class,
        ],
    ],

    'permissions' => [
        'pim::department.index',
        'pim::department.store',
        'pim::department.show',
        'pim::department.update',
        'pim::department.destroy',
        'pim::department.restore',
        'pim::division.index',
        'pim::division.store',
        'pim::division.show',
        'pim::division.update',
        'pim::division.destroy',
        'pim::division.restore',
        'pim::employee.index',
        'pim::employee.store',
        'pim::employee.show',
        'pim::employee.update',
        'pim::employee.destroy',
        'pim::employee.address.index',
        'pim::employee.address.store',
        'pim::employee.address.show',
        'pim::employee.address.update',
        'pim::employee.address.destroy',
        'pim::employee.compensation.index',
        'pim::employee.compensation.store',
        'pim::employee.compensation.show',
        'pim::employee.compensation.update',
        'pim::employee.compensation.destroy',
        'pim::employee.direct-report.index',
        'pim::employee.emergency-contact.index',
        'pim::employee.emergency-contact.store',
        'pim::employee.emergency-contact.show',
        'pim::employee.emergency-contact.update',
        'pim::employee.emergency-contact.destroy',
        'pim::employee.employment-status.index',
        'pim::employee.employment-status.store',
        'pim::employee.employment-status.show',
        'pim::employee.employment-status.update',
        'pim::employee.employment-status.destroy',
        'pim::employee.indirect-report.index',
        'pim::employee.job.index',
        'pim::employee.job.store',
        'pim::employee.job.show',
        'pim::employee.job.update',
        'pim::employee.job.destroy',
        'pim::employment-status.index',
        'pim::employment-status.store',
        'pim::employment-status.show',
        'pim::employment-status.update',
        'pim::employment-status.destroy',
        'pim::employment-status.restore',
        'pim::job-title.index',
        'pim::job-title.store',
        'pim::job-title.show',
        'pim::job-title.update',
        'pim::job-title.destroy',
        'pim::job-title.restore',
        'pim::location.index',
        'pim::location.store',
        'pim::location.show',
        'pim::location.update',
        'pim::location.destroy',
        'pim::location.restore',
        'pim::marital-status.index',
        'pim::marital-status.store',
        'pim::marital-status.show',
        'pim::marital-status.update',
        'pim::marital-status.destroy',
        'pim::marital-status.restore',
        'pim::pay-period.index',
        'pim::pay-period.store',
        'pim::pay-period.show',
        'pim::pay-period.update',
        'pim::pay-period.destroy',
        'pim::pay-period.restore',
        'pim::pay-type.index',
        'pim::pay-type.store',
        'pim::pay-type.show',
        'pim::pay-type.update',
        'pim::pay-type.destroy',
        'pim::pay-type.restore',
        'pim::relationship.index',
        'pim::relationship.store',
        'pim::relationship.show',
        'pim::relationship.update',
        'pim::relationship.destroy',
        'pim::relationship.restore',
        'pim::termination-reason.index',
        'pim::termination-reason.store',
        'pim::termination-reason.show',
        'pim::termination-reason.update',
        'pim::termination-reason.destroy',
        'pim::termination-reason.restore',
    ],
];
