<?php
if (isset($_GET['id'])) {
     $testimonial_id = $_GET['id'];
     $testimonial = BookTestimonial::find_by_custom_id('testimonial_id',$testimonial_id);
?>
    <div class="col-md-6">
        <label class="form-label">testimonial Added By</label>
        <input type="text" class="form-control form-control-lg" name="testimonial[testimonial_added_by]" value="<?php echo $testimonial->testimonial_added_by ?>">
    </div>
     
 
    <div class="col-6">
        <label class="form-label">testimonial Status</label>
         <select name="testimonial[testimonial_status]" class="form-control form-control-lg" id="">
              <?php if ($testimonial->testimonial_status == 'Y') echo $Y="Active";
                else {
                    echo $Y="Inactive";
                } ?>
            <option value="<?php echo $testimonial->testimonial_status ?>"<?php if($testimonial->testimonial_status == $testimonial->testimonial_status){ echo "selected"; } ?>><?php echo $Y ?></option>
            <option value="N">Inactive</option>
             <option value="Y">Active</option>
         </select>
    </div>
 
        <div class="col-12">
        <label for="formFile" class="form-label">Testimonnial Image</label>
        <input class="form-control " type="file" name="testimonial_image" id="formFile">
        <img src="<?php echo $testimonial->picture_path()?>">
    </div>
    <div class="col-12">
        <label class="form-label">Testimonial Details</label>
        <textarea type="text" class="form-control form-control-lg" name="testimonial[testimonial_detail]" placeholder="Testimonial Details"> <?php echo $testimonial->testimonial_detail ?></textarea>
    </div>
      
      
<?php } else { ?>
     
    <div class="col-md-6">
        <label class="form-label">Testimonial Added By</label>
        <input type="text" class="form-control form-control-lg" name="testimonial[testimonial_added_by]" placeholder="Testimonial Added By" required>
    </div>
     <div class="col-6">
        <label class="form-label">Testimonial Status</label>
         <select name="testimonial[testimonial_status]" class="form-control form-control-lg" id="">
            <option value="" required>-Status-</option>
            <option value="Y">Active</option>
            <option value="N">Inactive</option>
         </select>
    </div>
        <div class="col-12">
        <label for="formFile" class="form-label">Testimonnial Image</label>
        <input class="form-control " type="file" name="testimonial_image" id="formFile">
    </div>
     <div class="col-12">
        <label class="form-label">Testimonial Details</label>
        <textarea type="text" class="form-control form-control-lg" name="testimonial[testimonial_detail]" placeholder="Testimonial Details"></textarea>
    </div>
     <input type="hidden" name="testimonial[testimonial_date]" value="<?php echo $time ?>">
     <input type="hidden" name="testimonial[testimonial_time]" value="<?php echo $time ?>">

<?php } ?>