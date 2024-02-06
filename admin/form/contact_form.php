<?php
if (isset($_GET['id'])) {
     $contact_id = $_GET['id'];
     $contact = Contact::find_by_id($contact_id);
?>

    
       <h5 class="contact">Header Details</h5>
   
    <div class="col-md-4">
        <label class="form-label">Mobile No.</label>
        <input type="text" class="form-control form-control-lg" name="contact[mobile]" value="<?php echo $contact->mobile?>" placeholder="+919000909000" required>
    </div>
     <div class="col-4">
        <label class="form-label">Whatsapp</label>
        <input type="text" class="form-control form-control-lg" name="contact[whatsapp]" value="<?php echo $contact->whatsapp?>" placeholder="Whatsapp">
    </div>
    <div class="col-4">
        <label class="form-label">Email</label>
        <input type="text" class="form-control form-control-lg" name="contact[email]" value="<?php echo $contact->email?>" placeholder="Madhubun@gamil.in">
    </div>
   
        <h5 class="contact">Social Media</h5>
     
    <div class="col-4">
        <label class="form-label">Facebook</label>
        <input type="text" class="form-control form-control-lg" name="contact[facebook]" value="<?php echo $contact->facebook?>" placeholder="FaceBook ID">
    </div>
      <div class="col-4">
        <label class="form-label">Twitter</label>
        <input type="text" class="form-control form-control-lg" name="contact[twitter]" value="<?php echo $contact->twitter?>" placeholder="Twitter Account">
    </div>
      <div class="col-4">
        <label class="form-label">LinkedIn</label>
        <input type="text" class="form-control form-control-lg" name="contact[linkedin]" value="<?php echo $contact->linkedin?>" placeholder="LinkedIn">
    </div>
      <div class="col-4">
        <label class="form-label">Instagram</label>
        <input type="text" class="form-control form-control-lg" name="contact[instagram]" value="<?php echo $contact->instagram?>" placeholder="Instagram">
    </div>
      <div class="col-4">
        <label class="form-label">Youtube</label>
        <input type="text" class="form-control form-control-lg" name="contact[youtube]" value="<?php echo $contact->youtube?>" placeholder="youtube">
    </div>
     
         <h5 class="contact">Footer Details</h5>
      
     <div class="col-4">
        <label class="form-label">Fax</label>
        <input type="text" class="form-control form-control-lg" name="contact[fax]" value="<?php echo $contact->fax?>" placeholder="Fax">
    </div>
     <div class="col-4">
        <label class="form-label">Landline</label>
        <input type="text" class="form-control form-control-lg" name="contact[landline]" value="<?php echo $contact->landline?>" placeholder="+911204078900">
    </div>
     <div class="col-4">
        <label class="form-label">Address</label>
        <input type="text" class="form-control form-control-lg" name="contact[address]" value="<?php echo $contact->address?>" placeholder="Address">
    </div>
    
    <div class="col-4">
        <label for="formFile" class="form-label">Logo</label>
        <input class="form-control " type="file" name="image" id="formFile">
        <img src="<?php echo $contact->picture_path()?>" width="100px" height="70px" >
    </div>


<?php } else { ?>
     
     <h5 class="contact">Header Details</h5>
    <div class="col-md-4">
        <label class="form-label">Mobile No.</label>
        <input type="text" class="form-control form-control-lg" name="contact[mobile]" placeholder="+919000909000" required>
    </div>
     <div class="col-4">
        <label class="form-label">Whatsapp</label>
        <input type="text" class="form-control form-control-lg" name="contact[whatsapp]" placeholder="Whatsapp">
    </div>
     <div class="col-4">
        <label class="form-label">Email</label>
        <input type="text" class="form-control form-control-lg" name="contact[email]" placeholder="Madhubun@gamil.in">
    </div>
     
    <h5 class="contact">Social Media</h5>
    <div class="col-4">
        <label class="form-label">Facebook</label>
        <input type="text" class="form-control form-control-lg" name="contact[facebook]" placeholder="FaceBook ID">
    </div>
      <div class="col-4">
        <label class="form-label">Twitter</label>
        <input type="text" class="form-control form-control-lg" name="contact[twitter]" placeholder="Twitter Account">
    </div>
      <div class="col-4">
        <label class="form-label">LinkedIn</label>
        <input type="text" class="form-control form-control-lg" name="contact[linkedin]" placeholder="LinkedIn">
    </div>
      <div class="col-4">
        <label class="form-label">Instagram</label>
        <input type="text" class="form-control form-control-lg" name="contact[instagram]" placeholder="Instagram">
    </div>
      <div class="col-4">
        <label class="form-label">Youtube</label>
        <input type="text" class="form-control form-control-lg" name="contact[youtube]" placeholder="youtube">
    </div>
     
    <h5 class="contact">Footer Details</h5>
     <div class="col-4">
        <label class="form-label">Fax</label>
        <input type="text" class="form-control form-control-lg" name="contact[fax]" placeholder="Fax">
    </div>
     <div class="col-4">
        <label class="form-label">Landline</label>
        <input type="text" class="form-control form-control-lg" name="contact[landline]" placeholder="+911204078900">
    </div>
     <div class="col-4">
        <label class="form-label">Address</label>
        <input type="text" class="form-control form-control-lg" name="contact[address]" placeholder="Address">
    </div>
    
    <div class="col-4">
        <label for="formFile" class="form-label">Logo</label>
        <input class="form-control " type="file" name="image" id="formFile">
    </div>

<?php } ?>