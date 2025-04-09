


                          <style>
  .loading-message {
    text-align: center;
    font-size: 16px;
    color: #333;
}

/* Optional: Add a spinner */
.spinner {
    border: 4px solid rgba(0, 0, 0, 0.1);
    border-top: 4px solid #007bff;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    animation: spin 1s linear infinite;
    margin: 20px auto;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.swal2-container {
  z-index: 20000 !important;
}

</style>

<div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="py-3 mb-4"><span class="text-muted fw-light"><a href="<?=AdminURL?>">Home</a> /</span> <a href="<?=AdminURL?>/reviews">Reviews</a> </h4>


    
    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="card-header">
        <div class="d-flex justify-content-between">
            <h5 class="mb-0 showingBy">All Reviews</h5>
            
            <div class="d-flex justify-content-end">
            <div class="btn-group" role="group" aria-label="Basic example">
                           
                              <div class="btn-group">
                      <button type="button" class="btn btn-secondary dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                        Action
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item waves-effect activateAll" href="javascript:void(0);">Activate All</a></li>
                        <li><a class="dropdown-item waves-effect trashAll" href="javascript:void(0);">Trash All</a></li>
                
                      </ul>
                    </div>
                    <div class="btn-group">
                      <button type="button" class="btn btn-secondary dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                        Show
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item waves-effect showAll" href="javascript:void(0);">Show All</a></li>
                        <li><a class="dropdown-item waves-effect showActive" href="javascript:void(0);">Show Active</a></li>
                        <li><a class="dropdown-item waves-effect showTrash" href="javascript:void(0);">Show Trashed</a></li>
                
                      </ul>
                    </div>
                            </div>
        </div>    


        </div>   

      

       

                          <div class="table-responsive text-nowrap p-2">
                       
    <table id="dataTable" class="table table-striped table-bordered nowrap reports " width="100%" cellspacing="0" data-table="reviews" data-filter="ALL">
    <thead>
            <tr>
                <th>Id</th>
                <th>username</th>
                <th>Ebook name</th>
                <th>Status</th>
                <th>Action</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <!-- Table body content goes here -->
        </tbody>
    </table>

    </div>
    </div>
    <!--/ Basic Bootstrap Table -->

</div>





 <div class="modal fade" id="view" tabindex="-1" style="display: none;" aria-hidden="true">

                        <div class="modal-dialog modal-lg" role="document">
                        <form id="addpost" method="post" enctype="multipart/form-data">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title" id="exampleModalLabel3">View Review</h4>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            
                              <div class="row">
                                
                                <div class="col-sm-12 mb-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <p id="content"></p>
                                  </div>
                              </div>
                               
                            
                            </div>
                            <div class="modal-footer">

                              <button type="button" class="btn btn-outline-secondary waves-effect" data-bs-dismiss="modal">
                                Close
                              </button>
                          
                            </div>
  </div>
  </div>




       





