<?php
if (isset($_GET['id'])) {
     $book_id = $_GET['id'];
     $book = BookMaster::find_by_custom_id('book_id',$book_id);
?>
      <div class="col-md-4">
        <label class="form-label">Book Title</label>
        <input type="text" class="form-control" name="books[book_title]" placeholder="Enter Title" value="<?php echo $book->book_title?>" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Book Image</label>
        <input type="file" class="form-control" name="book_image">
        <img src="<?php echo $book->picture_path()?>" width="100px" height="88px">
    </div>
    <div class="col-md-4 mt-5">
        <label class="form-label">New Release</label>
        <input type="checkbox" class="checkboxx" name="books[book_new_release]" value="1" <?php if($book->book_new_release){echo "checked";} ?>>
    </div>
    <div class="col-md-4 mt-5">
        <label class="form-label">Mark As New Book</label>
        <input type="checkbox" class="checkboxx" name="books[book_as_new]" value="1" <?php if($book->book_as_new){echo "checked";}?>>
    </div>
     <div class="col-md-4 mt-5">
        <label class="form-label">Show in Resource Center</label>
        <input type="checkbox" class="checkboxx" name="books[book_as_resource]" value="<?php echo $book->book_as_resource ?>" <?php if($book->book_as_resource) { echo "checked";}  ?>>
    </div>
    
     <div class="col-md-4">
        <label class="form-label">Book ISBN</label>
        <input type="text" class="form-control" name="books[book_isbn]" value="<?php echo $book->book_isbn?>" placeholder=" Enter Book ISBN">
    </div>
     <div class="col-md-4">
        <label class="form-label">Book Price</label>
        <input type="text" class="form-control" name="books[book_price]" value="<?php echo $book->book_price?>" placeholder=" Enter Book Price">
    </div>
     <div class="col-md-4">
        <label class="form-label">Book Author</label>
        <textarea type="text" class="form-control" name="books[book_author]" placeholder=" Enter Book Author"><?php echo $book->book_author?></textarea>
    </div>
     <div class="col-md-4">
        <label class="form-label">Amazon Url</label>
        <input type="text" class="form-control" name="books[book_amazon_url]" value="<?php echo $book->book_amazon_url?>" placeholder=" Enter Amazon Url">
    </div>
      <div class="col-md-4">
        <label class="form-label">Degital Content</label>
        <input type="text" class="form-control" name="books[book_digital_content]" value="<?php echo $book->book_digital_content?>" placeholder="Enter Digital Content">
    </div>
       <div class="col-md-4">
        <label class="form-label">Board</label>
         <select name="books[book_board]" class="form-control" id="">
            <option value="" required>-class-</option>
                <?php
                $booards = Board::find_by_order();
                foreach($booards as $board){
                 ?>
                 <option value="<?php echo $board->id?>"<?php if($book->book_board == $board->id){ echo "selected"; } ?>><?php echo $board->board_title?></option>
             <?php } ?>
             
         </select>
    </div>
     <div class="col-md-4">
        <label class="form-label">For Class</label>
         <select name="books[book_class]" class="form-control" id="">
            <option value="" required>-class-</option>
                <?php
                $book_c = BookClass::find_by_order();
                foreach($book_c as $cls){
                 ?>
                 <option value="<?php echo $cls->class_id?>"<?php if($book->book_class == $cls->class_id){ echo "selected"; } ?>><?php echo $cls->class_title?></option>
              <?php } ?>
             
         </select>
    </div>
    <div class="col-4">
        <label class="form-label">For Subject</label>
         <select name="books[book_subject]" class="form-control" id="">
            <option value="">-Select-</option>
              <?php
                $book_subject = BookSubject::find_by_order();
                foreach($book_subject as $sub){
                 ?>
                 <option value="<?php echo $sub->subject_id?>"<?php if($book->book_subject == $sub->subject_id){ echo "selected"; } ?>><?php echo $sub->subject_title?></option>
                <?php } ?>
         </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">Worksheet</label>
        <input type="file" class="form-control" name="book_pdf_1">
         <?php echo $book->book_pdf_2 ?>
    </div>
    
     <div class="col-md-4">
        <label class="form-label">Worksheet+Ans.</label>
        <input type="file" class="form-control" name="book_pdf_2">
        <?php echo $book->book_pdf_2 ?>
    </div>
     
     <div class="col-md-4">
        <label class="form-label">Flipbook URL</label>
        <input type="text" class="form-control" name="books[book_flipbook_link]" value="<?php echo $book->book_flipbook_link?>" placeholder=" Enter Flipbook URL">
     </div>
     
      <div class="col-4">
        <label class="form-label">Book Series</label>
         <select name="books[book_series]" class="form-control" id="">
            <option value="" required>-Series-</option>
              <?php
                $book_series = BookSeries::find_by_status();
                foreach($book_series as $s){
                 ?>
                 <option value="<?php echo $s->series_id?>"<?php if($book->book_series == $s->series_id){ echo "selected"; } ?>><?php echo $s->series_title?></option>
                  <?php } ?>
         </select>
    </div>
     
   <div class="col-4">
        <label class="form-label">Set As Reading Club Book</label>
         <select name="books[book_reading_club]" class="form-control" id="">
              <?php if ($book->book_reading_club == 'Y') echo $Y="Active";
                else {
                    echo $Y="Inactive";
                } ?>
            <option value="<?php echo $book->book_reading_club?>"<?php if($book->book_reading_club == $book->book_reading_club){ echo "selected"; } ?>><?php echo $Y?></option>
            <option value="Y">Active</option>
            <option value="N">Inactive</option>
         </select>
    </div>
    
     <div class="col-4">
        <label class="form-label">Set As Betseller</label>
         <select name="books[book_bestseller]" class="form-control" id="">
              <?php if ($book->book_bestseller == 'Y') echo $Y="Active";
                else {
                    echo $Y="Inactive";
                } ?>
            <option value="<?php echo $book->book_bestseller?>"<?php if($book->book_bestseller == $book->book_bestseller){ echo "selected"; } ?>><?php echo $Y?></option>
            <option value="Y">Active</option>
            <option value="N">Inactive</option>
         </select>
    </div>
    
     <div class="col-4">
        <label class="form-label">Book Status</label>
         <select name="books[book_status]" class="form-control" id="">
              <?php if ($book->book_status == 'Y') echo $Y="Active";
                else {
                    echo $Y="Inactive";
                } ?>
            <option value="<?php echo $book->book_status?>"<?php if($book->book_status == $book->book_status){ echo "selected"; } ?>><?php echo $Y?></option>
            <option value="Y">Active</option>
            <option value="N">Inactive</option>
         </select>
    </div>
     
     <div class="col-md-4 mt-5">
        <label class="form-label">E-Book Display</label>
        <input type="checkbox" class="checkboxx" name="books[book_as_ebook]" value="1" <?php if($book->book_as_ebook==1) { echo "checked";}  ?>>
    </div>
     <div class="col-6">
        <label class="form-label"> Request an E-sample Pdf</label>
        <input type="file" class="form-control" name="sample_pdf" placeholder="sample_pdf">
        <?php echo $book->sample_pdf ?>
    </div>
    <div class="col-md-4">
        <label class="form-label">Amazon</label>
        <input type="text" class="form-control" name="books[book_amazon_link]" value="<?php echo $book->book_amazon_link?>" placeholder="Enter Amazon"> 
    </div>
    
     <div class="col-md-4">
        <label class="form-label">Google</label>
        <input type="text" class="form-control" name="books[book_google_link]" value="<?php echo $book->book_google_link?>" placeholder="Enter Google"> 
    </div>
    
     <div class="col-md-4">
        <label class="form-label">Kopykitab</label>
        <input type="text" class="form-control" name="books[book_kopykitab_link]" value="<?php echo $book->book_kopykitab_link?>" placeholder="Enter Kopykitab">
    </div>
    
    <div class="col-md-6">
        <label class="form-label">Book Detail</label>
        <textarea type="text" class="form-control" name="books[book_detail]" placeholder=" Enter Book Detail"><?php echo $book->book_detail?></textarea>
    </div>
    
     <div class="col-md-6">
        <label class="form-label">Book Supporting Material</label>
        <textarea type="text" class="form-control" name="books[book_supporting_material]" placeholder=" Enter "><?php echo $book->book_supporting_material?></textarea>
    </div>
     <div class="col-md-6">
        <label class="form-label">Book Salient Feature</label>
        <textarea type="text" class="form-control" name="books[salient_features]" placeholder="Enter "><?php echo $book->salient_features?></textarea>
    </div>
    
<?php } else { ?>

     <div class="col-4">
        <label class="form-label">For Subject</label>
         <select name="books[book_subject]" class="form-control" id="">
            <option value="" required>-Select-</option>
              <?php
                $book_subject = BookSubject::find_by_order();
                foreach($book_subject as $sub){
                 ?>
                 <option value="<?php echo $sub->subject_id ?>"><?php echo $sub->subject_title ?></option>
                 <?php } ?>
         </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">Board</label>
         <select name="books[book_board]" class="form-control" id="">
            <option value="" required>-Board-</option>
                <?php
                $booards = Board::find_by_order();
                foreach($booards as $board){
                 ?>
                 <option value="<?php echo $board->id ?>"><?php echo $board->board_title ?></option>
             <?php } ?>
             
         </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">For Class</label>
         <select name="books[book_class]" class="form-control" id="">
            <option value="" required>-class-</option>
                <?php
                $book_c = BookClass::find_by_order();
                foreach($book_c as $cls){
                 ?>
                 <option value="<?php echo $cls->class_id ?>"><?php echo $cls->class_title ?></option>
             <?php } ?>
             
         </select>
    </div>
     <div class="col-md-4">
        <label class="form-label">Book Title</label>
        <input type="text" class="form-control" name="books[book_title]" placeholder="Enter Title" required>
    </div>
    <div class="col-4">
        <label class="form-label">Book Series</label>
         <select name="books[book_series]" class="form-control" id="">
            <option value="" required>-Series-</option>
              <?php
                $book_series = BookSeries::find_by_status();
                foreach($book_series as $s){
                 ?>
                 <option value="<?php echo $s->series_id ?>"><?php echo $s->series_title ?></option>
                 <?php } ?>
         </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">Book Image</label>
        <input type="file" class="form-control" name="book_image" required>
    </div>
    <div class="col-md-4 mt-5">
        <label class="form-label">Mark As New Series</label>
        <input type="checkbox" class="checkboxx" name="books[book_as_new]" value="1">
    </div>
     <div class="col-md-4">
        <label class="form-label">Book ISBN</label>
        <input type="text" class="form-control" name="books[book_isbn]" placeholder=" Enter Book ISBN">
    </div>
     <div class="col-md-4">
        <label class="form-label">Book Price</label>
        <input type="text" class="form-control" name="books[book_price]" placeholder=" Enter Book Price">
    </div>
     <div class="col-md-4">
        <label class="form-label">Book Author</label>
        <textarea type="text" class="form-control" name="books[book_author]" placeholder=" Enter Book Author"></textarea>
    </div>
      
      <div class="col-md-4">
        <label class="form-label">Degital Content</label>
        <input type="text" class="form-control" name="books[book_digital_content]" placeholder="Enter Digital Content">
    </div>
     <div class="col-md-4 mt-5">
        <label class="form-label">Show in Resource Center</label>
        <input type="checkbox" class="checkboxx" name="books[book_as_resource]" value="1">
     </div>
    <div class="col-md-4">
        <label class="form-label">Worksheet</label>
        <input type="file" class="form-control" name="book_pdf_1">
    </div>
    
     <div class="col-md-4">
        <label class="form-label">Worksheet+Ans.</label>
        <input type="file" class="form-control" name="book_pdf_2">
    </div>
    
     <div class="col-md-4">
        <label class="form-label">Flipbook URL</label>
        <input type="text" class="form-control" name="books[book_flipbook_link]" placeholder=" Enter Flipbook URL">
     </div>
    
   <div class="col-4">
        <label class="form-label">Set As Reading Club Book</label>
         <select name="books[book_reading_club]" class="form-control" id="">
            <option value="" required>-Status-</option>
            <option value="Y">Active</option>
            <option value="N">Inactive</option>
         </select>
    </div>
    
     <div class="col-4">
        <label class="form-label">Set As Betseller</label>
         <select name="books[book_bestseller]" class="form-control" id="">
            <option value="" required>-Status-</option>
            <option value="Y">Active</option>
            <option value="N">Inactive</option>
         </select>
    </div>
    
     <div class="col-4">
        <label class="form-label">Book Status</label>
         <select name="books[book_status]" class="form-control" id="">
            <option value="" required>-Status-</option>
            <option value="Y">Active</option>
            <option value="N">Inactive</option>
         </select>
    </div>
    
     <div class="col-4">
        <label class="form-label"> Request an E-sample Pdf</label>
        <input type="file" class="form-control" name="sample_pdf">
    </div>
    <div class="col-md-4 mt-5">
        <label class="form-label">New Release</label>
        <input type="checkbox" class="checkboxx" name="books[book_new_release]" value="1">
    </div>
     <div class="col-md-4 mt-5">
        <label class="form-label">E-Book Display</label>
        <input type="checkbox" class="checkboxx" name="books[book_as_ebook]" value="1">
    </div>
     
    <div class="col-md-4">
        <label class="form-label">Amazon</label>
        <input type="text" class="form-control" name="books[book_amazon_link]" placeholder="Enter Amazon"> 
    </div>
     <div class="col-md-4">
        <label class="form-label">Google</label>
        <input type="text" class="form-control" name="books[book_google_link]" placeholder="Enter Google"> 
    </div>
    
     <div class="col-md-4">
        <label class="form-label">Kopykitab</label>
        <input type="text" class="form-control" name="books[book_kopykitab_link]" placeholder="Enter Kopykitab">
    </div>
    
    <div class="col-md-6">
        <label class="form-label">Book Detail</label>
        <textarea type="text" class="form-control" name="books[book_detail]" placeholder=" Enter Book Detail"></textarea>
    </div>
    
     <div class="col-md-6">
        <label class="form-label">Book Supporting Material</label>
        <textarea type="text" class="form-control" name="books[book_supporting_material]" placeholder=" Enter "></textarea>
    </div>
     <div class="col-md-6">
        <label class="form-label">Book Salient Feature</label>
        <textarea type="text" class="form-control" name="books[salient_features]" placeholder="Enter "></textarea>
    </div>

<?php } ?>