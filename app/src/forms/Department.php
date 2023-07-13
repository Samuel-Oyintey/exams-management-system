<?php

use SilverStripe\Control\HTTPRequest;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\TextField;

class AddDepartmentForm extends Form
{
    public function __construct($controller, $name)
    {
        $fields = new FieldList([
            TextField::create('Name', 'Department Name')
            ->addExtraClass('form-control'),
        ]);

        $actions = FieldList::create(
			FormAction::create('save')->setTitle("Add")
				->addExtraClass('btn btn-primary')
		);

        $validator = new RequiredFields('Name');

        parent::__construct($controller, $name, $fields, $actions, $validator);

    }

    public function save($data, $form,  HTTPRequest $request)
    {
        $session = $request->getSession();

        if (!empty($data['Name']))  
        {
            $d = Departments::get()->filter("Name", $data['Name'])->first();

            if ($d)
            {
                $form->sessionMessage("Sorry, department already exist..", 'error');

                return $this->controller->redirectBack();
            }
        } else {
            $this->controller->setSessionMessage("Sorry, email address field is required", 'danger');
            return $this->controller->redirectBack();
        }

        $d = new Departments();

        $form->saveInto($d);

        $d->write();
        
        $form->sessionMessage('Department Added Successfully!','good');

        // return $this->controller->redirectBack();

        return $this->controller->redirect("dashboard/departments/");
 
    } 

    public function getDepartmentName()
    {
        if ($this->DepartmentID && $this->Department()) {
            return $this->Department()->Name;
        }
        return '';
    }
}