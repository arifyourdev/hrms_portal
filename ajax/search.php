<?php
require_once "../admin/private/initialize.php";

if(isset($_POST['sea'])){
     
     $keyword = $_POST['sea'];
    
    $query ="(SELECT series_title as s_name, series_id as series_id FROM books_series WHERE series_title LIKE '%" .  $keyword . "%')";
          
           $result = mysqli_query($database,$query);
            while($data2=$result->fetch_array()){
             
              $response[] = array("label"=>$data2['s_name'],"pro"=>$data2['series_id']);
          }
           
echo json_encode($response);
    
}
?>