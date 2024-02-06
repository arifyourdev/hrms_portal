<?php
if (isset($_GET['id'])) {
     $magazine_id = $_GET['id'];
     $magazine = BookMagazine::find_by_custom_id('magazine_id',$magazine_id);
?>
    <div class="col-md-6">
        <label class="form-label">Journal Title</label>
        <input type="text" class="form-control form-control-lg" name="magazine[magazine_title]" value="<?php echo $magazine->magazine_title ?>">
    </div>
    <div class="col-md-6">
        <label class="form-label">Journal Sort Order</label>
        <input type="text" class="form-control form-control-lg" name="magazine[magazine_sort_order]" value="<?php echo $magazine->magazine_sort_order ?>">
    </div>
     <div class="col-md-6">
        <label class="form-label">Journal Image</label>
        <input type="file" class="form-control" name="magazine_image">
        <img src="<?php echo $magazine->picture_path()?>" width="100px" height="80px">
    </div>
    <div class="col-md-6">
        <label class="form-label">Journal File</label>
        <input type="file" class="form-control" name="magazine_pdf">
         <?php echo $magazine->magazine_pdf ?>
    </div>
    
 
    <div class="col-6">
        <label class="form-label">Journal Status</label>
         <select name="magazine[magazine_status]" class="form-control form-control-lg" id="">
             <?php if ($magazine->magazine_status == 'Y') echo $Y="Active";
                else {
                    echo $Y="Inactive";
                } ?>
            <option value="<?php echo $magazine->magazine_status ?>"<?php if($magazine->magazine_status == $magazine->magazine_status){ echo "selected"; } ?>><?php echo $Y ?></option>
            <option value="N">Inactive</option>
             <option value="Y">Active</option>
         </select>
    </div>
      
<?php } else { ?>
     
    <div class="col-md-6">
        <label class="form-label">Journal Title</label>
        <input type="text" class="form-control form-control-lg" name="magazine[magazine_title]" placeholder="Enter Title" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Journal Image</label>
        <input type="file" class="form-control" name="magazine_image" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Journal File</label>
        <input type="file" class="form-control" name="magazine_pdf" required>
    </div>
     <div class="col-6">
        <label class="form-label">Magazine Sort Order</label>
        <input type="text" class="form-control form-control-lg" name="magazine[magazine_sort_order]" placeholder=" Enter Sort Order">
    </div>
    
    <div class="col-6">
        <label class="form-label">Journal Status</label>
         <select name="magazine[magazine_status]" class="form-control form-control-lg" id="">
            <option value="" required>-Status-</option>
            <option value="Y">Active</option>
            <option value="N">Inactive</option>
         </select>
    </div>
    

<?php } ?>