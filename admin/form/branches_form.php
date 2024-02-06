<?php
if (isset($_GET['id'])) {
     $branch_id = $_GET['id'];
     $branch = Branches::find_by_custom_id('branch_id',$branch_id);
?>
    <div class="col-md-6">
        <label class="form-label">City Name</label>
        <input type="text" class="form-control form-control-lg" name="branch[city_name]" value="<?php echo $branch->city_name ?>">
    </div>
    <div class="col-md-6">
        <label class="form-label">Address</label>
        <input type="text" class="form-control form-control-lg" name="branch[address]" value="<?php echo $branch->address ?>">
    </div>
 <div class="col-md-6">
        <label class="form-label">Landline</label>
        <input type="text" class="form-control form-control-lg" name="branch[landline]" value="<?php echo $branch->landline ?>">
    </div>
    <div class="col-md-6">
        <label class="form-label">Mobile</label>
        <input type="text" class="form-control form-control-lg" name="branch[mobile]" value="<?php echo $branch->mobile ?>">
    </div>
    <div class="col-md-6">
        <label class="form-label">Email</label>
        <input type="text" class="form-control form-control-lg" name="branch[email]" value="<?php echo $branch->email ?>">
    </div>
    <div class="col-md-6">
        <label class="form-label">URL</label>
        <input type="text" class="form-control form-control-lg" name="branch[url]" value="<?php echo $branch->url ?>">
    </div>
    <div class="col-md-6">
        <label class="form-label">Fax</label>
        <input type="text" class="form-control form-control-lg" name="branch[fax]" value="<?php echo $branch->fax ?>">
    </div>
    <div class="col-6">
        <label class="form-label">Status</label>
         <select name="branch[status]" class="form-control form-control-lg" id="">
              <?php if ($branch->status == 'Y') echo $Y="Active";
                else {
                    echo $Y="Inactive";
                } ?>
            <option value="<?php echo $branch->status ?>"<?php if($branch->status == $branch->status){ echo "selected"; } ?>><?php echo $Y ?></option>
            <option value="N">Inactive</option>
             <option value="Y">Active</option>
         </select>
    </div>
      
<?php } else { ?>
     
    <div class="col-md-6">
        <label class="form-label">City name</label>
        <input type="text" class="form-control form-control-lg" name="branch[city_name]" placeholder="Enter City Name" required>
    </div>
     <div class="col-6">
        <label class="form-label">Address</label>
        <input type="text" class="form-control form-control-lg" name="branch[address]" placeholder="Address">
    </div>
     <div class="col-6">
        <label class="form-label">Landline</label>
        <input type="text" class="form-control form-control-lg" name="branch[landline]" placeholder="Landline">
    </div>
    <div class="col-6">
        <label class="form-label">Mobile</label>
        <input type="text" class="form-control form-control-lg" name="branch[mobile]" placeholder="Mobile">
    </div>
     <div class="col-6">
        <label class="form-label">Fax</label>
        <input type="text" class="form-control form-control-lg" name="branch[fax]" placeholder="Fax">
    </div>
     <div class="col-6">
        <label class="form-label">Email</label>
        <input type="text" class="form-control form-control-lg" name="branch[email]" placeholder="Email">
    </div>
     <div class="col-6">
        <label class="form-label">URL</label>
        <input type="text" class="form-control form-control-lg" name="branch[url]" placeholder="URL">
    </div>
    <div class="col-6">
        <label class="form-label">Status</label>
         <select name="branch[status]" class="form-control form-control-lg" id="">
            <option value="" required>-Status-</option>
            <option value="Y">Active</option>
            <option value="N">Inactive</option>
         </select>
    </div>
    

<?php } ?>