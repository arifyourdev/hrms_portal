<?php
if (isset($_GET['id'])) {
     $lavel_id = $_GET['id'];
     $level = BookLeval::find_by_custom_id('lavel_id',$lavel_id);
?>
    <div class="col-md-6">
        <label class="form-label">Level Title</label>
        <input type="text" class="form-control form-control-lg" name="level[lavel_title]" value="<?php echo $level->lavel_title ?>">
    </div>
    <div class="col-md-6">
        <label class="form-label">Level Sort Order</label>
        <input type="text" class="form-control form-control-lg" name="level[lavel_sort_order]" value="<?php echo $level->lavel_sort_order ?>">
    </div>
 
    <div class="col-6">
        <label class="form-label">Level Status</label>
         <select name="level[lavel_status]" class="form-control form-control-lg" id="">
              <?php if ($level->lavel_status == 'Y') echo $Y="Active";
                else {
                    echo $Y="Inactive";
                } ?>
            <option value="<?php echo $level->lavel_status ?>"<?php if($level->lavel_status == $level->lavel_status){ echo "selected"; } ?>><?php echo $Y ?></option>
            <option value="N">Inactive</option>
             <option value="Y">Active</option>
         </select>
    </div>
      
<?php } else { ?>
     
    <div class="col-md-6">
        <label class="form-label">Level Title</label>
        <input type="text" class="form-control form-control-lg" name="level[lavel_title]" placeholder="Enter Level Title" required>
    </div>
     <div class="col-6">
        <label class="form-label">Level Sort Order</label>
        <input type="text" class="form-control form-control-lg" name="level[lavel_sort_order]" placeholder="Level Sort Order">
    </div>
    
    <div class="col-6">
        <label class="form-label">Status</label>
         <select name="level[lavel_status]" class="form-control form-control-lg" id="">
            <option value="" required>-Status-</option>
            <option value="Y">Active</option>
            <option value="N">Inactive</option>
         </select>
    </div>
    

<?php } ?>