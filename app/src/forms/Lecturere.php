<?php

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Forms\ConfirmedPasswordField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\FileField;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\TextField;
use SilverStripe\Security\Member;

class AddLecturereForm extends Form
{
    public function __construct($controller, $name)
    {
        $fields = new FieldList([
            TextField::create('FirstName', 'First Name')
            ->addExtraClass('form-control'),

            TextField::create('Surname', 'Surname')
            ->addExtraClass('form-control'),

            TextField::create('Email', 'Email Address')
            ->addExtraClass('form-control'),

            DropdownField::create(
                'Department', 
                'Department', 
                Departments::get()->map('ID', 'Name')
            ) ->setEmptyString('Select Department')
            ->addExtraClass('form-control'),

            $upload = FileField::create(
                'ProfilePhoto',
                'Profile Photo'
            )->addExtraClass('form-control'),

            ConfirmedPasswordField::create(
                'Password',
                'Password'
            )->addExtraClass('form-control'),

        ]);

        $actions = FieldList::create(
			FormAction::create('save')->setTitle("Save & Continue")
				->addExtraClass('btn btn-primary')
		);

        $upload->getValidator()->setAllowedExtensions(['png', 'jpg', 'jpeg', 'gif']);
        $upload->setFolderName('Lectureres-Profile-Images');

        $validator = new RequiredFields('FirstName', 'Surname', 'Email', 'Department', 'Password');

        parent::__construct($controller, $name, $fields, $actions, $validator);

    }

    public function save($data, $form,  HTTPRequest $request)
    {
        $session = $request->getSession();

        if (!empty($data['Email']))
        {
            $member = Member::get()->filter("Email", $data['Email'])->first();
            if ($member)
            {
                $form->sessionMessage("Sorry, email is already in use..", 'error');
                return $this->controller->redirect("dashboard/lectureres/");
            }
        }

        $member = new Member();
        $form->saveInto($member);
        $member->write();
        $member->addToGroupByCode("Lectureres");
        
        return $this->controller->redirectBack();
            
    } 
}