<?php if($files) 
{ ?>
    <section class="horror p-40">
        <div class="container">
          <div class="heading">
            <h3><?=$files[0]['cat_title'];?></h3>
          </div>
          <div class="row">
            <?php

            $count = 0;
            $firstItem = false;

            foreach($files as $catitems) {

                $image = empty($catitems['image']) ? APP_URL.'/Public/assets/main/img/noimg.jpg' : APP_URL.'/Public/thumb/450x650'.$catitems['img_folder'].'/'.$catitems['image'];

                $count++;
                if(!$firstItem && $count == 1) {
                    echo '<div class="col-lg-4 col-md-5">
                    <a href="'.APP_URL.'/'.$catitems['slug'].'"><img src="'.$image.'" alt="'.$catitems['name'].'" class="br-30"></a>
                      </div>';
                continue;
                $firstItem = true;
                }
            }

            ?>


            <div class="col-lg-8 col-md-7 ">
              <div class="horror-books-slider">

              <?php

              foreach($files as $catitems) {

                $image = empty($catitems['image']) ? APP_URL.'/Public/assets/main/img/noimg.jpg' : APP_URL.'/Public/thumb/450x650'.$catitems['img_folder'].'/'.$catitems['image'];

                if($count == 1) {
                    $count++;
                    continue;
                }

                echo '<div class="slide-images">
                  <a href="'.APP_URL.'/'.$catitems['slug'].'" alt="'.$catitems['name'].'"><img src="'.$image.'"></a>
                  <div class="images-text">
                    <h5 class="mt-3"><a href="'.APP_URL.'/'.$catitems['slug'].'">'.$catitems['name'].'</a></h5>
                    <h5 class="color-primary mt-8">'.date('d M, Y', strtotime($catitems['created_at'])).'</h5>
                  </div>
                </div>';

              }
              
              ?>
                
              </div>
            </div>

          </div>
        </div>
      </section>
<?php } ?>