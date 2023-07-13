<?php

use SilverStripe\Security\Member;
use SilverStripe\Control\Controller;
use SilverStripe\Control\Director;
use SilverStripe\ORM\ArrayList;
use SilverStripe\Security\Security;


/**
 *
 * Secured Page inherited by all restricted pages for registered users only
 *
 */

class SecuredPageController extends PageController
{
    private static $allowed_actions = [];

    public function init()
    {
        parent::init();
        $member = Security::getCurrentUser();
        // Check if user is logged in
        if (!$member) {
            $link = urlencode($this->request->getURL());

            $this->response->removeHeader('Location');
            return $this->redirect("Security/login?BackURL=dashboard");
        }

        // if ($this->firstVisit()) {
        //     $this->setSessionMessage("Please complete your account information", 'info');

        //     return $this->redirect("profile/");
        // }

        // $controller = $this->URLSegment;
        // $excludedControllers = [
        //     "ProfilePageController",
        // ];

        // if (!$this->isProfileComplete() && !in_array($controller, $excludedControllers)) {
        //     $this->setSessionMessage("Please complete your account information", 'info');
        //     return $this->redirect("profile");
        // }

        // if(!$this->isVerified()){
        //     $this->setSessionMessage("Your account has not yet been approved", 'info');
        //     return $this->redirect("profile/pending");
        // }
    }

    /**
     *
     * Check if user profile complete
     * @return Boolean
     */
    // public function isProfileComplete(): bool
    // {
    //     $member = Security::getCurrentUser();
    //     return (!empty($member->EmergencyContactName) && !empty($member->EmergencyContactPhone));
    // }

        /**
     *
     * Check if user profile complete
     * @return Boolean
     */
    // public function isVerified(): bool
    // {
    //     $member = Security::getCurrentUser();
    //     return ($member->Verified);
    // }

    // public function firstVisit()
    // {
    //     $member = Security::getCurrentUser();
    //     if ($member->NumVisit == 1) {
    //         $member->NumVisit = 2;
    //         $member->write();
    //         return true;
    //     }
    //     return false;
    // }

}