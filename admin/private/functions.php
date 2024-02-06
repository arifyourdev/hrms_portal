<?php

function url_for($script_path)
{
  // add the leading '/' if not present
  if ($script_path[0] != '/') {
    $script_path = $script_path;
  }
  return WWW_ROOT . $script_path;
}

function u($string = "")
{
  return urlencode($string);
}

function raw_u($string = "")
{
  return rawurlencode($string);
}

function h($string = "")
{
  return stripslashes(htmlspecialchars($string));
}

function error_404()
{
  header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
  exit();
}

function error_500()
{
  header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
  exit();
}

function redirect_to($location)
{
  header("Location: " . $location);
  exit;
}

function is_post_request()
{
  return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function is_get_request()
{
  return $_SERVER['REQUEST_METHOD'] == 'GET';
}

function dateformat($value)
{

  $date = date('j M, Y', strtotime($value));
  return $date;
}

function dateonly($value)
{

  $date = date('j', strtotime($value));
  return $date;
}

function monthonly($value)
{

  $date = date('M', strtotime($value));
  return $date;
}

function year_only_timestamp($value)
{

  $date = date('Y', $value);
  return $date;
}

function isSelected($dbvalue, $field)
{
  if ($dbvalue == $field) {
    echo 'selected';
  }
}

function get_row($database, $query)
{
  $sql = $database->query($query);
  $x = array();
  while ($row = mysqli_fetch_assoc($sql)) {
    $x[] = $row;
  }
  return $x;
}

function getSubcategory($database, $id)
{
  $row = get_row($database, "select subcategory_name from sub_category where subcategory_name='$id'");
  return @$row[0]['subcategory_name'];
}

function time_ago($datetime)
{

  $time_ago = strtotime($datetime);

  $current_time = time();

  $time_difference = $current_time - $time_ago;

  $seconds = $time_difference;
  $minutes = round($seconds / 60); // value 60 is seconds
  $hours = round($seconds / 3600); // value 3600 is 60 minutes * 60 seconds
  $days = round($seconds / 86400); // value 8600 = 24 * 60 *60 

  $weeks = round($seconds / 604800); // 7*24*60*60
  $months = round($seconds / 2629440); //((365+365+365+365+366)/5/12)*24*60*60
  $years = round($seconds / 31553280);  // (365+365+365+365+366)/5 * 24* 60* 60


  if ($seconds <= 60) {
    return "Just Now";
  } elseif ($minutes <= 60) {

    if ($minutes == 1) {
      return "1 minute ago";
    } else {
      return "$minutes minutes ago";
    }
  } elseif ($hours <= 24) {
    if ($hours == 1) {
      return "an hour ago";
    } else {
      return "$hours hrs ago";
    }
  } elseif ($days <= 7) {
    if ($days == 1) {
      return "yesterday";
    } else {
      return "$days days ago";
    }
  } elseif ($weeks <= 4.3) // 4.3 == 52/12
  {
    if ($weeks == 1) {
      return "a week ago";
    } else {
      return "$weeks weeks ago";
    }
  } elseif ($months <= 12) {
    if ($months == 1) {
      return "a month ago";
    } else {
      return "$months months ago";
    }
  } else {
    if ($years == 1) {
      return "one year ago";
    } else {
      return "$years years ago";
    }
  }
}

/* creates a compressed zip file */
function create_zip($files = array(),$destination = '',$overwrite = false) {
    //if the zip file already exists and overwrite is false, return false
    if(file_exists($destination) && !$overwrite) { return false; }
    //vars
    $valid_files = array();
    //if files were passed in...
    if(is_array($files)) {
        //cycle through each file
        foreach($files as $file) {
            //make sure the file exists
            if(file_exists($file)) {
                $valid_files[] = $file;
            }
        }
    }
    //if we have good files...
    if(count($valid_files)) {
        //create the archive
        $zip = new ZipArchive();
        if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
            return false;
        }
        //add the files
        foreach($valid_files as $file) {
            $zip->addFile($file,$file);
        }
        //debug
        //echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;

        //close the zip -- done!
        $zip->close();

        //check to make sure the file exists
        return file_exists($destination);
    }
    else
    {
        return false;
    }
}

function get_time($time)
{

  $main_time = date('h:i a', strtotime($time));

  return $main_time;
}


function hash_add($id)
{
  return substr_replace($id, rand(0, 9) . '-' . rand(0, 9), 14, 0);
}

function hash_remove($id)
{
  return substr_replace($id, '', 14, 3);
}

function generateRandomString($length)
{
  $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return "SYS-" . $randomString;
}


function compress_image($source, $destination, $quality)
{
  // Get image info 
  $imgInfo = @getimagesize($source);
  $mime = $imgInfo['mime'];

  // Create a new image from file 
  switch ($mime) {
    case 'image/jpeg':
      $image = imagecreatefromjpeg($source);
      break;
      case 'image/jpg':
        $image = imagecreatefromjpeg($source);
        break;
    case 'image/png':
      $image = imagecreatefrompng($source);
      break;
    case 'image/gif':
      $image = imagecreatefromgif($source);
      break;
    default:
      $image = imagecreatefromjpeg($source);
  }

  // Save image 
  imagejpeg($image, $destination, $quality);

  // Return compressed image 
  return $destination;
}

function encrypt_data($string)
{

  $cipher = "aes-128-gcm";
  $key = "b0194a53bc749115d8347cdda1fff5a975ea2c8e15a65279a2996d4578eedb54a9e0ac4594c4eb0b37a7639ef806a6c8b43691b43d6d3f255b12c57e6fb44130";
  $iv_len = openssl_cipher_iv_length($cipher);
  $tag_length = 16;
  $iv = openssl_random_pseudo_bytes($iv_len);
  $tag = "";

  $output = openssl_encrypt($string, $cipher, $key, OPENSSL_RAW_DATA, $iv, $tag, "", $tag_length);
  $output = base64_encode($iv . $tag . $output);

  return $output;
}


function decrypt_data($string)
{

  $encrypted_string = base64_decode($string);
  $key = "b0194a53bc749115d8347cdda1fff5a975ea2c8e15a65279a2996d4578eedb54a9e0ac4594c4eb0b37a7639ef806a6c8b43691b43d6d3f255b12c57e6fb44130";
  $cipher = "aes-128-gcm";
  $iv_len = openssl_cipher_iv_length($cipher);
  $tag_length = 16;
  $iv = substr($encrypted_string, 0, $iv_len);
  $tag = substr($encrypted_string, $iv_len, $tag_length);
  $encrypt_text = substr($encrypted_string, $iv_len + $tag_length);

  $output = openssl_decrypt($encrypt_text, $cipher, $key, OPENSSL_RAW_DATA, $iv, $tag);

  return $output;
}