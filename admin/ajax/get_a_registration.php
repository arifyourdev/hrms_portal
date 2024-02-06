<?php 
require_once "../private/initialize.php";

if(is_post_request())
{
     $sql = "SELECT * FROM books_user_master";
     
        $sql .= 'where user_id ="Y" ORDER BY user_id DESC ';
    
    
    if($_POST['length'] !=-1){
        
        $sql .= ' LIMIT '.$_POST['start'].','.$_POST['length'];
        
    }

   $r_data = BookUserMaster::find_by_sql($sql);
   if(isset($_POST['search']['value']) && $_POST['search']['value'] !== '')
   {
    //    $count_row = BooksRrequest::count_child($_POST['search']['value']);
   }
   else
   {
       $count_row = BookUserMaster::count_all();
   }
   
  $data = array();

  $i = 1;

  foreach ($r_data as $data)
    {
        
        $row = array();
        $row[] = $i;
        $row[] = '<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">';
        $row[] = $data->user_email;
        $row[] = $data->user_type;
        $row[] = $data->user_date;
        $row[] = $data->user_status;
        $row[] = '<button type="button" class="btn btn-sm btn-outline-secondary edit_registration" id="'.$data->user_id.'" data-bs-toggle="modal" data-bs-target="#modal_registration"><i class="fa fa-edit"></i></button>
        <button type="button" id="'.$data->user_id.'" class="btn btn-sm btn-outline-danger user_delete"><i class="fa fa-trash-o"></i></button>';
        $data[] = $row;
        $i++;
    }
    
    $counts = BookUserMaster::count_all();
    
    $output = array('draw' => intval($_POST['draw']),
    'recordsFiltered'=>$count_row,
    'recordsTotal'=>$counts,
    'data'=>$data);
    
    echo json_encode($output);
    
}
?>
