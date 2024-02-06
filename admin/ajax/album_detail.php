<?php
require_once "../private/initialize.php";

if(isset($_POST['id'])){
$album_data = $_POST['id'];
$user_master = BookAlbumCross::find_by_custom_id('data_id',$album_data);?> 
         
         
         <div class="modal-header">
            <h4 class="modal-title">Add Images</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
    
          <!-- Modal body -->
          <div class="modal-body" action="album">
             <form method="post" enctype="multipart/form-data">
                <div class="row g-3">
                 <div class="col-4">
                            <label class="form-label">Image <span style="color:red">(upload multiple Images)</span></label>
                            <input type="file" class="form-control" name="data_image[]" placeholder="Data Image" multiple>
                        </div>
                        <input type="hidden" name="album_c[data_album_id]" value="<?php echo $album_data ?>">
                        <div class="col-4">
                            <label class="form-label">Type</label>
                             <select name="album_c[data_type]" class="form-control" id="">
                                <option value="" required>-Type-</option>
                                <option value="I">Image</option>
                                <option value="V">Video</option>
                             </select>
                        </div>
                         
                        <div class="col-4">
                            <label class="form-label">Video Url</label>
                            <input type="text" class="form-control" name="album_c[data_url]" placeholder="Video url">
                        </div>
                         
                        <input type="hidden" name="album_c[data_status]" value="Y">
                       <div class="mt-3">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
              </form>
              
              
                  <div class="col-md-12">
                      <div class="row">
                      <?php $all_images = BookAlbumCross::find_by_album_gallery($album_data);
                            foreach($all_images as $image)
                            {
                      ?>
                      <div class="col-md-3 m-0">
                           <div class="show-image">
                               <img src="<?php echo $image->picture_path() ?>" width="180" height="130">
                                <button class="delete btn btn-sm btn-outline-danger delete_album_img" id="<?php echo $image->data_id ?>" type="button"  ><i class="fa fa-close"></i></button>
                              </div>
                      </div>
                      <?php } ?>
                      </div>
                  </div>
              
          </div>
       
<?php } ?>