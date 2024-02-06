<?php
require_once "../admin/private/initialize.php";
 
$series_id = $_POST['series_id'];

$class_sql = BookSeriesClass::find_by_series_class($series_id);
foreach ($class_sql as $class_data){
    $class_data1 = BookClass::find_by_id($class_data->sc_class_id);
    $check_book = BookMaster::check_for_resources($series_id,$class_data1->class_id);
   
    if($check_book){
        $check_pdf = BookChapterLog::find_by_book_id($check_book->book_id);
        if($check_pdf){
?>
<option value="<?php echo $class_data1->class_id ?>"><?php echo $class_data1->class_title ?></option>
<?php } } } ?>