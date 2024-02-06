<?php
if (isset($_GET['id'])) {
     $newaroom_detail = $_GET['id'];
     $detail = NewsroomDetail::find_by_id($newaroom_detail);
?>

      <div class="col-6">
        <label class="form-label">News Category</label>
         <select name="detail[newsroom_id]" class="form-control form-control-lg" id="">
            <option value="" required>-Select Category-</option>
            <?php $newsroom = Newsroom::find_by_order();
            foreach($newsroom as $news_category){ ?>
           <option value="<?php echo $news_category->id?>"<?php if($detail->newsroom_id == $news_category->id){ echo 'selected'; } ?>><?php echo $news_category->category?></option>           <?php } ?>
         </select>
    </div>
    <div class="col-md-6">
        <label class="form-label"> Title</label>
        <input type="text" class="form-control form-control-lg" name="detail[title]" value="<?php echo $detail->title?>" placeholder="Enter Title" required>
    </div>
    <div class="col-6">
        <label class="form-label">Date</label>
        <input type="text" class="form-control form-control-lg" name="detail[date]" value="<?php echo $detail->date?>" placeholder=" Date">
    </div>
     
     
    <div class="col-6">
        <label for="formFile" class="form-label">Image</label>
        <input class="form-control " type="file" name="image" id="formFile">
        <img src="<?php echo $detail->picture_path()?>" alt="" width="80px" height="80px">
    </div>
    <div class="col-12">
        <label class="form-label">Details</label>
        <textarea type="text" class="form-control form-control-lg" name="detail[details]" placeholder=" Enter Details"><?php echo $detail->details?></textarea>
    </div>
<?php } else { ?>
      <div class="col-6">
        <label class="form-label">News Category</label>
         <select name="detail[newsroom_id]" class="form-control form-control-lg" id="">
            <option value="" required>-Select Category-</option>
            <?php $newsroom = Newsroom::find_by_order();
            foreach($newsroom as $news_category){ ?>
            <option value="<?php echo $news_category->id?>"><?php echo $news_category->category?></option>
           <?php } ?>
         </select>
    </div>
    <div class="col-md-6">
        <label class="form-label"> Title</label>
        <input type="text" class="form-control form-control-lg" name="detail[title]" placeholder="Enter Title" required>
    </div>
    <div class="col-6">
        <label class="form-label">Date</label>
        <input type="date" class="form-control form-control-lg" name="detail[date]" placeholder=" Date">
    </div>
     
    
    <div class="col-6">
        <label for="formFile" class="form-label">Image</label>
        <input class="form-control " type="file" name="image" id="formFile">
    </div>
    <div class="col-12">
        <label class="form-label">Details</label>
        <textarea type="text" class="form-control form-control-lg" name="detail[details]" placeholder=" Enter Details"></textarea>
    </div>
<?php } ?>