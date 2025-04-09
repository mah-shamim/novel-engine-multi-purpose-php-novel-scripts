



    <!-- Banner-2 Start -->
    <div class="hero-banner-2 bg-lightest-gray pb-40">
      <div class="container">
        <div class="banner-2">
          <div class="banner-images">
            <?php
            $serial = 1;
             foreach($rand as $row) : ?>
            <a href="<?php echo APP_URL.'/'.$row['slug']; ?>"><img src="<?php echo APP_URL.'/Public/thumb/225x325'.$row['img_folder'].'/'.$row['image'] ?>" alt="" class="stair-image-<?php echo $serial++;?> swing"></a>
            <?php endforeach; ?>
          </div>
          <div class="banner-text text-center">
            <h1>Explore Your Dream Novels</h1>
            <h5 class="dark-gray">Explore, search, download and read our Novels as <?=APP_NAME?> </h5>
            
          </div>
        </div>
      </div>
    </div>


    <!-- Banner-2 End-->