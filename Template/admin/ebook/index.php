


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

    <h4 class="py-3 mb-4"><span class="text-muted fw-light"><a href="<?=AdminURL?>">Home</a> /</span> <a href="<?=AdminURL?>/ebook">Ebook</a> </h4>


    
    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="card-header">
        <div class="d-flex justify-content-between">
            <h5 class="mb-0 showingBy">All Ebook</h5>
            
            <div class="d-flex justify-content-end">
            <div class="btn-group" role="group" aria-label="Basic example">
                              <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#ebookmodal"><span class="tf-icons mdi mdi-plus me-1"></span> Add Ebook</button>
                              <div class="btn-group">
                      <button type="button" class="btn btn-secondary dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                        Action
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item waves-effect activateAll" href="javascript:void(0);">Activate All</a></li>
                        <li><a class="dropdown-item waves-effect trashAll" href="javascript:void(0);">Trash All</a></li>
                        <?php if(INSTANT_INDEXING === 1) :?>
                        <li><a class="dropdown-item waves-effect indexAll" href="javascript:void(0);">Index All</a></li>
                        <?php endif;?>
                
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
                       
    <table id="dataTable" class="table table-striped table-bordered nowrap reports " width="100%" cellspacing="0" data-table="ebook" data-filter="ALL">
    <thead>
            <tr>
                <th>Id</th>
                <th>Image</th>
                <th>Name</th>
                <th>Author</th>
                <th>Group</th>
                <th>Compiler</th>
                <th>Category</th>
                <th>Action</th>
                <th>Book Album</th>
                <th>Size</th>
                <th>Views</th>
                <th>Downloads</th>
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












                      <div class="mt-3">

                    
 <div class="modal fade" id="editmodal" tabindex="-1" style="display: none;" aria-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                          <form id="addpost" method="post" enctype="multipart/form-data">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title" id="modalCenterTitle">Edit Ebook</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">

    
                              <div class="row g-2">
    <div class="col-md-3 mb-2">
        <div class="form-floating form-floating-outline">
            <select class="form-select" name="filetype" id="edit-filetype" aria-label="Upload Type">
                <option value="FILE">FILE</option>
                <option value="URL">URL</option>
            </select>
            <label for="Upload Type">Upload Type</label>
        </div>
    </div>
    <div class="col-md-9 mb-2">
        <div id="edit-local_file_show" class="form-floating form-floating-outline">
            <input type="file" id="file_input" name="file" class="form-control">
            <label for="Local file">LOCAL FILE</label>
        </div>

        <div id="edit-file_url_show" style="display: none;" class="form-floating form-floating-outline">
            <input type="text" id="file_url" name="file_url" class="form-control" placeholder="FILE URL">
            <label for="File URL">FILE URL</label>
        </div>
    </div>
</div>
    
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

          <div class="col-md-6 mb-2">
                                  <div class="form-floating form-floating-outline">
                                  <select class="form-control" id="category2" name="cid">
                                   
                                  </select>
                                    <label for="title">Category</label>
                                  </div>
                                  </div>
                                  <div class="col-md-12 mb-2">
                                  <div class="form-floating form-floating-outline">
                                  <select class="form-control" id="bookalbum1" name="baid">
                                   
                                  </select>
                                    <label for="title">Book Album</label>
                                  </div>
                                  </div>

          <div class="col-md-6 mb-2">
          <div class="form-floating form-floating-outline">
          <select class="form-control" id="authorEdit" name="author[]" multiple="multiple">
          </select>
            <label for="title">Author</label>
          </div>
          </div>
          <div class="col-md-6 mb-2">
          <div class="form-floating form-floating-outline">
          <select class="form-control" id="groupsEdit" name="groups[]" multiple="multiple">
          </select>
            <label for="title">Group</label>
          </div>
          </div>
            <div class="col-md-6 mb-2">
                                  <div class="form-floating form-floating-outline">
                                  <select class="form-control" id="compiler1" name="compiler[]" multiple="multiple">
                                  </select>
                                    <label for="title">Compiler</label>
                                  </div>
                                  </div>

                                  <div class="col-md-6 mb-2">
                                  <div class="form-floating form-floating-outline">
                                    <textarea class="form-control phone" id="" name="phone"></textarea>
                                    <label for="phone">Author contact</label>
                                  </div>
                                  </div>
                                  

        
                                <div class="col-md-12 mb-2 mt-3">
                                <h4 class="m-3" for="title">Description</h4>
                                  <div class="form-floating form-floating-outline ck-custom-height">
                                    <textarea class="form-control " id="desc2" name="desc"> <div class="dectext"></div> </textarea>
                                    
                                  </div>
                                  </div>
        <div class="col-md mb-2">
          <div class="form-floating form-floating-outline">
            <input type="text" name="title" class="form-control meta-title">
            <label for="title">SEO Title</label>
          </div>
          </div>
          
        </div>
        <div class="row">

          <div class="col-md mb-2">
          <div class="form-floating form-floating-outline">
            <input type="text" name="Description" class="form-control meta-desc">
            <label for="title">SEO Description</label>
          </div>
        </div>
        <div class="col-md mb-2">
          <div class="form-floating form-floating-outline">
            <input type="text" name="keyword" class="form-control meta-key">
            <label for="title">SEO keyword</label>
          </div>
        </div>
        
      </div>
    
    </div>
    <div class="modal-footer">
        
    <div class="form-group col-md-12 d-flex align-items-center row">
    <div class="col-sm-4 col-md-2 col-6">
    <div id="status-switch"></div>
                        </div>


    <div class="col-sm-4 col-md-2 col-6">
      <div id="ishome-switch"></div>
    </div>

    <div class="col-sm-4 col-md-2 col-6">
    <div id="istrend-switch"></div>
    </div>

    <div class="col-sm-4 col-md-2 col-6">
     <div id="isdownload-switch"></div>
    </div>

    <div class="col-sm-4 col-md-2 col-6">
    <div id="isread-switch"></div>
    </div>

    <div class="col-sm-4 col-md-2 col-6">
    <div id="isfree-switch"></div>
    </div>








