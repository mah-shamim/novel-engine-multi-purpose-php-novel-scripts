


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

.fr-box.fr-basic .fr-element {
        height: 250px;
    }

    .fr-box.fr-basic {
        height: auto;
    }



</style>


<div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="py-3 mb-4"><span class="text-muted fw-light"><a href="<?=AdminURL?>">Home</a> /</span> <a href="<?=AdminURL?>/blog-cats">Blog Category</a> </h4>


    <div id="editor"></div>
    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="card-header">
        <div class="d-flex justify-content-between">
            <h5 class="mb-0 showingBy">All Blog Category</h5>
            
            <div class="d-flex justify-content-end">
            <div class="btn-group" role="group" aria-label="Basic example">
                              <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#addmodal"><span class="tf-icons mdi mdi-plus me-1"></span> Add Blog Category</button>
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
                       
    <table id="dataTable" class="table table-striped table-bordered nowrap reports " width="100%" cellspacing="0" data-table="blog-cats" data-filter="ALL">
    <thead>
            <tr>
                <th>Id</th>
                <th>Image</th>
                <th>Name</th>
                <th>Action</th>
                <th>Status</th>
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












                    
 <div class="modal fade" id="editmodal" tabindex="-1" style="display: none;" aria-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                          <form id="addpost" method="post" enctype="multipart/form-data">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title" id="modalCenterTitle">Edit Blog Category</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
    
      <div class="row">
        
        <div class="col-sm-6 mb-4 mt-2">
          <div class="form-floating form-floating-outline">
            <input type="text" class="form-control post-title" placeholder="Enter Name" name="name">
            <label for="nameLarge">Name</label>
          </div>
        </div>
        <div class="col-sm-6 mb-4 mt-2">
          <div class="form-floating form-floating-outline">
            <input type="text" class="form-control slug" name="slug">
            <label for="nameLarge">Slug</label>
          </div>
        </div>
      </div>
      <div class="row g-2">
        <div class="col-md-3 mb-2">
          <div class="form-floating form-floating-outline">
          <select class="form-select" name="imagetype" id="edit-imagetype" aria-label="Image Type">
  <option value="FILE">FILE</option>
  <option value="URL">URL</option>
</select>
 <label for="Image Type">Image Type</label>

          </div>
        </div><div class="col-md-9 mb-2">
          <div id="edit-file_show" class="form-floating form-floating-outline">
          <input type="file" id="edit-image" name="image" class="form-control">
 <label for="Image">Image File</label>

          </div>

          <div id="edit-url_show" style="display: none;" class="form-floating form-floating-outline">
          <input type="text" id="edit-image" name="img_url" class="form-control" placeholder="Image URL">
 <label for="Image">Image URL</label>

          </div>
        </div>
        </div>
        <div class="row mt-3 mb-3">
                                  <div class="col-md-6 mb-2">
          <div class="form-floating form-floating-outline">
            <div id="img_preview"></div>
          </div>
          </div>

        
                                <div class="col-md-12 mb-2">
                                  <div class="form-floating form-floating-outline">
                                    <textarea class="form-control custom-height" id="desc2" name="desc"> </textarea>
                                    <label for="title">Description</label>
                                  </div>
                                  </div>
        </div>

    
    </div>
    <div class="modal-footer">
        
    <div class="form-group col-12 d-flex align-items-center">

<div id="status-switch"></div>

</div>


      <button type="button" class="btn btn-outline-secondary waves-effect" data-bs-dismiss="modal">
        Close
      </button>
      <input type="hidden" name="action" value="editblogcategory">
      <input class="postID" type="hidden" name="id">
      <div id="isEdit"></div>
      <input class="hiddenimg" type="hidden" name="hiddenimg">
      <input class="hiddenimg_foler" type="hidden" name="hiddenimg_foler">
      <button type="submit" id="submit" class="btn btn-primary waves-effect waves-light">SUBMIT </button>
    </div>
                            </div>
                            </form>
                          </div>
                          
  </div>



 <div class="modal fade" id="addmodal" tabindex="-1" style="display: none;" aria-hidden="true">

                        <div class="modal-dialog modal-lg" role="document">
                        <form id="addpost" method="post" enctype="multipart/form-data">
                          <div class="modal-content">
                          
                            <div class="modal-header">
                              <h4 class="modal-title" id="exampleModalLabel3">Add Category</h4>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            
                              <div class="row">
                                
                                <div class="col-sm-6 mb-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control post-title" placeholder="Enter Name" name="name">
                                    <label for="nameLarge">Name</label>
                                  </div>
                                </div>
                                <div class="col-sm-6 mb-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control slug" name="slug">
                                    <label for="nameLarge">Slug</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row g-2">
                                <div class="col-md-3 mb-2">
                                  <div class="form-floating form-floating-outline">
                                  <select class="form-select imagetype" name="imagetype" id="" aria-label="Image Type">
                          <option value="FILE">FILE</option>
                          <option value="URL">URL</option>
                        </select>
                         <label for="Image Type">Image Type</label>

                                  </div>
                                </div><div class="col-md-9 mb-2">
                                  <div id="file_show" class="form-floating form-floating-outline">
                                  <input type="file" id="image" name="image" class="form-control">
                         <label for="Image">Image File</label>

                                  </div>

                                  <div id="url_show" style="display: none;" class="form-floating form-floating-outline">
                                  <input type="text" id="image" name="img_url" class="form-control" placeholder="Image URL">
                         <label for="Image">Image URL</label>

                                  </div>
                                </div>
                                </div>
                                
                               
                                <div class="row">
                                
                                <div class="col-md-12 mb-2">
                                  <div class="form-floating form-floating-outline">
                                    <textarea class="form-control custom-height" id="desc" name="desc"></textarea>
                                    <label for="title">Description</label>
                                  </div>
                                  </div>
                                </div>
                            
                            </div>
                            <div class="modal-footer">
                                
                            <div class="form-group col-12 d-flex align-items-center">
                        <label class="form-check-label m-3" for="status">Status </label>
                        <div class="custom-switch custom-switch-label-status pl-0 ml-3">
                            <input class="custom-switch-input" name="status" id="status" type="checkbox" checked>
                            <label class="custom-switch-btn" for="status"></label>
                        </div>
                        </div>


                              <button type="button" class="btn btn-outline-secondary waves-effect" data-bs-dismiss="modal">
                                Close
                              </button>
                              <input type="hidden" name="action" value="addblogcategory">
                              <button type="submit" id="submit" class="btn btn-primary waves-effect waves-light">SUBMIT </button>
                            </div>
                            </form>
  </div>
  </div>


</div>

      






       





