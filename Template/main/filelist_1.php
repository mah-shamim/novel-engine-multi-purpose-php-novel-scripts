<?php 
foreach($files as $file): ?>
				<?php

				$image = empty($file['image']) ? APP_URL.'/Public/assets/main/img/noimg.jpg' : APP_URL.'/Public/thumb/450x650'.$file['img_folder'].'/'.$file['image'];

				?>
          <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">

            <div class="coming-block mb-2">
              <div class="fit-image">
                <a href="<?php echo APP_URL.'/'.$file['slug'];?>"><img src="<?php echo $image;?>" class="br-20" alt="<?php  echo $file['name'] ?>" /></a>
              </div>
              <div class="coming-content">
                <div class="first-content">
                  <h5 class="shu-short"><a href="<?php echo APP_URL.'/'.$file['slug'];?>"><?php  echo $file['name'] ?></a></h5>
               
                  <h6 class="dark-gray mb-24"><?php  echo $file['author'] ?></h6>
				  <span><?php echo date('d M, Y', strtotime($file['created_at'])); ?></span>
                </div>
                <div class="second-content">
                  <div class="prices">
                    <span class="h5"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15.1614 12.0531C15.1614 13.7991 13.7454 15.2141 11.9994 15.2141C10.2534 15.2141 8.83838 13.7991 8.83838 12.0531C8.83838 10.3061 10.2534 8.89111 11.9994 8.89111C13.7454 8.89111 15.1614 10.3061 15.1614 12.0531Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.998 19.355C15.806 19.355 19.289 16.617 21.25 12.053C19.289 7.48898 15.806 4.75098 11.998 4.75098H12.002C8.194 4.75098 4.711 7.48898 2.75 12.053C4.711 16.617 8.194 19.355 12.002 19.355H11.998Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </svg> <?php echo $file['views']; ?> </span>
                    
                  </div>
                  <div class="product-btn">
                    <button type="button"  class="cus-btn small h6">
					  <span class="plain-text"><a href="<?php echo APP_URL.'/'.$file['slug'];?>"> <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.666 21.25H16.335C19.355 21.25 21.25 19.111 21.25 16.084V7.916C21.25 4.889 19.365 2.75 16.335 2.75H7.666C4.636 2.75 2.75 4.889 2.75 7.916V16.084C2.75 19.111 4.636 21.25 7.666 21.25Z" stroke="currentColor"></path>                                    <path d="M12 16.0861V7.91406" stroke="currentColor"></path>                                    <path d="M15.748 12.3223L12 16.0863L8.25195 12.3223" stroke="currentColor"></path>                                </svg></a></span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
<?php endforeach; ?>