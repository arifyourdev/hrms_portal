<?php
if (isset($_GET['id'])) {
     $album_id = $_GET['id'];
     $album = BookAlbum::find_by_custom_id('album_id',$album_id);
?>
    <div class="col-6">
        <label class="form-label">Album Category</label>
         <select name="album[album_category]" class="form-control form-control-lg" id="">
            <option value="" required>-Select Category-</option>
            <?php $content = BookAlbumCateg::find_by_order();
            foreach($content as $digi){ ?>
            <option value="<?php echo $digi->id?>"<?php if($album->album_category == $digi->id){ echo "selected"; } ?>><?php echo $digi->album_category?></option>
           <?php } ?>
         </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Album Title</label>
        <input type="text" class="form-control form-control-lg" name="album[album_title]" value="<?php echo $album->album_title ?>">
    </div>
     
     <div class="col-6">
        <label class="form-label">Album Status</label>
         <select name="album[album_status]" class="form-control form-control-lg" id="">
              <?php if ($album->album_status == 'Y') echo $Y="Active";
                else {
                    echo $Y="Inactive";
                } ?>
            <option value="<?php echo $album->album_status ?>"<?php if($album->album_status == $album->album_status){ echo "selected"; } ?>><?php echo $Y ?></option>
            <option value="Y">Active</option>
            <option value="N">Inactive</option>
         </select>
    </div>
    <div class="col-md-12">
        <label class="form-label">Album Image</label>
        <input type="file" class="form-control" name="album_image" placeholder="Enter Title">
        <img src="<?php echo $album->picture_path()?>" width="100px" height="88px">
    </div>
     <div class="col-md-12">
        <label class="form-label">Album Detail</label>
        <textarea class="form-control" name="album[album_detail]" placeholder="Enter Details" required><?php echo $album->album_detail?></textarea>
    </div>
      
<?php } else { ?>
      <div class="col-6">
        <label class="form-label">Album Category</label>
         <select name="album[album_category]" class="form-control form-control-lg" id="">
           <option value="" required>-Select Category-</option>
            <?php $content = BookAlbumCateg::find_by_order();
            foreach($content as $digi){ ?>
            <option value="<?php echo $digi->id?>"><?php echo $digi->album_category?></option>
           <?php } ?>
         </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Album Title</label>
        <input type="text" class="form-control form-control-lg" name="album[album_title]" placeholder="Enter Title" required>
    </div>
      
    <div class="col-6">
        <label class="form-label">Album Status</label>
         <select name="album[album_status]" class="form-control form-control-lg" id="">
            <option value="" required>-Status-</option>
            <option value="Y">Active</option>
            <option value="N">Inactive</option>
         </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Album Image</label>
        <input type="file" class="form-control" name="album_image" placeholder="Enter Title" required>
    </div>
     <div class="col-md-12">
        <label class="form-label">Album Detail</label>
        <textarea class="form-control" name="album[album_detail]" placeholder="Enter Details" required></textarea>
    </div>
      
 
<?php } ?>