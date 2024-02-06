<?php require_once 'private/initialize.php';
require_login();

$page = "testimonial";

$test_data = BookTestimonial::find_all();
?>
<!doctype html>
<html class="no-js " lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <title>Books Testimonial | Madhubunbooks</title>
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
                        <h1 class="fs-5 color-900 mt-1 mb-0">Manage Testimonial</h1>
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
                                <h6 class="card-title m-0">Manage Testimonial</h6>
                                <div class="dropdown morphing scale-left">
                                    <a href="add_testimonial" data-bs-toggle="tooltip" title="Add Testimonial"><i class="icon-size-fullscreen"></i>Add Testimonial</a>

                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover align-middle mb-0 "style="vertical-align: top!important;">
                                    <thead>
                                        <tr>
                                            <th>Sn</th>
                                            <th style="width:65%;">Details</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $s = 1;
                                        foreach ($test_data as $test) {
                                        ?>
                                            <tr>
                                                <td><?php echo $s; ?>.</td>
                                                <td><b><?php echo $test->testimonial_added_by ?></b><br><br><span><?php echo $test->testimonial_detail ?></span></td>
                                                 <td>
                                                    <img src="<?php echo $test->picture_path() ?>" class="rounded-circle avatar" alt="">
                                                </td>
                                                 <td>
                                                    <?php if ($test->testimonial_status == 'Y') echo "Active";
                                                    else {
                                                        echo "Inactice";
                                                    } ?>
                                                 </td>
                                                <td>
                                                    <button type="button" onclick="window.location.href= 'edit_testimonial/<?php echo $test->testimonial_id ?>'" class="btn btn-sm btn-outline-secondary"><i class="fa fa-edit"></i></button>
                                                    <button type="button" id="<?php echo $test->testimonial_id ?>" class="btn btn-sm btn-outline-danger testimonial_delete"><i class="fa fa-trash-o"></i></button>
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

        $(document).on('click','.testimonial_delete', function() {

            var x = confirm('Are You Sure Want to Delete this?');
            if (x == true) {

                var id = $(this).attr('id');
                $.ajax({

                    type: "POST",
                    url: "ajax/testimonial_delete",
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