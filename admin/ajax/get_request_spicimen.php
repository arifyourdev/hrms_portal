<?php 
require_once "../private/initialize.php";

if(is_post_request())
{
    if(isset($_POST['search']['value']) && $_POST['search']['value'] !== ''){
        $search_value = $_POST['search']['value'];
        $sql = "SELECT * FROM speciman_copy_request";
        $sql .= " WHERE request_name LIKE '%$search_value%' OR request_email LIKE '%$search_value%'";
        $sql .= ' ORDER BY request_id DESC ';
    
       if($_POST['length'] !=-1){
       
       $sql .= ' LIMIT '.$_POST['start'].','.$_POST['length'];
       
   }
  
     $specimen_sql = Specimancopyrequest::find_by_sql($sql);

    }else{

      $sql = "SELECT * FROM speciman_copy_request";
      $sql .= ' ORDER BY request_id DESC ';
  
 if($_POST['length'] !=-1){
     
     $sql .= ' LIMIT '.$_POST['start'].','.$_POST['length'];
     
 }

   $specimen_sql = Specimancopyrequest::find_by_sql($sql);
 }
    
   if(isset($_POST['search']['value']) && $_POST['search']['value'] !== '')
   {
         $search_value = $_POST['search']['value'];
         $count_row = mysqli_query($database,"SELECT COUNT(request_id) FROM speciman_copy_request WHERE request_name LIKE '%$search_value%' OR request_email LIKE '%$search_value%'");
         
   }
   else
   {
       $count_row = Specimancopyrequest::count_all();
   }
   
  $data = array();

  $i = 1;

  foreach ($specimen_sql as $specimen_data) {
    {
        $s_data = BookSeries::find_by_series_id($specimen_data->request_for_id);   
                  
        $row = array();
        $row[] = $i;
        $row[] ='<div class="d-flex">
        <ul style="list-style:none;">
            <li><b>For Book: </b>'.wordwrap($s_data->series_title,20,"<br>").'</li>
            <li><b>Author :</b>'.wordwrap($s_data->series_author,20,"<br>").'</li>
        </ul>
       </div>';
        $row[] ='<div class="d-flex">
        <ul style="list-style:none;">
            <li><b>By :</b>'.$specimen_data->request_name.'</li>
            <li><b>Email :</b>'.$specimen_data->request_email.'</li>
            <li><b>Mobile :</b>'.$specimen_data->request_mobile.'</li>
            <li><b>Message :</b>'.wordwrap($specimen_data->request_msg ,30,"<br>").'</li>
        </ul>
        </div>';
        $row[] = $specimen_data->request_date_time;
        $row[] = '<button type="button" id="'.$specimen_data->request_id.'" class="btn btn-sm btn-outline-danger delete_specimen"><i class="fa fa-trash"></i></button>';
        $data[] = $row;
        $i++;
    }
}
    $counts = Specimancopyrequest::count_all();
    
    $output = array('draw' => intval($_POST['draw']),
    'recordsFiltered'=>$count_row,
    'recordsTotal'=>$counts,
    'data'=>$data);
    
    echo json_encode($output);
    
}

?>