</div>


      <button type="button" class="btn btn-outline-secondary waves-effect" data-bs-dismiss="modal">
        Close
      </button>
      <input type="hidden" name="action" value="editebook">
      <input class="postID" type="hidden" name="id">
      <div id="isEdit"></div>
      <input class="hiddenimg" type="hidden" name="hiddenimg">
      <input class="hiddenimg_foler" type="hidden" name="hiddenimg_foler">
      <input class="hiddenfile" type="hidden" name="hiddenfile">
      <input class="hiddenfilefoler" type="hidden" name="hiddenfilefoler">
      <input class="size" type="hidden" name="hidesize">
      <input class="ext" type="hidden" name="ext">
      <button type="submit" id="submit" class="btn btn-primary waves-effect waves-light">SUBMIT </button>
    </div>
                            </div>
                            </form>
                          </div>
                          
                        </div>




</div>

<div class="modal fade" id="ebookmodal" tabindex="-1" style="display: none;" aria-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                          
                          <div class="modal-content">
                              <form id="addpost" method="post" enctype="multipart/form-data">
                          
                            <div class="modal-header">
                              <h4 class="modal-title" id="">Add Ebook</h4>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
    <div class="modal-body">
       <div class="row g-2">
    <div class="col-md-3 mb-2">
        <div class="form-floating form-floating-outline">
            <select class="form-select" name="filetype" id="filetype" aria-label="Upload Type">
                <option value="FILE">FILE</option>
                <option value="URL">URL</option>
            </select>
            <label for="Upload Type">Upload Type</label>
        </div>
    </div>
    <div class="col-md-9 mb-2">
        <div id="local_file_show" class="form-floating form-floating-outline">
            <input type="file" id="file_input2" name="file" class="form-control">
            <label for="Local file">LOCAL FILE</label>
        </div>

        <div id="file_url_show" style="display: none;" class="form-floating form-floating-outline">
            <input type="text" id="file_url" name="file_url" class="form-control" placeholder="FILE URL">
            <label for="File URL">FILE URL</label>
        </div>
    </div>
</div>
       <div class="row">
                                
                                <div class="col-sm-6 mb-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control post-title" placeholder="Enter Name" name="name">
                                    <label for="name">Name</label>
                                  </div>
                                </div>

                                <div class="col-sm-6 mb-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control slug" name="slug">
                                    <label for="slug">Slug</label>
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
    </div>
    <div class="col-md-9 mb-2">
        <div id="file_show" class="form-floating form-floating-outline">
            <input type="file" id="image_input" name="image" class="form-control">
            <label for="Image">Image File</label>
        </div>

        <div id="url_show" style="display: none;" class="form-floating form-floating-outline">
            <input type="text" id="image_url" name="img_url" class="form-control" placeholder="Image URL">
            <label for="Image">Image URL</label>
        </div>
    </div>
