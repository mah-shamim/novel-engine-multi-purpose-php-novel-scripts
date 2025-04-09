
<div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="py-3 mb-4"><span class="text-muted fw-light"><a href="<?=AdminURL?>">Home</a> </span> </h4>

  <div class="row mb-5">



  <div class="col-sm-6 col-lg-3 mb-3">
    <div class="card card-border-shadow-primary h-100">
      <div class="card-body">
        <div class="d-flex align-items-center mb-2">
          <div class="avatar me-4">
            <span class="avatar-initial rounded bg-label-primary"><i class="mdi mdi-file-multiple mdi-24px"></i></span>
          </div>
          <h4 class="mb-0"><?php echo $totalFiles; ?></h4>
        </div>
        <h6 class="mb-0 fw-normal">Files </h6>
        <p class="mb-0">
          <span class="me-1 fw-medium"><?php echo $monthFiles; ?></span>
          <small class="text-muted">Added this Month</small>
        </p>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-lg-3 mb-3">
    <div class="card card-border-shadow-warning h-100">
      <div class="card-body">
        <div class="d-flex align-items-center mb-2">
          <div class="avatar me-4">
            <span class="avatar-initial rounded bg-label-warning"><i class="mdi mdi-book-open mdi-24px"></i></span>
          </div>
          <h4 class="mb-0"><?php echo $totalBooks; ?></h4>
        </div>
        <h6 class="mb-0 fw-normal">Book Albums</h6>
        <p class="mb-0">
          <span class="me-1 fw-medium"><?php echo $db->table('book')
                 ->where('YEAR(created_at)', date('Y'))
                 ->where('MONTH(created_at)', date('m'))
                 ->count(); ?></span>
          <small class="text-muted">Added this Month</small>
        </p>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-lg-3 mb-3">
    <div class="card card-border-shadow-danger h-100">
      <div class="card-body">
        <div class="d-flex align-items-center mb-2">
          <div class="avatar me-4">
            <span class="avatar-initial rounded bg-label-danger"><i class="mdi mdi-account-outline mdi-24px"></i></span>
          </div>
          <h4 class="mb-0"><?php echo $totalAuthors; ?></h4>
        </div>
        <h6 class="mb-0 fw-normal">Authors</h6>
        <p class="mb-0">
          <span class="me-1 fw-medium"><?php echo $db->table('author')
                 ->where('YEAR(created_at)', date('Y'))
                 ->where('MONTH(created_at)', date('m'))
                 ->count(); ?></span>
          <small class="text-muted">Added this Month</small>
        </p>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-lg-3 mb-3">
    <div class="card card-border-shadow-info h-100">
      <div class="card-body">
        <div class="d-flex align-items-center mb-2">
          <div class="avatar me-4">
            <span class="avatar-initial rounded bg-label-info"><i class="menu-icon mdi mdi-account-box-multiple"></i></span>
          </div>
          <h4 class="mb-0"><?php echo $totalUsers;?></h4>
        </div>
        <h6 class="mb-0 fw-normal">Users</h6>
        <p class="mb-0">
        <span class="me-1 fw-medium"><?php echo $db->table('users')
                 ->where('YEAR(created_at)', date('Y'))
                 ->where('MONTH(created_at)', date('m'))
                 ->count(); ?></span>
          <small class="text-muted">Added this Month</small>
        </p>
      </div>
    </div>
  </div>


  <div class="col-sm-6 col-lg-3 mb-3">
    <div class="card card-border-shadow-secondary h-100">
      <div class="card-body">
        <div class="d-flex align-items-center mb-2">
          <div class="avatar me-4">
            <span class="avatar-initial rounded bg-label-secondary"><i class="mdi mdi-account-cash"></i></span>
          </div>
          <h4 class="mb-0"><?php echo $db->table('subscriptions')->count(); ?></h4>
        </div>
        <h6 class="mb-0 fw-normal">Subscriptions </h6>
        <p class="mb-0">
          <span class="me-1 fw-medium"><?php echo $db->table('subscriptions')
                 ->where('YEAR(created_at)', date('Y'))
                 ->where('MONTH(created_at)', date('m'))
                 ->count(); ?></span>
          <small class="text-muted">Added this Month</small>
        </p>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-lg-3 mb-3">
    <div class="card card-border-shadow-dark h-100">
      <div class="card-body">
        <div class="d-flex align-items-center mb-2">
          <div class="avatar me-4">
            <span class="avatar-initial rounded bg-label-dark"><i class="mdi mdi-post mdi-24px"></i></span>
          </div>
          <h4 class="mb-0"><?php echo $db->table('blogs')->count(); ?></h4>
        </div>
        <h6 class="mb-0 fw-normal">Blog Posts</h6>
        <p class="mb-0">
          <span class="me-1 fw-medium"><?php echo $db->table('blogs')
                 ->where('YEAR(created_at)', date('Y'))
                 ->where('MONTH(created_at)', date('m'))
                 ->count(); ?></span>
          <small class="text-muted">Added this Month</small>
        </p>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-lg-3 mb-3">
    <div class="card card-border-shadow-success h-100">
      <div class="card-body">
        <div class="d-flex align-items-center mb-2">
          <div class="avatar me-4">
            <span class="avatar-initial rounded bg-label-success"><i class="mdi mdi-eye mdi-24px"></i></span>
          </div>
          <h4 class="mb-0"><?php echo $downloads[0]['total_download']; ?></h4>
        </div>
        <h6 class="mb-0 fw-normal">Total Download</h6>
        <p class="mb-0">
          <span class="me-1 fw-medium"><?php echo $downloads[0]['total_views']; ?></span>
          <small class="text-muted">Total views</small>
        </p>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-lg-3 mb-3">
    <div class="card card-border-shadow-info h-100">
      <div class="card-body">
        <div class="d-flex align-items-center mb-2">
          <button id="sitemap" class="btn btn-primary">Generate Sitemap</button>
        </div>
        <h6 class="mb-0 fw-normal">Auto Ping to google</h6>
        <p class="mb-0">
        <span class="me-1 fw-medium">To edit go to</span>
          <small class="text-danger"><i>src</i> > <i>General</i> > <i>Sitemap</i>  > <b>Ping method </i> </b>  </small>
        </p>
      </div>
    </div>
  </div>

  <div class="col-xl-12">
    <div class="card h-100">
      <div class="card-body row g-2">
        <div class="col-12 col-md-6 card-separator pe-0 pe-md-3">
          <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
            <h5 class="m-0 me-2">Recent Ebooks</h5>
            <a class="fw-medium" href="/SHU-Admin/ebook">View all</a>
          </div>
          <div class="pt-2">
            <ul class="p-0 m-0">
              <?php foreach($recentEbooks as $item) : ?>
              <li class="d-flex mb-4 align-items-center pb-2">
                <div class="flex-shrink-0 me-3">
                  <img src="<?=APP_URL.'/Public/thumb/182x268/'.$item['img_folder'].'/'.$item['image']?>" class="img-fluid"  height="60" width="60">
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                   <a href="<?=APP_URL.'/'.$item['slug'];?>"> <h6 class="mb-0"><?=$item['name'];?></h6></a>
                    <small><?=$item['author'];?></small>
                  </div>
                  <h6 class="text-success mb-0"><?=$item['cat_name'];?></h6>
                </div>
              </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
        <div class="col-12 col-md-6 ps-0 ps-md-3 mt-3 mt-md-2">
          <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
            <h5 class="m-0 me-2">Recent Blog Posts</h5>
            <a class="fw-medium" href="/SHU-Admin/blog">View all</a>
          </div>
          <div class="pt-2">
            <div class="p-0 m-0">
              <?php foreach($recentPosts as $item) :?>
              <li class="d-flex mb-4 align-items-center pb-2">
                <div class="flex-shrink-0 me-3">
                  <img src="<?=APP_URL.'/Public/thumb/'.$item['img_folder'].'/'.$item['image']?>" class="img-fluid"  height="60" width="60">
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2"><a href="<?=APP_URL.'/blog/'.$item['slug'];?>"> <h6 class="mb-0"><?=$item['name'];?></h6></a>
                    <small><?=$item['admin'];?></small>
                  </div>
                  <h6 class="text-danger mb-0"><?=$item['cat_name'];?></h6>
                </div>
              </li>
              <?php endforeach;?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

    
   
 
      
