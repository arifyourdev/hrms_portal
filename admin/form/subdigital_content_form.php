<?php
if (isset($_GET['id'])) {
     $subcontent_id = $_GET['id'];
     $subcontent = SubDigitalContent::find_by_id($subcontent_id);
?>
     <div class="col-6">
        <label class="form-label">Digital Category</label>
         <select name="subcontent[digital_id]" class="form-control form-control-lg" id="">
            <option value="" required>-Select Category-</option>
            <?php $content = DigitalContent::find_by_order();
            foreach($content as $digi_c){ ?>
            <option value="<?php echo $digi_c->id?>"<?php if($subcontent->digital_id == $digi_c->id){ echo "selected"; } ?>><?php echo $digi_c->category_name?></option>
           <?php } ?>
         </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Title</label>
        <input type="text" class="form-control form-control-lg" name="subcontent[title]" value="<?php echo $subcontent->title ?>" placeholder="  Title">
    </div>
    
    <div class="col-6">
        <label class="form-label">  Url</label>
        <input type="text" class="form-control form-control-lg" name="subcontent[seo_url]" value="<?php echo $subcontent->seo_url ?>" placeholder="URL">
    </div>
    <div class="col-6">
        <label class="form-label">Status</label>
         <select name="subcontent[status]"  class="form-control form-control-lg" id="">
              <?php if ($subcontent->status == 'Y') echo $Y="Active";
                else {
                    echo $Y="Inactive";
                } ?>
            <option value="<?php echo $subcontent->status ?>"<?php if($subcontent->status == $subcontent->status){ echo "selected"; } ?>><?php echo $Y ?></option>
            <option value="N">Inactive</option>
             <option value="Y">Active</option>
         </select>
    </div>
    
    <div class="col-6">
        <label for="formFile" class="form-label"> Image (250px * 600px)*</label>
        <input class="form-control " type="file" name="image" id="formFile">
         <img src="<?php echo $subcontent->picture_path() ?>" alt="" width="80px" height="80px">
    </div>
    <div class="col-md-6">
        <label class="form-label">Details</label>
        <textarea type="text" class="form-control form-control-lg" name="subcontent[description]" value="" placeholder="  Title"><?php echo $subcontent->description ?></textarea>
    </div>

<?php } else { ?>


     <div class="col-6">
        <label class="form-label">Digital Category</label>
         <select name="subcontent[digital_id]" class="form-control form-control-lg" id="">
            <option value="" required>-Select Category-</option>
            <?php $content = DigitalContent::find_by_order();
            foreach($content as $digi_c){ ?>
            <option value="<?php echo $digi_c->id ?>"><?php echo $digi_c->category_name?></option>
           <?php } ?>
         </select>
    </div>
    <div class="col-md-6">
        <label class="form-label"> Title</label>
        <input type="text" class="form-control form-control-lg" name="subcontent[title]" placeholder="Enter Title" required>
    </div>
    <div class="col-6">
        <label class="form-label">Url (same as title but in small text)</label>
        <input type="text" class="form-control form-control-lg" name="subcontent[seo_url]" placeholder=" url">
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
        <label for="formFile" class="form-label">Image (250px * 600px)*</label>
        <input class="form-control " type="file" name="image" id="formFile">
    </div>
    <div class="col-md-6">
        <label class="form-label">Details</label>
        <textarea type="text" class="form-control form-control-lg" name="subcontent[description]" value="" placeholder="Details"></textarea>
    </div>

<?php } ?>