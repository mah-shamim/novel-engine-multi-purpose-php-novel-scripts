<?php

if($page) : ?>
<?php

include('hero2.php');
unset($latest); 
?>   


	    <!-- Main Content Start -->
	<div class="page-content">
      <section>
        <div class="container">
          <div class="row">
            <div class="col-xl-9">
			<div class="ads-container">
				<div class="ads">
				<?php echo getAds('content_start'); ?>
				</div>
			</div>
			 <div class="our-story-img">
				<img src="<?php echo $imagepage;?>" alt="<?php echo $page['name'];?>">
			 </div>
			 <div class="ads-container">
				<div class="ads">
				<?php echo getAds('content_after_image'); ?>
				</div>
			</div>
			 <p class="mb-16 dark-gray"><?php echo html_entity_decode($page['description']) ?></p>
			 <div class="ads-container">
				<div class="ads">
				<?php echo getAds('content_end'); ?>
				</div>
			</div>
            </div>

            <div class="col-xl-3">
            <?php include('sidebar.php'); ?>
          </div>
          </div>
        </div>
      </section>
    </div>


<?php endif; ?>

    