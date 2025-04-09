<?php 
foreach($rows as $list): ?>
	  <?php

            if($list['image']) {

                if($table == 'book') {
                    $image = APP_URL.'/Public/thumb/182x268'.$list['img_folder'].'/'.$list['image'];
                } else {
                    $image = APP_URL.'/Public/thumb/'.$list['img_folder'].'/'.$list['image'];
                }
                
            } else {
                $image =  APP_URL.'/Public/assets/main/img/noimg.jpg';
            }

		?>
               <div class="col-lg-3 col-md-4 col-sm-6">
                  <div class="book-card mb-24">
                    <a href="<?php echo APP_URL.'/'.$slug.'/'.$list['slug'];?>"><img src="<?php echo $image;?>" alt="<?php  echo $list['name'] ?>"></a>

                    <div class="book-content">
                      <h5 class="mt-24"><a href="<?php echo APP_URL.'/'.$slug.'/'.$list['slug'];?>"><?php  echo $list['name'] ?></a></h5>
                      <h6 class="dark-gray">Total Books: <?php  echo $list['total_post'] ?></h6>
                    </div>
                  </div>
                </div>
<?php endforeach; ?>