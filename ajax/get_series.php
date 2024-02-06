<?php
require_once "../admin/private/initialize.php"; ?>
 <option value="">Select Series</option>
<?php    $subject_id = $_POST['subject_id'];
    
         $series_sql = BookSeries::find_by_series_author($subject_id);
           foreach ($series_sql as $s_data){
         ?>
         
         <option value="<?php echo $s_data->series_id?>"><?php echo $s_data->series_title ?></option>
         
   <?php } ?> 

 