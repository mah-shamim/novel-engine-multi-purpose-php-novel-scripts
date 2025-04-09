

<div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="py-3 mb-4"><span class="text-muted fw-light"><a href="<?=AdminURL?>">Home</a> /</span> <span class="text-muted fw-light"><a href="<?=AdminURL?>/setting">Setting</a> /</span> <a href="<?=AdminURL?>/metacode">head / Foot Code</a> </h4>


   
        <div class="row">
        <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Header / Footer Code</h5>
                    </div>
                    <div class="card-body">
                  <div class="row">
                   <form action="" name="widgetforom" method="POST">
                        <div class="">
                            <div class="form-group col-md-4">
                                <label for="Select File">Select File</label>
                                <select name="wid" class="form-control" onchange="document.widgetforom.submit();">
                                    <option disabled selected>Select Area</option>
                                    <?php for ($i = 0; $i < count($widgetFiles); $i++) :
                                        if (strpos($widgetFiles[$i], '.') == 0 || $widgetFiles[$i] == 'default.php')
                                            continue;
                                    ?>
                                        <option value="<?php echo $widgetFiles[$i]; ?>" <?php if ($widgetFiles[$i] == Input('wid')) echo ' selected'; ?>><?php echo pathinfo($widgetFiles[$i],PATHINFO_FILENAME); ?> </></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <?php if (Input('wid') != '') : ?>
                                <div class="form-group col-12">
                                    <label for="Contents">Editor </></label>
                                    <textarea name="contents" class="form-control" id="" cols="30" rows="10"><?php echo $content; ?></textarea>
                                </div>
                                    <input type="submit" class="btn btn-primary m-2 bg-primary" value="Save" name="save" />
                            
                            <?php endif; ?>
                        </div>
                    </form>
                   </div>
                   
                   
                    </div>
                  </div>
                </div>
        </div>
      