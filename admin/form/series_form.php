<?php
if (isset($_GET['id'])) {
     $series_id = $_GET['id'];
     $series = BookSeries::find_by_custom_id('series_id',$series_id);
?>
     <div class="col-md-4">
        <label class="form-label">Series Title</label>
        <input type="text" class="form-control" name="series[series_title]" placeholder="Enter Title" value="<?php echo $series->series_title?>" required>
    </div>
     <div class="col-md-4 mt-5">
        <label class="form-label">Mark As New Series</label>
        <input type="checkbox" class="checkboxx" name="series[series_as_new]" value="1" <?php if($series->series_as_new){echo "checked";} ?>>
    </div>
     <div class="col-md-4 mt-5">
        <label class="form-label">Show in Resource Center</label>
        <input type="checkbox" class="checkboxx" name="series[series_as_resource]" value="1"<?php if($series->series_as_resource){echo "checked";} ?> >
    </div>
    <div class="col-md-6">
         <label class="form-label">For Class Choose Class</label><br>
         <div class="row">
             <?php
            $book_c = BookClass::find_by_order();
            foreach($book_c as $cls) {
                $check_series = BookSeriesClass::check_series_class($series->series_id,$cls->class_id);

             ?>
              <div class="col-md-6">
                  <input type="checkbox" class="checkboxx" name="series_class[]" value="<?php echo $cls->class_id ?>" <?php echo ($check_series  ? 'checked' :'' ) ?>>
                  <span><?php echo $cls->class_title ?></span>
              </div>
              <?php } ?>
           </div>
     </div>
    <div class="col-md-6">
        <label class="form-label">Series Image  <span style="color:red">(Size Required =347 × 447 px)</span></label>
        <input type="file" class="form-control" name="series_image">
        <img src="<?php echo $series->picture_path() ?>" width="100px" height="88px">
    </div>
    <div class="col-md-4">
        <label class="form-label">Series Brochure</label>
        <input type="file" class="form-control" name="series_brochure">
        
    </div>
      <div class="col-4">
        <label class="form-label">Book Series Speciman</label>
         <select name="series[series_speciman]" class="form-control" id="">
             <?php if ($series->series_speciman == 'Y') echo $Y="Active";
                else {
                    echo $Y="Inactive";
                } ?>
            <option value="<?php echo $series->series_speciman ?>"<?php if($series->series_speciman  == $series->series_speciman){ echo "selected"; } ?>><?php echo $Y ?></option>
            <option value="Y">Active</option>
            <option value="N">Inactive</option>
          </select>
    </div>
    <div class="col-4">
        <label class="form-label">Type</label>
         <select name="series[series_type]" class="form-control" id="">
            <option value="0" required>-Type-</option>
             <?php
                $gValue = BookGroup::find_by_order();
                foreach($gValue as $grp){
                 ?>
                 <option value="<?php echo $grp->group_id ?>" <?php if($series->series_type == $grp->group_id){ echo "selected"; } ?>><?php echo $grp->group_title ?></option>
             <?php } ?>
          </select>
    </div>
     <div class="col-6">
        <label class="form-label">Book Series Author</label>
        <textarea type="text" class="form-control" name="series[series_author]" placeholder="Enter Author"><?php echo $series->series_author ?></textarea>
    </div>
     <div class="col-6">
        <label class="form-label">Series Detail</label>
        <textarea type="text" class="form-control" name="series[series_detail]" placeholder=" Enter Details"><?php echo $series->series_detail ?></textarea>
    </div>
     <div class="col-6">
        <label class="form-label">Book Series About Author</label>
        <textarea type="text" class="form-control" name="series[series_about_author]" placeholder="Enter Series About Author"><?php echo $series->series_about_author ?></textarea>
    </div>
    <div class="col-6">
        <label class="form-label">About Book Series</label>
        <textarea type="text" class="form-control" name="series[series_about_series]" placeholder="Enter About Book Series"><?php echo $series->series_about_series ?></textarea>
    </div>
       <div class="col-6">
        <label class="form-label">e-Book Detail</label>
        <textarea type="text" class="form-control" name="series[series_ebook_detail]" placeholder="e-Book Detail"><?php echo $series->series_ebook_detail ?></textarea>
    </div>
     <div class="col-6">
        <label class="form-label">Series Salient Feature</label>
        <textarea type="text" class="form-control" name="series[series_salient_feature]" placeholder="Enter Salient Feature"><?php echo $series->series_salient_feature ?></textarea>
    </div>
    <div class="col-6">
        <label class="form-label">Series Supporting Material</label>
        <textarea type="text" class="form-control" name="series[series_supporting_material]" placeholder="Enter Series Supporting Material"><?php echo $series->series_supporting_material ?></textarea>
    </div>
    <div class="col-6">
        <label class="form-label">Book Series Supporting Material</label>
         <select name="series[series_is_supporting_material]" class="form-control" id="">
             <?php if ($series->series_is_supporting_material == 'Y') echo $Y="Active";
                else {
                    echo $Y="Inactive";
                } ?>
            <option value="<?php echo $series->series_is_supporting_material ?>"<?php if($series->series_is_supporting_material  == $series->series_is_supporting_material){ echo "selected"; } ?>><?php echo $Y ?></option>
            <option value="Y">Active</option>
            <option value="N">Inactive</option>
          </select>
    </div>
    <div class="col-6">
        <label class="form-label">Book Series Status</label>
         <select name="series[series_status]" class="form-control" id="">

            <option value="Y" <?php if($series->series_status  == 'Y'){ echo "selected"; } ?>>Active</option>
            <option value="N" <?php if($series->series_status  == 'N'){ echo "selected"; } ?>>Inactive</option>
          </select>
    </div>
    <div class="col-6">
        <label class="form-label">Book Series Lavel</label>
         <select name="series[series_lavel]" class="form-control" id="">
            <option value="" required>-Series Level-</option>
             <?php
                $book_level = BookLeval::find_by_order();
                foreach($book_level as $level){
                 ?>
                 <option value="<?php echo $level->lavel_id ?>" <?php if($series->series_lavel == $level->lavel_id){ echo "selected";} ?>><?php echo $level->lavel_title ?></option>
                 <?php } ?>
          </select>
    </div>
      <div class="col-md-6 mt-5">
        <label class="form-label">E-Book Display</label>
        <input type="checkbox" class="checkboxx" v name="series[book_as_ebook]" value="1" <?php if($series->book_as_ebook){echo "checked";} ?> >
    </div>
     <div class="col-6">
        <label class="form-label">Digital Content</label>
        <input type="text" class="form-control" name="series[series_digital_content]" placeholder="Enter Digital Content" value="<?php echo $series->series_digital_content ?>">
    </div>
     
    <div class="col-6">
        <label class="form-label">Set As Betseller</label>
         <select name="series[series_bestseller]" class="form-control" id="">
            <option value="" required>-Status-</option>
             <?php if ($series->series_bestseller == 'Y') echo $Y="Active";
                else {
                    echo $Y="Inactive";
                } ?>
             <option value="<?php echo $series->series_bestseller ?>"<?php if($series->series_bestseller == $series->series_bestseller){ echo "selected"; } ?>><?php echo $Y ?></option>   
            <option value="Y">Active</option>
            <option value="N">Non Active</option>
         </select>
    </div>
    <div class="col-6">
        <label class="form-label">Series Subject</label>
         <select name="series[series_subject]" class="form-control" id="">
            <option value="" required>-Select-</option>
              <?php
                $book_subject = BookSubject::find_by_order();
                foreach($book_subject as $sub){
                 ?>
                 <option value="<?php echo $sub->subject_id ?>"<?php if($series->series_subject == $sub->subject_id){ echo "selected"; } ?>><?php echo $sub->subject_title ?></option>
                 <?php } ?>
         </select>
    </div>
     <div class="col-6">
        <label class="form-label">Amazon</label>
        <input type="text" class="form-control" name="series[series_amazon_url]" placeholder="Amazon" value="<?php echo $series->series_amazon_url ?>">
    </div>
     <div class="col-6">
        <label class="form-label">Google</label>
        <input type="text" class="form-control" name="series[book_google_link]" placeholder="Google" value="<?php echo $series->book_google_link ?>">
    </div>
     <div class="col-6">
        <label class="form-label">Kopykitab</label>
        <input type="text" class="form-control" name="series[book_kopykitab_link]" placeholder="Kopykitab" value="<?php echo $series->book_kopykitab_link?>">
    </div>
    
     <div class="col-6">
        <label class="form-label"> Request an E-sample Pdf</label>
        <input type="file" class="form-control" name="sample_pdf" placeholder="Kopykitab">
        <?php echo $series->sample_pdf ?>
    </div>
    <div class="col-6">
        <label class="form-label">Board</label>
         <select name="series[series_board]" class="form-control" id="">
            <option value="" required>-Board-</option>
                <?php
                $booards = Board::find_by_order();
                foreach($booards as $board){
                 ?>
                 <option value="<?php echo $board->id?>"<?php if($series->series_board == $board->id){ echo "selected"; } ?>><?php echo $board->board_title?></option>
             <?php } ?>
             
         </select>
    </div>
   
      
<?php } else { ?>
     
    <div class="col-md-4">
        <label class="form-label">Series Title</label>
        <input type="text" class="form-control" name="series[series_title]" placeholder="Enter Title" required>
    </div>
     <div class="col-md-4 mt-5">
        <label class="form-label">Mark As New Series</label>
        <input type="checkbox" class="checkboxx" name="series[series_as_new]" value="1">
    </div>
     <div class="col-md-4 mt-5">
        <label class="form-label">Show in Resource Center</label>
        <input type="checkbox" class="checkboxx" name="series[series_as_resource]" value="1">
    </div>
    <div class="col-md-6">
         <label class="form-label">For Class Choose Class</label><br>
         <div class="row">
             <?php
                $book_c = BookClass::find_by_order();
                foreach($book_c as $cls) {
             ?>
              <div class="col-md-6">
                  <input type="checkbox" class="checkboxx" name="series_class[]" value="<?php echo $cls->class_id ?>">
                  <span><?php echo $cls->class_title ?></span>
              </div>
              <?php } ?>
           </div>
     </div>
    <div class="col-md-6">
        <label class="form-label">Series Image <span style="color:red">(Size Required =347 × 447 px)</span></label>
        <input type="file" class="form-control" name="series_image">
    </div>
    <div class="col-md-4">
        <label class="form-label">Series Brochure</label>
        <input type="file" class="form-control" name="series_brochure">
    </div>
      <div class="col-4">
        <label class="form-label">Book Series Speciman</label>
         <select name="series[series_speciman]" class="form-control" id="">
            <option value="" required>-Status-</option>
            <option value="Y">Active</option>
            <option value="N">Inactive</option>
          </select>
    </div>
    <div class="col-4">
        <label class="form-label">Type</label>
         <select name="series[series_type]" class="form-control" id="">
            <option value="0" required>-Type-</option>
             <?php
                $gValue = BookGroup::find_by_order();
                foreach($gValue as $grp){
                 ?>
                 <option value="<?php echo $grp->group_id ?>"><?php echo $grp->group_title ?></option>
             <?php } ?>
          </select>
    </div>
     <div class="col-6">
        <label class="form-label">Book Series Author</label>
        <textarea type="text" class="form-control" name="series[series_author]" placeholder="Enter Author"></textarea>
    </div>
     <div class="col-6">
        <label class="form-label">Series Detail</label>
        <textarea type="text" class="form-control" name="series[series_detail]" placeholder=" Enter Details"></textarea>
    </div>
     <div class="col-6">
        <label class="form-label">Book Series About Author</label>
        <textarea type="text" class="form-control" name="series[series_about_author]" placeholder="Enter Series About Author"></textarea>
    </div>
    <div class="col-6">
        <label class="form-label">About Book Series</label>
        <textarea type="text" class="form-control" name="series[series_about_series]" placeholder="Enter About Book Series"></textarea>
    </div>
       <div class="col-6">
        <label class="form-label">e-Book Detail</label>
        <textarea type="text" class="form-control" name="series[series_ebook_detail]" placeholder="e-Book Detail"></textarea>
    </div>
     <div class="col-6">
        <label class="form-label">Series Salient Feature</label>
        <textarea type="text" class="form-control" name="series[series_salient_feature]" placeholder="Enter Salient Feature"></textarea>
    </div>
    <div class="col-6">
        <label class="form-label">Series Supporting Material</label>
        <textarea type="text" class="form-control" name="series[series_supporting_material]" placeholder="Enter Series Supporting Material"></textarea>
    </div>
    <div class="col-6">
        <label class="form-label">Book Series Supporting Material</label>
         <select name="series[series_is_supporting_material]" class="form-control" id="">
            <option value="" required>-Status-</option>
            <option value="Y">Active</option>
            <option value="N">Inactive</option>
          </select>
    </div>
    <div class="col-6">
        <label class="form-label">Book Series Status</label>
         <select name="series[series_status]" class="form-control" id="">
            <option value="" required>-Status-</option>
            <option value="Y">Active</option>
            <option value="N">Inactive</option>
          </select>
    </div>
    <div class="col-6">
        <label class="form-label">Book Series Lavel</label>
         <select name="series[series_lavel]" class="form-control" id="">
            <option value="" required>-Series Level-</option>
             <?php
                $book_level = BookLeval::find_by_order();
                foreach($book_level as $level){
                 ?>
                 <option value="<?php echo $level->lavel_id ?>"><?php echo $level->lavel_title ?></option>
                 <?php } ?>
          </select>
    </div>
      <div class="col-md-6 mt-5">
        <label class="form-label">E-Book Display</label>
        <input type="checkbox" class="checkboxx" name="series[book_as_ebook]">
    </div>
     <div class="col-6">
        <label class="form-label">Digital Content</label>
        <input type="text" class="form-control" name="series[series_digital_content]" placeholder="Enter Digital Content">
    </div>
     
    <div class="col-6">
        <label class="form-label">Set As Betseller</label>
         <select name="series[series_bestseller]" class="form-control" id="">
            <option value="" required>-Status-</option>
            <option value="Y">Active</option>
            <option value="N">Non Active</option>
         </select>
    </div>
    <div class="col-6">
        <label class="form-label">Series Subject</label>
         <select name="series[series_subject]" class="form-control" id="">
            <option value="" required>-Select-</option>
              <?php
                $book_subject = BookSubject::find_by_order();
                foreach($book_subject as $sub){
                 ?>
                 <option value="<?php echo $sub->subject_id ?>"><?php echo $sub->subject_title ?></option>
                 <?php } ?>
         </select>
    </div>
     <div class="col-6">
        <label class="form-label">Amazon</label>
        <input type="text" class="form-control" name="series[series_amazon_url]" placeholder="Amazon">
    </div>
     <div class="col-6">
        <label class="form-label">Google</label>
        <input type="text" class="form-control" name="series[book_google_link]" placeholder="Google">
    </div>
     <div class="col-6">
        <label class="form-label">Kopykitab</label>
        <input type="text" class="form-control" name="series[book_kopykitab_link]" placeholder="Kopykitab">
    </div>
    
     <div class="col-6">
        <label class="form-label"> Request an E-sample Pdf</label>
        <input type="file" class="form-control" name="sample_pdf" placeholder="Kopykitab">
    </div>
    <div class="col-md-4">
        <label class="form-label">Board</label>
         <select name="series[series_board]" class="form-control" id="">
            <option value="" required>-Board-</option>
                <?php
                $booards = Board::find_by_order();
                foreach($booards as $board){
                 ?>
                 <option value="<?php echo $board->id ?>"><?php echo $board->board_title ?></option>
             <?php } ?>
             
         </select>
    </div>

<?php } ?>