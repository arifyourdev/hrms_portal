<?php require_once 'private/initialize.php';
$page = "branches";

$branch = Branches::find_by_all();
?>
<!doctype html>
<html class="no-js " lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <title>Madhubun Branches | Madhubunbooks</title>
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
                        <h1 class="fs-5 color-900 mt-1 mb-0">Manage </h1>
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
                                <h6 class="card-title m-0">Manage </h6>
                                <div class="dropdown morphing scale-left">
                                    <a href="add_branches" data-bs-toggle="tooltip" title="Add Form"><i class="icon-size-fullscreen"></i>Add Branch</a>

                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table myDataTable table-hover align-middle mb-0 card-table">
                                    <thead>
                                        <tr>
                                            <th>Sn</th>
                                            <th>City Name</th>
                                            
                                            <th>Landline</th>
                                             
                                            <th>Email</th>
                                             
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $s = 1;
                                        foreach ($branch as $data) {
                                        ?>
                                            <tr>
                                                <td><?php echo $s; ?></td>
                                                <td><?php echo $data->city_name ?></td>
                                                <td><?php echo $data->landline?></td>
                                                <td><?php echo $data->email?></td>
                                                 <td>
                                                    <?php if ($data->status == 'Y') echo "Active";
                                                    else {
                                                        echo "Inactice";
                                                    } ?></td>
                                                <td>
                                                    <button type="button" onclick="window.location.href= 'edit_branches/<?php echo $data->branch_id ?>'" class="btn btn-sm btn-outline-secondary"><i class="fa fa-edit"></i></button>
                                                    <button type="button" id="<?php echo $data->branch_id ?>" class="btn btn-sm btn-outline-danger branch_delete"><i class="fa fa-trash-o"></i></button>
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

        $(document).on('click','.branch_delete',function() {

            var x = confirm('Are You Sure Want to Delete this?');
            if (x == true) {

                var id = $(this).attr('id');
                $.ajax({

                    type: "POST",
                    url: "ajax/delete_branch",
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