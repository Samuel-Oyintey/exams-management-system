<?php

namespace {

    use SilverStripe\CMS\Controllers\ContentController;
    use SilverStripe\Security\Security;
    use SilverStripe\View\ArrayData;
    use SilverStripe\View\Requirements;
    use Symfony\Contracts\Service\Attribute\Required;

    class PageController extends ContentController
    {
        /**
         * An array of actions that can be accessed via a request. Each array element should be an action name, and the
         * permissions or conditions required to allow the user to access it.
         *
         * <code>
         * [
         *     'action', // anyone can access this action
         *     'action' => true, // same as above
         *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
         *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
         * ];
         * </code>
         *
         * @var array
         */
        private static $allowed_actions = [];

        protected function init()
        {
            parent::init();

            $ThemeDir =  "app/";

            Requirements::css($ThemeDir. 'css/styles.css');
            Requirements::css('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');
            Requirements::css('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css');
            Requirements::javascript('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js');

            // if(!Security::getCurrentUser()){
            //     return $this->redirect('Security/login/?BackURL=dashboard');
            // }
            // You can include any CSS or JS required by your project here.
            // See: https://docs.silverstripe.org/en/developer_guides/templates/requirements/
        }

        public function setSessionMessage($message, $type = 'success')
        {
            $session = $this->getRequest()->getSession();
            $session->set("Page.message", $message);
            $session->set("Page.messageType", $type);
        }

        public function SessionMessage()
        {

            $session = $this->getRequest()->getSession();

            $Message = $session->get('Page.message');
            $Type = $session->get('Page.messageType');

            $session->clear('Page.message');
            $session->clear('Page.messageType');

            if ($Message) {
                return new ArrayData(compact('Message', 'Type'));
            }

            return false;
        }
    }
}
