<?php 

$cls = isset($cts) ? $cts : 4;

foreach($files as $file): ?>
				<?php

				$image = empty($file['image']) ? APP_URL.'/Public/assets/main/img/noimg.jpg' : APP_URL.'/Public/thumb/450x650'.$file['img_folder'].'/'.$file['image'];

				?>



               <div class="col-lg-<?=$cls;?> col-md-6 col-sm-6">
                  <div class="book-card mb-24">
                    <a href="<?php echo APP_URL.'/'.$file['slug'];?>"><img src="<?php echo $image;?>" alt="<?php  echo $file['name'] ?>"></a>
                    <div class="">
                      <ul class="unstyled hover-buttons">
                        <li><a href="<?php echo APP_URL.'/'.$file['slug'];?>"><i class="fal fa-download"></i></a></li>
                      </ul>
                    </div>
                    <div class="book-content">
                      <h5 class="mt-24 shu-short"><a href="<?php echo APP_URL.'/'.$file['slug'];?>"><?php  echo $file['name'] ?></a></h5>
                      <h6 class="dark-gray"><?php  echo $file['author'] ?></h6>
                      <h6><?php echo date('d M, Y', strtotime($file['created_at'])); ?> | <?php  echo $file['views'] ?> views</h6>
                    </div>
                  </div>
                </div>


<?php endforeach; ?>