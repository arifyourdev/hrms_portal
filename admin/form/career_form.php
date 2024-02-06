<?php
if(isset($_GET['id'])) 
{
    $jobs_id = $_GET['id'];
    $jobs = CurrentOpening::find_by_id($jobs_id);
?>
    <div class="col-md-6">
        <label class="form-label">Experience</label>
        <input type="text" class="form-control form-control-lg" name="jobs[experience]" value="<?php echo $jobs->experience ?>">
    </div>
    <div class="col-md-6">
        <label class="form-label">Jobs Title</label>
        <input type="text" class="form-control form-control-lg" name="jobs[job_title]" value="<?php echo $jobs->job_title ?>">
    </div>
     <div class="col-md-6">
        <label class="form-label">Salary</label>
        <input type="text" class="form-control form-control-lg" name="jobs[salary]" value="<?php echo $jobs->salary ?>">
    </div>
     <div class="col-md-6">
        <label class="form-label">Skills</label>
        <input type="text" class="form-control form-control-lg" name="jobs[skills]" value="<?php echo $jobs->skills ?>">
    </div>
     <div class="col-md-6">
        <label class="form-label">Location</label>
        <input type="text" class="form-control form-control-lg" name="jobs[location]" value="<?php echo $jobs->location ?>">
    </div>
    <div class="col-6">
        <label class="form-label">Status</label>
         <select name="jobs[status]" class="form-control form-control-lg" id="">
             <?php if ($jobs->status == 'Y') { echo $Y="Active"; }
                else {
                    echo $Y="Inactice";
                } ?>
            <option value="<?php echo $jobs->status ?>"<?php if($jobs->status == $jobs->status){ echo "selected"; } ?>><?php echo $Y?></option>
            <option value="N">Inactive</option>
             <option value="Y">Active</option>
         </select>
    </div>
     <div class="col-md-6">
        <label class="form-label">Description</label>
        <textarea type="text" class="form-control form-control-lg" name="jobs[description]"><?php echo $jobs->description ?></textarea>
    </div>
   <input type="hidden" name="jobs[date]" value="<?php echo $time ?>">
      
<?php } else { ?>
     
     <div class="col-md-6">
        <label class="form-label">Experience</label>
        <input type="text" class="form-control form-control-lg" name="jobs[experience]">
    </div>
    <div class="col-md-6">
        <label class="form-label">Jobs Title</label>
        <input type="text" class="form-control form-control-lg" name="jobs[job_title]" required>
    </div>
     <div class="col-md-6">
        <label class="form-label">Salary</label>
        <input type="text" class="form-control form-control-lg" name="jobs[salary]">
    </div>
     <div class="col-md-6">
        <label class="form-label">Skills</label>
        <input type="text" class="form-control form-control-lg" name="jobs[skills]">
    </div>
     <div class="col-md-6">
        <label class="form-label">Location</label>
        <input type="text" class="form-control form-control-lg" name="jobs[location]">
    </div>
    <div class="col-6">
        <label class="form-label">Status</label>
         <select name="jobs[status]" class="form-control form-control-lg" id="">
            <option value="">-select-</option>
            <option value="N">Inactive</option>
             <option value="Y">Active</option>
         </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Description</label> 
        <textarea type="text" class="form-control form-control-lg" name="jobs[description]"></textarea>
    </div>
    <input type="hidden" name="jobs[date]" value="<?php echo $time ?>">
<?php } ?>