<?php

use SilverStripe\ORM\DataObject;

class Courses extends DataObject
{
    private static $db = [
        'Title' => 'Varchar(255)',
    ];
}