
<div class="hero-banner-3 bg-lightest-gray">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-4 col-md-4 col-sm-12">
                  <div class="text-block">
                    <h2 class="mb-12 shu-short2"><?=$title;?></h2>
                    <p class="dark-gray">Let download <br> Embrace and explore our novels.</p>
                  </div>
                </div>
                <div class="col-xl-6 col-lg-8 col-md-8 col-sm-12">
                  <div class="images-row">

   
                    
                    <?php 
$count = 0;

foreach($latests as $item) {
    $image = empty($item['image']) ? APP_URL.'/Public/assets/main/img/noimg.jpg' : APP_URL.'/Public/thumb/182x268'.$item['img_folder'].'/'.$item['image'];
    $count++;
    
    // Add the 'big' class to the second image
    $class = $count == 2 ? 'blog-img big' : 'blog-img';
    $style = $count == 2 ? 'max-height:280px;' : 'max-height:240px;';
    
    echo '<a href="'.APP_URL.'/'.$item['slug'].'"> <img src="'.$image.'" class="'.$class.'" style="'.$style.'" alt="'.$item['name'].'"> </a>';
}
?>

                   
                  </div>
                </div>
            </div>
        </div>
</div>