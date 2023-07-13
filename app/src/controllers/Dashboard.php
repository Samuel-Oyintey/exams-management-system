
<?php

use GuzzleHttp\Promise\Create;
use SilverStripe\Security\Member;
use SilverStripe\Security\Security;
use SilverStripe\View\ArrayData;
use SilverStripe\View\Requirements;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\ORM\ArrayList;
use SilverStripe\Security\Group;

class  DashboardController extends SecuredPageController
{

    private static $allowed_actions = [
        'accountants',
        'lectureres',
        'students',
        'disciplinary_committee',
        'departments',
        'profile',
        'addDepartment',
        'addLectureres',
        'addAccountants',
        'addDisciplinaryCommittee',
        'payments',
        'payment_history',
        'addPaymentForm'
    ];

    public function init()
    {
        parent::init();

        $ThemeDir =  "app/";

        // New Dashboard

        // css
        Requirements::css($ThemeDir . 'css/dashboard/assets/css/core.css');
        Requirements::css($ThemeDir . 'css/dashboard/assets/css/demo.css');
        Requirements::css($ThemeDir . 'css/dashboard/assets/css/theme-default.css');
       
        //libs
        Requirements::css($ThemeDir . 'css/dashboard/assets/libs/apex-charts.css');
        Requirements::css($ThemeDir . 'css/dashboard/assets/libs/perfect-scrollbar.css');

        //Fonts
        Requirements::css($ThemeDir . 'css/dashboard/assets/fonts/boxicons.css');

        //js
        Requirements::javascript($ThemeDir . 'javascript/dashboard-js/assets/js/helpers.js');
        Requirements::javascript($ThemeDir . 'javascript/dashboard-js/assets/js/config.js');
        Requirements::javascript($ThemeDir . 'javascript/dashboard-js/assets/js/menu.js');
        Requirements::javascript($ThemeDir . 'javascript/dashboard-js/assets/js/main.js');
        Requirements::javascript($ThemeDir . 'javascript/dashboard-js/assets/libs/popper.js');
        Requirements::javascript($ThemeDir . 'javascript/dashboard-js/assets/js/bootstrap.js');
        Requirements::javascript($ThemeDir . 'javascript/dashboard-js/assets/libs/perfect-scrollbar.js');

        Requirements::javascript(' https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.js'); 
        Requirements::javascript('https://buttons.github.io/buttons.js');
        Requirements::javascript(' https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.js'); 
       
        // datatable
        Requirements::css('//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css');
        Requirements::css('https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.css');
        Requirements::css('https://use.fontawesome.com/releases/v5.6.3/css/all.css');
        Requirements::css('https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.css');
        Requirements::css('https://cdn.datatables.net/autofill/2.3.9/css/autoFill.dataTables.min.css');
        Requirements::css('https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css');
        Requirements::css('https://cdn.datatables.net/colreorder/1.5.5/css/colReorder.dataTables.min.css');
        Requirements::css('https://cdn.datatables.net/1.11.5/css/dataTables.jqueryui.min.css');
        Requirements::css('https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css');
        Requirements::css('https://cdn.datatables.net/rowgroup/1.1.4/css/rowGroup.dataTables.min.css');
        Requirements::css('https://cdn.datatables.net/scroller/2.0.5/css/scroller.dataTables.min.css');
        Requirements::css('https://cdn.datatables.net/autofill/2.3.7/css/autoFill.jqueryui.min.css');
        Requirements::css('https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css');
        Requirements::css('https://cdn.datatables.net/buttons/2.2.2/css/buttons.jqueryui.min.css');
        Requirements::css('https://cdn.datatables.net/colreorder/1.5.5/css/colReorder.jqueryui.min.css');
        Requirements::css('https://cdn.datatables.net/keytable/2.6.4/css/keyTable.dataTables.min.css');
        Requirements::css('https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css');
        Requirements::css('https://unpkg.com/feather-icons');
        Requirements::css('https://cdn.datatables.net/scroller/2.0.5/css/scroller.dataTables.min.css');

        Requirements::javascript('https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.js');
        Requirements::javascript('https://kit.fontawesome.com/6dc44d80e7.js');
        Requirements::javascript('https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js');
        Requirements::javascript('https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js');
        Requirements::javascript('//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js');
        Requirements::javascript('https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js');
        Requirements::javascript('https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table-locale-all.min.js');
        Requirements::javascript('https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js');
        Requirements::javascript('https://unpkg.com/bootstrap-table@1.19.1/dist/extensions/export/bootstrap-table-export.min.js');
        Requirements::javascript('https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js');
        Requirements::javascript('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js');
        Requirements::javascript('https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.js');
        // pagination
        Requirements::javascript('https://cdn.datatables.net/plug-ins/1.11.5/pagination/jPaginator/dataTables.jPaginator.js');
        Requirements::javascript('https://cdn.datatables.net/plug-ins/1.11.5/pagination/ellipses.js');
        Requirements::javascript('https://cdn.datatables.net/plug-ins/1.11.5/pagination/four_button.js');
        Requirements::javascript('https://cdn.datatables.net/plug-ins/1.11.5/pagination/full_numbers_no_ellipses.js');
        Requirements::javascript('https://cdn.datatables.net/plug-ins/1.11.5/pagination/select.js');
        Requirements::javascript('https://cdn.datatables.net/plug-ins/1.11.5/pagination/simple_incremental_bootstrap.js');
        Requirements::javascript('https://cdn.datatables.net/autofill/2.3.9/js/dataTables.autoFill.min.js');
        Requirements::javascript('https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js');
        Requirements::javascript('https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js');
        Requirements::javascript('https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js');
        Requirements::javascript('https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js');
        Requirements::javascript('https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js');
        Requirements::javascript('https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js');
        Requirements::javascript('https://cdn.datatables.net/1.11.5/js/dataTables.jqueryui.min.js');
        Requirements::javascript('https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js');
        Requirements::javascript('https://cdn.datatables.net/rowgroup/1.1.4/js/dataTables.rowGroup.min.js');
        Requirements::javascript('https://cdn.datatables.net/scroller/2.0.5/js/dataTables.scroller.min.js');
        Requirements::javascript('https://cdn.datatables.net/autofill/2.3.7/js/dataTables.autoFill.min.js');
        Requirements::javascript('https://cdn.datatables.net/autofill/2.3.7/js/autoFill.jqueryui.min.js');
        Requirements::javascript('https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js');
        Requirements::javascript('https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js');
        Requirements::javascript('https://cdn.datatables.net/buttons/2.2.2/js/buttons.jqueryui.min.js');
        Requirements::javascript('https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js');
        Requirements::javascript('https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js');
        Requirements::javascript('https://cdn.datatables.net/colreorder/1.5.5/js/dataTables.colReorder.min.js');
        Requirements::javascript('https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js');
        Requirements::javascript('https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js');
        Requirements::javascript('https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js');
        Requirements::javascript('https://cdn.datatables.net/keytable/2.6.4/js/dataTables.keyTable.min.js');
        Requirements::javascript('https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js');
        Requirements::javascript('https://unpkg.com/feather-icons');
        Requirements::javascript('https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js');
        Requirements::javascript('https://cdn.datatables.net/scroller/2.0.5/js/dataTables.scroller.min.js');
        Requirements::javascript('https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js');



       //eterna Js
        Requirements::customScript(
            <<<JS
                $(document).ready(function() {
                    $('#myTable').DataTable();
                });
            JS
        );

    }


