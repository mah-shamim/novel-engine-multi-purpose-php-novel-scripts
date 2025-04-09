        <!-- Blog Details Start -->
        <section class="blogs mt-60">
          <div class="container">
            <div class="row">
              <div class="col-xl-8">
                <div class="blog-title" id="file">
                  <h3><?php echo $post['name'];?></h3>
                  <div class="ads-container">
                  <div class="ads">
                  <?php echo getAds('content_start'); ?>
                  </div>
                </div>
                  <div class="tag-name-date mt-3 d-flex flex-column flex-md-row justify-content-start align-items-start align-items-md-center">
                    <div class="category-tag">
                      <a href="<?php echo APP_URL.'/blog?cat='.$post['cat_id'];?>"> <h6><?php echo $post['cat_name'];?></a></h6>
                    </div>
                    <div class="name-date mb-3 mb-md-0 ml-md-3 d-flex flex-column flex-sm-row flex-wrap">
                      <div class="writer-name">
                      <svg class="icon-22" width="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9849 15.3462C8.11731 15.3462 4.81445 15.931 4.81445 18.2729C4.81445 20.6148 8.09636 21.2205 11.9849 21.2205C15.8525 21.2205 19.1545 20.6348 19.1545 18.2938C19.1545 15.9529 15.8735 15.3462 11.9849 15.3462Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9849 12.0059C14.523 12.0059 16.5801 9.94779 16.5801 7.40969C16.5801 4.8716 14.523 2.81445 11.9849 2.81445C9.44679 2.81445 7.3887 4.8716 7.3887 7.40969C7.38013 9.93922 9.42394 11.9973 11.9525 12.0059H11.9849Z" stroke="currentColor" stroke-width="1.42857" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>
                        <p class="dark-gray"><?php echo $post['author'] ;?></p>
                        &nbsp;&nbsp;
                      </div>
                      <div class="date">
                      <svg class="icon-22" width="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M3.09277 9.40421H20.9167" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M16.442 13.3097H16.4512" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M12.0045 13.3097H12.0137" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M7.55818 13.3097H7.56744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M16.442 17.1962H16.4512" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M12.0045 17.1962H12.0137" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M7.55818 17.1962H7.56744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M16.0433 2V5.29078" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M7.96515 2V5.29078" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.2383 3.5791H7.77096C4.83427 3.5791 3 5.21504 3 8.22213V17.2718C3 20.3261 4.83427 21.9999 7.77096 21.9999H16.229C19.175 21.9999 21 20.3545 21 17.3474V8.22213C21.0092 5.21504 19.1842 3.5791 16.2383 3.5791Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>        
                        <p class="dark-gray"><?php echo date('d M Y', strtotime($post['created_at'])) ;?></p>
                      </div>

                      <div class="date">
                      <svg class="icon-22" width="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M22.4541 11.3918C22.7819 11.7385 22.7819 12.2615 22.4541 12.6082C21.0124 14.1335 16.8768 18 12 18C7.12317 18 2.98759 14.1335 1.54586 12.6082C1.21811 12.2615 1.21811 11.7385 1.54586 11.3918C2.98759 9.86647 7.12317 6 12 6C16.8768 6 21.0124 9.86647 22.4541 11.3918Z" stroke="currentColor"></path>                                    <circle cx="12" cy="12" r="5" stroke="currentColor"></circle>                                    <circle cx="12" cy="12" r="3" fill="currentColor"></circle>                                    <mask mask-type="alpha" maskUnits="userSpaceOnUse" x="9" y="9" width="6" height="6">                                    <circle cx="12" cy="12" r="3" fill="currentColor"></circle>                                    </mask>                                    <circle opacity="0.89" cx="13.5" cy="10.5" r="1.5" fill="white"></circle> </svg>
                        <p class="dark-gray"><?php echo $post['views'] ;?></p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="blog-img mt-24 mb-5">
                  <img style="max-height:600px;" src="<?php echo $image;?>" alt="<?php echo $post['name'];?>">
                  <div class="ads-container">
                  <div class="ads">
                  <?php echo getAds('content_after_image'); ?>
                  </div>
                </div>
                </div>
                <div class="ads-container">
                <div class="ads">
                <?php echo getAds('content_middle'); ?>
                </div>
              </div>
                <?php echo htmlspecialchars_decode($post['description']); ?>
                <div class="ads-container">
                <div class="ads">
                <?php echo getAds('content_end'); ?>
                </div>
              </div>
                <!-- Blog Comments Start -->
                <div class="comment mt-5">
                  <div class="heading ">
                    <h3>  <?php echo $db->table('comments')->where('post_id', $post['id'])->count();?> Comments</h3>
                  </div>
        
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
                        echo renderCommentsBlog($nestedReviews, $isLogin, $AuthUser, $post['id']);

                  ?>

                  </div>
        
                </div>
                <!-- Blog Comments End -->

                <div class="leave-comment mb-32 mt-40">
                  <h3>Leave a Comment</h3>
                  <?php if($isLogin) : ?>
                    <h6 class="my-3">Commenting as <b><?php echo $AuthUser['name'];?></b></h6>
                  <h6>Your email will be kept private. Required fields are marked *</h6>
                  <form class="auth" method="POST">
                    <div class="mt-24 mb-24">
                      <textarea class="form-control notes write-comment bg-lightest-gray" name="content" rows="4"
                        placeholder="Write your comments here"></textarea>
                    </div>
                    <input type="hidden" name="name" value="<?php echo $AuthUser['name']; ?>">
                    <input type="hidden" name="email" value="<?php echo $AuthUser['email']; ?>">
                    <input type="hidden" name="post_id" value="<?php echo $post['id'];?>">
                    <input type="hidden" name="action" value="addblogcomment">
                    <button type="submit" class="cus-btn small"><span class="icon"><img src="<?php echo MAIN_ASSETS;?>/media/icons/click-button.png"
                          alt=""></span>Send Message</button>
                  </form>

                  <?php else: ?>

                    <h6>Your email will be kept private. Required fields are marked *</h6>
                  <form class="auth" method="POST">
                    <div class="mt-24 mb-24">
                      <textarea class="form-control notes write-comment bg-lightest-gray" name="content" rows="4"
                        placeholder="Write your comments here"></textarea>
                    </div>
                    <div class="row mb-4">
                      <div class="col">
                        <div class="email-input">
                          <input type="text" id="" class="form-control notes email bg-lightest-gray" name="email" placeholder="Email" />
                        </div>
                      </div>
                      <div class="col">
                        <div class="email-input">
                          <input type="text" id="form6Example2" class="form-control notes email bg-lightest-gray" name="name" placeholder="Name" />
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="cus-btn small"><span class="icon"><img src="<?php echo MAIN_ASSETS;?>/media/icons/click-button.png"
                          alt=""></span>Send Message</button>
                          
                    <input type="hidden" name="action" value="addblogcomment">
                    <input type="hidden" name="post_id" value="<?php echo $post['id'];?>">
                  </form>

                  <?php endif; ?>

                </div>


                
              </div>
        
              <div class="col-xl-4">
              <div class="ads-container">
                <div class="ads">
                <?php echo getAds('sidebar'); ?>
                </div>
              </div>
                <div class="right-content">

                  <div class="filter-block">
                  <div class="title mb-32">
                                          <h5>Search</h5>
                                          <i class="far fa-horizontal-rule"></i>
                                      </div>
                                      <form method="get" action="<?=APP_URL?>/blog">
                                          <div class="form-group has-search">
                                              <input name="search" type="text" class="form-control" placeholder="Find the books...">
                                              <button type="submit" class="b-unstyle"><i class="fal fa-search"></i></button>
                                          </div>
                                      </form>
                                  </div>
                  <hr>
                  <div class="filter-block">
                                      <div class="title mb-32">
                                          <h5>Categories</h5>
                                          <i class="far fa-horizontal-rule"></i>
                                      </div>
                                      <ul class="unstyled list">
                                        
                                        <?php
                                        foreach($_cats as $item): ?>
                                          <li class="mb-16">
                                              <div class="filter-checkbox">
                                                  <input type="checkbox">
                                                  <label for="Instock" class="shu-short"><a href="<?=APP_URL.'/blog?cat='.$item['id']?>"><?=$item['name']?></a></label>
                                              </div>
                                              <h6 class="dark-gray">(<?=$item['total_post']?>)</h6>
                                          </li>
                                          <?php endforeach; ?>
                                          
                                      </ul>
                                  </div>
        
                  
                  <hr>
                  <h5>Recent Article</h5>
                  <div class="recent-articles">
                    <?php 
                    foreach($recents as $item) :?>
                    <?php $imageBLOG = $item['image'] ? APP_URL.'/Public/thumb'.$item['img_folder'].'/'.$item['image'] : APP_URL.'/Public/assets/main/img/noimg.jpg'; ?>

                    <div class="article-box bg-lightest-gray mb-24">
                      <div class="image-area">
                        <a href="<?php echo APP_URL.'/blog/'.$item['slug'];?>"><img style="max-width:132px; max-height:80px;" src="<?php echo $imageBLOG;?>" alt="<?php echo $item['name'];?>"></a>
                      </div>
                      <div class="content-area">
                        <h6 class="short"><?php echo $item['name'];?></h6>
                        <a href="<?php echo APP_URL.'/blog/'.$item['slug'];?>" class="cus-btn bg-white">Read More<img src="<?php echo MAIN_ASSETS.'/media/icons/click-button.png';?>"
                            alt="<?php echo $item['name'];?>"></a>
                      </div>
                    </div>
                    <?php endforeach;?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- Blog Details End -->