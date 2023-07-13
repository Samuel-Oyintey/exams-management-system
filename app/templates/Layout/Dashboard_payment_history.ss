<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold mb-4">$PageTitle</h4>
        
        <!-- table -->
        
        <table id="myTable" class="table hover text-center table-responsive-sm table-sm" >
            <thead>
                <tr>
                    <th>Payment Date</th>
                    <th>Student Name</th>
                    <th>Student ID</th>
                    <th>Department</th>
                    <th>Payment Type</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <% loop $PaymentHistory %>
                <tr>
                    <td>$Created.Nice</td>
                    <td>$Member.FirstName $Member.Surname</td>
                    <td>$Member.StudentID</td>
                    <td>$Member.getDepartmentName</td>
                    <td>$PaymentType</td>
                    <td>$Amount</td>
                    <td>
                        <% if $PaymentStatus == "pending" %>
                            <button type="button" class="btn btn-warning btn-sm">Pending</button>
                        <% else_if $PaymentStatus == "approved" %>
                            <button type="button" class="btn btn-success btn-sm">Approved</button>
                        <% else_if $PaymentStatus == "failed" %>
                            <button type="button" class="btn btn-danger btn-sm">Failed</button>
                        <% end_if %>
                    </td>
                </tr>
            <% end_loop %>
            </tbody>
        </table>
    </div>
    <!-- / Content -->
</div>
<!-- Content wrapper -->