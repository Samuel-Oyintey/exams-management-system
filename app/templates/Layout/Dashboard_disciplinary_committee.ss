<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold mb-4">Disciplinary Committee</h4>
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#smallModal">
            Add D-C
        </button>
        <div class="modal fade" id="smallModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel2">Add an Account</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            $addDisciplinaryCommittee
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- table -->
        <table id="myTable" class="table hover text-center table-responsive-sm table-sm" >
            <thead>
                <tr>
                <th>#</th>
                <th>Profile</th>
                <th>Full Name</th>
                <th>Email Address</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <% loop $DisciplinaryCommittee %>
                <tr>
                    <td>$ID</td>
                    <td>
                        <img src="$ProfilePhoto.URL" alt="Avatar" class="rounded-circle" style="height:40px;"/>
                    </td>
                    <td>$Surname $FirstName</td>
                    <td>$Email</td>
                    <td>
                        <a href="dashboard/#/{$ID}" class="btn btn-sm btn-primary">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <%-- <a href="dashboard/edit-product/{$ID}" class="btn btn-sm btn-success">
                            <i class="fas fa-pencil-alt"></i>
                        </a> --%>
                        <a href="dashboard/delete-product/{$ID}" class="btn btn-sm btn-danger">
                            <i class="fa fa-trash "></i>
                        </a>
                    </td>
                </tr>
            <% end_loop %>
            </tbody>
        </table>
    </div>
    <!-- / Content -->
</div>
<!-- Content wrapper -->