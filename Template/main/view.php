
<?php

include('hero2.php');
 
?>


    <!-- Main Content Start -->
    <div class="page-content">
      <!-- Product Detail Start -->
    <section class="product-detail p-40">
        <div class="container">
        <div class="ads-container">
				<div class="ads">
				<?php echo getAds('content_start'); ?>
				</div>
			</div>
            <div class="row">
              <div class="col-md-6">
                <div class="product-image">
                  <img src="<?php echo $ogImage; ?>" alt="<?php echo $file['name'];?>">
                </div>
                <div class="ads-container">
                <div class="ads">
                <?php echo getAds('content_after_image'); ?>
                </div>
              </div>
              </div>
              <div class="col-md-6">
                  <div class="product-content">
                      <div class="main-content " id="file">
                          <h3><?php echo $file['name'];?></h3>
                          <div class="price">
                              <h5 class=>                                    <span>                                  <svg class="icon-22" width="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M3.09277 9.40421H20.9167" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M16.442 13.3097H16.4512" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M12.0045 13.3097H12.0137" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M7.55818 13.3097H7.56744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M16.442 17.1962H16.4512" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M12.0045 17.1962H12.0137" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M7.55818 17.1962H7.56744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M16.0433 2V5.29078" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M7.96515 2V5.29078" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.2383 3.5791H7.77096C4.83427 3.5791 3 5.21504 3 8.22213V17.2718C3 20.3261 4.83427 21.9999 7.77096 21.9999H16.229C19.175 21.9999 21 20.3545 21 17.3474V8.22213C21.0092 5.21504 19.1842 3.5791 16.2383 3.5791Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                                  </span> <?php echo date('d D m, Y', strtotime($file['created_at'])); ?></h5>


                              <h5 class="ml-5 dark-gray ">   <span>                                           <svg class="icon-22" width="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M12.1221 15.436L12.1221 3.39502" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M15.0381 12.5083L12.1221 15.4363L9.20609 12.5083" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M16.7551 8.12793H17.6881C19.7231 8.12793 21.3721 9.77693 21.3721 11.8129V16.6969C21.3721 18.7269 19.7271 20.3719 17.6971 20.3719L6.55707 20.3719C4.52207 20.3719 2.87207 18.7219 2.87207 16.6869V11.8019C2.87207 9.77293 4.51807 8.12793 6.54707 8.12793L7.48907 8.12793" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                                                                                             </span> <?php echo $file['download'];?></h5>


                              <h5 class="ml-5 dark-gray"><span> <svg class="icon-22" width="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M22.4541 11.3918C22.7819 11.7385 22.7819 12.2615 22.4541 12.6082C21.0124 14.1335 16.8768 18 12 18C7.12317 18 2.98759 14.1335 1.54586 12.6082C1.21811 12.2615 1.21811 11.7385 1.54586 11.3918C2.98759 9.86647 7.12317 6 12 6C16.8768 6 21.0124 9.86647 22.4541 11.3918Z" stroke="currentColor"></path>                                    <circle cx="12" cy="12" r="5" stroke="currentColor"></circle>                                    <circle cx="12" cy="12" r="3" fill="currentColor"></circle>                                    <mask mask-type="alpha" maskUnits="userSpaceOnUse" x="9" y="9" width="6" height="6">                                    <circle cx="12" cy="12" r="3" fill="currentColor"></circle>                                    </mask>                                    <circle opacity="0.89" cx="13.5" cy="10.5" r="1.5" fill="white"></circle> </svg></span> <?php echo $file['views'];?></h5>

                          </div>
                          <div class="rating-stars">
                          <h5 class="ml-5 dark-gray mb-2">  <span>                                         <svg class="icon-22" width="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M7.37121 10.2017V17.0618" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M12.0382 6.91919V17.0619" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M16.6285 13.8269V17.0619" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.6857 2H7.31429C4.04762 2 2 4.31208 2 7.58516V16.4148C2 19.6879 4.0381 22 7.31429 22H16.6857C19.9619 22 22 19.6879 22 16.4148V7.58516C22 4.31208 19.9619 2 16.6857 2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                                                                                                </span> File Size: <?php echo formatSize($file['size']);?></h5>
                          <h5 class="ml-5 dark-gray mb-2">  <span>                                         <svg class="icon-22" width="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M7.37121 10.2017V17.0618" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M12.0382 6.91919V17.0619" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M16.6285 13.8269V17.0619" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.6857 2H7.31429C4.04762 2 2 4.31208 2 7.58516V16.4148C2 19.6879 4.0381 22 7.31429 22H16.6857C19.9619 22 22 19.6879 22 16.4148V7.58516C22 4.31208 19.9619 2 16.6857 2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                                                                                                </span> Format: <?php echo strtoupper($file['ext']);?></h5>
                          <h5 class="ml-5 dark-gray mb-2">   <span>                                  <svg class="icon-22" width="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M14.353 2.5C18.054 2.911 20.978 5.831 21.393 9.532" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M14.353 6.04297C16.124 6.38697 17.508 7.77197 17.853 9.54297" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.0315 12.4724C15.0205 16.4604 15.9254 11.8467 18.4653 14.3848C20.9138 16.8328 22.3222 17.3232 19.2188 20.4247C18.8302 20.737 16.3613 24.4943 7.68447 15.8197C-0.993406 7.144 2.76157 4.67244 3.07394 4.28395C6.18377 1.17385 6.66682 2.58938 9.11539 5.03733C11.6541 7.5765 7.04254 8.48441 11.0315 12.4724Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                                                        </span> Phone Number: <?php echo $file['phone'];?></h5>
                          <h5 class="ml-5 dark-gray mb-2">    <svg class="icon-22" width="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M17.8877 10.8967C19.2827 10.7007 20.3567 9.50473 20.3597 8.05573C20.3597 6.62773 19.3187 5.44373 17.9537 5.21973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M19.7285 14.2505C21.0795 14.4525 22.0225 14.9255 22.0225 15.9005C22.0225 16.5715 21.5785 17.0075 20.8605 17.2815" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.8867 14.6638C8.67273 14.6638 5.92773 15.1508 5.92773 17.0958C5.92773 19.0398 8.65573 19.5408 11.8867 19.5408C15.1007 19.5408 17.8447 19.0588 17.8447 17.1128C17.8447 15.1668 15.1177 14.6638 11.8867 14.6638Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.8869 11.888C13.9959 11.888 15.7059 10.179 15.7059 8.069C15.7059 5.96 13.9959 4.25 11.8869 4.25C9.7779 4.25 8.0679 5.96 8.0679 8.069C8.0599 10.171 9.7569 11.881 11.8589 11.888H11.8869Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M5.88509 10.8967C4.48909 10.7007 3.41609 9.50473 3.41309 8.05573C3.41309 6.62773 4.45409 5.44373 5.81909 5.21973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M4.044 14.2505C2.693 14.4525 1.75 14.9255 1.75 15.9005C1.75 16.5715 2.194 17.0075 2.912 17.2815" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg> Group: <?php echo (isset($group) ? $group : 'None');?> </h5>
                          <h5 class="ml-5 dark-gray mb-2"> <svg class="icon-22" width="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9849 15.3462C8.11731 15.3462 4.81445 15.931 4.81445 18.2729C4.81445 20.6148 8.09636 21.2205 11.9849 21.2205C15.8525 21.2205 19.1545 20.6348 19.1545 18.2938C19.1545 15.9529 15.8735 15.3462 11.9849 15.3462Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9849 12.0059C14.523 12.0059 16.5801 9.94779 16.5801 7.40969C16.5801 4.8716 14.523 2.81445 11.9849 2.81445C9.44679 2.81445 7.3887 4.8716 7.3887 7.40969C7.38013 9.93922 9.42394 11.9973 11.9525 12.0059H11.9849Z" stroke="currentColor" stroke-width="1.42857" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg> Compiler: <?php echo (isset($group) ? $group : 'None');?> </h5>


                          <h5 class="ml-5 dark-gray mb-2"> <span>                                 <svg class="icon-22" width="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.7379 2.76175H8.08493C6.00493 2.75375 4.29993 4.41175 4.25093 6.49075V17.2037C4.20493 19.3167 5.87993 21.0677 7.99293 21.1147C8.02393 21.1147 8.05393 21.1157 8.08493 21.1147H16.0739C18.1679 21.0297 19.8179 19.2997 19.8029 17.2037V8.03775L14.7379 2.76175Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M14.4751 2.75V5.659C14.4751 7.079 15.6231 8.23 17.0431 8.234H19.7981" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M14.2882 15.3584H8.88818" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M12.2432 11.606H8.88721" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                                                                                               </span> Book Album: <?php echo (isset($book) ? $book : 'None');?> </h5>


                          <h5 class="ml-5 dark-gray mb-2">     <span>                                  <svg class="icon-22" width="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M3.09277 9.40421H20.9167" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M16.442 13.3097H16.4512" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M12.0045 13.3097H12.0137" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M7.55818 13.3097H7.56744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M16.442 17.1962H16.4512" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M12.0045 17.1962H12.0137" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M7.55818 17.1962H7.56744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M16.0433 2V5.29078" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M7.96515 2V5.29078" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.2383 3.5791H7.77096C4.83427 3.5791 3 5.21504 3 8.22213V17.2718C3 20.3261 4.83427 21.9999 7.77096 21.9999H16.229C19.175 21.9999 21 20.3545 21 17.3474V8.22213C21.0092 5.21504 19.1842 3.5791 16.2383 3.5791Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                                  </span> Last Download: <?php echo to_time_ago( strtotime($file['dl_last']));?></h5>
                          

                          </div>

                      </div>
                      <div class="writer-area">
                              <h5 class="ml-5 dark-gray mb-2">Author: <?php echo $file['author'] ? $author : 'None';?></h5>
                          <span>
                              <h5 class="ml-5 dark-gray mb-2">Category: <?php echo $file['cat_slug'] ? '<a href="'.APP_URL.'/category/'.$file['cat_slug'].'">'.$file['cat_name'].'</a>' : 'None';?></h5>
                          </span>
                          
                          <span>
                              <h5 class="ml-5 dark-gray mb-2">Share:</h5>&nbsp;&nbsp;
                              <ul class="unstyled">
                              <li><a href="#" class="share-link" data-platform="facebook"><img src="<?=MAIN_ASSETS?>/media/icons/facebook-fade.png" alt="Facebook"></a></li>
                              <li><a href="#" class="share-link" data-platform="whatsapp"><img src="<?=MAIN_ASSETS?>/media/icons/whatsapp.png" alt="WhatsApp"></a></li>
                              <li><a href="#" class="share-link" data-platform="twitter"><img src="<?=MAIN_ASSETS?>/media/icons/twitter.png" alt="Twitter"></a></li>
                            </ul>
                          </span>
                        </div>
                      <hr class="mb-4 mt-4">
                      
                      <div class="ads-container">
                      <div class="ads">
                      <?php echo getAds('content_middle'); ?>
                      </div>
                    </div>

                      <?php if(($file['isFree'] == 1)): ?>
                      
                      <div class="cart-button">
                      <?php if((DOWNLOAD === 1) && $file['isDownload'] == 1): ?>
                          <a href="<?php echo APP_URL.'/download/'.$file['id'];?>" class="btn btn-primary mt-3"> Download Now</a>
                      <?php endif; ?>
                      <?php if((READ_FREE === 1) && $file['isRead'] == 1): ?>
                          <a href="<?php echo APP_URL.'/read/'.$file['id'];?>" class="btn btn-primary mt-3">Read Now</a>
                      <?php endif; ?>    
                      </div>

                      <?php elseif(!$isLogin) : ?>

                        <div class="writer-area">
                          Pls Login or Register in order to download this novel
                        </div>
                        <div class="cart-button mb-32 mt-3">

                        <?php if((READ_FREE === 1) && $file['isRead'] == 1): ?>
                          <h6>  <a href="<?php echo APP_URL.'/read/'.$file['id'];?>" class="btn btn-primary">Read Now</a> </h6>
                      <?php endif; ?>    
                          <h6><a href="<?php echo APP_URL.'/login';?>" class="btn btn-primary">Login</a></h6>
                          <h6><a href="<?php echo APP_URL.'/signup';?>" class="btn btn-primary">Register</a></h6>
                        </div>

                      <?php else : ?>

                      <?php if(SUBSCRIBE === 1): ?>

                          <?php if($gen->isSubscribe($AuthUser['id'])): ?>
                            <div class="writer-area">
                            Congrats Download or read the novel below
                          </div>
                          <div class="cart-button mb-32">
                              <?php if((DOWNLOAD === 1) && $file['isDownload'] == 1): ?>
                                <a href="<?php echo APP_URL.'/download/'.$file['id'];?>" class="btn btn-primary mt-3"> Download Now</a>
                              <?php endif; ?>

                                <a href="<?php echo APP_URL.'/read/'.$file['id'];?>" class="btn btn-primary mt-3">Read Now</a>   

                          </div>
                  
                        <?php else: ?>
                          <div class="writer-area">
                              You cannot download this novel untill you Subscribe to one of our subscriptions package
                              <h6><a href="<?php echo APP_URL.'/account';?>" class="btn btn-primary mt-3">Subscribe Now</a></h6>
                            </div>
                         <?php endif;?>


                      <?php elseif(READ_FREE === 1 && $file['isRead'] == 1) : ?>
                        <div class="writer-area">
                              You cannot download this novel, you can only read it online
                            </div>
                            <div class="cart-button mb-32">
                              <h6><a href="<?php echo APP_URL.'/read/'.$file['id'];?>" class="btn btn-primary mt-3">Read Novel</a></h6>
                          </div>
                      <?php else: ?>
                        <div class="writer-area">
                              You cannot read / download this novel untill you Subscribe to one of our subscriptions package
                              <h6><a href="<?php echo APP_URL.'/account';?>" class="btn btn-primary mt-3">Subscribe Now</a></h6>
                            </div>

                    <?php endif; ?>
                    <?php endif; ?>






                  </class=>
              </div>
            </div>
        </div>
    </section>
      <!-- Product Detail End -->

      <!-- Product Description Start -->
    <section class="product-description">
      <div class="container">
        <div class="row">
          <div class="col-xl-8">
            <nav>
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button"
                  role="tab" aria-controls="nav-home" aria-selected="false">Descriptions</button>
                <button class="nav-link " id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                  type="button" role="tab" aria-controls="nav-profile" aria-selected="true">Reviews (<?php echo $db->table('reviews')->where('file_id', $file['id'])->count();?>)</button>
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <p class="dark-gray p-16">
                <?php echo htmlspecialchars_decode($file['description']); ?>
                </p>
              </div>
              <div class="tab-pane fade " id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="comments-sec m-40">
                  <?php

        $nestedReviews = [];
        $lookup = [];

        // Initialize lookup and base structure
        foreach ($reviews as $review) {
            $review['replies'] = [];
            $lookup[$review['id']] = $review;
        }

      // Build the nested structure
      foreach ($reviews as $review) {
          if ($review['parent_id'] == 0) {
              $nestedReviews[] = &$lookup[$review['id']];
          } else {
              if (isset($lookup[$review['parent_id']])) {
                  $lookup[$review['parent_id']]['replies'][] = &$lookup[$review['id']];
              }
          }
      }
                        echo renderComments($nestedReviews, $isLogin, $AuthUser, $file)

                  ?>
                </div>
              </div>
            </div>
            <div class="ads-container">
            <div class="ads">
            <?php echo getAds('content_end'); ?>
            </div>
          </div>
          </div>
          <div class="col-xl-4">
            <div class="review-form">
              <h3 class="mb-8">Leave a Review</h3>
              <?php if(!$isLogin) : ?>
              <h6 class="dark-gray mb-32">You cannot submit review untill you <a href="/register">Register</a> or <a href="/login">login </a> </h6>
              <?php else: ?>
              <form class="auth" method="POST">
                <textarea class="form-control comment mb-24" name="content" id="" rows="4"
                  placeholder="Write your comments here" style="height: 138px;"></textarea>
                  <input type="hidden" name="user_id" value="<?php echo $AuthUser['id'];?>">
                  <input type="hidden" name="file_id" value="<?php echo $file['id'];?>">
                  <input type="hidden" name="action" value="addreview">
                <div class="filter-checkbox mb-24">
                  <input type="checkbox" id="remember">
                  <label for="remember">Please remember my details for future reviews.</label>
                </div>
                <button type="submit" class="cus-btn small"><span class="icon"><img
                      src="<?=MAIN_ASSETS?>/media/icons/click-button.png" alt=""></span>Submit Review</button>
              </form>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </section>
      <!-- Product Description End -->
      
			<div class="ads-container">
				<div class="ads">
				<?php echo getAds('sidebar'); ?>
				</div>
			</div>
      <!-- Related Product Start -->
    <section class="related-product">
      <div class="container">
        <div class="top-row mb-48">
          <div class="heading mb-0">
            <h3>Related Novels</h3>
          </div>
          <h6><a href="/category/<?=$file['cat_slug'];?>" class="cus-btn"><span class="icon"><img src="<?=MAIN_ASSETS?>/media/icons/click-button.png"
                  alt=""></span>VIEW ALL</a></h6>
        </div>
        <div class="row">
          <?php
          $files = $relatedFiles;
          $cts = 3;
          include('filelist_2.php');
          unset($files);
          ?>
        </div>
      </div>
    </section>
      <!-- Related Product End -->
       
    </div>
    <!-- Main Content End -->








