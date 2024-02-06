<?php 
require_once "../private/initialize.php";

if(is_post_request())
{
     $sql = "SELECT * FROM books_pwu";
     
        $sql .= ' ORDER BY pwu_id DESC ';
    
    
    if($_POST['length'] !=-1){
        
        $sql .= ' LIMIT '.$_POST['start'].','.$_POST['length'];
        
    }

   $pwu_data = BookPwu::find_by_sql($sql);

   if(isset($_POST['search']['value']) && $_POST['search']['value'] !== '')
   {
    //    $count_row = BooksRrequest::count_child($_POST['search']['value']);
   }
   else
   {
       $count_row = BookPwu::count_all();
   }
   
  $data = array();

  $i = 1;

    foreach($pwu_data as $app)
    {
                   
        $row = array();
        $row[] = $i;
        $row[] = '<div class="d-flex">
                <ul style="list-style:none;">
                    <li><b>Receive Date :</b>'.$app->pwu_date_time.'</li>
                    <li><b>Name :</b> '.$app->pwu_name.'</li>
                    <li><b>Email :</b> '.$app->pwu_email.'</li>
                    <li><b>Mobile :</b> '.$app->pwu_mobile.'</li>
                    <li><b>Address :</b>  '.wordwrap($app->pwu_address,20,"<br>").'</li>
                    <li><b>City :</b><span>'.$app->pwu_city.'</span></li>
                    <li><b>To Download Synopsis :</b><a href="" class="down-links">Click here<i class="fa-solid fa-download"></i></a></li>
                </ul>
               </div>';
        $row[] = wordwrap($app->pwu_synopsis_text,40,"<br>");
        $row[] = '<button type="button" id="'.$app->pwu_id.'" class="btn btn-sm btn-outline-danger pwu_delete"><i class="fa fa-trash-o"></i></button>';
        $data[] = $row;
        $i++;
    }
    
    $counts = BookPwu::count_all();
    
    $output = array('draw' => intval($_POST['draw']),
    'recordsFiltered'=>$count_row,
    'recordsTotal'=>$counts,
    'data'=>$data);
    
    echo json_encode($output);
    
}
?>
