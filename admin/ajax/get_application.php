<?php 
require_once "../private/initialize.php";

if(is_post_request())
{
     $sql = "SELECT * FROM books_application";
     
        $sql .= ' ORDER BY applicant_id DESC ';
    
    
    if($_POST['length'] !=-1){
        
        $sql .= ' LIMIT '.$_POST['start'].','.$_POST['length'];
        
    }

   $appl_data = BookApplication::find_by_sql($sql);
   if(isset($_POST['search']['value']) && $_POST['search']['value'] !== '')
   {
    //    $count_row = BooksRrequest::count_child($_POST['search']['value']);
   }
   else
   {
       $count_row = BookApplication::count_all();
   }
   
  $data = array();

  $i = 1;

     foreach ($appl_data as $app) {
    {
 
        $row = array();
        $row[] = $i;
         $row[] = '<div class="d-flex">
            <ul style="list-style:none;">
                <li><b>Receive Date :</b>'.$app->applicant_date_time.'</li>
                <li><b>Exp :</b> '.$app->applicant_exp.'</li>
                <li><b>Name :</b> '.$app->applicant_name.'</li>
                <li><b>Email :</b> '.$app->applicant_email.'</li>
                <li><b>mobile :</b> '.$app->applicant_mobile.'</li>
                <li><b>Description :</b> '.wordwrap($app->applicant_detail,50,"<br />\n").'</li>
                <li><b>To Download Resume :</b><a href="'.$app->applicant_file.'" download class="down-links">Click here<i class="fa-solid fa-download"></i></a></li>
            </ul>
     </div>';
        $row[] = '<div class="d-flex">
        <ul style="list-style:none;">
            <li><b>Type  :</b>  '.$app->applicant_type.'</li>
            <li><b>Department  : </b> '.$app->applicant_department.'</li>
            <li><b>Qualification  : </b> '.$app->applicant_qualification.'</li>
            <li><b>Specification  : </b> '.$app->applicant_specialization.'</li>
        </ul>
        </div>';
        
         $row[] = '<button type="button" id="'.$app->applicant_id.'" class="btn btn-sm btn-outline-danger applicant_delete"><i class="fa fa-trash-o"></i></button>';
        $data[] = $row;
        $i++;
    }
}
    $counts = BookApplication::count_all();
    
    $output = array('draw' => intval($_POST['draw']),
    'recordsFiltered'=>$count_row,
    'recordsTotal'=>$counts,
    'data'=>$data);
    
    echo json_encode($output);
    
}
?>
