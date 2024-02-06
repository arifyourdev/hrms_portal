<?php
if (isset($_GET['id'])) {
     $newsroom_id = $_GET['id'];
     $newsroom = Newsroom::find_by_id($newsroom_id);
?>
     
    <div class="col-md-6">
        <label class="form-label">News Category</label>
        <input type="text" class="form-control form-control-lg" name="newsroom[category]" value="<?php echo $newsroom->category ?>">
    </div>
     <div class="col-6">
        <label class="form-label">News Status</label>
         <select name="newsroom[status]" class="form-control form-control-lg" id="">
             <?php if ($newsroom->status == 'Y') echo $Y="Active";
                else {
                    echo $Y="Inactive";
                } ?>
            <option value="<?php echo $newsroom->status ?>"<?php if($newsroom->status == $newsroom->status){ echo "selected"; } ?>><?php echo $Y ?></option>
            <option value="N">Inactive</option>
             <option value="Y">Active</option>
         </select>
    </div>
      
<?php } else { ?>
     
    
     <div class="col-md-6">
        <label class="form-label">News Category</label>
        <input type="text" class="form-control form-control-lg" name="newsroom[category]" placeholder="Enter News Category" required>
    </div>
     <div class="col-6">
        <label class="form-label">News Status</label>
         <select name="newsroom[status]" class="form-control form-control-lg" id="">
            <option value="" required>-Status-</option>
            <option value="Y">Active</option>
            <option value="N">Inactive</option>
         </select>
    </div>
    

<?php } ?>