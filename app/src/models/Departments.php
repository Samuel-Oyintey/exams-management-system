<?php

use SilverStripe\ORM\DataObject;

class Departments extends DataObject
{
    private static $db = [
        'Name' => 'Varchar(255)',
    ];
    
}