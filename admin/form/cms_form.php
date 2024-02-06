<?php
if (isset($_GET['id'])) {
     $cms_id = $_GET['id'];
     $cms = BookCms::find_by_custom_id('cms_id',$cms_id);
?>
    <div class="col-md-6">
        <label class="form-label">cms Title</label>
        <input type="text" class="form-control form-control-lg" name="cms[cms_title]" value="<?php echo $cms->cms_title ?>">
    </div>
    <div class="col-md-6">
        <label class="form-label">Cms Filename</label>
        <input type="text" class="form-control form-control-lg" name="cms[cms_filename]" value="<?php echo $cms->cms_filename ?>" placeholder="Enter Cms Filename" required>
    </div>  
     <div class="col-md-6">
        <label class="form-label">Cms Image</label>
        <input type="file" class="form-control" name="cms_image" placeholder="Enter Title">
        <img src="<?php echo $cms->picture_path()?>" width="100px" height="88px">
    </div>
     
     <div class="col-6">
        <label class="form-label">Cms Status</label>
         <select name="cms[cms_status]" class="form-control form-control-lg" id="">
             <?php if ($cms->cms_status == 'Y') echo $Y="Active";
                else {
                    echo $Y="Inactive";
                } ?>
            <option value="<?php echo $cms->cms_status ?>"<?php if($cms->cms_status == $cms->cms_status){ echo "selected"; } ?>><?php echo $Y ?> </option>
            <option value="Y">Active</option>
            <option value="N">Inactive</option>
         </select>
    </div>
       <div class="col-md-12">
        <label class="form-label">Cms Detail</label>
        <textarea class="form-control" name="cms[cms_detail]" placeholder="Enter Details" required><?php echo $cms->cms_detail?></textarea>
    </div>
<?php } else { ?>
     
    <div class="col-md-6">
        <label class="form-label">Cms Title</label>
        <input type="text" class="form-control form-control-lg" name="cms[cms_title]" placeholder="Enter Title"  >
    </div>
    <div class="col-md-6">
        <label class="form-label">Cms Filename</label>
        <input type="text" class="form-control form-control-lg" name="cms[cms_filename]" placeholder="Enter Cms Filename"  >
    </div>  
     <div class="col-md-6">
        <label class="form-label">Cms Image</label>
        <input type="file" class="form-control" name="cms_image" placeholder="Enter Title"  >
    </div>
     <div class="col-6">
        <label class="form-label">Cms Status</label>
         <select name="cms[cms_status]" class="form-control form-control-lg" id="">
            <option value="" required>-Status-</option>
            <option value="Y">Active</option>
            <option value="N">Inactive</option>
         </select>
    </div>
     <div class="col-md-12">
        <label class="form-label">Cms Detail</label>
        <textarea class="form-control" name="cms[cms_detail]" placeholder="Enter Details" required></textarea>
    </div>
       
 
<?php } ?>