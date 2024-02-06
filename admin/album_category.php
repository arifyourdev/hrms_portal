<?php require_once 'private/initialize.php';
$page = "level";

$albums = BookAlbumCateg::find_by_order();
?>
<!doctype html>
<html class="no-js " lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <title>Book Album Category | Madhubunbooks</title>
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
                        <h1 class="fs-5 color-900 mt-1 mb-0">Manage Album Category</h1>
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
                                <h6 class="card-title m-0">Manage Album Category</h6>
                                <div class="dropdown morphing scale-left">
                                    <a href="add_album_category" data-bs-toggle="tooltip" title="Add Form"><i class="icon-size-fullscreen"></i>Add Album Category</a>

                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table myDataTable table-hover align-middle mb-0 card-table">
                                    <thead>
                                        <tr>
                                            <th>Sn</th>
                                            <th>Album Category Title</th>
                                            <th>Status</th>
                                            <th style="width:20%;text-align:center;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $s = 1;
                                        foreach ($albums as $lev) {
                                        ?>
                                            <tr>
                                                <td><?php echo $s; ?></td>
                                                <td><span><?php echo $lev->album_category ?></span></td>
                                                 <td>
                                                    <?php if ($lev->status == 'Y') echo "Active";
                                                    else {
                                                        echo "Inactice";
                                                    } ?></td>
                                                <td>
                                                    <button type="button" onclick="window.location.href= 'edit_album_category/<?php echo $lev->id ?>'" class="btn btn-sm btn-outline-secondary"><i class="fa fa-edit"></i></button>
                                                    <button type="button" id="<?php echo $lev->id ?>" class="btn btn-sm btn-outline-danger category_delete"><i class="fa fa-trash-o"></i></button>
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

        $(document).on('click','.category_delete',function() {

            var x = confirm('Are You Sure Want to Delete this?');
            if (x == true) {

                var id = $(this).attr('id');
                $.ajax({

                    type: "POST",
                    url: "ajax/album_category_delete",
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