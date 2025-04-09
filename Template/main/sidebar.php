

<div class="ads-container">
				<div class="ads">
				<?php echo getAds('sidebar'); ?>
				</div>
</div>

<div class="sidebar">
                  <div class="sidebar mb-48">
                      <div class="sidebar-block">
                          <div class="filters">
                              
                                  <div class="filter-block">
                                      <h4 class="mb-24">Filter</h4>
                                      <form method="get" action="<?=APP_URL?>/search">
                                          <div class="form-group has-search">
                                              <input name="novel" type="text" class="form-control" placeholder="Find the books...">
                                              <button type="submit" class="b-unstyle"><i class="fal fa-search"></i></button>
                                          </div>
                                      </form>
                                  </div>
                                  <hr>
                                  <div class="filter-block">
                                      <div class="title mb-32">
                                          <h5>Categories</h5>
                                          <i class="far fa-horizontal-rule"></i>
                                      </div>
                                      <ul class="unstyled list">
                                        
                                        <?php
                                        foreach($_cats as $item): ?>
                                          <li class="mb-16">
                                              <div class="filter-checkbox">
                                                  <input type="checkbox">
                                                  <label for="Instock" class="shu-short"><a href="<?=APP_URL.'/category/'.$item['slug']?>"><?=$item['name']?></a></label>
                                              </div>
                                              <h6 class="dark-gray">(<?=$item['total_post']?>)</h6>
                                          </li>
                                          <?php endforeach; ?>
                                          
                                      </ul>
                                  </div>
                                  <hr>
                                  <div class="filter-block">
                                      <div class="title mb-32">
                                          <h5>Authors</h5>
                                          <i class="far fa-horizontal-rule"></i>
                                      </div>
                                      <ul class="unstyled list">
                                      <?php
                                        foreach($_authors as $item): ?>
                                          <li class="mb-16">
                                              <div class="filter-checkbox">
                                                  <input type="checkbox">
                                                  <label for="Instock" class="shu-short"><a href="<?=APP_URL.'/author/'.$item['slug']?>"><?=$item['name']?> </a></label>
                                              </div>
                                              <h6 class="dark-gray">(<?=$item['total_post']?>)</h6>
                                          </li>
                                          <?php endforeach; ?>
                                      </ul>
                                  </div>
                                  
                                  <hr>
                                  <div class="filter-block border-0">
                                    <div class="title mb-32">
                                      <h5>Books Album</h5>
                                      <i class="far fa-horizontal-rule"></i>
                                    </div>
                                    <ul class="unstyled list">
                                    <?php
                                        foreach($_books as $item): ?>
                                          <li class="mb-16">
                                              <div class="filter-checkbox">
                                                  <input type="checkbox">
                                                  <label for="Instock" class="shu-short"><a href="<?=APP_URL.'/book/'.$item['slug']?>"><?=$item['name']?> </a></label>
                                              </div>
                                              <h6 class="dark-gray">(<?=$item['total_post']?>)</h6>
                                          </li>
                                          <?php endforeach; ?>
                                     
                                    </ul>
                                  </div>
                                  <hr>
                                  <div class="filter-block">
                                      <div class="title mb-32">
                                          <h5>Compilers</h5>
                                          <i class="far fa-horizontal-rule"></i>
                                      </div>
                                      <ul class="unstyled list">
                                      <?php
                                        foreach($_compilers as $item): ?>
                                          <li class="mb-16">
                                              <div class="filter-checkbox">
                                                  <input type="checkbox">
                                                  <label for="Instock" class="shu-short"><a href="<?=APP_URL.'/compiler/'.$item['slug']?>"><?=$item['name']?> </a></label>
                                              </div>
                                              <h6 class="dark-gray">(<?=$item['total_post']?>)</h6>
                                          </li>
                                          <?php endforeach; ?>
                                         
                                      </ul>
                                  </div>
                                  <hr>
                                  <div class="filter-block">
                                      <div class="title mb-32">
                                          <h5>Groups</h5>
                                          <i class="far fa-horizontal-rule"></i>
                                      </div>
                                      <ul class="unstyled list">
                                      <?php
                                        foreach($_groups as $item): ?>
                                          <li class="mb-16">
                                              <div class="filter-checkbox">
                                                  <input type="checkbox">
                                                  <label for="Instock" class="shu-short"><a href="<?=APP_URL.'/group/'.$item['slug']?>"><?=$item['name']?> </a></label>
                                              </div>
                                              <h6 class="dark-gray">(<?=$item['total_post']?>)</h6>
                                          </li>
                                          <?php endforeach; ?>
                                      </ul>
                                  </div>
                                  <hr>
                              
                          </div>
                      </div>
                  </div>
  </div>


