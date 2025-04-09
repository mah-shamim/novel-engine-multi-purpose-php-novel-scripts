

<div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="py-3 mb-4"><span class="text-muted fw-light"><a href="<?=AdminURL?>">Home</a> /</span> <a href="<?=AdminURL?>/setting">Setting</a> </h4>

    

    
   
        <div class="row">
        <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">General Setting</h5>
                    </div>
                    <div class="card-body">
                      <form data-process="setting" method="post" id="setting">
                        <div class="row">
                        <div class="col-md-6">
                        <div class="form-floating form-floating-outline mb-4">
                          <input type="text" class="form-control" name="appname" id="" value="<?php echo APP_NAME; ?>">
                          <label for="">Site Name</label>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-floating form-floating-outline mb-4">
                          <input type="file" name="logo" class="form-control" id="">
                          <label for="">Site Logo</label>
                        </div>
                        </div>

                         <div class="col-sm-12">
                        <div class="form-floating form-floating-outline mb-4">
                          <input type="text" name="appdesc" class="form-control" id="" value="<?php echo APP_DESC; ?>">
                          <label for="">Site Description</label>
                        </div>
                        </div>

                        <div class="col-sm-12">
                        <div class="form-floating form-floating-outline mb-4">
                          <input type="text" name="appkey" class="form-control" id="" value="<?php echo APP_KEY; ?>">
                          <label for="">Site Keyword</label>
                        </div>
                        </div>

                        <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Contacts Setting</h5>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-floating form-floating-outline mb-4">
                          <input type="text" name="app_mail" class="form-control" id="" value="<?php echo APP_MAIL; ?>">
                          <label for="">App Email</label>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-floating form-floating-outline mb-4">
                          <input type="text" name="app_phone" class="form-control" id="" value="<?php echo APP_PHONE; ?>">
                          <label for="">App Phone</label>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-floating form-floating-outline mb-4">
                          <input type="text" name="app_address" class="form-control" id="" value="<?php echo APP_ADDRESS; ?>">
                          <label for="">App Address</label>
                        </div>
                    </div>

                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Other Setting</h5>
                    </div>

                    <div class="col-md-3 col-sm-4  col-6 mb-3">
                        
                          <label for="">Download</label>
                          <div class="custom-switch custom-switch-label-status pl-0 ml-3">
                            <input class="custom-switch-input" name="download" id="download" type="checkbox" <?php if(DOWNLOAD == 1): ?>checked <?php endif;?>>
                            <label class="custom-switch-btn" for="download"></label>
                        </div> 
                    </div>

                    <div class="col-md-2 col-sm-4  col-6 mb-3">                        
                        <label for="">Register / Membership</label>
                        <div class="custom-switch custom-switch-label-status pl-0 ml-3">
                          <input class="custom-switch-input" name="register" id="register" type="checkbox" <?php if(REGISTER == 1): ?>checked <?php endif;?>>
                          <label class="custom-switch-btn" for="register"></label>
                      </div> 
                  </div>

                  <div class="col-md-2 col-sm-4  col-6 mb-3">                        
                        <label for="">Subscription</label>
                        <div class="custom-switch custom-switch-label-status pl-0 ml-3">
                          <input class="custom-switch-input" name="subscribe" id="subscribe" type="checkbox" <?php if(SUBSCRIBE == 1): ?>checked <?php endif;?>>
                          <label class="custom-switch-btn" for="subscribe"></label>
                      </div> 
                  </div>

                  <div class="col-md-2 col-sm-4  col-6 mb-3">                        
                        <label for="">Instant Indexing</label>
                        <div class="custom-switch custom-switch-label-status pl-0 ml-3">
                          <input class="custom-switch-input" name="instant" id="instant" type="checkbox" <?php if(INSTANT_INDEXING == 1): ?>checked <?php endif;?>>
                          <label class="custom-switch-btn" for="instant"></label>
                      </div> 
                  </div>

                  <div class="col-md-3 col-sm-4  col-6 mb-3">                        
                        <label for="">Read Free</label>
                        <div class="custom-switch custom-switch-label-status pl-0 ml-3">
                          <input class="custom-switch-input" name="read" id="read" type="checkbox" <?php if(READ_FREE == 1): ?>checked <?php endif;?>>
                          <label class="custom-switch-btn" for="read"></label>
                      </div> 
                  </div>

                  <div class="col-md-3 col-sm-4  col-6 mt-3">
                        
                        <div class="form-floating form-floating-outline mb-4">
                                <input type="text" name="currency" class="form-control" id="currency" value="<?php echo CURRENCY; ?>">
                                <label for="currency">Currency</label>
                              </div>
                        </div>

                  <div class="col-md-2 col-sm-4  col-6 mt-3">
                        
                  <div class="form-floating form-floating-outline mb-4">
                          <input type="number" name="file_limit" class="form-control" id="" value="<?php echo FILE_LIMIT; ?>">
                          <label for="">Files Per Page</label>
                        </div>
                  </div>
                  <div class="col-md-2 col-sm-4  col-6 mt-3">
                  <div class="form-floating form-floating-outline mb-4">
                          <input type="number" name="rel_limit" class="form-control" id="" value="<?php echo RELATED_LIMIT; ?>">
                          <label for="">Related Per Page</label>
                        </div>
                  </div>

                  <div class="col-md-2 col-sm-4  col-6 mt-3">
                        
                        <div class="form-floating form-floating-outline mb-4">
                                <input type="number" name="cat_home_1" class="form-control" id="" value="<?php echo CAT_HOME1; ?>">
                                <label for="">Home Category 1</label>
                              </div>
                        </div>

                        <div class="col-md-3 col-sm-4  col-6 mt-3">
                        
                        <div class="form-floating form-floating-outline mb-4">
                                <input type="number" name="cat_home_2" class="form-control" id="" value="<?php echo CAT_HOME2; ?>">
                                <label for="">Home Category 2</label>
                              </div>
                        </div>

                  
                        <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Payment API - PAYSTACK</h5>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-floating form-floating-outline mb-4">
                          <input type="text" name="api" class="form-control" id="" value="<?php echo PAYSTACK_API; ?>">
                          <label for="">API</label>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-floating form-floating-outline mb-4">
                          <input type="text" name="key" class="form-control" id="" value="<?php echo PAYSTACK_KEY; ?>">
                          <label for="">SECRET KEY</label>
                        </div>
                        </div>
                    



                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Social Media</h5>
                    </div>
                        <div class="col-sm-4">
                        <div class="form-floating form-floating-outline mb-4">
                          <input type="text" name="facebookurl" class="form-control" id="" value="<?php echo FACEBOOK_URL; ?>">
                          <label for="">Facebook Page</label>
                        </div>
                        </div>
                        <div class="col-sm-4">
                        <div class="form-floating form-floating-outline mb-4">
                          <input type="text" name="xurl" class="form-control" id="" value="<?php echo X_URL; ?>">
                          <label for="">Twitter Page</label>
                        </div>
                        </div>

                        <div class="col-sm-4">
                        <div class="form-floating form-floating-outline mb-4">
                          <input type="text" name="telegramurl" class="form-control" id="" value="<?php echo TELEGRAM_URL; ?>">
                          <label for="">Telegram Page</label>
                        </div>
                        </div>

                        <div class="col-sm-6">
                        <div class="form-floating form-floating-outline mb-4">
                          <input type="text" name="tiktokurl" class="form-control" id="" value="<?php echo TIKTOK_URL; ?>">
                          <label for="">Tiktok Page</label>
                        </div>
                        </div>

                        <div class="col-sm-6">
                        <div class="form-floating form-floating-outline mb-4">
                          <input type="text" name="instagramurl" class="form-control" id="" value="<?php echo INSTAGRAM_URL; ?>">
                          <label for="">Whatsapp Group</label>
                        </div>
                        </div>
                        <input type="hidden" name="setting" value="general">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
        </div>
      




       





