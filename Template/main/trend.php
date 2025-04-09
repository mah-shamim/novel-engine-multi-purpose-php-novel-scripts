
	    <!-- Trending Books Slider Start-->
		<section class="weekly-deals-2 pt-40">
      <div class="container">
        <div class="heading">
          <h3>Trending Novels</h3>
        </div>
        <div class="weekly-deals-slider mt-48">

        <?php foreach($trend as $row) : ?>
        <div class="week-deal-card">
              <div class="img-box">
              <img src="<?php echo APP_URL.'/Public/thumb/225x325'.$row['img_folder'].'/'.$row['image'] ?>" alt="<?php echo $row['name'];?>">
              </div>
              <div class="content-box">
                <div class="price-row mb-3">
                  <h6 class="shu-short"><?php echo $row['author']; ?></h6>
                </div>
                <h5 class="mb-16 shu-short"><a href="<?php echo APP_URL.'/'.$row['slug']; ?>"><?php echo $row['name'];?></a></h5>
                <h6><a href="<?php echo APP_URL.'/'.$row['slug']; ?>" class="cus-btn small m-auto"><span class="icon"><img
                        src="<?=MAIN_ASSETS?>/media/icons/click-button.png" alt=""></span>Download</a></h6>
              </div>
            </div>
			<?php endforeach; ?>

   
        </div>
      </div>
    </section>

    <!-- Trending Books Slider End-->
	
	
	
	    <!-- Trending Books Slider Start-->
		<section class="trending-books pt-40 mb-5">
      <div class="container">
        <div class="heading">
          <h3>Top Authors</h3>
        </div>
		<div class="owl-carousel owl-theme" id="topAuthorsCarousel">
			<?php foreach($author as $row) : ?>
				<?php

								if(empty($row['image'])) {
									$image = APP_URL.'/Public/assets/main/img/author.jpg';
								} else {
									$image = APP_URL.'/Public/thumb/'.$row['img_folder'].'/'.$row['image'];
								}
								?>
		<div class="item">
		<a href="<?php echo APP_URL.'/author/'.$row['slug']; ?>"><img src="<?php echo $image; ?>" class="rounded-circle" alt="<?php echo $row['name']; ?>" style="width: 100px; height: 100px;"></a>
		<h5 class="mt-3"><a href="<?php echo APP_URL.'/author/'.$row['slug']; ?>"><?php echo $row['name']; ?></a></h5>
		</div>
		<?php endforeach; ?>
  

  </div>
      </div>
    </section>
    <!-- Trending Books Slider End-->


