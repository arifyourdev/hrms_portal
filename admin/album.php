<?php require_once 'private/initialize.php';
require_login();

$page = "album";

$album = BookAlbum::find_by_all();

if(isset($_POST['submit'])){
 
    $data_id = htmlentities($database->escape_string($_POST['album_c']['data_album_id']));
    $album_c = BookAlbumCross::find_by_data_album($data_id);
    if($_POST['album_c']['data_type'] == "I")
    {
        $targetDir = "images/album_images/";
        $allowTypes = array('jpg', 'png', 'jpeg');
        foreach ($_FILES['data_image']['name'] as $key => $val) 
        {
            $name = pathinfo($_FILES['data_image']['name'][$key], PATHINFO_FILENAME);
            $ext = pathinfo($_FILES['data_image']['name'][$key], PATHINFO_EXTENSION);
            $rand = rand(1111, 9999);
            $fileName = $name.date("YmdHis") . "-" . $rand . "." . $ext;
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    
            if(in_array($fileType, $allowTypes)) 
            {
                if(move_uploaded_file($_FILES["data_image"]["tmp_name"][$key], $targetFilePath)) 
                {
                    $insert_query = "insert into books_album_cross(data_album_id,data_title,data_image,data_url,data_type,data_status) values('$data_id','','$fileName','','I','V')";
                    $conclusion = $database->query($insert_query);
                } 
                else 
                {
                }
            }
        }
        echo 'true';
    } 
    else
    { 
        $args = $_POST['album_c'];
        $new_album = new BookAlbumCross($args);
      $result =  $new_album->save('data_id');
   
    }
   
       $session->message('The Image Was Inserted Successfully.');
            
       redirect_to('album');
   
   } 
?>
<!doctype html>
<html class="no-js " lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <title>Album | Madhubunbooks</title>
    <link rel="icon" href="assets/images/logo.svg" type="image/x-icon"> <!-- Favicon-->

    <!-- plugin css file  -->
    <link rel="stylesheet" href="assets/css/dataTables.min.css">

    <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/luno.style.min.css">
</head>

<body class="layout-1" data-luno="theme-black">
    <style>
        div.show-image {
    position: relative;
    float:left;
    margin:5px;
}
div.show-image:hover img{
    opacity:0.5;
}
div.show-image:hover button {
    display: block;
}
div.show-image button {
    position:absolute;
    display:none;
}
div.show-image button.delete {
    top:0;
    left:79%;
}
    </style>
    <!-- start: sidebar -->
    <?php include "include/side-bar.php" ?>

    <!-- start: body area -->
    <div class="wrapper">

        <!-- start: page header -->
        <?php include "include/top-header.php" ?>

        <!-- start: page toolbar -->
        <div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
            <div class="container-fluid">

                <div class="row align-items-center">
                    <div class="col-auto">
                        <h1 class="fs-5 color-900 mt-1 mb-0">Album List</h1>
                    </div>
                </div> <!-- .row end -->

            </div>
        </div>

        <!-- Body: Body -->
        <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-3">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title m-0">Album List</h6>
                                <div class="dropdown morphing scale-left">
                                    <a href="add_album" data-bs-toggle="tooltip" title="Add Album"><i class="icon-size-fullscreen"></i>Add Album</a>

                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table myDataTable table-hover align-middle mb-0 card-table">
                                    <thead>
                                        <tr>
                                            <th> Sn</th>
                                            <th>Album Title</th>
                                            <th>Album Image</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $s = 1;
                                        foreach ($album as $alb) {
                                        ?>
                                            <tr>
                                                <td><?php echo $s; ?></td>
                                                <td><span><?php echo $alb->album_title ?></span></td>
                                                <td>
                                                     <img src="<?php echo $alb->picture_path();?>" style="width:50px;" alt="">
                                                </td>
                                                <td>
                                                    <?php if ($alb->album_status == 'Y') echo "Active";
                                                    else {
                                                        echo "Inactice";
                                                    } ?></td>
                                                <td>
                                                    <button type="button" onclick="window.location.href= 'edit_album/<?php echo $alb->album_id ?>'" class="btn btn-sm btn-outline-secondary"><i class="fa fa-edit"></i></button>
                                                    <button type="button" id="<?php echo $alb->album_id ?>" data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-sm btn-success album_images"><i class="ace-icon fa fa- fa-camera bigger-120"></i></button>
                                                     <button type="button" id="<?php echo $alb->album_id ?>" class="btn btn-sm btn-outline-danger album_delete"><i class="fa fa-trash-o"></i></button>
                                                </td>
                                            </tr>
                                        <?php $s++;
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> <!-- Row end  -->

            </div>
        </div>

   <!-- The Modal -->
    <div class="modal fade" id="myModal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" id="add_data">

        </div>
      </div>
    </div>

</div>

    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>

    <!-- Plugin Js -->
    <script src="assets/bundles/dataTables.bundle.js"></script>

    <!-- Jquery Page Js -->
    <script>
        // project data table
        $('.myDataTable')
            .addClass('nowrap')
            .dataTable({
                responsive: true,
                columnDefs: [{
                    targets: [-1, ],
                    className: 'dt-body-right'
                }]
            });

        $(document).on('click','.album_delete',function() {

            var x = confirm('Are You Sure Want to Delete this?');
            if (x == true) {

                var id = $(this).attr('id');
                $.ajax({

                    type: "POST",
                    url: "ajax/album_delete",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        window.location.reload();
                    }
                });
            }
        });
    </script>
         <script>
               $(document).on('click','.album_images',function(){
                   var id = $(this).attr('id');
                $.ajax({
                    type: "post",
                    url: "ajax/album_detail",
                    data: {
                       id:id
                    },
                    success: function(data) {
                        $("#add_data").html(data);
                        $("#myModal").modal('show');
                          }
                });
            });
         </script>
         <script>
             $(document).on('click','.delete_album_img',function() {

            var x = confirm('Are You Sure Want to Delete this?');
            if (x == true) {

                var id = $(this).attr('id');
                $.ajax({

                    type: "POST",
                    url: "ajax/album_detail_delete",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        window.location.reload();
                    }
                });
            }
        });
         </script>
</body>

</html>