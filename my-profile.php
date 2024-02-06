<?php 
require_once "admin/private/initialize.php";
user_login();
 
$user_id = $_SESSION['user_id'];
$user_master = BookUserMaster::find_by_custom_id('user_id',$user_id);
$user_profile = BookUserProfile::find_by_profile_user_id($user_id);

 if(isset($_POST['update'])){
     
    $user_mobile = htmlentities($database->escape_string($_POST['user_mobile']));
    $user_firstname = htmlentities($database->escape_string($_POST['user_firstname']));
    $user_lastname = htmlentities($database->escape_string($_POST['user_lastname']));
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
       
        $user_master->user_mobile = $user_mobile;
        $user_master->user_firstname = $user_firstname;
        $user_master->user_lastname = $user_lastname;
        $user_master->user_date = $time;
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
         
          echo "<script language='javascript'>alert('User Update Successfully');window.location.href='my-profile'</script>";
          
       }
       else{
           echo "<script language='javascript'>alert('Something Wrong');window.location.href='my-profile'</script>";
        }
            
    }

    
if(isset($_POST['submit_request'])){
  
    $subject = htmlentities($database->escape_string($_POST['request_subject']));
    $series = htmlentities($database->escape_string($_POST['request_series']));
    $class =$_POST['request_class'];
    
    foreach($class as $key => $class_data)
    {
        $books = BookMaster::find_by_subject_series_class($subject,$series,$class_data);
        $args = $_POST['request'];
        $request = new BooksRrequest ($args);
        $request->request_book_id = $books->book_id;
        $request->request_user_id = $user_id;
        $request->request_status= 'N';
        $result = $request->save('request_id');
    }
     
      
	$session->message('The Request Was Send Successfully.');
    	 
	redirect_to('my-profile');

} 


 if(isset($_POST['change_password'])){
    $user_old_password = htmlentities($database->escape_string($_POST['user_password']));
    $new_password = htmlentities($database->escape_string($_POST['new_password']));
    $c_new_password = htmlentities($database->escape_string($_POST['c_new_password']));
    
    $check_password = BookUserMaster::find_by_user_id($user_id);
    
    if($check_password->user_password == $user_old_password) 
    {   
           if($new_password === $c_new_password)
         {  
            $check_password->merge_attributes();
            $check_password->user_password = $new_password;
            $result = $check_password->save('user_id');
            $session->message('Password Updated Successfully!');
         }
         else
         {
            $session->message('Confirm Password must be same as New Password'); 
         }
    }
    else{
        $session->message('Current Password is incorrect');
    }   
    
    redirect_to('my-profile');
 }

?>
<!doctype html>
<html class="no-js" lang="zxx">
 <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>My Profile | Madhubunbooks</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include 'includes/head.php' ?>
</head>

<body>
  <style>
      .active a{
          color:#a32c4c !important;
          font-weight: 500 !important;
      }
      .product__thumb img{
          height:230px;
      }
       
  </style>
