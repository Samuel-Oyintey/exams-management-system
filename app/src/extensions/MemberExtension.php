<?php

use SilverStripe\ORM\DataExtension;
use SilverStripe\Assets\Image;

class MemberExtension extends DataExtension
{

    private static $db = [
        'StudentID' => "Varchar(13)",
    ];

    private static $has_one = [
        "ProfilePhoto" => Image::class,
        "Department" => Departments::class
    ];

    private static $has_many = [
        'Payments' => Payments::class
    ];

    public function getDepartmentName()
    {
        if ($this->owner->DepartmentID && $this->owner->Department()) {
            return $this->owner->Department()->Name;
        }
        return '';
    }

    public function onBeforeWrite()
    {
        parent::onBeforeWrite();

        if (!$this->owner->StudentID) {
            // Generate the student ID
            $this->owner->StudentID = $this->generateStudentID();
        }
    }

    protected function generateStudentID()
    {
        // Logic to generate the student ID
        // You can modify this based on your requirements
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $idLength = 13;
        $studentID = '';

        for ($i = 0; $i < $idLength; $i++) {
            $randomIndex = mt_rand(0, strlen($characters) - 1);
            $studentID .= $characters[$randomIndex];
        }

        return $studentID;
    }

}