<?php 
require_once "../private/initialize.php";

if(is_post_request()){

if(isset($_POST['search']['value']) && $_POST['search']['value'] !== '')
 {
     $search_value = $_POST['search']['value'];
     $sql = "SELECT * FROM books_master";
     $sql .= " WHERE book_title LIKE '%$search_value%'";
     $sql .= ' ORDER BY book_id ASC ';
     
    if($_POST['length'] !=-1){
        
        $sql .= ' LIMIT '.$_POST['start'].','.$_POST['length'];
     }

      $books = BookMaster::find_by_sql($sql);
    }
    else
    {
        $sql = "SELECT * FROM books_master";
         
        $sql .= ' ORDER BY book_id ASC ';
        
       if($_POST['length'] !=-1){
           
           $sql .= ' LIMIT '.$_POST['start'].','.$_POST['length'];
        }
   
         $books = BookMaster::find_by_sql($sql);
    }

   if(isset($_POST['search']['value']) && $_POST['search']['value'] !== '')
   {
    //    $count_row = BooksRrequest::count_child($_POST['search']['value']);
   }
   else
   {
       $count_row = BookMaster::count_all();
   }
   
  $data = array();

  $i = 1;
 
   foreach ($books as $book) {
    
    if ($book->book_status == 'Y') 
    $status= "Active";
   else {
     $status=  "Inactive";
   }
         
        $row = array();
        $row[] = $i;
        $row[] = wordwrap($book->book_title,20,'<br>');
        $row[] = $book->subject_name($book->book_subject);
        $row[] = $book->series_name($book->book_series);
        $row[] = $status;
        $row[] = '<a type="button" href="edit_book/'.$book->book_id.'" class="btn btn-sm btn-outline-secondary"><i class="fa fa-edit"></i></a>
        <button type="button" id="'.$book->book_id.'" data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-sm btn-success chapter_detail"><i class="fa fa-upload" aria-hidden="true"></i></button>
        <button type="button" id="'.$book->book_id.'" class="btn btn-sm btn-outline-danger book_delete"><i class="fa fa-trash-o"></i></button>';
        $data[] = $row;
        $i++;
    }
    
    $counts = BookMaster::count_all();
    
    $output = array('draw' => intval($_POST['draw']),
    'recordsFiltered'=>$count_row,
    'recordsTotal'=>$counts,
    'data'=>$data);
    
    echo json_encode($output);
    
}
?>
