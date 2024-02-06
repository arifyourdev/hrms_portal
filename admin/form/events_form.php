<?php
if (isset($_GET['id'])) {
     $event_id = $_GET['id'];
     $event = PastEvent::find_by_id($event_id);
?>
    <div class="col-md-6">
        <label class="form-label">Banner Name</label>
        <input type="text" class="form-control form-control-lg" name="event[title]" value="<?php echo $event->title ?>" placeholder="Banner Title">
    </div>
      <div class="col-6">
        <label class="form-label">Date</label>
        <input type="date" class="form-control form-control-lg" name="event[event_date]" value="<?php echo $event->event_date ?>" placeholder="Date">
    </div>
    <div class="col-6">
        <label class="form-label">Banner Status</label>
         <select name="event[status]"class="form-control form-control-lg" id="">
             <?php if ($event->status == 'Y') echo $Y="Active";
                else {
                    echo $Y="Inactive";
                } ?>
            <option value="<?php echo $event->status ?>"<?php if($event->status == $event->status){ echo "selected"; } ?>><?php echo $Y ?></option>
            <option value="N">Inactive</option>
             <option value="Y">Active</option>
         </select>
    </div>
     <div class="col-6">
        <label class="form-label">Event Type</label>
         <select name="event[event_type]" class="form-control form-control-lg" id="">
             <option value="<?php echo $event->event_type ?>"<?php if($event->event_type == $event->event_type){ echo "selected"; } ?>><?php echo $event->event_type ?></option>
            <option value="WORKSHOPS">WORKSHOPS</option>
            <option value="WEBINARS">WEBINARS</option>
             
         </select>
    </div>
    <div class="col-12">
        <label for="formFile" class="form-label">Event Image</label>
        <input class="form-control " type="file" name="image" id="formFile">
         <img src="<?php echo $event->picture_path() ?>" alt="" width="80px" height="80px">
    </div>
     <div class="col-12">
        <label for="formFile" class="form-label">Details</label>
        <textarea class="form-control form-control-lg" type="text" name="event[details]" id="formFile"  placeholder="Details"><?php echo $event->details?></textarea>
    </div>
    

<?php } else { ?>
     
    <div class="col-md-6">
        <label class="form-label">Event Title</label>
        <input type="text" class="form-control form-control-lg" name="event[title]" placeholder="Enter Event Title" required>
    </div>
    
    <div class="col-6">
        <label class="form-label">Date</label>
        <input type="date" class="form-control form-control-lg" name="event[event_date]" placeholder="Date">
    </div>
    <div class="col-6">
        <label class="form-label">Event Type</label>
         <select name="event[event_type]" class="form-control form-control-lg" id="">
            <option value="D" required>-Status-</option>
            <option value="WORKSHOPS">WORKSHOPS</option>
            <option value="WEBINARS">WEBINARS</option>
             
         </select>
    </div>
    <div class="col-6">
        <label class="form-label">Status</label>
         <select name="event[status]" class="form-control form-control-lg" id="">
            <option value="" required>-Status-</option>
            <option value="Y">Active</option>
            <option value="N">Inactive</option>
         </select>
    </div>
    <div class="col-12">
        <label for="formFile" class="form-label">Image</label>
        <input class="form-control form-control-lg" type="file" name="image" id="formFile">
    </div>
      <div class="col-12">
        <label for="formFile" class="form-label">Details</label>
        <textarea class="form-control form-control-lg" type="text" name="event[details]" id="formFile"  placeholder="Details"></textarea>
    </div>
    
     <input type="hidden" name="event[time]" value="<?php echo $time ?>">
<?php } ?>