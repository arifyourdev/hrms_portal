<?php
if (isset($_GET['id'])) {
     $albums_id = $_GET['id'];
     $albums = BookAlbumCateg::find_by_id($albums_id);
?>
    <div class="col-md-6">
        <label class="form-label">Album Category</label>
        <input type="text" class="form-control form-control-lg" name="albums[album_category]" value="<?php echo $albums->album_category ?>">
    </div>
    
    <div class="col-6">
        <label class="form-label">Status</label>
         <select name="albums[status]" class="form-control form-control-lg" id="">
              <?php if ($albums->status == 'Y') echo $Y="Active";
                else {
                    echo $Y="Inactive";
                } ?>
            <option value="<?php echo $albums->status ?>"<?php if($albums->status == $albums->status){ echo "selected"; } ?>><?php echo $Y ?></option>
            <option value="N">Inactive</option>
             <option value="Y">Active</option>
         </select>
    </div>
      
<?php } else { ?>
     
    <div class="col-md-6">
        <label class="form-label">Album Category</label>
        <input type="text" class="form-control form-control-lg" name="albums[album_category]" placeholder="Enter Album Category" required>
    </div>
    
    <div class="col-6">
        <label class="form-label">Status</label>
         <select name="albums[status]" class="form-control form-control-lg" id="">
            <option value="" required>-Status-</option>
            <option value="Y">Active</option>
            <option value="N">Inactive</option>
         </select>
    </div>
    

<?php } ?>