    //links for routing
    public function Link($action = null)
    {
        return "dashboard/$action";
    }

    public function index(HTTPRequest $request)
    {
        return $this->customise([
            'PageTitle' => 'Dashboard'
        ]);
    }

    public function accountants()
    {
        $groupCodeName = 'accountants';

        $group = Group::get()->filter('Code', $groupCodeName)->first();

        if ($group) {
            $members = $group->Members();

            $data = [
                'Accountants' => $members,
            ];

            return $this->customise($data)->render();
        }

        return $this->customise([
            'PageTitle' => 'Accountants',
            'Accountants' => ArrayList::create(), // or an empty ArrayList depending on your requirements
        ]);
        
    }

    // public function lectureres()
    // {
    //     $groupCodeName = 'lectureres';

    //     $group = Group::get()->filter('Code', $groupCodeName)->first();

    //     if ($group) {
    //         $members = $group->Members();

    //         $data = ArrayData::create([
    //             'Lectureres' => $members,
    //         ]);

    //         return $this->customise($data)->render();
    //     }

    //     return $this->customise([
    //         'PageTitle' => 'Lectureres',
    //         // 'Lectureres' => $data,
    //     ]); 
    // }
    // new code

    public function lectureres()
    {
        $groupCodeName = 'lectureres';

        $group = Group::get()->filter('Code', $groupCodeName)->first();

        if ($group) {
            $members = $group->Members();

            foreach ($members as $member) {
                $departmentName = $member->getDepartmentName();
                
            }

            $data = [
                'Lecturers' => $members,
            ];

            return $this->customise($data)->render();
        }

        return $this->customise([
            'PageTitle' => 'Lectureres',
            'Lecturers' => ArrayList::create(), // or an empty ArrayList depending on your requirements
        ])->render();
    }

