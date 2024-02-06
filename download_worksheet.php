<?php
require_once "admin/private/initialize.php";
user_login();


if(is_post_request()){
    
    foreach($_POST['selected_check'] as $checked)
    {
        
        $files = BookChapterLog::find_by_custom_id('clog_id',$checked);
        
            header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=" . urlencode($files->picture_worksheet()));
header("Content-Type: application/download");
header("Content-Description: File Transfer");
header("Content-Length: " . filesize('admin/'.$files->picture_worksheet()));
flush(); // Not a must.
$fp = fopen('admin/'.$files->picture_worksheet(), "r");
while (!feof($fp)) {
echo fread($fp, 65536);
flush(); // This is essential for large downloads
}

    }
  fclose($fp);  
    exit();
    

    
            if (file_exists("D:/wwwroot/Workspace/George/Goliath/modules/test/file.txt")) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename("D:/wwwroot/Workspace/George/Goliath/modules/test/file.txt") . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize("D:/wwwroot/Workspace/George/Goliath/modules/test/file.txt"));
            readfile("D:/wwwroot/Workspace/George/Goliath/modules/test/file.txt");
            sleep(2);
            unlink("D:/wwwroot/Workspace/George/Goliath/modules/test/file.txt");
            exit;
        }
}