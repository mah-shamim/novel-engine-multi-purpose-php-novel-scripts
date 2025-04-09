    <!-- Main Content Start -->
    <div class="page-content">
    <section class="product-detail-2 p-40">
      <div class="container">
        <div class="row">
       


          <div class="col-xl-9">

          <?php if($isSubscribe) {
            include __DIR__.'/account/subscribe.php';
          } else if($isNotification) {
            include __DIR__.'/account/notification.php';
          } else { ?>
<div class="row">
                <div class="col-md-4 mb-5" style="margin:0 auto;">
                    <img src="<?=APP_URL?>/Public/thumb/users/<?php echo $AuthUser['image'];?>" style="width:50%; margin:0 auto;" alt=""/>
                </div>
                <div class="col-md-8 mb-3">
                    <h4 style="padding:5px;border-bottom:2px solid #ddd;">Username: <?php echo $AuthUser['username'] ?></h4>
                    <h4 style="padding:5px;border-bottom:2px solid #ddd;">Name: <?php echo $AuthUser['name'] ?></h4>
                    <h4 style="padding:5px;border-bottom:2px solid #ddd;">Email: <?php echo $AuthUser['email'] ?></h4>

                    
                </div>
            </div>
          
        <?php  } ?>
        </div>





          <div class="col-xl-3">
            <div class="product-content-2">
              <div class="main-content-2">
                <div class="m-40">
                <div class="filter-block">
                    <ul class="unstyled list">
                      <li class="mb-16">
                        <div class="filter-checkbox">
                          <input type="checkbox" id="" checked>
                          <label for="cp" class="black-color"> <a href="javascript:void(0)" id="" class="black-color" data-bs-toggle="modal" data-bs-target="#changepic">Change Pic</a> </label>

                        </div>
                      </li>
                      <li class="mb-16">
                        <div class="filter-checkbox">
                          <input type="checkbox" id="" checked>
                          <label for="" class="black-color"><a href="javascript:void(0)" id="" class="black-color" data-bs-toggle="modal" data-bs-target="#editprofile">Edit Profile</a></label>
                        </div>
                      </li>
                      <li class="mb-16">
                        <div class="filter-checkbox">
                          <input type="checkbox" id="" checked>
                          <label for="" class="black-color"><a href="javascript:void(0)" id="" class="black-color" data-bs-toggle="modal" data-bs-target="#changepass">Change Password</a></label>
                        </div>
                      </li>
                      <li class="mb-16">
                        <div class="filter-checkbox">
                          <input type="checkbox" id="" checked>
                          <label for="" class="black-color"><a href="/account?shu=notification" id="" class="black-color">Notifitions</a></label>
                        </div>
                        <h6 class="color-primary">(<?php echo $db->table('notifications')->where('is_read', 0)->where('user_id',$AuthUser['id'])->count(); ?>)</h6>
                      </li>

                      <li>
                        <div class="filter-checkbox">
                          <input type="checkbox" id="profile" checked>
                          <label for="" class="black-color"><a href="/account?shu=subscribe" id="" class="black-color">Subscribe</a></label>
                        </div>
                      </li>

                    </ul>
                  </div>
    

    </div>
            </div>
          </div>
        </div>




    <!-- Change Picture Modal -->
    <div class="modal fade" id="changepic" tabindex="-1" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="auth" method="POST" enctype="multipart/form-data">

                
                <div class="modal-header">
                    <h5 class="modal-title" id="">Change Your Profile Picture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   <input type="file" name="image" class="form-control"/>
                   <input type="hidden" name="id" value="<?php echo $AuthUser['id'];?>">
                   <input type="hidden" name="action" value="changepic">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>


        <!-- Change Password Modal -->
        <div class="modal fade" id="changepass" tabindex="-1" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="auth" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="">Change Your password Picture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-2">
                        <input type="password" name="old" class="form-control" placeholder="Input your Old Password"/>
                        </div>
                        <div class="col-12 mb-2">
                        <input type="password" name="new" class="form-control" placeholder="Input your New Password"/>
                        </div>

                        <div class="col-12 mb-2">
                        <input type="password" name="confirm" class="form-control" placeholder="Confirm your news Password"/>
                        </div>
                    </div>
                   
                   <input type="hidden" name="id" value="<?php echo $AuthUser['id'];?>">
                   <input type="hidden" name="action" value="changepass">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>


            <!-- Edit Profile Modal -->
            <div class="modal fade" id="editprofile" tabindex="-1" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="auth" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="">Edit Profile Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-2">
                        <input type="text"  class="form-control" value="<?php echo $AuthUser['username'];?>" disabled>
                        </div>
                        <div class="col-12 mb-2">
                        <input type="name" name="name" class="form-control" value="<?php echo $AuthUser['name'];?>"/>
                        </div>

                        <div class="col-12 mb-2">
                        <input type="email" name="email" class="form-control" value="<?php echo $AuthUser['email'];?>"/>
                        </div>
                    </div>
                   
                   <input type="hidden" name="id" value="<?php echo $AuthUser['id'];?>">
                   <input type="hidden" name="action" value="editprofile">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>

      </div>
    </section>



       
    </div>
    <!-- Main Content End -->