<!-- Main wrapper -->
<div class="wrapper" id="wrapper">
    <!-- Header -->
    
    <?php include 'includes/header.php'?>
    <!-- //Header -->
    <!-- Start Search Popup -->
    <div class="box-search-content search_active block-bg close__top">
        <form id="search_mini_form" class="minisearch" action="#">
            <div class="field__search">
                <input type="text" placeholder="Search entire store here...">
                <div class="action">
                    <a href="#"><i class="zmdi zmdi-search"></i></a>
                </div>
            </div>
        </form>
        <div class="close__wrap">
            <span>close</span>
        </div>
    </div>

    <!-- End Search Popup -->

   <div class="page-blog bg--white section-padding--lg blog-sidebar right-sidebar">
       <?php if(isset($_SESSION['message'])){ ?>
               <div class="text-center">
                    <h5 style="color: darkgreen;"><?php echo display_session_message() ?></h5>
               </div>
               <?php } ?>
        <div class="container">
             <div class="row mt-3">
                 <div class="col-lg-3 col-12 order-2 order-lg-1 md-mt-40 sm-mt-40">
                      <div class="shop__sidebar">
                        <aside class="tabs-nav">
                            <div class="my_profile_text"><h5>My Account</h5></div>
                          <?php if($user_login_type=='1')
                             { 
                           ?>
                             <ul class="my_profile_ul">
                               <li class="active" ><a href="#edit_profile"><i class="fa-solid fa-user"></i> Edit Profile</a></li>
                               <li class=""><a href="subscription"><i class="fa-solid fa-subscript"></i> My Subscription</a></li>
                               <!--<li class=""><a href="all-worksheet"><i class="fa fa-book" aria-hidden="true"></i> Worksheets</a></li>-->
                               <!--<li class=""><a href="all-answer-key"><i class="fa fa-download" aria-hidden="true"></i> Answer Keys</a></li>-->
                               <!-- <li class=""><a href="#favourite"><i class="fa-solid fa-heart"></i> My Favourite</a></li> -->
                               <li class=""><a href="#change_password"><i class="fa-solid fa-lock"></i>Change Password</a></li>
                               <li class=""><a href="#resources"><i class="fa-solid fa-file-export"></i> Request Resources</a></li>
                               <li><a href="../logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                            </ul>
                            <?php }else {?>
                            <ul class="my_profile_ul">
                               <li class=" active" ><a href="#edit_profile"><i class="fa-solid fa-user"></i> Edit Profile</a></li>
                                <!-- <li class=""><a href="#favourite"><i class="fa-solid fa-heart"></i> My Favourite</a></li> -->
                               <li class=""><a href="#change_password"><i class="fa-solid fa-lock"></i>Change Password</a></li>
                                <li><a href="../logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                            </ul>
                            <?php } ?>
                        </aside>
  
                    </div>
                </div>
                <div class="col-lg-9 col-12 order-1 order-lg-2">
                    <div class="content tabs-content">
                       <!--Edit Profile  -->
                      <div class="about-lft my_p" id="edit_profile">
                          <div class="all_background_">
                             <h5>Edit Profile</h5>
                             <div class="profile_form__">
                                 <form method="post">
                                    <div class="row">
                                        <div class="col-lg-4">
                                          <div class="form-group form_label">
                                              <label for="name">Mobile: <span>*</span></label>
                                              <input type="text" class="form-control" name="user_mobile" value="<?php echo $user_master->user_mobile ?>">
                                         </div>  
                                        </div>
                                        <div class="col-lg-4">
                                          <div class="form-group form_label">
                                              <label for="name">First Name: <span>*</span></label>
                                              <input type="text" class="form-control" name="user_firstname"  value="<?php echo $user_master->user_firstname ?>">
                                         </div>  
                                        </div>
                                        <div class="col-lg-4">
                                          <div class="form-group form_label">
                                              <label for="name">Last Name: <span>*</span></label>
                                              <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_master->user_lastname ?>">
                                         </div>  
                                        </div>
                                        <div class="col-lg-4">
                                          <div class="form-group form_label">
                                              <label for="name">Designation: <span>*</span></label>
                                              <input type="text" class="form-control" name="profile_designation" value="<?php echo (isset($user_profile->profile_designation) ? $user_profile->profile_designation: '') ?>">
                                         </div>  
                                        </div>
                                         <div class="col-lg-4">
                                          <div class="form-group form_label">
                                              <label for="name">Department: <span>*</span></label>
                                              <input type="text" class="form-control" name="profile_department" value="<?php echo (isset($user_profile->profile_department) ? $user_profile->profile_department: '') ?>">
                                         </div>  
                                        </div>
                                        <div class="col-lg-4">
                                          <div class="form-group form_label">
                                              <label for="name">Level: <span>*</span></label>
                                               <select class="form-control" name="profile_level">
                                                                <option value="">-Select-</option>
                                                            <?php $level_sql = BookLeval::find_by_order();
                                                            foreach ($level_sql as $level_data){
                                                            ?>
                                                             <option value="<?php echo $level_data->lavel_id?>"<?php if(isset($user_profile->profile_level)){ if($user_profile->profile_level == $level_data->lavel_id){ echo 'selected'; } } ?>><?php echo $level_data->lavel_title?></option>
                                                             <?php } ?>
                                               </select>
                                         </div>  
                                        </div>
                                        <div class="row">
                                            <h4>SCHOOL INFORMATION</h4>
                                                 <div class="col-lg-4 mt-2">
                                                  <div class="form-group form_label">
                                                      <label for="name">School Name: <span>*</span></label>
                                                      <input type="text" class="form-control" name="profile_school_name" value="<?php echo (isset($user_profile->profile_school_name) ? $user_profile->profile_school_name: '') ?>">
                                                 </div>  
                                                </div>
                                                 <div class="col-lg-4 mt-2">
                                                  <div class="form-group form_label">
                                                      <label for="name">Principal Name*: <span>*</span></label>
                                                      <input type="text" class="form-control" name="profile_principal_name" value="<?php echo (isset($user_profile->profile_principal_name) ? $user_profile->profile_principal_name: '') ?>">
                                                 </div>  
                                                </div>
                                                 <div class="col-lg-4 mt-2">
                                                  <div class="form-group form_label">
                                                      <label for="name">Country: <span>*</span></label>
                                                     <select class="form-control" name="profile_country">
                                                         <option value="">-Select-</option>
                                                          
                                                      </select>
                                                 </div>  
                                                </div>
                                                <div class="col-lg-4">
                                                  <div class="form-group form_label">
                                                      <label for="name">State: <span>*</span></label>
                                                      <input type="text" class="form-control" name="profile_state" value="<?php echo (isset($user_profile->profile_state) ? $user_profile->profile_state: '') ?>">
                                                 </div>  
                                                </div>
                                                <div class="col-lg-4">
                                                  <div class="form-group form_label">
                                                      <label for="name">City: <span>*</span></label>
                                                      <input type="text" class="form-control" name="profile_city" value="<?php echo (isset($user_profile->profile_city) ? $user_profile->profile_city: '') ?>">
                                                 </div>  
                                                </div>
                                                <div class="col-lg-4">
                                                  <div class="form-group form_label">
                                                      <label for="name">Pin/Zip: <span>*</span></label>
                                                      <input type="text" class="form-control" name="profile_zip" value="<?php echo (isset($user_profile->profile_zip) ? $user_profile->profile_zip: '') ?>">
                                                 </div>  
                                                </div>
                                                <div class="col-lg-4">
                                                  <div class="form-group form_label">
                                                      <label for="name">School Email Id: <span>*</span></label>
                                                      <input type="text" class="form-control" name="profile_school_email" value="<?php echo (isset($user_profile->profile_school_email) ? $user_profile->profile_school_email: '') ?>">
                                                 </div>  
                                                </div>
                                         </div>
                                           <input type="hidden" name="profile_date" value="<?php echo $time ?>">
                                        <div class="button_align__">
                                            <button type="submit" name="update" class="profile_btn__">Save</button>
                                        </div>
                                    </div>  
                                 </form>
                             </div>
                          </div>
                     </div>
                      <!--End Edit Profile-->  
                        
                         
                      
                     
                      <!--favourite  -->
                      <div class="about-lft my_p" id="favourite">
                          <div class="all_background_">
                             <h5>MY favourite</h5>
                             <div class="profile_form__">
                                 <div class="row">
                                    <?php   $fav_sql = Bookfavourite ::find_by_fav_user_id($user_id);
                                        foreach ($fav_sql as $fav_data){ 
                                        $fav_book = BookMaster::find_by_book_id($fav_data->fav_book_id);
                                        ?>
                                         <div class="product product__style--3 col-lg-3 col-md-4 col-sm-6 col-12">
                                            <div class="product__style--detail">
                                                <div class="product__thumb first__imgs imgsss">
                                                  <img src="admin/<?php echo $fav_book->picture_path() ?>" alt="product image">
                                                </div>
                                                <div class="product__contents">
                                                    <h4><?php echo $fav_book->book_title; ?></h4>
                                                </div>
                                            </div>
                                         </div>
                                    <?php } ?>
                             </div>
                          </div>
                     </div>
                     </div>
                      <!--End favourite-->
                      <!--Change Password-->
                      
                      <div class="about-lft my_p" id="change_password">
                          <div class="all_background_">
                             <h5>Change Password</h5>
                             <div class="profile_form__">
                                 <div class="profile_form__">
                                   <form method="POST">
                                               <div class="col-lg-6 mt-2">
                                                  <div class="form-group form_label">
                                                      <label for="name">Current Password : <span>*</span></label>
                                                      <input type="password" class="form-control" name="user_password" required>
                                                  </div>  
                                                </div>
                                                 <div class="col-lg-6 mt-2">
                                                   <div class="form-group form_label">
                                                      <label for="name">New Password : <span>*</span></label>
                                                      <input type="password" class="form-control" name="new_password" required>
                                                   </div>  
                                                 </div>
                                               <div class="col-lg-6 mt-2">
                                                  <div class="form-group form_label">
                                                      <label for="name">Confirm Password : <span>*</span></label>
                                                      <input type="password" class="form-control" name="c_new_password" required>
                                                  </div>  
                                               </div>
                                          <div class="button_align_chan">
                                            <button type="submit" name="change_password" class="profile_btn__">Change Password</button>
                                          </div>
                                </form>
                             </div>
                          </div>
                       </div>
                     </div>
                      
                       
                      <!--End Password-->
                        <!--resources  -->
                      <div class="about-lft my_p" id="resources">
                          <div class="all_background_">
                             <h5>Request Resources</h5>
                             <div class="profile_form__">
                                 <div class="profile_form__">
                                  <form method="post">
                                      <div class="text-center">
                                          <h4 class="text-success"><?php echo display_session_message();?></h4>
                                      </div>
                                      <div class="row">
                                       <div class="col-lg-1">
                                          <div class="form-group form_label">
                                            <div class="add_button add_m_btn" title="add field"> <i class="fa-solid fa-plus" style="font-size: 1.5em;position: absolute;right: 150px;"></i></div>                                           
                                         </div>
                                           </div>
                                      <div class="after-add-more">
                                    <div class="row field_wrapper">
                                          <div class="col-lg-4">
                                          <div class="form-group form_label">
                                              <label for="name">Subject: <span>*</span></label>
                                               <select class="form-control" id="subject_id" name="request_subject">
                                                   <option value="">-Subject-</option>
                                                   <?php $subject_sql = BookSubject::find_by_order();
                                                     foreach ($subject_sql as $sub_data){
                                                     ?>
                                                     <option value="<?php echo $sub_data->subject_id?>"><?php echo $sub_data->subject_title ?></option>
                                                     <?php } ?>
                                               </select>
                                          </div>  
                                         </div>
                                          <div class="col-lg-4">
                                          <div class="form-group form_label">
                                              <label for="name">Series: <span>*</span></label>
                                               <select class="form-control" id="series_id" name="request_series">
                                                   <option value="">-Series-</option>
                                                      
                                               </select>
                                          </div>  
                                         </div>
                                          <div class="col-lg-3">
                                          <div class="form-group form_label">
                                              <label for="name">Class: <span>*</span></label>
                                               <select class="form-control" id="class_id" name="request_class[]" multiple>
                                                   <option value="">-Class-</option>
                                               </select>
                                          </div>  
                                         </div>
                                         
                                        <div>
                                         <input type="hidden" name="request[request_date]" value="<?php echo $time ?>">
                                         <input type="hidden" name="request[request_status]" >
                                        
                                    </div>  
                                
                             </div>
                             </div>
                              <div class="button_align__">
                            <button type="submit" name="submit_request" class="profile_btn__">Submit</button>
                             </div>
                             </div>
                              </form>
                             </div> 
                            
                          </div>
                     </div>
                      </div>
                      <!--End resources-->
                      
                </div>
            </div>
        </div>
    </div>
    <!-- Start About Area -->
    <div class="page-about about_area bg--white section-padding--lg">
        <div class="container">
             <div class="row align-items-center">
                 <div class="col-lg-9 col-sm-12 col-12">
                     
                </div>
             </div>
        </div>
        
    </div>
    <!-- End About Area -->
    
