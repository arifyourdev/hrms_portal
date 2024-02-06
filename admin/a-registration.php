 <?php require_once 'private/initialize.php';
 require_login();
$page = "registration";

$r_data = BookUserMaster::find_by_approved_registration();
 if(isset($_POST['update'])){
    $user_id = $_POST['p_user'];
   

    $user_email = htmlentities($database->escape_string($_POST['user_email']));
    $user_mobile = htmlentities($database->escape_string($_POST['user_mobile']));
    $user_firstname = htmlentities($database->escape_string($_POST['user_firstname']));
    $user_lastname = htmlentities($database->escape_string($_POST['user_lastname']));
    $user_status = htmlentities($database->escape_string($_POST['user_status']));
    $profile_designation = htmlentities($database->escape_string($_POST['profile_designation']));
    $profile_department = htmlentities($database->escape_string($_POST['profile_department']));
    $profile_level = htmlentities($database->escape_string($_POST['profile_level']));
    $profile_school_name = htmlentities($database->escape_string($_POST['profile_school_name']));
    $profile_principal_name = htmlentities($database->escape_string($_POST['profile_principal_name']));
    $profile_country = htmlentities($database->escape_string($_POST['profile_country']));
    $profile_state = htmlentities($database->escape_string($_POST['profile_state']));
    $profile_city = htmlentities($database->escape_string($_POST['profile_city']));
    $profile_zip = htmlentities($database->escape_string($_POST['profile_zip']));
    $profile_school_email = htmlentities($database->escape_string($_POST['profile_school_email']));
    $profile_date = htmlentities($database->escape_string($_POST['profile_date']));
    
      $user_master = BookUserMaster::find_by_custom_id('user_id',$user_id);

        $user_master->merge_attributes();
        $user_master->user_email = $user_email;
        $user_master->user_mobile = $user_mobile;
        $user_master->user_firstname = $user_firstname;
        $user_master->user_lastname = $user_lastname;
        $user_master->user_date = $time;
        $user_master->user_status = $user_status;
       
        $result = $user_master->save('user_id');


          if($result == true){
            $user_profile = BookUserProfile::find_by_profile_user_id($user_id);
            
        $user_profile->merge_attributes();   
        $user_profile->profile_designation = $profile_designation;
        $user_profile->profile_department = $profile_department;
        $user_profile->profile_level = $profile_level;
        $user_profile->profile_school_name = $profile_school_name;
        $user_profile->profile_user_id = $user_id;
        $user_profile->profile_principal_name = $profile_principal_name;
        $user_profile->profile_country = $profile_country;
        $user_profile->profile_state = $profile_state;
        $user_profile->profile_city = $profile_city;
        $user_profile->profile_zip = $profile_zip;
        $user_profile->profile_school_email = $profile_school_email;
        $user_profile->profile_date = $profile_date;
        

         $result = $user_profile->save('profile_id');
         
          echo "<script language='javascript'>alert('User Update Successfully');window.location.href='a-registration'</script>";
          
       }
       else{
           echo "<script language='javascript'>alert('Something Wrong');window.location.href='a-registration'</script>";
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
    <title> Approved Registration | Madhubunbooks</title>
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
                        <h1 class="fs-5 color-900 mt-1 mb-0">Approved Registration</h1>
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
                                <h6 class="card-title m-0">Approved Registration</h6>
                               
                            </div>
                            <div class="card-body">
                                <table class="table myDataTable table-hover align-middle mb-0 card-table"style="vertical-align: top!important;">
                                    <thead>
                                        <tr>
                                            <th>Sn</th>
                                            <!-- <th>Action</th> -->
                                            <th>Email</th>
                                            <th>User Type</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
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
      </div>
     </div>
    <div id="modal_registration" class="modal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" id="registration_data">
     
    
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
            "url": "ajax/get_approve_reg",
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

        $(document).on('click','.user_delete', function() {

            var x = confirm('Are You Sure Want to Delete this?');
            if (x == true) {

                var id = $(this).attr('id');
                $.ajax({

                    type: "POST",
                    url: "ajax/a_registration_delete",
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
             
             $(document).on('click','.edit_registration', function() {
                   var id = $(this).attr('id');
                $.ajax({
                    type: "post",
                    url: "ajax/edit-registration",
                    data: {
                       id:id
                    },
                    success: function(data) {
                        $("#registration_data").html(data);
                        $("#modal_registration").modal('show');
                          }
                });
               
            });
            
            
         </script>

</body>

</html>