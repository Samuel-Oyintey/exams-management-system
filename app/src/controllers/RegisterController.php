<?php

use SilverStripe\Control\HTTPRequest;

class RegisterPageController extends PageController
{
    private static $allowed_actions = [
        "studentRegisterForm",
        "registration_confirm"
    ];

    public function Link($action = null)
    {
        return  "register/$action";
    }

    public function index(HTTPRequest $request)
    {
        return $this->Customise([
        'Title' => 'Create Account',
        ])->renderWith(['Register', 'Page']);
    }

    public function studentRegisterForm()
    {
        return StudentRegistrationForm::create($this, __FUNCTION__);
    }

    public function registration_confirm()
    {
        return $this->customise([
        'Title' => 'Registration Confirmation',
        ])->renderWith(['RegistrationConfirm', 'Page']); 
    }

    public function setSessionMessage($message, $type = 'success')
    {
        $session = $this->getRequest()->getSession();
        $session->set("Page.message", $message);
        $session->set("Page.messageType", $type);
    }
}