<style>
    .tabs-content .my_p:not(:first-child) {
    display: none;
}
</style>
 
    <!-- Footer Area -->
    <?php include 'includes/footer.php' ?>
    <!-- //Footer Area -->

</div>
<!-- //Main wrapper -->
 <!-- JS Files -->
<?php include 'includes/foot.php' ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
      <script>$(document).ready(function() {
    $("body").on("click",".add_m_btn",function(){ 
        var html = $(".after-add-more").first().clone();
      
        //  $(html).find(".change").prepend("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");
      
          $(html).find(".change").html();
      
      
        $(".after-add-more").last().after(html);
      
     
       
    });

});</script>
        <script>
          $(function() {
          $('.tabs-nav a').click(function() {
        
            // Check for active
            $('.tabs-nav li').removeClass('active');
            $(this).parent().addClass('active');
        
            // Display active tab
            let currentTab = $(this).attr('href');
            $('.tabs-content .my_p').hide();
            $(currentTab).show();
        window.location.hash = e.target.hash;
           
            return false;
          });
        });
        </script>
    <script>
 $(document).ready(function()
 {
       var hash = location.hash.replace();  // ^ means starting, meaning only match the first hash
       get_data(hash);
      $(document).on("click",".my-profile_label a",function(){
        var id =$(this).attr("href");
        
        var hash = id.replace('my-profile', '');
        get_data(hash);
     });
    
    function get_data(hash)
    {
        if (hash) {
   if($('.tabs-nav li a[href="' + hash + '"]').length>0)
   {    
        $('.tabs-nav li').removeClass('active');  
       $('a[href="' + hash + '"]').parent().addClass('active');
       $('.tabs-content .my_p').hide();
       $(hash).show();
    
   }
   else
   {
      $('.tabs-content .my_p').hide();
   }
    
}
    }
 
  
 });

