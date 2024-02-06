<?php
if (isset($_GET['id'])) {
     $blog_id = $_GET['id'];
     $blog = Blog::find_by_id($blog_id);
?>
    <div class="col-md-6">
        <label class="form-label">Blog Title</label>
        <input type="text" class="form-control form-control-lg" name="blog[title]" value="<?php echo $blog->title ?>" placeholder="Blog Title">
    </div>
    <div class="col-md-6">
        <label class="form-label">Blog Name</label>
        <input type="text" class="form-control form-control-lg" name="blog[name]" value="<?php echo $blog->name ?>" placeholder="Blog Name">
    </div>
    <div class="col-md-6">
        <label class="form-label">Blog Category</label>
        <input type="text" class="form-control form-control-lg" name="blog[category]" value="<?php echo $blog->category ?>" placeholder="Blog Category">
    </div>
    
    <div class="col-6">
        <label class="form-label">Blog Url</label>
        <input type="text" class="form-control form-control-lg" name="blog[seo_url]" value="<?php echo $blog->seo_url ?>" placeholder="Blog url">
    </div>
    <div class="col-6">
        <label class="form-label">Blog Status</label>
         <select name="blog[status]"  class="form-control form-control-lg" id="">
             <?php if ($blog->status == 'Y') echo $Y="Active";
                else {
                    echo $Y="Inactive";
                } ?>
            <option value="<?php echo $blog->status ?>"<?php if($blog->status == $blog->status){ echo "selected"; } ?>><?php echo $Y ?></option>
            <option value="N">Inactive</option>
             <option value="Y">Active</option>
         </select>
    </div>
    <div class="col-6">
        <label for="formFile" class="form-label">Blog Image</label>
        <input class="form-control " type="file" name="image" id="formFile">
         <img src="<?php echo $blog->picture_path() ?>" alt="" width="80px" height="80px">
    </div>
    <div class="col-12">
        <label class="form-label">Blog Detail</label>
        <textarea type="text" class="form-control form-control-lg" name="blog[detail]" value="" placeholder="Blog details"><?php echo $blog->detail?></textarea>
    </div>

<?php } else { ?>
     
    <div class="col-md-6">
        <label class="form-label">Blog Title</label>
        <input type="text" class="form-control form-control-lg" name="blog[title]" placeholder="Enter Blog Title" required>
    </div>
     <div class="col-6">
        <label class="form-label">Blog Name</label>
        <input type="text" class="form-control form-control-lg" name="blog[name]" placeholder="Blog Name">
    </div>
    <div class="col-6">
        <label class="form-label">Blog Category</label>
        <input type="text" class="form-control form-control-lg" name="blog[category]" placeholder="Blog Category"> 
    </div>
     <div class="col-6">
        <label class="form-label">Url</label>
        <input type="text" class="form-control form-control-lg" name="blog[seo_url]" placeholder=" url">
    </div>
     <div class="col-6">
        <label for="formFile" class="form-label">Blog Image</label>
        <input class="form-control form-control-lg" type="file" name="image" id="formFile">
    </div>
    <div class="col-6">
        <label class="form-label">Blog Status</label>
         <select name="blog[status]" class="form-control form-control-lg" id="">
            <option value="" required>-Status-</option>
            <option value="Y">Active</option>
            <option value="N">Inactive</option>
         </select>
    </div>
    <div class="col-12">
        <label class="form-label">Blog Detail</label>
        <textarea type="text" class="form-control form-control-lg" name="blog[detail]" placeholder="Blog details"></textarea>
    </div>
        <input type="hidden" name="blog[date]" value="<?php echo $time ?>">

<?php } ?>