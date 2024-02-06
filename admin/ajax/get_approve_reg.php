<?php 
require_once "../private/initialize.php";

if(is_post_request()){
    if(isset($_POST['search']['value']) && $_POST['search']['value'] !== ''){
        $search_value = $_POST['search']['value'];
        $sql = "SELECT * FROM books_user_master";
        $sql .= " WHERE user_email LIKE '%$search_value%'";
        $sql .= ' ORDER BY user_id DESC ';
        if($_POST['length'] !=-1){
        $sql .= ' LIMIT '.$_POST['start'].','.$_POST['length'];
        }
        $epd_sql = BookUserMaster::find_by_sql($sql);

    }else{

        $sql = "SELECT * FROM books_user_master";
        $sql .= ' ORDER BY user_id DESC ';
        if($_POST['length'] !=-1){
        $sql .= ' LIMIT '.$_POST['start'].','.$_POST['length'];
        }
        $epd_sql = BookUserMaster::find_by_sql($sql);
    }
  

   if(isset($_POST['search']['value']) && $_POST['search']['value'] !== '')
   {
    
   }
   else
   {
       $count_row = BookUserMaster::count_all();
   }
   
  $data = array();

  $i = 1;

  foreach ($epd_sql as $epd_data) {

     if ($epd_data->user_type == '1')

        $Y="Teacher";

        else {
            $Y="Student,Parents,Others";
        } 

        if($epd_data->user_status =='Y'){
            $status = "Approved";
         }else{
            $status = "Not Approved";
        }

                   
        $row = array();
        $row[] = $i;
    //     $row[] = '<div class="form-check">
    //     <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
    // </div>';
        $row[] = $epd_data->user_email;
        $row[] = $Y;
        $row[] = $epd_data->user_date;
        $row[] = $status;
         $row[] = '<button type="button" class="btn btn-sm btn-outline-secondary edit_registration" id="'.$epd_data->user_id.'" data-bs-toggle="modal" data-bs-target="#modal_registration"><i class="fa fa-edit"></i></button><button type="button" id="'.$epd_data->user_id.'" class="btn btn-sm btn-outline-danger user_delete"><i class="fa fa-trash-o"></i></button>';
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
