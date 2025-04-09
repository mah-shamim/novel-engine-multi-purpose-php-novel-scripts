<?php
require_once "rand.php";
require_once "trend.php";
?>
			<div class="ads-container">
				<div class="ads">
				<?php echo getAds('home_ads_1'); ?>
				</div>
			</div>
<?php
require_once "recent.php";
?>
			<div class="ads-container">
				<div class="ads">
				<?php echo getAds('home_ads_2'); ?>
				</div>
			</div>
<?php

$files = $cat_home_1;
include ("widget_cat.php");
unset($files);
$files = $cat_home_2; 
include('widget_cat.php');
unset($files);?>

<div class="ads-container">
				<div class="ads">
				<?php echo getAds('home_ads_3'); ?>
				</div>
			</div>
<?php

include('latest.php');

?>






  

