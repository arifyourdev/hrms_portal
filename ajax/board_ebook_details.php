<?php 
require_once "../admin/private/initialize.php";

if(is_post_request())
{
    if($_POST['board'] === 'multiple')
    {
        if($_POST['book_board']=='')
        {
            $board_sql_data = BookMaster::find_by_ebook_subject($_POST['book_id']); 
        }
        else
        {
            $book_board = $_POST['book_board'];
            $book_id = $_POST['book_id'];
            if(count($_POST['book_board']) == 3)
            {
               $board_sql_data = BookMaster::find_by_ebook_subject($_POST['book_id']); 
            }
            else
            {
                $board_filter = implode(",", $_POST["book_board"]);
               $board_sql_data = BookMaster::find_by_ebook_subject_board($_POST['book_id'],$board_filter);
            }
        }
    }
    else
    {
        $book_board = $_POST['book_board'][0];
        $book_id = $_POST['book_id'];
        $board_sql_data = BookMaster::find_by_ebook_subject_board($_POST['book_id'],$book_board);
    }
?>

<div class="row">
    <?php 
    foreach($board_sql_data as $ebooks_list){?>
    
    <div class="product product__style--3 col-lg-3 col-md-4 col-sm-6 col-12 books-maxwidth">
      <div class="product__style--detail">
        <div class="product__thumb">
            <?php ?>
            <a class="first__imgs" href="ebook-details/<?php echo $ebooks_list->book_id?>">
                <img src="admin/<?php echo $ebooks_list->picture_path()?>" alt="product image"></a>
            <div class="hot__box_book">
                <?php if($ebooks_list->book_as_new =='1'){?>
                <img src="img/new.svg">
                <?php } ?>
            </div>
        </div>
        <div class="product__contents">
            <h4><a href="ebook-details/<?php echo $ebooks_list->book_id?>"><?php echo $ebooks_list->book_title?></a></h4>
         </div>
      </div>
    </div>
    <?php } ?> 
</div>
                          
<?php }?>