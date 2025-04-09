<?php

$db = new App\General\DB();

include(__DIR__.'/../../Controllers/main/sidebar.php');

$title = "Page not found";

$latests = $db->table('ebook')
->select('*')
->where('status', 1)
->orderBy('RAND()', '')
->limit(3)
->get();


include('hero2.php');
unset($latests); 
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
				<img src="/Public/img/book.png" alt="<?php echo APP_NAME;?>">
			 </div>
			 <div class="ads-container">
				<div class="ads">
				<?php echo getAds('content_after_image'); ?>
				</div>
			</div>
			 <h2 class="mb-16 dark-gray">
			 Oops! Something Went Wrong
			 </h2>
			 <h4 class="mb-16 dark-gray">The page you're looking for might have been deleted or expired.
			 </h4>
			 <p class="mb-16 dark-gray">We couldn't find the page you were looking for. It might have been removed, had its name changed, or is temporarily unavailable. But don't worry, we've got a few options to help you get back on track..
			 </p>
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

