<?php 
require_once "../private/initialize.php";

if(is_post_request())
{

if(isset($_POST['search']['value']) && $_POST['search']['value'] !== '')
   {
     $search_value = $_POST['search']['value'];
 
     $sql ="SELECT * FROM `books_r_request` WHERE (`request_user_id` IN (SELECT `user_id` FROM `books_user_master` WHERE `user_email` LIKE '%$search_value%')) OR (`request_book_id` IN (SELECT `book_id` FROM `books_master` WHERE `book_title` LIKE '%$search_value%'))";

    //  $sql .= " WHERE user_email LIKE '%$search_value%'";
     
     $sql .= ' ORDER BY request_id DESC ';
    
     if($_POST['length'] !=-1){
        
     $sql .= ' LIMIT '.$_POST['start'].','.$_POST['length'];
        
    }

    $book_request = BooksRrequest::find_by_sql($sql);

}
else
{
    // request_id,request_user_id,request_book_id,request_date,request_status 'request_status'
     $sql = "SELECT * FROM books_r_request where request_status ='N'";
 
     $sql .= 'ORDER BY request_date desc';
   
    if($_POST['length'] !=-1){
       
    $sql .= ' LIMIT '.$_POST['start'].','.$_POST['length'];
       
   }

   $book_request = BooksRrequest::find_by_sql($sql);

}
   
   
   if(isset($_POST['search']['value']) && $_POST['search']['value'] !== '')
   {
        $search_value = $_POST['search']['value'];

        $count_row = mysqli_query($database,"SELECT COUNT(request_id) FROM `books_r_request` WHERE (`request_user_id` IN (SELECT `user_id` FROM `books_user_master` WHERE `user_email` LIKE '%$search_value%')) OR (`request_book_id` IN (SELECT `book_id` FROM `books_master` WHERE `book_title` LIKE '%$search_value%')))");
   }
   else
   {
        $count_row = BooksRrequest::count_all();
   }
   
  $data = array();

  $i = 1;

    foreach($book_request as $r_data)
    {
        $user_data = BookUserMaster::find_by_user_id($r_data->request_user_id);                                          
        $book_data = BookMaster::find_by_book_id($r_data->request_book_id);
        
        if($r_data->request_status == 'Y'){
            $status = "<div class='text-success' style='font-weight 700px;'>Approved</div>";
        }elseif($r_data->request_status == 'N'){
            $status = "Not Approved";
        }
        
        $row = array();
        $row[] = $i;
        $row[] = '<input type="checkbox" name="request_id[]" value="'.$r_data->request_id.'">';
        $row[] = $r_data->request_date;
        $row[] =  '<ul style="list-style:none;">
        <li><b>For Book :</b>'.wordwrap($book_data->book_title,'20','<br>').'</li>
         <li><b>Author :</b>'.wordwrap($book_data->book_author,20,'<br>').'</li>
      </ul>';
        $row[] ='<div class="d-flex">
                    <ul style="list-style:none;">
                        <li><b>By :</b>'.$user_data->user_firstname.' '.$user_data->user_lastname.'</li>
                        <li><b>Email :</b>'.$user_data->user_email.'</li>
                    </ul>
                </div>';
        $row[] = $status;
        $row[] = '<button type="button" id="'.$r_data->request_id.'" class="btn btn-sm btn-outline-success request_status"><i class="fa fa-check"></i></button>';
        $data[] = $row;
        $i++;
    }
    
    $counts = BooksRrequest::count_all();
    
    $output = array('draw' => intval($_POST['draw']),
    'recordsFiltered'=>$count_row,
    'recordsTotal'=>$counts,
    'data'=>$data);
    
    echo json_encode($output);
    
}
