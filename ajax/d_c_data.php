<?php
 require_once "../admin/private/initialize.php";
             if(isset($_GET["term"]))
            {
             
             $query = mysqli_query($database,"SELECT * FROM digital_category WHERE category_name LIKE '%".$_GET["term"]."%' ORDER BY category_name ASC");
             
             $total_row = mysqli_num_rows($query); 
             
             if($total_row > 0)
             {
              foreach($query as $row)
              {
               $temp_array = array();
               $temp_array['value'] = $row['category_name'];
               $temp_array['label'] = '<img src="../admin/images/DigitalContent/'.$row['image'].'" width="70" />&nbsp;&nbsp;&nbsp;'.$row['category_name'].'';
               $output[] = $temp_array;
              }
             }
             else
             {
              $output['value'] = '';
              $output['label'] = 'No Record Found';
             }
            
             echo json_encode($output);
            }

?>