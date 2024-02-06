<?php
if (isset($_GET['id'])) {
     $mail_id = $_GET['id'];
     $mail = EmailtemplateMaster::find_by_custom_id('mail_id',$mail_id);
?>
  <div class="col-6">
        <label class="form-label">Mail Type</label>
         <select name="mail[mail_type_id]" class="form-control form-control-lg" id="">

        <?php if($mail->mail_type_id == 101) { ?>
          <option value="<?php echo $mail->mail_type_id ?>"<?php if($mail->mail_type_id == $mail->mail_type_id){ echo "selected"; } ?>> Registration ( To User )</option>

          <?php }elseif($mail->mail_type_id == 102){?>
            <option value="<?php echo $mail->mail_type_id ?>"<?php if($mail->mail_type_id == $mail->mail_type_id){ echo "selected"; } ?>> Registration ( To Admin )</option>

          <?php }elseif($mail->mail_type_id == 103){?>
            <option value="<?php echo $mail->mail_type_id ?>"<?php if($mail->mail_type_id == $mail->mail_type_id){ echo "selected"; } ?>> Forgot Password ( To User )</option>

            <?php }elseif($mail->mail_type_id == 104){?>
            <option value="<?php echo $mail->mail_type_id ?>"<?php if($mail->mail_type_id == $mail->mail_type_id){ echo "selected"; } ?>>  Contact Us ( To User )</option>

            <?php }elseif($mail->mail_type_id == 105){?>
            <option value="<?php echo $mail->mail_type_id ?>"<?php if($mail->mail_type_id == $mail->mail_type_id){ echo "selected"; } ?>>  Contact Us ( To Admin )</option>

            <?php }elseif($mail->mail_type_id == 106){?>
            <option value="<?php echo $mail->mail_type_id ?>"<?php if($mail->mail_type_id == $mail->mail_type_id){ echo "selected"; } ?>> Publishwithus ( To User )</option>
            
            <?php }elseif($mail->mail_type_id == 107){?>
            <option value="<?php echo $mail->mail_type_id ?>"<?php if($mail->mail_type_id == $mail->mail_type_id){ echo "selected"; } ?>> Publishwithus ( To Admin )</option>

            <?php }elseif($mail->mail_type_id == 108){?>
            <option value="<?php echo $mail->mail_type_id ?>"<?php if($mail->mail_type_id == $mail->mail_type_id){ echo "selected"; } ?>> Workshop/Teacher Training ( To User )</option>

            <?php }elseif($mail->mail_type_id == 109){?>
            <option value="<?php echo $mail->mail_type_id ?>"<?php if($mail->mail_type_id == $mail->mail_type_id){ echo "selected"; } ?>> Workshop/Teacher Training ( To Admin )</option>

            <?php }elseif($mail->mail_type_id == 110){?>
            <option value="<?php echo $mail->mail_type_id ?>"<?php if($mail->mail_type_id == $mail->mail_type_id){ echo "selected"; } ?>> Job Apply  ( To User )</option>

            <?php }elseif($mail->mail_type_id == 111){?>
            <option value="<?php echo $mail->mail_type_id ?>"<?php if($mail->mail_type_id == $mail->mail_type_id){ echo "selected"; } ?>> Job Apply  ( To Admin )</option>

            <?php }elseif($mail->mail_type_id == 112){?>
            <option value="<?php echo $mail->mail_type_id ?>"<?php if($mail->mail_type_id == $mail->mail_type_id){ echo "selected"; } ?>>Specimen request  ( To User )</option>

            <?php }elseif($mail->mail_type_id == 113){?>
            <option value="<?php echo $mail->mail_type_id ?>"<?php if($mail->mail_type_id == $mail->mail_type_id){ echo "selected"; } ?>>Specimen request  ( To Admin )</option>
             

            <?php } else { ?>
         <option value="101">Registration ( To User )</option>
         <option value="102">Registration ( To Admin )</option>
         <option value="103">Forgot Password ( To User )</option>
         <option value="104">Contact Us ( To User )</option>
         <option value="105">Contact Us ( To Admin )</option>
         <option value="106">Publishwithus ( To User )</option>
         <option value="107">Publishwithus ( To Admin )</option>
         <option value="108">Workshop/Teacher Training ( To User )</option>
         <option value="109">Workshop/Teacher Training ( To Admin )</option>
         <option value="110">Job Apply  ( To User )</option>
         <option value="111">Job Apply  ( To Admin )</option>
         <option value="112">Specimen request  ( To User )</option>
         <option value="113">Specimen request  ( To Admin )</option>
          <?php } ?>
         
         </select>
         
    </div>
    <div class="col-md-6">
        <label class="form-label">Mail Send From</label>
        <input type="text" class="form-control form-control-lg" name="mail[mail_send_from]" value="<?php echo $mail->mail_send_from ?>">
    </div>
     <div class="col-md-6">
        <label class="form-label">Mail To Admin</label>
        <input type="text" class="form-control form-control-lg" name="mail[mail_subject]" value="<?php echo $mail->mail_subject ?>"> 
    </div>
     <div class="col-6">
        <label class="form-label">Mail Status</label>
         <select name="mail[mail_status]" class="form-control form-control-lg" id="">
              <?php if ($mail->mail_status == 'Y') echo $Y="Active";
                else {
                    echo $Y="Inactive";
                } ?>
            <option value="<?php echo $mail->mail_status ?>"<?php if($mail->mail_status == $mail->mail_status){ echo "selected"; } ?>><?php echo $Y ?></option>
            <option value="N">Inactive</option>
             <option value="Y">Active</option>
         </select>
    </div>
    <div class="col-md-12">
        <label class="form-label">Mail Message</label>
        <textarea type="text" class="form-control form-control-lg" name="mail_message" ><?php echo $mail->mail_message ?></textarea>
    </div>
    <!-- <div class="col-md-12">
        <label class="form-label">Message</label>
        <textarea type="text" class="form-control form-control-lg" name="message" ><?php echo $mail->message ?></textarea>
    </div> -->
   
      
<?php } else { ?>
     
    

<?php } ?>