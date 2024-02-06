<?php 
require_once "../admin/private/initialize.php";

if(is_post_request())
{
    if($_POST['board'] === 'multiple')
    {
        if($_POST['series_board']=='')
        {
            $board_sql_data = BookSeries::find_by_series_subject($_POST['series_id']);
        }
        else
        {
            $series_board = $_POST['series_board'];
            $series_id = $_POST['series_id'];
            if(count($_POST['series_board']) == 3)
            {
               $board_sql_data = BookSeries::find_by_series_subject($_POST['series_id']); 
            }
            else
            {
               $board_filter = $_POST['series_board'];
               $board_sql_data = BookSeries::find_by_series_subject_board_multiple($_POST['series_id'],$board_filter);
            }
        }
    }
    else
    {
        $series_board = $_POST['series_board'][0];
        $series_id = $_POST['series_id'];
        $board_sql_data = BookSeries::find_by_series_subject_board($_POST['series_id'],$series_board);
    }
?>
    <div class="row">
                                 
        <?php
        foreach($board_sql_data as $data){
        ?> 
    
        <div class="product product__style--3 col-lg-3 col-md-4 col-sm-6 col-12 books-maxwidth">
          <div class="product__style--detail">
            <div class="product__thumb">
                 
                <a class="first__imgs imgsss" href="book-details/<?php echo $data->series_id ?>">
                    
                <?php
                if($data->series_image != ''){
                ?>                
                     <img src="admin/<?php echo $data->picture_path() ?>" alt="product image">
                <?php } else { ?>
                      <img src="img/book_list.png" alt="product image">
                <?php } ?>                  
                  </a>
                        
                 <div class="hot__box_book">
                     <?php if($data->series_as_new == '1'){?>
                       <img src="img/new.svg">
                    <?php } ?>
                </div>
            </div>
            <div class="product__contents">
                <h4><a href="book-details/<?php echo $data->series_id ?>"><?php echo $data->series_title ?></a></h4>
             </div>
          </div>
        </div>
        
      <?php } ?>
     
    </div>
                           
<?php } ?>                         