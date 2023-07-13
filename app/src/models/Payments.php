<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Member;

class Payments extends DataObject
{
    private static $db = [
        'Amount' => 'Currency',
        'PaymentType' => 'Enum("School Fees,Hostel Fees,Dues")',
        'PaymentStatus' => 'Varchar'
    ];

    private static $has_one = [
        'Member' => Member::class
    ];
}