// Change hash for page-reload
$('.tabs-nav li a').on('shown.bs.tab', function (e) {
    window.location.hash = e.target.hash;
})
</script>
      <script>
        $(document).ready(function() {
        $('#subject_id').on('change', function() {
        var subject_id = this.value;
         $.ajax({
           url: "ajax/get_series",
            type: "POST",
             data: {
             subject_id: subject_id
         },
        cache: false,
        success: function(result){
        $("#series_id").html(result);
        $("#class_id").empty();
        // $('#class_id').html('<option value="">Select Series First</option>'); 
        }
        });
        });  
        
        $('#series_id').on('change', function() {
        var series_id = this.value;
        if(series_id !='')
        {
                    $.ajax({
        url: "ajax/get_new_class",
        type: "POST",
        data: {
        series_id: series_id
        },
        cache: false,
         success: function(result){
        $("#class_id").html(result);
        }
        });
        }
        else
        {
            $("#class_id").empty();
        }

        });
        });
        
        // Add More
        
        $(document).ready(function() {
            var maxField = 500; 
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            // var fieldHTML = '<a href="javascript:void(0);" class="remove_button remove_m_btn"><i class="fa-solid fa-minus"></i></a></div>';
            var x = 1;
             $(addButton).click(function() {
                 if (x < maxField) {
                    x++; 
                    $(wrapper).append(fieldHTML); 
                }
            });

             $(wrapper).on('click', '.remove_button', function(e) {
                e.preventDefault();
                $(this).parent('div').remove(); 
                x--;  
            });
        });
</script>  
        
</body>
</html>