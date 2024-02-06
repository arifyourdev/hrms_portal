<?php
if (isset($_GET['id'])) {
     $class_id = $_GET['id'];
     $b_class = BookClass::find_by_custom_id('class_id',$class_id);
?>
    <div class="col-md-6">
        <label class="form-label">Class Title</label>
        <input type="text" class="form-control form-control-lg" name="b_class[class_title]" value="<?php echo $b_class->class_title ?>">
    </div>
    <div class="col-md-6">
        <label class="form-label">Sort Order</label>
        <input type="text" class="form-control form-control-lg" name="b_class[class_sort_order]" value="<?php echo $b_class->class_sort_order ?>">
    </div>
 
    <div class="col-6">
        <label class="form-label">Class Status</label>
         <select name="b_class[class_status]" class="form-control form-control-lg" id="">
              <?php if ($b_class->class_status == 'Y') echo $Y="Active";
                else {
                    echo $Y="Inactive";
                } ?>
            <option value="<?php echo $b_class->class_status ?>"<?php if($b_class->class_status == $b_class->class_status){ echo "selected"; } ?>><?php echo $Y ?></option>
            <option value="N">Inactive</option>
             <option value="Y">Active</option>
         </select>
    </div>
      
<?php } else { ?>
     
    <div class="col-md-6">
        <label class="form-label">Class Title</label>
        <input type="text" class="form-control form-control-lg" name="b_class[class_title]" placeholder="Enter Title" required>
    </div>
     <div class="col-6">
        <label class="form-label">Class Sort Order</label>
        <input type="text" class="form-control form-control-lg" name="b_class[class_sort_order]" placeholder=" Enter Sort Order">
    </div>
    
    <div class="col-6">
        <label class="form-label">Class Status</label>
         <select name="b_class[class_status]" class="form-control form-control-lg" id="">
            <option value="" required>-Status-</option>
            <option value="Y">Active</option>
            <option value="N">Inactive</option>
         </select>
    </div>
    

<?php } ?>