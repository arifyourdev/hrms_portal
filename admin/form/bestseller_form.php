<?php
if (isset($_GET['id'])) {
     $bestseller_id = $_GET['id'];
     $bestseller = Bestseller::find_by_id($bestseller_id);
?>
    <div class="col-md-6">
        <label class="form-label">Bestseller Title</label>
        <input type="text" class="form-control form-control-lg" name="bestseller[bestseller_title]" value="<?php echo $bestseller->bestseller_title ?>" placeholder="Bestseller Title">
    </div>
    <div class="col-md-6">
        <label class="form-label">Bestseller Badge</label>
        <input type="text" class="form-control form-control-lg" name="bestseller[bestseller_badge]" value="<?php echo $bestseller->bestseller_badge?>" placeholder="Badge">
    </div>
 
    <div class="col-6">
        <label class="form-label">Status</label>
         <select name="bestseller[bestseller_status]"  class="form-control form-control-lg" id="">
             <?php if ($bestseller->bestseller_status == 'Y') echo $Y="Active";
                else {
                    echo $Y="Inactive";
                } ?>
            <option value="<?php echo $bestseller->bestseller_status ?>"<?php if($bestseller->bestseller_status == $bestseller->bestseller_status){ echo "selected"; } ?>><?php echo $Y ?></option>
            <option value="N">Inactive</option>
             <option value="Y">Active</option>
         </select>
    </div>
    <div class="col-16">
        <label for="formFile" class="form-label">Bestseller Image</label>
        <input class="form-control " type="file" name="bestseller_image" id="formFile">
         <img src="<?php echo $bestseller->picture_path() ?>" alt="" width="80px" height="80px">
    </div>

<?php } else { ?>
     
    <div class="col-md-6">
        <label class="form-label">Bestseller Title</label>
        <input type="text" class="form-control form-control-lg" name="bestseller[bestseller_title]" placeholder="Enter Bestseller Title" required>
    </div>
     <div class="col-6">
        <label class="form-label">Bestseller Badge</label>
        <input type="text" class="form-control form-control-lg" name="bestseller[bestseller_badge]" placeholder="Banner Position">
    </div>
    
    <div class="col-6">
        <label class="form-label">Bestseller Status</label>
         <select name="bestseller[bestseller_status]" class="form-control form-control-lg" id="">
            <option value="" required>-Status-</option>
            <option value="Y">Active</option>
            <option value="N">Inactive</option>
         </select>
    </div>
    <div class="col-6">
        <label for="formFile" class="form-label">Bestseller Image</label>
        <input class="form-control " type="file" name="bestseller_image" id="formFile">
    </div>

<?php } ?>