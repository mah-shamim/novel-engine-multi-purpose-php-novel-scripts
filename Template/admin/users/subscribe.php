


<style>
  .loading-message {
    text-align: center;
    font-size: 16px;
    color: #333;
}

/* Optional: Add a spinner */
.spinner {
    border: 4px solid rgba(0, 0, 0, 0.1);
    border-top: 4px solid #007bff;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    animation: spin 1s linear infinite;
    margin: 20px auto;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.swal2-container {
  z-index: 20000 !important;
}

</style>

<div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="py-3 mb-4"><span class="text-muted fw-light"><a href="<?=AdminURL?>">Home</a> /</span> <a href="<?=AdminURL?>/users">Users</a> </h4>


    
    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="card-header">
        <div class="d-flex justify-content-between">
            <h5 class="mb-0 showingBy">Applied Subscribtion to this User <?=$user['name']?></h5>
             
        </div>   
    </div>
    <!--/ Basic Bootstrap Table -->


    <div id="model" data-model="subscriptions"></div>


    <div class="card m-3">
        <div class="row">
        <form id="addpost" class="row" method="post" enctype="multipart/form-data">
            <div class="col-12 mb-2">
                <h5 class="card-header">Choose Subscribtion Data</h5>
            </div>

            <div class="col-md m-3">
            <div class="form-floating form-floating-outline">
            <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control" disabled></label>
                                  </div>
            <label for="nameLarge"><?=$user['username']?></label>
                                  </div>
            </div>

            <div class="col-md m-3">
            <div class="form-floating form-floating-outline">
            <select class="form-select substype" name="type_id" id="" aria-label="Subscribtion Type">
                <?php foreach($packages as $item) :?>
                <option value="<?=$item['id']?>"><?=$item['package_name']?>   <?=$item['days']?> Days    N<?=$item['price']?></option>
                <?php endforeach; ?>
            </select>
            <label for="nameLarge">Subscribtion Type</label>
                                  </div>
            </div>
            <input type="hidden" name="action" value="subscribe">
            <input type="hidden" name="user_id" value="<?=$user['id']?>">
            
            <div class="col-12 m-3">
            <button type="submit" id="submit" class="btn btn-primary waves-effect waves-light">SUBMIT </button>
            </div>
            </form>
        </div>
    </div>

</div>




       





