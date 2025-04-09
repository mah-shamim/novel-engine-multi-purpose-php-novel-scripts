<div class="row">
    <div class="">
        <h2 class="card-title my-3">Notifications</h2>

        <div class="card-body">
            <div class="row">
                <div class="col-12 mb-3">
                    <div class="filter-block">
                        <div class="title mb-32">
                            <h5><?php echo $title; ?></h5>
                            <i class="far fa-horizontal-rule"></i>
                        </div>
                    </div>
                </div>

                <div class="col-12 mb-3">
                <div class="recent-articles">
                    <?php foreach($notifications as $item) :?>
                        <div class="card article-box bg-lightest-gray mb-24">
                            <div class="card-body">
                              <h5 class="card-title"><?php echo $item['title']; ?></h5>
                              <p class="card-text"><?php echo $item['message']; ?></p>
                              <p class="card-text"><small class="text-muted"><?php echo to_time_ago(strtotime($item['created_at']) - 5); ?></small></p>
                            </div>
                      </div>
                    <?php endforeach; ?>
                </div>
                </div>

                <div class="col-12 mb-3">
                <section class="page-numbers mb-48">
                <div class="container">
                   <?php include(__DIR__.'/../pagination.php'); ?>
                </div>
                </section>
                </div>
            </div>
        </div>
    </div>
</div>