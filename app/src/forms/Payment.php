<?php

use SilverStripe\Control\HTTPRequest;
use SilverStripe\Forms\CompositeField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\HiddenField;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\TextField;
use SilverStripe\Security\Group;
use SilverStripe\Security\Member;

class AddPaymentForm extends Form
{
    public function __construct($controller, $name)
    {
        $groupCode = "users";
        $group = Group::get()->filter('Code', $groupCode)->first(); 
        if ($group) {
            $members = $group->Members()->map('ID', 'FirstName'); // Fetch all members of the group and map their IDs to first names
        }

        $fields = new FieldList([
            
            CompositeField::create(
                CompositeField::create(
                    DropdownField::create(
                        'MemberID',
                        'Select Member',
                        $members,
                    )->addExtraClass('form-control')
                )->addExtraClass('col-md-6'),

                CompositeField::create(
                    DropdownField::create(
                        'PaymentType',
                        'Payment Type', ['School Fees' => 'School Fees', 'Hostel Fees' => 'Hostel Fees'])
                        ->setEmptyString('--Select Payment Type--')
                    ->addExtraClass('form-control')
                )->addExtraClass('col-md-6'),

                CompositeField::create(
                    TextField::create(
                        'Amount',
                        'Amount (GHC)'
                    )->addExtraClass('form-control')
                )->addExtraClass('col-md-6'),
            )->addExtraClass('row'),

            HiddenField::create('PaymentStatus','', 'pending'),
            
        ]);

        $actions = FieldList::create(
			FormAction::create('save')->setTitle("Pay")
				->addExtraClass('btn btn-primary')
		);

        $validator = new RequiredFields('MemberID');

        parent::__construct($controller, $name, $fields, $actions, $validator);

    }

    public function save($data, $form)
    {
        
        $p = new Payments();

        $form->saveInto($p);

        $p->write();
        
        $form->sessionMessage('Payment is Successful!','good');

        return $this->controller->redirectBack();
 
    } 
}