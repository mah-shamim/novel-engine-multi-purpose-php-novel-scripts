<?php

include( __DIR__.'/../hero2.php');
 
?>

        <!-- Main Content Start -->
        <div class="container mt-60">
            
                <div class="input-field">
                    <div class="categories">
                    <form method="get" action="<?php echo APP_URL; ?>/blog" id="search-bar">
                    <select class="search-select" id="category-select" name="cat" onchange="this.form.submit()">
                    <option class="books-name" value="">All Categories</option>
                            <?php 
                                foreach($categories as $cat) {
                                    echo '<option class="" value="'.$cat['id'].'">'.$cat['name'].'</option>';
                                }?>
                            
                        </select>
                    </div>
                    <div class="vl"></div>
                    <div class="input-search">
                        <input type="text" class="search-books" name="search" placeholder="Search Posts...">
                        <button type="submit"><i class="fal fa-search"></i></button>
                    </div>
                </div>
            </form> 
        </div>

        <section class="blog-section mt-24">
          <div class="container">
            <div class="row mb-24">

                <?php 
   foreach($rows as $post) {

    $image = $post['image'] ? APP_URL.'/Public/thumb'.$post['img_folder'].'/'.$post['image'] : APP_URL.'/Public/assets/main/img/noimg.jpg';

    $html = '<div class="col-xl-4 col-lg-6 mb-24">';
    $html .= '<div class="blog-box bg-lightest-gray">';
    $html .= '<div class="blog-img mb-32">';
    $html .= '<a href="'.APP_URL.'/blog/'.$post['slug'].'"><img src="'.$image.'" alt=""></a></div>';
    $html .= '<div class="name-date mb-12 d-flex justify-content-start">';
    $html .= '<div class="writer-name">';
    $html .= '<svg class="icon-22" width="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9849 15.3462C8.11731 15.3462 4.81445 15.931 4.81445 18.2729C4.81445 20.6148 8.09636 21.2205 11.9849 21.2205C15.8525 21.2205 19.1545 20.6348 19.1545 18.2938C19.1545 15.9529 15.8735 15.3462 11.9849 15.3462Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9849 12.0059C14.523 12.0059 16.5801 9.94779 16.5801 7.40969C16.5801 4.8716 14.523 2.81445 11.9849 2.81445C9.44679 2.81445 7.3887 4.8716 7.3887 7.40969C7.38013 9.93922 9.42394 11.9973 11.9525 12.0059H11.9849Z" stroke="currentColor" stroke-width="1.42857" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>';
    $html .= '<p class="dark-gray">'.$post['author'].'</p>';
    $html .= '&nbsp;&nbsp;';
    $html .= '</div>';
    $html .= '                      <div class="date">
      <svg class="icon-22" width="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M22.4541 11.3918C22.7819 11.7385 22.7819 12.2615 22.4541 12.6082C21.0124 14.1335 16.8768 18 12 18C7.12317 18 2.98759 14.1335 1.54586 12.6082C1.21811 12.2615 1.21811 11.7385 1.54586 11.3918C2.98759 9.86647 7.12317 6 12 6C16.8768 6 21.0124 9.86647 22.4541 11.3918Z" stroke="currentColor"></path>                                    <circle cx="12" cy="12" r="5" stroke="currentColor"></circle>                                    <circle cx="12" cy="12" r="3" fill="currentColor"></circle>                                    <mask mask-type="alpha" maskUnits="userSpaceOnUse" x="9" y="9" width="6" height="6">                                    <circle cx="12" cy="12" r="3" fill="currentColor"></circle>                                    </mask>                                    <circle opacity="0.89" cx="13.5" cy="10.5" r="1.5" fill="white"></circle> </svg>
        <p class="dark-gray">'.$post['views'].'</p>
      </div>';
    $html .= '</div>';
    $html .= '<div class="blog-content">';
    $html .= '<h5 class="mb-24">';
    $html .= '<a href="'.APP_URL.'/blog/'.$post['slug'].'"> '.$post['name'].' </a>';
    $html .= '</h5>';
    $html .= '<div class="d-flex justify-content-start">';
    $html .= '<span class="h6 mx-2"><a href="'.APP_URL.'/blog/'.$post['slug'].'" class="cus-btn small"><span class="icon"><img
      src="'.MAIN_ASSETS.'/media/icons/click-button.png" alt="read more"></span>Read More</a></span>';
  
      $html .= '<div class="date mx-2">';
      $html .= '    <span>                      <svg class="icon-22" width="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M3.09277 9.40421H20.9167" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M16.442 13.3097H16.4512" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M12.0045 13.3097H12.0137" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M7.55818 13.3097H7.56744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M16.442 17.1962H16.4512" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M12.0045 17.1962H12.0137" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M7.55818 17.1962H7.56744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M16.0433 2V5.29078" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M7.96515 2V5.29078" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.2383 3.5791H7.77096C4.83427 3.5791 3 5.21504 3 8.22213V17.2718C3 20.3261 4.83427 21.9999 7.77096 21.9999H16.229C19.175 21.9999 21 20.3545 21 17.3474V8.22213C21.0092 5.21504 19.1842 3.5791 16.2383 3.5791Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                ';
      $html .= '<span class="dark-gray">'.date('d M Y', strtotime($post['created_at'])).'</span> </span>';
      $html .= '</div>';
      $html .= '</div>';
    $html .= '                  </div>
</div>
</div>';
    $html .= '';

echo $html;
}
                
                ?>
              
            </div>
        
        
          </div>
        </section>

                <!-- Blogs Section End -->
                <section class="page-numbers mb-48">
                <div class="container">
                   <?php include(__DIR__.'/../pagination.php'); ?>
                </div>
                </section>