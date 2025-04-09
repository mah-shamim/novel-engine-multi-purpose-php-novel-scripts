


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

    <h4 class="py-3 mb-4"><span class="text-muted fw-light"><a href="<?=AdminURL?>">Home</a> /</span> <a href="<?=AdminURL?>/setting">Profile</a> </h4>

    

    
   
        <div class="row">
        <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Change Admin Details</h5>
                    </div>
                    <div class="card-body">
                      <form data-process="profile" method="post" id="setting">
                        <div class="row">
                        <div class="col-md-6">
                        <div class="form-floating form-floating-outline mb-4">
                          <input type="text" class="form-control" name="name" id="" value="<?php echo $user['name']; ?>">
                          <label for=""> Name</label>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-floating form-floating-outline mb-4">
                          <input type="text" class="form-control" name="username" id="" value="<?php echo $user['username']; ?>">
                          <label for="">Username</label>
                        </div>
                        </div>

                         <div class="col-sm-12">
                        <div class="form-floating form-floating-outline mb-4">
                          <input type="text" name="email" class="form-control" id="" value="<?php echo $user['email']; ?>">
                          <label for="">Email</label>
                        </div>
                        </div>

                        <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Change Password</h5>
                    </div>
                        <div class="col-sm-12">
                        <div class="form-floating form-floating-outline mb-4">
                          <input type="password" name="oldpassword" class="form-control" id="">
                          <label for="">Enter Old Password</label>
                        </div>
                        </div>
                        <div class="col-sm-12">
                        <div class="form-floating form-floating-outline mb-4">
                          <input type="password" name="newpassword" class="form-control" id="">
                          <label for="">Enter new password</label>
                        </div>
                        </div>

                        <div class="col-sm-12">
                        <div class="form-floating form-floating-outline mb-4">
                          <input type="password" name="confirmnewpassword" class="form-control" id="">
                          <label for="">Confirm New Password</label>
                        </div>
                        </div>

                        
                        <input type="hidden" name="setting" value="changeP">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
        </div>
      




       





