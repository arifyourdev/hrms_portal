<!doctype html>

<html class="no-js " lang="en">
    
 <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Bootstrap 5 admin template and web Application ui kit.">
    <meta name="keyword" content="LUNO, Bootstrap 5, ReactJs, Angular, Laravel, VueJs, ASP .Net, Admin Dashboard, Admin Theme, HRMS, Projects">
    <title>Table | Madhubunbooks</title>
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
                        <h1 class="fs-5 color-900 mt-1 mb-0">Table</h1>
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
                                <h6 class="card-title m-0">Table List</h6>
                                <div class="dropdown morphing scale-left">
                                    <a href="add_form.php" data-bs-toggle="tooltip" title="Add Form"><i class="icon-size-fullscreen"></i>Add Form</a>
                                   
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table myDataTable table-hover align-middle mb-0 card-table">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                </div>
                                            </th>
                                            <th>Name</th>
                                            <th>Employee ID</th>
                                            <th>Phone</th>
                                            <th>Join Date</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                </div>
                                            </td>
                                            <td class="d-flex">
                                                <img src="assets/images/xs/avatar6.jpg" class="rounded-circle avatar" alt="">
                                             </td>
                                            <td><span>LA-0233</span></td>
                                            <td><span>+ 264-625-2583</span></td>
                                            <td>13 Nov, 2016</td>
                                            <td>IOS Developer</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fa fa-edit"></i></button>
                                                <button type="button" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash-o"></i></button>
                                            </td>
                                        </tr>
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
    .addClass( 'nowrap' )
    .dataTable( {
        responsive: true,
        columnDefs: [
            { targets: [-1,], className: 'dt-body-right' }
        ]
    });
</script>

</body>
 </html>