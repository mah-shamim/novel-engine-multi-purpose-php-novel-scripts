

<div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="py-3 mb-4"><span class="text-muted fw-light"><a href="<?=AdminURL?>">Home</a> /</span> <span class="text-muted fw-light"><a href="<?=AdminURL?>/setting">Setting</a> /</span> <a href="<?=AdminURL?>/instant-indexing">Instant Indexing</a> </h4>


   
        <div class="row">

        <div class="col-12 mt-3 mb-3">
                        <?php if(isset($status) && isset($message)) :
                            if($status === 1) : ?>
                            
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <strong>Success!</strong> <?php echo $message; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                </button>
                                </div>

                            <?php else: ?>

                                <div class="alert alert-warning alert-dismissible" role="alert">
                                <strong>Warning!</strong> <?php echo $message; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    </button>
                                    </div>

                            <?php endif; 
                            endif;?>    
         </div>

        <div class="col-xl-4">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Settings</h5>
                    </div>
                    <div class="card-body">
                  <div class="row">
                   <form action="" method="POST" enctype="multipart/form-data">
                        <div class="">
                                <div class="form-group col-12">
                                    <label for="file">Upload your Google Secret Service Json file</label>
                                    <input type="file" id="file" name="file" class="form-control">
                                </div>
                                <input type="hidden" name="action" value="upload">
                                <button type="submit" class="btn btn-primary mt-3">Upload</button>
                        </div>
                    </form>
                   </div>
                   
                   
                    </div>
                  </div>
        </div>

        <div class="col-xl-8">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Google Instant URL Indexer - Shuraih99</h5>
                    </div>
                    <div class="card-body">
                  <div class="row">
                   <form action="" method="POST">
                        <div class="">
                                <div class="form-group col-12">
                                    <label for="Contents">Enter URLs (one per line):</label>
                                    <textarea name="contents" class="form-control" id="" cols="30" rows="10"></textarea>
                                </div>
                                <input type="hidden" name="action" value="Index">
                                <button type="submit" class="btn btn-primary mt-3">Index now</button>
         
                        </div>
                    </form>
                   </div>
                   
                   
                    </div>
                  </div>
        </div>

        <div class="col-xl-12">
        <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Log File</h5>
                    </div>
                    <div class="card-body">
                  <div class="row">
                    <div class="col-12 mt-3 mb-3">  
                    </div>
                   <form action="" name="widgetforom" method="POST">
                        <div class="">
                                <div class="form-group col-12">
                                    <label for="Contents">Log file </></label>
                                    <textarea name="contents" class="form-control" id="" cols="30" rows="10"><?php echo $content;?></textarea>
                                </div>
                                <input type="hidden" name="action" value="clear">
                                <button type="submit" class="btn btn-primary mt-3">Clear</button>
                                
                        </div>
                    </form>
                   </div>
                   
                   
                    </div>
                  </div>
        </div>
        </div>
      