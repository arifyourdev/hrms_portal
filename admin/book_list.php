<?php require_once 'private/initialize.php';
$page = "book_list";

$books = BookMaster::find_by_order();

 if (is_post_request()) {
     
    $name = htmlentities($database->escape_string($_POST['chapter']['clog_chapter_id']));
    $args = $_POST['chapter'];
    $chapter = new BookChapterLog ($args);

    if(is_uploaded_file($_FILES['clog_worksheet']['tmp_name'])){
        $chapter->set_worksheet($_FILES['clog_worksheet']);
        $chapter->clog_chapter_id = $name;
        $result = $chapter->save_worksheet('clog_id');
       }
      
    
    if(is_uploaded_file($_FILES['clog_worksheet_ans']['tmp_name'])){
        $chapter->set_ansheet($_FILES['clog_worksheet_ans']);
        $chapter->clog_chapter_id = $name;
        $result = $chapter->save_ansheet('clog_id');
     }

 
 if(is_uploaded_file($_FILES['clog_stepwise']['tmp_name'])){
    $chapter->set_stepwise($_FILES['clog_stepwise']);
    $chapter->clog_chapter_id = $name;
    $result = $chapter->save_stepwise('clog_id');
 }
 else{
    $chapter->clog_chapter_id = $name;
    $result = $chapter->save('clog_id');
 }

    
    if($result === true) {
            
 	$session->message('The chapter created successfully.');
	// echo  '<script>window.location.href = "./project.php";</script>' ;
	redirect_to('book_list');
 }
 else {
	// show errors 
	$session->message(join("<br>", $chapter->errors));

  }
     
} else {
    // display the form
    $chapter = new BookChapterLog;
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
    <title>Books Master | Madhubunbooks</title>
    <link rel="icon" href="assets/images/logo.svg" type="image/x-icon"> <!-- Favicon-->

    <!-- plugin css file  -->
    <link rel="stylesheet" href="assets/css/dataTables.min.css">

    <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/luno.style.min.css">
</head>

<body class="layout-1" data-luno="theme-black">

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
                        <h1 class="fs-5 color-900 mt-1 mb-0">Manage Book</h1>
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
                                <h6 class="card-title m-0">Manage Book</h6>
                                <div class="dropdown morphing scale-left">
                                    <a href="add_book" data-bs-toggle="tooltip" title="Add Book"><i class="icon-size-fullscreen"></i>Add book</a>

                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table myDataTable table-hover align-middle mb-0 card-table">
                                    <thead>
                                        <tr>
                                            <th>Sn</th>
                                            <th>Title</th>
                                            <th>Subject</th>
                                            <th>Series</th>
                                            <th>Status</th>
                                            <th style="width:20%;text-align:center;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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

    </div>

    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>

    <!-- Plugin Js -->
    <script src="assets/bundles/dataTables.bundle.js"></script>

    <!-- Jquery Page Js -->
    <script>
        // project data table
        $('.myDataTable').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "ordering": false,
        
   "lengthMenu": [10, 25, 50, 75, 100],
        "order": [],
                 "language": {
            "infoFiltered": '' 
        },
            "ajax": {
            "url": "ajax/get_book_data",
            "type": "POST"
        },
                "columnDefs": [
            { 
                
                "targets": [-1, ], //first column / numbering column
                "orderable": false, //set not orderable
                "className": 'dt-body-right'
            },
        ],
    });


        $(document).on('click','.book_delete',function() {

            var x = confirm('Are You Sure Want to Delete this?');
            if (x == true) {

                var id = $(this).attr('id');
                $.ajax({

                    type: "POST",
                    url: "ajax/delete_book",
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
               $(document).on('click','.chapter_detail',function(){
                   var id = $(this).attr('id');
                $.ajax({
                    type: "post",
                    url: "ajax/chapter_detail",
                    data: {
                       id:id
                    },
                    success: function(data) {
                        $("#add_data").html(data);
                        $("#myModal").modal('show');
                                    
                    $('#myModal .myDataTable2')
            .addClass('nowrap')
            .dataTable({
                responsive: true,
                columnDefs: [{
                    targets: [-1, ],
                    className: 'dt-body-right'
                }]
            });
                          }
                });
            });
            </script>
            <script>
            $(document).on('click','.clog_id_delete',function() {

            var x = confirm('Are You Sure Want to Delete this?');
            if (x == true) {

                var id = $(this).attr('id');
                $.ajax({

                    type: "POST",
                    url: "ajax/chapter_delete",
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