</div>
        <div class="row">
                                <div class="col-md-6 mb-2">
                                  <div class="form-floating form-floating-outline">
                                  <select class="form-control" id="category" name="cid">
                                   
                                  </select>
                                    <label for="title">Category</label>
                                  </div>
                                  </div>

                                <div class="col-md-6 mb-2">
                                  <div class="form-floating form-floating-outline">
                                  <select class="form-control" id="author" name="author[]" multiple="multiple">
                                  </select>
                                    <label for="title">Author</label>
                                  </div>
                                  </div>
                                  <div class="col-md-6 mb-2">
                                  <div class="form-floating form-floating-outline">
                                  <select class="form-control" id="group" name="groups[]" multiple="multiple">
                                  </select>
                                    <label for="title">Group</label>
                                  </div>
                                  </div>

                                  <div class="col-md-6 mb-2">
                                  <div class="form-floating form-floating-outline">
                                  <select class="form-control" id="bookalbum" name="baid">
                                   
                                  </select>
                                    <label for="title">Book Album</label>
                                  </div>
                                  </div>

                                  <div class="col-md-6 mb-2">
                                  <div class="form-floating form-floating-outline">
                                  <select class="form-control" id="compiler" name="compiler[]" multiple="multiple">
                                  </select>
                                    <label for="title">Compiler</label>
                                  </div>
                                  </div>

                                  <div class="col-md-6 mb-2">
                                  <div class="form-floating form-floating-outline">
                                    <textarea class="form-control" id="" name="phone"></textarea>
                                    <label for="phone">Author contact</label>
                                  </div>
                                  </div>

                                <div class="col-md-12 mb-2 mt-3">
                                <h4 class="m-3" for="title">Description</h4>
                                  <div class="form-floating form-floating-outline">
                                    <textarea class="form-control desc3" id="" name="desc"></textarea>
                                  </div>
                                  </div>
                                <div class="col-md-12 mb-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" name="title" class="form-control">
                                    <label for="title">SEO Title</label>
                                  </div>
                                  </div>
                                </div>


                                <div class="row">

                                  <div class="col-md mb-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" name="Description" class="form-control">
                                    <label for="title">SEO Description</label>
                                  </div>
                                </div>
                                <div class="col-md mb-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" name="keyword" class="form-control">
                                    <label for="title">SEO keyword</label>
                                  </div>
                                </div>
                                
                              </div>
                            
                            </div>
                            <div class="modal-footer">
                                
                            <div class="form-group col-md-12 d-flex align-items-center row">
                             
                            
                            <div class="col-sm-4 col-md-2 col-6">
                        <label class="form-check-label m-3" for="extrastatus2">Status </label>
                        <div class="custom-switch custom-switch-label-status pl-0 ml-3">
                            <input class="custom-switch-input" name="status" id="extrastatus2" type="checkbox" checked>
                            <label class="custom-switch-btn" for="extrastatus2"></label>
                        </div> 
                        </div>
                        
                        <div class="col-sm-4 col-md-2 col-6 ">
                        <label class="form-check-label m-3" for="extrahome">Add to Home </label>
                        <div class="custom-switch custom-switch-label-status pl-0 ml-3">
                            <input class="custom-switch-input" name="isHome" id="extrahome2" type="checkbox" checked>
                            <label class="custom-switch-btn" for="extrahome2"></label>
                        </div>
                        </div>

                        <div class="col-sm-4 col-md-2 col-6 ">
                        <label class="form-check-label m-3" for="Trend">Trend </label>
                        <div class="custom-switch custom-switch-label-status pl-0 ml-3">
                            <input class="custom-switch-input" name="isTrend" id="Trend" type="checkbox">
                            <label class="custom-switch-btn" for="Trend"></label>
                        </div>
                        </div>

                        <div class="col-sm-4 col-md-2 col-6">
                        <label class="form-check-label m-3" for="Download">Download </label>
                        <div class="custom-switch custom-switch-label-status pl-0 ml-3">
                            <input class="custom-switch-input" name="isDownload" id="Download" type="checkbox" checked>
                            <label class="custom-switch-btn" for="Download"></label>
                        </div>
                        </div>

                        
                        <div class="col-sm-4 col-md-2 col-6">
                        <label class="form-check-label m-3" for="isRead">Read </label>
                        <div class="custom-switch custom-switch-label-status pl-0 ml-3">
                            <input class="custom-switch-input" name="isRead" id="isRead" type="checkbox" checked>
                            <label class="custom-switch-btn" for="isRead"></label>
                        </div>
                        </div>

                        <div class="col-sm-4 col-md-2 col-6">
                        <label class="form-check-label m-3" for="isFree">Free </label>
                        <div class="custom-switch custom-switch-label-status pl-0 ml-3">
                            <input class="custom-switch-input" name="Free" id="isFree" type="checkbox">
                            <label class="custom-switch-btn" for="isFree"></label>
                        </div>
                        </div>



                        </div>


                              <button type="button" class="btn btn-outline-secondary waves-effect" data-bs-dismiss="modal">
                                Close
                              </button>
                              <input type="hidden" name="action" value="addebook">
                              <button type="submit" id="submit" class="btn btn-primary waves-effect waves-light">SUBMIT </button>
                            </div>
                            </form>
                          </div>
                          
                          
                        </div>
                        </div>
                







       





