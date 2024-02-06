<?php 
require_once "../private/initialize.php";

if(is_post_request()){
    if(isset($_POST['search']['value']) && $_POST['search']['value'] !== ''){
        $search_value = $_POST['search']['value'];
        $sql = "SELECT * FROM epd_request";
        $sql .= " WHERE name LIKE '%$search_value%'";
        $sql .= ' ORDER BY id DESC ';
        if($_POST['length'] !=-1){
        $sql .= ' LIMIT '.$_POST['start'].','.$_POST['length'];
        }
        $epd_sql = Epd::find_by_sql($sql);

    }else{

        $sql = "SELECT * FROM epd_request";
        $sql .= ' ORDER BY id DESC ';
        if($_POST['length'] !=-1){
        $sql .= ' LIMIT '.$_POST['start'].','.$_POST['length'];
        }
        $epd_sql = Epd::find_by_sql($sql);
    }
  

   if(isset($_POST['search']['value']) && $_POST['search']['value'] !== '')
   {
    
   }
   else
   {
       $count_row = Epd::count_all();
   }
   
  $data = array();

  $i = 1;

  foreach ($epd_sql as $epd_data) {
    
         
                  
        $row = array();
        $row[] = $i;
        $row[] = $epd_data->name;
        $row[] = $epd_data->contact;
        $row[] = $epd_data->school;
        $row[] = $epd_data->state;
        $row[] = $epd_data->date;
        $row[] = '<button type="button" id="'.$epd_data->id.'" class="btn btn-sm btn-outline-danger epd_delete"><i class="fa fa-trash-o"></i></button>';
        $data[] = $row;
        $i++;
    }
    
    $counts = Epd::count_all();
    
    $output = array('draw' => intval($_POST['draw']),
    'recordsFiltered'=>$count_row,
    'recordsTotal'=>$counts,
    'data'=>$data);
    
    echo json_encode($output);
    
}
?>
