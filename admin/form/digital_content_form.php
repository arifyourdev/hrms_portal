<?php
if (isset($_GET['id'])) {
     $content_id = $_GET['id'];
     $content = DigitalContent::find_by_id($content_id);
?>
    <div class="col-md-6">
        <label class="form-label">Category Name</label>
        <input type="text" class="form-control form-control-lg" name="content[category_name]" value="<?php echo $content->category_name ?>" placeholder="Title">
    </div>
        <div class="col-6">
        <label class="form-label">  Url</label>
        <input type="text" class="form-control form-control-lg" name="content[seo_url]" value="<?php echo $content->seo_url ?>" placeholder="URl">
    </div>
    <div class="col-6">
        <label class="form-label">  Status</label>
         <select name="content[status]"  class="form-control form-control-lg" id="">
             <?php if ($content->status == 'Y') echo $Y="Active";
                else {
                    echo $Y="Inactive";
                } ?>
            <option value="<?php echo $content->status ?>"<?php if($content->status == $content->status){ echo "selected"; } ?>><?php echo $Y ?></option>
            <option value="N">Inactive</option>
             <option value="Y">Active</option>
         </select>
    </div>
    <div class="col-6">
        <label for="formFile" class="form-label">  Image</label>
        <input class="form-control " type="file" name="image" id="formFile">
         <img src="<?php echo $content->picture_path() ?>" alt="" width="80px" height="80px">
    </div>

<?php } else { ?>
     
    <div class="col-md-6">
        <label class="form-label">Category Name</label>
        <input type="text" class="form-control form-control-lg" name="content[category_name]" placeholder="Enter Title" required>
    </div>
    <div class="col-6">
        <label class="form-label">Url</label>
        <input type="text" class="form-control form-control-lg" name="content[seo_url]" placeholder=" url">
    </div>
    <div class="col-6">
        <label class="form-label">Status</label>
         <select name="status" class="form-control form-control-lg" id="">
            <option value="" required>-Status-</option>
            <option value="Y">Active</option>
            <option value="N">Inactive</option>
         </select>
    </div>
    <div class="col-6">
        <label for="formFile" class="form-label">Image</label>
        <input class="form-control " type="file" name="image" id="formFile">
    </div>

<?php } ?>