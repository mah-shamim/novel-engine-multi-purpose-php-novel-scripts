
        <!-- Blog Details Start -->
        <section class="blogs mt-60">
          <div class="container">
        <div class="row">
            <div class="row">
            <div class="top-row p-40">
              <div class="col-sm-6">
                <div class="left-block">

                <?php
				$sR = min(($page - 1) * $wordsPerPage + 1, $totalFiles);
				$eR = min($page * $limit, $totalFiles);
				echo '<h6 class="dark-gray">Showing '.$sR.' words to '.$eR.'  words out of '.$totalFiles.' words</h6>';
				?>
                  
                </div>
              </div>
              <div class="col-sm-6">
                <div class="right-block">
                  
                </div>
              </div>
            </div>
          </div>
              <div class="col-xl-9">
                <div class="blog-title" id="file">
                  <h3><?php echo $page ? "Chapter ".$page.' - '.$file['name'] : $file['name'];?></h3>
                  <div class="ads-container">
                  <div class="ads">
                  <?php echo getAds('content_start'); ?>
                  </div>
                </div>
                <div class="tag-name-date mt-3 d-flex flex-column flex-md-row justify-content-start align-items-start align-items-md-center">
  <div class="category-tag">
    <a href="<?php echo APP_URL.'/category/'.$file['cat_slug'];?>">
      <h6><?php echo $file['cat_name'];?></h6>
    </a>
  </div>
  <div class="name-date mb-3 mb-md-0 ml-md-3 d-flex flex-column flex-sm-row flex-wrap">
    <div class="writer-name d-flex align-items-center mr-3 mb-2 mb-sm-0">
      <svg class="icon-22" width="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    
        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9849 15.3462C8.11731 15.3462 4.81445 15.931 4.81445 18.2729C4.81445 20.6148 8.09636 21.2205 11.9849 21.2205C15.8525 21.2205 19.1545 20.6348 19.1545 18.2938C19.1545 15.9529 15.8735 15.3462 11.9849 15.3462Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    
        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9849 12.0059C14.523 12.0059 16.5801 9.94779 16.5801 7.40969C16.5801 4.8716 14.523 2.81445 11.9849 2.81445C9.44679 2.81445 7.3887 4.8716 7.3887 7.40969C7.38013 9.93922 9.42394 11.9973 11.9525 12.0059H11.9849Z" stroke="currentColor" stroke-width="1.42857" stroke-linecap="round" stroke-linejoin="round"></path>                                
      </svg>
      <p class="dark-gray mb-0 ml-2 "><?php echo (isset($author) ? $author : 'Unknown');?> &nbsp;&nbsp;</p>
       
    </div>
    <div class="date d-flex align-items-center mr-3 mb-2 mb-sm-0">
      <svg class="icon-22" width="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    
        <path d="M3.09277 9.40421H20.9167" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    
        <path d="M16.442 13.3097H16.4512" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    
        <path d="M12.0045 13.3097H12.0137" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    
        <path d="M7.55818 13.3097H7.56744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    
        <path d="M16.442 17.1962H16.4512" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    
        <path d="M12.0045 17.1962H12.0137" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    
        <path d="M7.55818 17.1962H7.56744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    
        <path d="M16.0433 2V5.29078" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    
        <path d="M7.96515 2V5.29078" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    
        <path fill-rule="evenodd" clip-rule="evenodd" d="M16.2383 3.5791H7.77096C4.83427 3.5791 3 5.21504 3 8.22213V17.2718C3 20.3261 4.83427 21.9999 7.77096 21.9999H16.229C19.175 21.9999 21 20.3545 21 17.3474V8.22213C21.0092 5.21504 19.1842 3.5791 16.2383 3.5791Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                
      </svg>
      <p class="dark-gray mb-0 ml-2"> <?php echo date('d M Y', strtotime($file['created_at']));?></p>
    </div>
    <div class="date d-flex align-items-center">
      <svg class="icon-22" width="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    
        <path d="M22.4541 11.3918C22.7819 11.7385 22.7819 12.2615 22.4541 12.6082C21.0124 14.1335 16.8768 18 12 18C7.12317 18 2.98759 14.1335 1.54586 12.6082C1.21811 12.2615 1.21811 11.7385 1.54586 11.3918C2.98759 9.86647 7.12317 6 12 6C16.8768 6 21.0124 9.86647 22.4541 11.3918Z" stroke="currentColor"></path>                                    
        <circle cx="12" cy="12" r="5" stroke="currentColor"></circle>                                    
        <circle cx="12" cy="12" r="3" fill="currentColor"></circle>                                    
        <mask mask-type="alpha" maskUnits="userSpaceOnUse" x="9" y="9" width="6" height="6">                                    
          <circle cx="12" cy="12" r="3" fill="currentColor"></circle>                                    
        </mask>                                    
        <circle opacity="0.89" cx="13.5" cy="10.5" r="1.5" fill="white"></circle> 
      </svg>
      <p class="dark-gray mb-0 ml-2"><?php echo $file['views'];?></p>
    </div>
  </div>
