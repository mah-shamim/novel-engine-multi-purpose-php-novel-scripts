

<div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="py-3 mb-4"><span class="text-muted fw-light"><a href="<?=AdminURL?>">Home</a> /</span> <span class="text-muted fw-light"><a href="<?=AdminURL?>/setting">Setting</a> /</span> <a href="<?=AdminURL?>/mail-setting">Mailing Setting</a> </h4>


   
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

        <div class="col-xl-12">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Settings</h5>
                    </div>
                    <div class="card-body">
                  <div class="row">
                   <form class="row" action="" method="POST" enctype="multipart/form-data">

                   <div class="col-sm-6 mb-3">
                        
                        <label for="">Activate</label>
                        <div class="custom-switch custom-switch-label-status pl-0 ml-3">
                          <input class="custom-switch-input" name="mail" id="mail" type="checkbox" <?php if(MAIL_ACTIVATION == 1): ?>checked <?php endif;?>>
                          <label class="custom-switch-btn" for="mail"></label>
                      </div> 
                  </div>

                  <div class="col-sm-6 mb-3">
                        <div class="form-floating form-floating-outline mb-4">
                          <input type="text" name="host" class="form-control" id="" value="<?php echo MAIL_HOST; ?>">
                          <label for="">SMTP Host</label>
                        </div>
                    </div>
                  
                    <div class="col-sm-6 mb-3">
                        <div class="form-floating form-floating-outline mb-4">
                          <input type="text" name="username" class="form-control" id="" value="<?php echo MAIL_USERNAME; ?>">
                          <label for="">Username</label>
                        </div>
                    </div>

                    <div class="col-sm-6 mb-3">
                        <div class="form-floating form-floating-outline mb-4">
                          <input type="text" name="password" class="form-control" id="" value="<?php echo MAIL_PASSWORD; ?>">
                          <label for="">Password</label>
                        </div>
                    </div>

                    <div class="col-sm-6 mb-3">
                        <div class="form-floating form-floating-outline mb-4">
                          <input type="text" name="port" class="form-control" id="" value="<?php echo MAIL_PORT; ?>">
                          <label for="">Port</label>
                        </div>
                    </div>

                    <div class="col-sm-6 mb-3">
                        <div class="form-floating form-floating-outline mb-4">
                          <input type="text" name="from" class="form-control" id="" value="<?php echo MAIL_FROM; ?>">
                          <label for="">From Email</label>
                        </div>
                    </div>
                    <input type="hidden" name="submit" value="yes">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                   </div>
                   
                   
                    </div>
                  </div>
        </div>
        </div>
      