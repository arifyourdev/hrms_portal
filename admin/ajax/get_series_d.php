<?php 
require_once "../private/initialize.php";

if(is_post_request())
{
    if(isset($_POST['search']['value']) && $_POST['search']['value'] !== '')
    {
      $search_value = $_POST['search']['value'];
      $sql = "SELECT * FROM books_series";
      $sql .= " WHERE series_title LIKE '%$search_value%'";
      $sql .= ' ORDER BY series_id DESC ';

      if($_POST['length'] !=-1){
        
      $sql .= ' LIMIT '.$_POST['start'].','.$_POST['length'];
        
      }
      $series = BookSeries::find_by_sql($sql);

    }else{

        $sql = "SELECT * FROM books_series";
        $sql .= ' ORDER BY series_id DESC ';
        if($_POST['length'] !=-1){
          
        $sql .= ' LIMIT '.$_POST['start'].','.$_POST['length'];
          
        }
        $series = BookSeries::find_by_sql($sql);  
    }

   if(isset($_POST['search']['value']) && $_POST['search']['value'] !== '')
   {
    //    $count_row = BooksRrequest::count_child($_POST['search']['value']);
   }
   else
   {
       $count_row = BookSeries::count_all();
   }
   
  $data = array();

  $i = 1;

    foreach($series as $ser)
    {      
      if ($ser->series_status == 'Y')
           $status = "Active";
        else {
            $status = "Inactive";
        }          
        $row = array();
        $row[] = $i;
        $row[] = substr($ser->series_title,0,35);
        $row[] = $ser->subject_name($ser->series_subject);
        $row[] = $status;
        $row[] = $ser->series_sort_order;
        $row[] = '<a type="button" href="edit_series/'.$ser->series_id.'" class="btn btn-btn-outline-secondary"><i class="fa fa-edit"></i></a>
        <button type="button" id="'.$ser->series_id.'" class="btn btn-sm btn-outline-danger series_delete"><i class="fa fa-trash-o"></i></button>';
        $data[] = $row;
        $i++;
    }
    
    $counts = BookSeries::count_all();
    
    $output = array('draw' => intval($_POST['draw']),
    'recordsFiltered'=>$count_row,
    'recordsTotal'=>$counts,
    'data'=>$data);
    
    echo json_encode($output);
    
}
?>
