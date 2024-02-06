<?php 
require_once "../admin/private/initialize.php";

    if(isset($_POST["action"]))
{
    if(!isset($_POST['board']) && !isset($_POST['class_book']))
    {
        $ebooks = BookMaster::find_by_book_id($_POST['book_subject']);
        $series_style = 'block';
        $class_book = 'style="display:none;"';
    }
    elseif(isset($_POST['board']) && isset($_POST['class_book']))
    {
        $ebooks = BookMaster::find_by_book_id($_POST['book_class']);
        $series_style = 'none';
        $class_book = 'style="display:block;"';
    }
    elseif(isset($_POST['class_book']))
    {
        $classes =  $_POST['class_book'];
        $ebooks = BookMaster::find_book_by_class($_POST['book_class'],$classes);
        $series_style = 'none';
        $class_book = 'style="display:none;"';
    }
    elseif(isset($_POST['board']))
    {
         $boards =  $_POST['board'];
        $ebooks = BookMaster::find_book_by_board($_POST['book_board'],$boards);
        $series_style = 'none';
        $class_book = 'style="display:none;"';
    }
    
    if($series_style === 'block' && $series_style != 'none')
    {
    ?>
    
        
         
    <div class="tab__container " >
        <div class="shop-grid tab-pane fade show active" id="nav-grid" role="tabpanel">
            <div class="row">
                  <!-- Start -->
                <div class="product product__style--3 col-lg-5 col-md-6 col-sm-6 col-12">
                  <div class="product__style--details">
                    <div class="product__thumb">
                       <img src="admin/<?php echo $ebooks->picture_path(); ?>">
                     </div>
                  </div>
                </div>
                <!-- End -->
                   <!-- Start -->
                <div class="product product__style--3 prostye col-lg-7 col-md-6 col-sm-6 col-12">
                    <h4 class="madhu-bal-text"><?php echo $ebooks->book_title; ?></h4>
                     
                  <div class="product__style--detailss">
                    <div class="product__author_book">
                        <p><?php echo $ebooks->book_author ?></p> 
                    </div>
                       <div class="product__author_des mt-2">
                         <p><?php echo $ebooks->book_detail ?></p>
                     </div>
                        <div class="product__author mt-5">
                           <a href="<?php echo $ebooks->book_amazon_link?>" class="view-buttons"><img src="img/Amazon_Books.png" width="100"></a>
                           <a href="<?php echo $ebooks->book_google_link?>" class="view-buttons"><img src="img/Google_Play_books.png" height="25" width="75"></a>
            <?php
            if(isset($_SESSION['user_id'])){
                 ?>
                 <a data-bs-toggle="modal" data-bs-target="#Review-modal" class="view-buttons">Submit Review</a>
             <?php }else{ ?>
              <a data-bs-toggle="modal" data-bs-target="#Review-modal2" class="view-buttons">Submit Review</a>
          <?php }   ?>               
                          
                        </div>
                 </div>
                </div>
                <!-- End -->
             </div>
         </div>
    </div>
    
<?php }  } ?>
 