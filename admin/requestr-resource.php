<?php require_once 'private/initialize.php';
require_login();

$page = "requestr-resource";

// $book_r_sql = BooksRrequest::find_by_order();

if(is_post_request($_POST['all_verify_submit']))
{
    $request_id = $_POST['request_id'];
    foreach($request_id as $request)
    {
        $level = BooksRrequest::approved_request($request);
    }
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
    <title>Request Resource | Madhubunbooks</title>
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
                        <h1 class="fs-5 color-900 mt-1 mb-0">Resource Request Pending For Approval</h1>
                    </div>
                </div> <!-- .row end -->

            </div>
        </div>

        <!-- Body: Body -->
        <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-3">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <form method="post">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title m-0">Resource Request Pending For Approval</h6>
                                <a href="approved-req" class="btn btn-info text-white">Approved List</a>
                                <div class="dropdown morphing scale-left">
                                    <button type="submit" class="btn btn-sm btn-outline-success" name="all_verify_submit"><i class="fa fa-check"></i>All Verify</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <table  class="table myDataTable table-hover nowrap align-middle mb-0 card-table">
                                    <thead>
                                        <tr>
                                            <th>Sn</th>
                                            <th><input type="checkbox" onClick="selectall(this)"></th>
                                            <th>Request Date</th>
                                            <th>Request Detail</th>
                                            <th>Request By</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </form>
                    </div>
                </div> <!-- Row end  -->

            </div>
        </div>
    </div>

    </div>

    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>

    <!-- Plugin Js -->
    <script src="assets/bundles/dataTables.bundle.js"></script>
    <script>
        function selectall(source) {
  checkboxes = document.getElementsByName('request_id[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>

    <!-- Jquery Page Js -->
<script>
$(document).ready(function(){
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
            "url": "ajax/get_requests",
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

    $(document).on('click','.request_status',function() {
            var x = confirm('Are You Sure Want to Approve this ?');
            if (x == true) {
                var id = $(this).attr('id');
                $.ajax({
                    type: "POST",
                    url: "ajax/approve_request",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        window.location.reload();
                    }
                });
            }
        });
});
</script>

</body>

</html>