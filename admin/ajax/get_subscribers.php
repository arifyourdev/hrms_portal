<?php 
require_once "../private/initialize.php";

if(is_post_request())
{
     

   if(isset($_POST['search']['value']) && $_POST['search']['value'] !== '')
   {
        $search_value = $_POST['search']['value'];

        $sql = "SELECT * FROM books_subscribe";
        $sql .= " WHERE nl_email LIKE '%$search_value%'";
        $sql .= ' ORDER BY nl_id DESC ';

        if($_POST['length'] !=-1){

        $sql .= ' LIMIT '.$_POST['start'].','.$_POST['length'];

        }

        $subscribers = BookSubscription::find_by_sql($sql);
   }
   else
   {

        $sql = "SELECT * FROM books_subscribe";
     
        $sql .= ' ORDER BY nl_id DESC ';


        if($_POST['length'] !=-1){

        $sql .= ' LIMIT '.$_POST['start'].','.$_POST['length'];

        }

        $subscribers = BookSubscription::find_by_sql($sql);
   }

   
   if(isset($_POST['search']['value']) && $_POST['search']['value'] !== '')
   {
      $count_row = BookSubscription::count_all();
   }
   else
   {
       $count_row = BookSubscription::count_all();
   }
   
  $data = array();

  $i = 1;

    foreach($subscribers as $r_data)
    {                
        $row = array();
        $row[] = $i;
        $row[] = $r_data->nl_email;
        $row[] =  time_ago($r_data->nl_date);
        $row[] = '<button type="button" id="'.$r_data->nl_id.'" class="btn btn-sm btn-outline-danger pwu_delete"><i class="fa fa-trash"></i></button>';
        $data[] = $row;
        $i++;
    }
    
    $counts = BookSubscription::count_all();
    
    $output = array('draw' => intval($_POST['draw']),
    'recordsFiltered'=>$count_row,
    'recordsTotal'=>$counts,
    'data'=>$data);
    
    echo json_encode($output);
    
}
