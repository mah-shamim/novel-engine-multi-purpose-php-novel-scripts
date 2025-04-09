

<div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="py-3 mb-4"><span class="text-muted fw-light"><a href="<?=AdminURL?>">Home</a> /</span> <span class="text-muted fw-light"><a href="<?=AdminURL?>/setting">Setting</a> /</span> <a href="<?=AdminURL?>/adstxt">Ads.txt Editor</a> </h4>


   
        <div class="row">
        <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Ads.txt Editor</h5>
                    </div>
                    <div class="card-body">
                  <div class="row">
                    <div class="col-12 mt-3 mb-3">
                        <?php if(isset($status) && isset($message)) :
                            if($status === 1) : ?>
                            
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> <?php echo $message; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <?php else: ?>
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Warning!</strong> <?php echo $message; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php endif; 
                            endif;?>    
                    </div>
                   <form action="" name="widgetforom" method="POST">
                        <div class="">
                                <div class="form-group col-12">
                                    <label for="Contents">Editor </></label>
                                    <textarea name="contents" class="form-control" id="" cols="30" rows="10"><?php echo $content;?></textarea>
                                </div>
                                    <input type="submit" class="btn btn-primary m-2 bg-primary" value="Save" name="save" />
                        </div>
                    </form>
                   </div>
                   
                   
                    </div>
                  </div>
        </div>
        </div>
      