<?php
if (isset($_GET['id'])) {
     $blogbanner_id = $_GET['id'];
     $blogbanner = Allbanner::find_by_id($blogbanner_id);
?>
    <div class="col-md-6">
        <label class="form-label">Banner Name</label>
        <input type="text" class="form-control form-control-lg" name="blog_banner[title]" value="<?php echo $blogbanner->title ?>" placeholder="Banner Title">
    </div>
    <div class="col-6">
        <label class="form-label">Banner Url</label>
        <input type="text" class="form-control form-control-lg" name="blog_banner[url]" value="<?php echo $blogbanner->url ?>" placeholder="Banner url">
    </div>
    <div class="col-6">
        <label class="form-label">Banner Type</label>
         <select name="blog_banner[banner_type]" class="form-control form-control-lg" id="">
            <option value="<?php echo $blogbanner->banner_type ?>"<?php if($blogbanner->banner_type == $blogbanner->banner_type){ echo "selected"; } ?>><?php echo $blogbanner->banner_type ?></option>
            <option value="B">Artical & Blog Banner</option>
            <option value="W">Webinars Banner</option>
            <option value="L">Books List Banner</option>
            <option value="E">Past Event Banner</option>
         </select>
    </div>
    <div class="col-6">
        <label class="form-label">Banner Status</label>
         <select name="blog_banner[status]"  class="form-control form-control-lg" id="">
             <?php if ($blogbanner->status == 'Y') echo $Y="Active";
                else {
                    echo $Y="Inactive";
                } ?>
            <option value="<?php echo $blogbanner->status ?>"<?php if($blogbanner->status == $blogbanner->status){ echo "selected"; } ?>><?php echo $Y ?></option>
            <option value="N">Inactive</option>
             <option value="Y">Active</option>
         </select>
    </div>
    <div class="col-12">
        <label for="formFile" class="form-label">Banner Image</label>
        <input class="form-control " type="file" name="image" id="formFile">
         <img src="<?php echo $blogbanner->picture_path() ?>" alt="" width="80px" height="80px">
    </div>

<?php } else { ?>
     
    <div class="col-md-6">
        <label class="form-label">Banner Title</label>
        <input type="text" class="form-control form-control-lg" name="blog_banner[title]" placeholder="Enter Banner Title" required>
    </div>
    
    <div class="col-6">
        <label class="form-label">Banner Url</label>
        <input type="text" class="form-control form-control-lg" name="blog_banner[url]" placeholder="Banner url">
    </div>
    <div class="col-6">
        <label class="form-label">Banner Type</label>
         <select name="blog_banner[banner_type]" class="form-control form-control-lg" id="">
            <option value="D" required>-Status-</option>
            <option value="B">Artical & Blog Banner</option>
            <option value="W">Webinars Banner</option>
            <option value="L">Books List Banner</option>
            <option value="E">Past Event Banner</option>
         </select>
    </div>
    <div class="col-6">
        <label class="form-label">Banner Status</label>
         <select name="blog_banner[status]" class="form-control form-control-lg" id="">
            <option value="" required>-Status-</option>
            <option value="Y">Active</option>
            <option value="N">Inactive</option>
         </select>
    </div>
    <div class="col-6">
        <label for="formFile" class="form-label">Banner Image</label>
        <input class="form-control " type="file" name="image" id="formFile">
    </div>

<?php } ?>