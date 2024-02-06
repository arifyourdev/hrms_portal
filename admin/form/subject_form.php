<?php
if (isset($_GET['id'])) {
     $subject_id = $_GET['id'];
     $subject = BookSubject::find_by_custom_id('subject_id',$subject_id);
?>
    <div class="col-md-6">
        <label class="form-label">Subject Title</label>
        <input type="text" class="form-control form-control-lg" name="subject[subject_title]" value="<?php echo $subject->subject_title ?>">
    </div>
    <div class="col-md-6">
        <label class="form-label">Sort Order</label>
        <input type="text" class="form-control form-control-lg" name="subject[subject_sort_order]" value="<?php echo $subject->subject_sort_order ?>">
    </div>
    <div class="col-6">
        <label class="form-label">Show On Home Page</label>
         <select name="subject[subject_on_homepage]" class="form-control form-control-lg" id="">
            <option value="<?php echo $subject->subject_on_homepage ?>"<?php if($subject->subject_on_homepage == $subject->subject_on_homepage){ echo "selected"; } ?>><?php echo $subject->subject_on_homepage ?></option>
            <option value="N">No</option>
             <option value="Y">Yes</option>
         </select>
    </div>
    <div class="col-6">
        <label class="form-label">Subject Status</label>
         <select name="subject[subject_status]" class="form-control form-control-lg" id="">
              <?php if ($subject->subject_status == 'Y') echo $Y="Active";
                else {
                    echo $Y="Inactive";
                } ?>
            <option value="<?php echo $subject->subject_status ?>"<?php if($subject->subject_status == $subject->subject_status){ echo "selected"; } ?>><?php echo $Y ?></option>
            <option value="N">Inactive</option>
             <option value="Y">Active</option>
         </select>
    </div>
      
<?php } else { ?>
     
    <div class="col-md-6">
        <label class="form-label">Subject Title</label>
        <input type="text" class="form-control form-control-lg" name="subject[subject_title]" placeholder="Enter Title" required>
    </div>
     <div class="col-6">
        <label class="form-label">Subject Sort Order</label>
        <input type="text" class="form-control form-control-lg" name="subject[subject_sort_order]" placeholder=" Enter Sort Order">
    </div>
    <div class="col-6">
        <label class="form-label">Show On Home Page</label>
         <select name="subject[subject_on_homepage]" class="form-control form-control-lg" id="">
            <option value="" required>-Select-</option>
            <option value="Y">Yes</option>
            <option value="N">No</option>
         </select>
    </div>
    <div class="col-6">
        <label class="form-label">Subject Status</label>
         <select name="subject[subject_status]" class="form-control form-control-lg" id="">
            <option value="" required>-Status-</option>
            <option value="Y">Active</option>
            <option value="N">Inactive</option>
         </select>
    </div>
    

<?php } ?>