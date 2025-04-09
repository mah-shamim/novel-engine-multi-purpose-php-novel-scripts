<?php

include('hero2.php');
 
?>


    <!-- Main Content Start -->
    <div class="page-content">
      <section>
        <div class="container">
          <div class="row">
            <div class="top-row p-40">
              <div class="col-sm-6">
                <div class="left-block">

                <?php
				$sR = min(($page - 1) * $limit + 1, $totalFiles);
				$eR = min($page * $limit, $totalFiles);
				echo '<h6 class="dark-gray">Showing '.$sR.'-'.$eR.'  of '.$totalFiles.' results</h6>';
				?>
                  
                </div>
              </div>
              <div class="col-sm-6">
                <div class="right-block">
                  
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xl-9">
              <div class="row">
              
               <?php
               if($isLatest) {

                $files = $rows;
                include('filelist_2.php');
                unset($files);
               } else {
                include('list.php');
                unset($list);
               }
               ?>
              </div>
              <section class="page-numbers mb-48">
                <div class="container">
                   <?php include('pagination.php'); ?>
                </div>
                </section>
            </div>
            <div class="col-xl-3">
            <?php include('sidebar.php'); ?>
          </div>
          </div>
        </div>
      </section>
    </div>
