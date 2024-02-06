<?php
if (isset($_GET['id'])) {
     $banner_id = $_GET['id'];
     $banner = Banner::find_by_custom_id('banners_id',$banner_id);
?>
    <div class="col-md-6">
        <label class="form-label">Banner Name</label>
        <input type="text" class="form-control form-control-lg" name="banner[banners_title]" value="<?php echo $banner->banners_title ?>" placeholder="Banner Title">
    </div>
    <div class="col-md-6">
        <label class="form-label">Banner Position</label>
        <input type="text" class="form-control form-control-lg" name="bannere[banners_position]" value="<?php echo $banner->banners_position ?>" placeholder="Position">
    </div>

    <div class="col-6">
        <label class="form-label">Banner Url</label>
        <input type="text" class="form-control form-control-lg" name="banner[banners_click_url]" value="<?php echo $banner->banners_click_url ?>" placeholder="Banner url">
    </div>
    <div class="col-6">
        <label class="form-label">Banner Status</label>
         <select name="banner[banners_status]"  class="form-control form-control-lg" id="">
             <?php if ($banner->banners_status == 'Y') echo $Y="Active";
                else {
                    echo $Y="Inactive";
                } ?>
            <option value="<?php echo $banner->banners_status ?>"<?php if($banner->banners_status == $banner->banners_status){ echo "selected"; } ?>><?php echo $Y ?></option>
            <option value="N">Inactive</option>
             <option value="Y">Active</option>
         </select>
    </div>
    <div class="col-12">
        <label for="formFile" class="form-label">Banner Image</label>
        <input class="form-control " type="file" name="banners_image" id="formFile">
         <img src="<?php echo $banner->picture_path() ?>" alt="" width="80px" height="80px">
    </div>

<?php } else { ?>
     
    <div class="col-md-6">
        <label class="form-label">Banner Title</label>
        <input type="text" class="form-control form-control-lg" name="banner[banners_title]" placeholder="Enter Banner Title" required>
    </div>
     <div class="col-6">
        <label class="form-label">Banner Position</label>
        <input type="text" class="form-control form-control-lg" name="banner[banners_position]" placeholder="Banner Position">
    </div>
    
    <div class="col-6">
        <label class="form-label">Banner Url</label>
        <input type="text" class="form-control form-control-lg" name="banner[banners_click_url]" placeholder="Banner url">
    </div>
    <div class="col-6">
        <label class="form-label">Banner Status</label>
         <select name="banners_status" class="form-control form-control-lg" id="">
            <option value="" required>-Status-</option>
            <option value="Y">Active</option>
            <option value="N">Inactive</option>
         </select>
    </div>
    <div class="col-12">
        <label for="formFile" class="form-label">Banner Image</label>
        <input class="form-control " type="file" name="banners_image" id="formFile">
    </div>

<?php } ?>