</div>

                </div>
                <div class="ads-container">
                <div class="ads">
                <?php echo getAds('content_middle'); ?>
                </div>
              </div>
                <p class="book mb-5" style="font-size:20px;"> <?php echo $novelText; ?></p>
                <?php if($isembed === true) {
                  echo embedPdfInIframe($pdfPath);
                }?>
                <div class="ads-container">
                <div class="ads">
                <?php echo getAds('content_end'); ?>
                </div>
              </div>

              <section class="page-numbers mb-48">
                <div class="container">
                   <?php include(__DIR__.'/readpaginate.php'); ?>
                </div>
                </section>
                
              </div>
              <div class="col-xl-3">
              <div class="ads-container">
                <div class="ads">
                <?php echo getAds('sidebar'); ?>
                </div>
              </div>
                <div class="right-content mr-3">


                  <div class="filter-block">
                                      <div class="title mb-32">
                                          <h5>Chapters</h5>
                                          <i class="far fa-horizontal-rule"></i>
                                      </div>
                                      <ul class="unstyled list">
                                        
                                      <?php 
                                    if ($totalPages > 1) {
                                        for ($i = 1; $i <= $totalPages; $i++) {
                                            if ($i == $page) {?>

                                        <li class="mb-16">
                                              <div class="filter-checkbox">
                                                  <input type="checkbox">
                                                  <label for="Instock" style="color:#c416bb;" class="shu-short active"><a href="?chapter=<?=$i?>">Chapter <?=$i?></a> </label>
                                              </div>
                                          </li>

                                           <?php  } else {?>
                                               
                                        <li class="mb-16">
                                              <div class="filter-checkbox">
                                                  <input type="checkbox">
                                                  <label for="Instock" class="shu-short"><a href="?chapter=<?=$i?>">Chapter <?=$i?> </a></label>
                                              </div>
                                          </li>
                                         <?php   }
                                        }
                                    
                                    } 
                                      ?> 
                                      </ul>
                  </div>  
                  
                  <hr>
                  <h5>Related Ebooks</h5>
                  <div class="recent-articles">
                    <?php 
                    foreach($recents as $item) :?>
                    <?php $imageBLOG = $item['image'] ? APP_URL.'/Public/thumb/182x268/'.$item['img_folder'].'/'.$item['image'] : APP_URL.'/Public/assets/main/img/noimg.jpg'; ?>

                    <div class="article-box bg-lightest-gray mb-24">
                      <div class="image-area">
                        <a href="<?php echo APP_URL.'/'.$item['slug'];?>"><img style="max-width:132px; max-height:80px;" src="<?php echo $imageBLOG;?>" alt="<?php echo $item['name'];?>"></a>
                      </div>
                      <div class="content-area">
                        <h6 class="short"><a href="<?php echo APP_URL.'/'.$item['slug'];?>"><?php echo $item['name'];?> </a></h6>
                      </div>
                    </div>
                    <?php endforeach;?>
                  </div>
                </div>
              </div>

              <div class="col-xl-8 mx-3">
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
              <div class="col-xl-4 mx-3">
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
        <div class="toast-container" id="toastContainer"></div>

        <!-- Blog Details End -->
        <div class="fixed-bottom-nav">
        <button class="btn-nav" id="homeBtn" onclick="navigateHome()" aria-label="Home"><i class="fal fa-home"></i></button>
        <button class="btn-nav" id="darkModeToggle" onclick="toggleDarkMode()" aria-label="Toggle dark mode"><i class="fal fa-moon"></i></button>
        <button class="btn-nav" id="increaseFontBtn" onclick="increaseFontSize()" aria-label="Increase font size">A+</button>
        <button class="btn-nav" id="decreaseFontBtn" onclick="decreaseFontSize()" aria-label="Decrease font size">A-</button>
    </div>       
        


<script>
          function showToast(message) {
            const toastContainer = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = 'toast';
            toast.innerText = message;
            toastContainer.appendChild(toast);

            setTimeout(() => {
                toast.classList.add('show');
                setTimeout(() => {
                    toast.classList.remove('show');
                    toastContainer.removeChild(toast);
                }, 3000);
            }, 100);
        }

        document.addEventListener('copy', (e) => {
            e.preventDefault();
            showToast('Copying content is not allowed');
        });

        document.addEventListener('cut', (e) => {
            e.preventDefault();
            showToast('Cutting content is not allowed');
        });

        document.addEventListener('selectstart', (e) => {
            e.preventDefault();
            showToast('Selecting content is not allowed');
        });

        document.addEventListener('keydown', (e) => {
            if (e.ctrlKey && (e.key === 'c' || e.key === 'x')) {
                e.preventDefault();
                showToast(`Using Ctrl+${e.key.toUpperCase()} is not allowed`);
            }
        });


        document.addEventListener('DOMContentLoaded', function() {
        var iframe = document.getElementById('pdf-iframe');

        document.getElementById('fullscreen-btn').addEventListener('click', function() {
            if (iframe.requestFullscreen) {
                iframe.requestFullscreen();
            } else if (iframe.mozRequestFullScreen) { // Firefox
                iframe.mozRequestFullScreen();
            } else if (iframe.webkitRequestFullscreen) { // Chrome, Safari, and Opera
                iframe.webkitRequestFullscreen();
            } else if (iframe.msRequestFullscreen) { // IE/Edge
                iframe.msRequestFullscreen();
            }
        });


                // Zoom functionality
       iframe.addEventListener('wheel', function(event) {
            event.preventDefault();
            if (event.deltaY < 0) {
                scale += 0.1; // Zoom in
            } else {
                scale -= 0.1; // Zoom out
            }
            scale = Math.min(Math.max(1, scale), 3); // Limit zoom scale between 1 and 3
            iframe.style.transform = 'scale(' + scale + ')';
        });
    });

</script>
