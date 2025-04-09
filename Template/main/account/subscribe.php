<div class="row">
    <div class="">
        <h2 class="card-title my-3">Subscribe</h2>

        <div class="card-body">
            <div class="row">
                <div class="col-12 mb-3">
                    <div class="filter-block">
                        <div class="title mb-32">
                            <h5>Select Package</h5>
                            <i class="far fa-horizontal-rule"></i>
                        </div>
                    </div>
                </div>

                <div class="col-12 mb-3">
                    <form id="subscribe">
                        <div class="row">
                            <div class="input-group">
                                <select class="form-control" name="package">
                                <?php foreach($packages as $pack) : ?>
                                    <option style="padding:30px;" value="<?php echo $pack['id'];?>"><?php echo "{$pack['package_name']} | Price : ".CURRENCY."{$pack['price']} - {$pack['days']} Days";?> </option>
                                <?php endforeach;?>
                                </select>    
                                <input type="hidden" id="user_id" name="user_id" value="<?php echo $AuthUser['id'];?>">
                                <input type="hidden" name="action" value="pay">
                                <input type="hidden" id="paystack" value="<?php echo PAYSTACK_API; ?>">
                                <button type="submit" class="cus-btn small"><span class="icon"><img src="<?php echo MAIN_ASSETS;?>/media/icons/click-button.png"
                          alt=""></span>SUBSCRIBE</button>
                            </div> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>