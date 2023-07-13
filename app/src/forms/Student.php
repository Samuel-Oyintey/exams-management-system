<?php

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Control\Email\Email;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Forms\CompositeField;
use SilverStripe\Forms\ConfirmedPasswordField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\FileField;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\TextField;
use SilverStripe\Security\Group;
use SilverStripe\Security\Member;
use SilverStripe\Security\RandomGenerator;
use SilverStripe\Security\Security;


class StudentRegistrationForm extends Form
{
    public function __construct($controller, $name)
    {
        $fields = new FieldList([
            CompositeField::create(LiteralField::create('notice', '<div class="alert alert-info">Please provide your Correct Details as these will appear on your certificates.</div>'))->addExtraClass('col-sm-12'),
            CompositeField::create(
                CompositeField::create(
                    TextField::create(
                        'Surname',
                        'Surname'
                    )->addExtraClass('form-control'),

                    TextField::create(
                        'FirstName',
                        'First Name'
                    )->addExtraClass('form-control'),
                
                    EmailField::create(
                        'Email',
                        'Email Address'
                    )->addExtraClass('form-control'),
                
                    DropdownField::create(
                        'Department', 
                        'Departments', 
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
                    ),
                )->addExtraClass('form-control'),

            )->addExtraClass('row')
        ]);

        $actions = FieldList::create(
			FormAction::create('register')->setTitle("Save")
				->addExtraClass('btn btn-success')
		);

        $upload->getValidator()->setAllowedExtensions(['png', 'jpg', 'jpeg', 'gif']);
        $upload->setFolderName('Students-Profile-Images');

        $validator = new RequiredFields(
			'Surname',
			'FirstName',
			'Email',
            'Password'
        );

        parent::__construct($controller, $name, $fields, $actions, $validator, $upload);
    }

    public function register($data, $form,  HTTPRequest $request)
    {
        $session = $request->getSession();

        if (!empty($data['Email']))  
        {
            $member = Member::get()->filter("Email", $data['Email'])->first();

            if ($member)
            {
                $form->sessionMessage("Sorry, email is already in use..", 'error');

                return $this->controller->redirect("register/");
            }
        } else {
            $this->controller->setSessionMessage("Sorry, email address field is required", 'danger');
            return $this->controller->redirect("register/");
        }

        $member = new Member();

        $form->saveInto($member);

        // $studentID = $this->generateUniqueStudentID();
        // $member->StudentID = $studentID;

        $member->write();
        
        $member->addToGroupByCode("Users");

        $form->sessionMessage('Your Registration is Successful!','good');

        return $this->controller->redirect("register/registration-confirm");

    }


    // private function generateUniqueStudentID()
    // {
    //     $generator = new RandomGenerator();
    //     $studentID = $generator->randomToken('alnum', 8); // Generate an alphanumeric ID with 8 characters

    //     // Check if the generated student ID already exists
    //     $existingMember = Member::get()->filter('StudentID', $studentID)->first();
    //     if ($existingMember) {
    //         // If the generated ID already exists, generate a new one recursively
    //         return $this->generateUniqueStudentID();
    //     }

    //     return $studentID;
    // }

    // private function getRegistrationEmailBody($member, $password)
    // {
    //     // Customize the email body content as needed
    //     $body = "Thank you for registering as a student. Your Student ID is: " . $member->StudentID;
    //     $body .= "\n\n";
    //     $body .= "Your username is: " . $member->Email;
    //     $body .= "\n";
    //     $body .= "Your password is: " . $password;

    //     return $body;
    // }

}