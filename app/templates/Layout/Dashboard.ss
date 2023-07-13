<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <div class="col-lg-8 mb-4 order-0">
        <div class="card">
          <div class="d-flex align-items-end row">
            <div class="col-sm-7">
              <div class="card-body">
                <% with $CurrentUser %>
                <h5 class="card-title text-primary">Welcome $Surname $FirstName! 🎉</h5>
                <% end_with %>
                <% if $isUserMember %>
                <% with $CurrentUser %>
                <p class="mb-4">
                  You Exam ID is <span class="fw-bold">$StudentID</span> 
                </p>
                <% end_with %>
                <% end_if %>
                
                <a href="{$Top.BaseHref}dashboard/profile/" class="btn btn-sm btn-outline-primary">Go to Your Profile</a>
                
              </div>
            </div>
            <div class="col-sm-5 text-center text-sm-left">
              <div class="card-body pb-0 px-0 px-md-4">
                <img src="$resourceURL('app/images/img/illustrations/man-with-laptop-light.png')" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mb-4 order-0">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">
              Payments
            </h5>
            <a class="card-link" href="{$Top.BaseHref}dashboard/#">View all payments</a>
            <p class="card-text">
              This is another card with title and supporting text below. This card has some additional content
             </p>
          </div>
        </div>
      </div>
    </div>

    <%-- <div class="row">
      <div class="col-lg-4 mb-4 order-0">
        <div class="card bg-transparent border border-primary">
          <div class="card-body">
            <i class="bx bx-comment text-primary mb-3"></i>
            <h5 class="card-title">0</h5>
            <p class="card-text pt-0">Total Sent</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mb-4 order-0">
        <div class="card bg-transparent border border-success">
          <div class="card-body">
            <i class="bx bx-comment-check text-success mb-3"></i>
            <h5 class="card-title">0</h5>
            <p class="card-text pt-0">Delivered Messages</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mb-4 order-0">
        <div class="card bg-transparent border border-danger">
          <div class="card-body">
            <i class="bx bx-comment-error text-danger mb-3"></i>
            <h5 class="card-title">0</h5>
            <p class="card-text pt-0">Failed Messages</p>
          </div>
        </div>
      </div>
    </div> --%>
    <!-- / Content -->

  </div>
</div>
<!-- Content wrapper -->