<?php
require_once "../private/initialize.php";
 
if(isset($_POST['id'])){
$user_id = $_POST['id'];
$user_master = BookUserMaster::find_by_custom_id('user_id',$user_id);
$user_profile = BookUserProfile::find_by_profile_user_id($user_id);
 

?>
          <div class="modal-header">
            <h4 class="modal-title">Update User</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
    
          <!-- Modal body -->
          <div class="modal-body" action="registration">
             <form method="post">
                <div class="row g-3">
                 <div class="col-md-6">
                    <label>Email Address <span>*</span></label>
                      <input type="text" class="form-control" name="user_email" value="<?php echo $user_master->user_email ?>">
                   </div>
                  <div class="col-6">
                    <div class="input__box">
                        <label>Mobile <span>*</span></label>
                        <input type="text"  class="form-control" name="user_mobile" value="<?php echo $user_master->user_mobile ?>">
                    </div>
                 </div>
                 
                 <input type="hidden" value="<?php echo $user_id ?>" name="p_user">
                  <div class="col-lg-6 col-6">
                    <div class="input__box">
                        <label>First Name <span>*</span></label>
                        <input type="text"  class="form-control" name="user_firstname"  value="<?php echo $user_master->user_firstname ?>">
                    </div>
                 </div>
                 <div class="col-lg-6 col-6">
                    <div class="input__box">
                        <label>Last Name <span>*</span></label>
                        <input type="text"  class="form-control" name="user_lastname" value="<?php echo $user_master->user_lastname ?>">
                    </div>
                 </div>
                 <div class="col-lg-6 col-6">
                         <div class="input__box">
                            <label style="font-weight:bold">Type <span>*</span></label>
                                <select type="text" class="form-control" style="color:crimson" name="user_type" class="type-select">
                                    <?php if ($user_master->user_type == '1') echo $Y="Teacher";
                                        else {
                                            echo $Y="Student,Parents,Others";
                                        } ?>
                                    <option value="<?php echo $user_master->user_type ?>"<?php if($user_master->user_type == $user_master->user_type){ echo "selected"; } ?>><?php echo $Y ?></option>
                                    <option value="2">Student</option>
                                    <option value="2">Parent</option>
                                    <option value="1">Teacher</option>
                                    <option value="2">Other</option>
                                 </select>
                        </div>
                </div>
                  <div class="col-lg-6 col-6">
                    <div class="input__box">
                        <label>Designation <span>*</span></label>
                        <input type="text" class="form-control" name="profile_designation" value="<?php echo $user_profile->profile_designation ?>">
                    </div>
                 </div>
                   <div class="col-lg-6 col-6">
                    <div class="input__box">
                        <label>Department <span>*</span></label>
                        <input type="text" class="form-control" name="profile_department" value="<?php echo $user_profile->profile_department ?>">
                    </div>
                 </div>
                  <div class="col-lg-6 col-6">
                        <div class="input__box">
                            <label>Level <span></span></label>
                            <select type="text" class="form-control" name="profile_level" class="type-select">
                                <option value="type">-Select-</option>
                                <?php $level_sql = BookLeval::find_by_order();
                                foreach ($level_sql as $level_data){
                                ?>
                                 <option value="<?php echo $level_data->lavel_id?>"<?php if($level_data->lavel_title == $level_data->lavel_title ){ echo 'selected'; } ?>><?php echo $level_data->lavel_title?></option>
                                 <?php } ?>
                            </select>
                        </div>
                     </div>
                     <div class="col-lg-6 col-6">
                        <div class="input__box">
                            <label>School Name <span>*</span></label>
                            <input type="text" class="form-control" name="profile_school_name" value="<?php echo $user_profile->profile_school_name ?>">
                        </div>
                     </div>
                      <div class="col-lg-6 col-6">
                        <div class="input__box">
                            <label>Principal Name <span>*</span></label>
                            <input type="text" class="form-control" name="profile_principal_name" value="<?php echo $user_profile->profile_principal_name ?>">
                        </div>
                     </div>
                      <div class="col-lg-6 col-6">
                        <div class="input__box">
                            <label>Country <span></span></label>
                            <select type="text" name="profile_country"  class="type-select form-control">
                                <option value="type">-Select Country-</option>
                                <?php 
                                $country_sql = CountrycitystateMaster::find_by_order();
                                foreach($country_sql as $country){
                                ?>
                                 <option value="<?php echo $country->zsc_id?>"<?php if($country->zsc_name == $country->zsc_name){ echo 'selected'; } ?>><?php echo $country->zsc_name?></option>
                                 <?php } ?>
                            </select>
                        </div>
                     </div>
                      <div class="col-lg-6 col-6">
                        <div class="input__box">
                            <label>State <span>*</span></label>
                            <input type="text" name="profile_state" class="form-control" value="<?php echo $user_profile->profile_state ?>">
                        </div>
                     </div>
                     <div class="col-lg-6 col-6">
                        <div class="input__box">
                            <label>City <span>*</span></label>
                            <input type="text" name="profile_city" class="form-control" value="<?php echo $user_profile->profile_city ?>">
                        </div>
                     </div>
                     <div class="col-lg-6 col-12">
                        <div class="input__box">
                            <label>Pin/Zip <span>*</span></label>
                            <input type="text" class="form-control" name="profile_zip" value="<?php echo $user_profile->profile_zip ?>">
                        </div>
                     </div>
                       <div class="col-lg-6 col-6">
                        <div class="input__box">
                            <label>School Email Id <span>*</span></label>
                            <input type="text" class="form-control" name="profile_school_email" value="<?php echo $user_profile->profile_school_email ?>">
                        </div>
                     </div>
                      <div class="col-lg-6 col-6">
                        <div class="input__box">
                            <label>Status <span></span></label>
                             <select type="text" name="user_status"  class="type-select form-control">
                                 <?php if($user_master->user_status =='Y'){ ?>
                                    <option value="<?php echo $user_master->user_status ?>">Approved</option>
                                    <option value="N">Not Approved</option>
                                    <?php }else { ?>
                                     <option value="<?php echo $user_master->user_status ?>">Not Approved</option>
                                     <option value="Y">Approved</option>
                                  <?php } ?>
                             </select>
                        </div>
                     </div>
                     </div>
                     <input type="hidden" name="user_date" value="<?php echo $time ?>"> 
                    <input type="hidden" name="profile_date" value="<?php echo $time ?>">
                      <div class="mt-3">
                        <button type="submit" name="update" class="btn btn-primary" name="submit">Update</button>
                         
                    </div>
                </div>
              </form>
          </div>
    <?php } ?>