    public function students()
    {
        $groupCodeName = 'users';

        $group = Group::get()->filter('Code', $groupCodeName)->first();

        if ($group) {
            $members = $group->Members();

            foreach ($members as $member) {
                $departmentName = $member->getDepartmentName();
                
            }

            $data = [
                'Students' => $members,
            ];

            return $this->customise($data)->render();
        }

        return $this->customise([
            'PageTitle' => 'Students',
            'Students' => ArrayList::create(), // or an empty ArrayList depending on your requirements
        ])->render();
    }

    public function disciplinary_committee()
    {
        $groupCodeName = 'disciplinarycommittee';

        $group = Group::get()->filter('Code', $groupCodeName)->first();

        if ($group) {
            $members = $group->Members();

            $data = [
                'DisciplinaryCommittee' => $members,
            ];

            return $this->customise($data)->render();
        }

        return $this->customise([
            'PageTitle' => 'Disciplinary Committee',
            'DisciplinaryCommittee' => ArrayList::create(), // or an empty ArrayList depending on your requirements
        ])->render();
    }

    public function departments()
    {
        $departments = Departments::get();

        return $this->customise([
            'PageTitle' => 'Departments',
            'Departments' => $departments,
        ]); 
    }

    public function profile()
    {
        return $this->customise([
            'PageTitle' => 'My Profile'
        ]); 
    }

    public function payments()
    {
        return $this->customise([
            'PageTitle' => 'Payments',
        ]); 
    }

    public function payment_history()
    {
        $payments = Payments::get();
        
        return $this->customise([
            'PageTitle' => 'Payments',
            'PaymentHistory' => $payments
        ]); 
    }

    public function addDepartment()
    {
        return AddDepartmentForm::create($this, __FUNCTION__);
    }

    public function addLectureres()
    {
        return AddLecturereForm::create($this, __FUNCTION__);
    }

    public function addAccountants()
    {
        return AddAccountantForm::create($this, __FUNCTION__);
    }

    public function addDisciplinaryCommittee()
    {
        return AddDisciplinaryCommitteeForm::create($this, __FUNCTION__);
    }

    public function addPaymentForm()
    {
        return AddPaymentForm::create($this, __FUNCTION__);
    }

    public function isUserAdmin()
    {
        $member = Security::getCurrentUser();

        return $member->inGroup('administrators');
    }

    public function isUserMember()
    {
        $member = Security::getCurrentUser();

        return $member->inGroup('users');
    }

    public function isUserLecturere()
    {
        $member = Security::getCurrentUser();

        return $member->inGroup('lectureres');
    }

    public function isUserAccountant()
    {
        $member = Security::getCurrentUser();

        return $member->inGroup('accountants');
    }

    public function isUserDC()
    {
        $member = Security::getCurrentUser();

        return $member->inGroup('disciplinarycommittee');
    }

}