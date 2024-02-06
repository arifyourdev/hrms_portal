<?php require_once 'private/initialize.php';
require_login();

$page = "Webinar-Register";
 
?>
<!doctype html>
<html class="no-js " lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <title>Webinar Register | Madhubunbooks</title>
    <link rel="icon" href="assets/images/logo.svg" type="image/x-icon"> <!-- Favicon-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <!-- plugin css file  -->
    <link rel="stylesheet" href="assets/css/dataTables.min.css">

    <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/luno.style.min.css">
</head>
<style>
   .down-links{
    font-weight: 800;
    color: #0c6b7a;
    font-size: 15px;
    margin-left: 5px;
   } 
</style>
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
                        <h1 class="fs-5 color-900 mt-1 mb-0">Webinars Registration</h1>
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
                                <h6 class="card-title m-0">Webinars Registration</h6>
                               
                            </div>
                            <div class="card-body">
                                <table class="table myDataTable table-hover align-middle mb-0 card-table"style="vertical-align: top!important;">
                                    <thead>
                                        <tr>
                                             <th>Sn</th>
                                             <th>Name</th>
                                             <th style="">Email</th>
                                             <th>Mobile</th>
                                             <th>Date</th>
                                             <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $s = 1;
                                        $r_data= WebinarsRegister::find_by_order();
                                        foreach ($r_data as $data) {
                                        ?>
                                            <tr>
                                                <td><?php echo $s; ?>.</td>
                                                  
                                                  <td>
                                                       <?php echo $data->name; ?> 
                                                  </td>
                                                  <td><?php echo $data->email ?></td>
                                                  <td><?php echo $data->mobile ?></td>
                                                  <td>
                                                       <?php echo dateformat($data->created_at); ?> 
                                                  </td>
                                                    
                                                 <td>
                                                    
                                                    <button type="button" id="<?php echo $data->id ?>" class="btn btn-sm btn-outline-danger web_r_delete"><i class="fa fa-trash-o"></i></button>
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

        $(document).on('click','.web_r_delete',function() {

            var x = confirm('Are You Sure Want to Delete this?');
            if (x == true) {

                var id = $(this).attr('id');
                $.ajax({

                    type: "POST",
                    url: "ajax/web_r_delete",
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