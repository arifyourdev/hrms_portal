<?php
if (isset($_GET['id'])) {
     $jobs_id = $_GET['id'];
     $jobs = BookJob::find_by_custom_id('jobs_id',$jobs_id);
?>
    <div class="col-md-6">
        <label class="form-label">Jobs Title</label>
        <input type="text" class="form-control form-control-lg" name="jobs[jobs_title]" value="<?php echo $jobs->jobs_title ?>">
    </div>
    <div class="col-6">
        <label class="form-label">Jobs Type</label>
         <select name="jobs[jobs_type]" class="form-control form-control-lg" id="">
            <option value="<?php echo $jobs->jobs_type ?>"<?php if($jobs->jobs_type == $jobs->jobs_type){ echo "selected"; } ?>><?php echo $jobs->jobs_type ?></option>
		    <option value="11">Freelance</option>
			<option value="12">Full-Time</option>
			<option value="13">On short-term contract</option>
			<option value="14">On 3 months short-term contract</option>
			<option value="15">On 6 months short-term contract</option>
         </select>
    </div>
    <div class="row mt-3">
      <div class="col-6">
         <label class="form-label">Expience From</label>
         <select name="jobs[jobs_from_exp]" class="form-control form-control-lg" id="">
             <option value="<?php echo $jobs->jobs_from_exp ?>"<?php if($jobs->jobs_from_exp == $jobs->jobs_from_exp){ echo "selected"; } ?>><?php echo $jobs->jobs_from_exp ?></option>
            <option selected="selected" value="0">Fresher</option>
			<option value="1">1 Year</option>
			<option value="2">2 Years</option>
			<option value="3">3 Years</option>
			<option value="4">4 Years</option>
			<option value="5">5 Years</option>
			<option value="6">6 Years</option>
			<option value="7">7 Years</option>
			<option value="8">8 Years</option>
			<option value="9">9 Years</option>
			<option value="10">10 Years</option>
			<option value="11">11 Years</option>
			<option value="12">12 Years</option>
			<option value="13">13 Years</option>
			<option value="14">14 Years</option>
			<option value="15">15 Years</option>
			<option value="99">15+ Years</option>
         </select>
    </div>
    <div class="col-6">
        <label class="form-label">To</label>
          <select name="jobs[jobs_to_exp]" class="form-control form-control-lg" id="">
            <option value="<?php echo $jobs->jobs_to_exp ?>"<?php if($jobs->jobs_to_exp == $jobs->jobs_to_exp){ echo "selected"; } ?>><?php echo $jobs->jobs_to_exp ?></option>
		    <option selected="selected" value="0">Fresher</option>
			<option value="1">1 Year</option>
			<option value="2">2 Years</option>
			<option value="3">3 Years</option>
			<option value="4">4 Years</option>
			<option value="5">5 Years</option>
			<option value="6">6 Years</option>
			<option value="7">7 Years</option>
			<option value="8">8 Years</option>
			<option value="9">9 Years</option>
			<option value="10">10 Years</option>
			<option value="11">11 Years</option>
			<option value="12">12 Years</option>
			<option value="13">13 Years</option>
			<option value="14">14 Years</option>
			<option value="15">15 Years</option>
			<option value="99">15+ Years</option>
         </select>
    </div>
    </div>
    <div class="col-6">
        <label class="form-label">Jobs Department</label>
         <select name="jobs[jobs_department]" class="form-control form-control-lg" id="">
            <option value="<?php echo $jobs->jobs_department ?>"<?php if($jobs->jobs_department == $jobs->jobs_department){ echo "selected"; } ?>><?php echo $jobs->jobs_department ?></option>
            <option value="">-Department-</option>
		    <option value="Accounts">Accounts</option>
			<option value="Customer Services">Customer Services</option>
			<option value="Editorial">Editorial</option>
			<option value="Human Resource">Human Resource</option>
			<option value="IT">IT</option>
			<option value="Operations">Operations</option>
			<option value="Production">Production</option>
			<option value=">Sales  Marketing">Sales &amp; Marketing</option>
			<option value="Support Services">Support Services</option>
         </select>
    </div>
    <div class="col-6">
        <label class="form-label">Jobs Qualification</label>
         <select name="jobs[jobs_qualification]" class="form-control form-control-lg" id="">
            <option value="<?php echo $jobs->jobs_qualification ?>"<?php if($jobs->jobs_qualification == $jobs->jobs_qualification){ echo "selected"; } ?>><?php echo $jobs->jobs_qualification ?></option>
            <option value="">-Qualification-</option>
		    <option value="31">Graduation</option>
			<option value="32">Post Graduation</option>
			<option value="33">Others</option>
         </select>
    </div>
    <div class="col-6">
        <label class="form-label">Jobs Status</label>
         <select name="jobs[jobs_status]" class="form-control form-control-lg" id="">
             <?php if ($jobs->jobs_status == 'Y') echo $Y="Active";
                else {
                    echo $Y="Inactive";
                } ?>
             <option value="<?php echo $jobs->jobs_status ?>"<?php if($jobs->jobs_status == $jobs->jobs_status){ echo "selected"; } ?>><?php echo $Y ?></option>
            <option value="Y">Active</option>
            <option value="N">Inactive</option>
         </select>
    </div>
     <div class="col-6">
        <label class="form-label">Job Specialization</label>
        <textarea type="text" class="form-control form-control-lg" name="jobs[jobs_specialization]" value="" placeholder="Enter Specialization"><?php echo $jobs->jobs_specialization?></textarea>
    </div>
     <div class="col-12">
        <label class="form-label">Job Details</label>
        <textarea type="text" class="form-control form-control-lg" name="jobs[jobs_detail]" placeholder="Enter Jobs Details"><?php echo $jobs->jobs_detail?></textarea>
    </div>
     <input type="hidden" name"jobs[jobs_post_date]" value="<?php echo $time; ?>">
      
<?php } else { ?>
     
    <div class="col-md-6">
        <label class="form-label">Jobs Title</label>
        <input type="text" class="form-control form-control-lg" name="jobs[jobs_title]" placeholder="Enter Title" required>
    </div>
    
      <div class="col-6">
        <label class="form-label">Jobs Type</label>
         <select name="jobs[jobs_type]" class="form-control form-control-lg" id="">
            <option value="">-Type-</option>
		    <option value="11">Freelance</option>
			<option value="12">Full-Time</option>
			<option value="13">On short-term contract</option>
			<option value="14">On 3 months short-term contract</option>
			<option value="15">On 6 months short-term contract</option>
         </select>
    </div>
    <div class="row mt-3">
      <div class="col-6">
         <label class="form-label">Expience From</label>
         <select name="jobs[jobs_from_exp]" class="form-control form-control-lg" id="">
            <option value="" required>-From-</option>
            <option selected="selected" value="0">Fresher</option>
			<option value="1">1 Year</option>
			<option value="2">2 Years</option>
			<option value="3">3 Years</option>
			<option value="4">4 Years</option>
			<option value="5">5 Years</option>
			<option value="6">6 Years</option>
			<option value="7">7 Years</option>
			<option value="8">8 Years</option>
			<option value="9">9 Years</option>
			<option value="10">10 Years</option>
			<option value="11">11 Years</option>
			<option value="12">12 Years</option>
			<option value="13">13 Years</option>
			<option value="14">14 Years</option>
			<option value="15">15 Years</option>
			<option value="99">15+ Years</option>
         </select>
    </div>
    <div class="col-6">
        <label class="form-label">To</label>
          <select name="jobs[jobs_to_exp]" class="form-control form-control-lg" id="">
            <option value="">-To-</option>
		    <option selected="selected" value="0">Fresher</option>
			<option value="1">1 Year</option>
			<option value="2">2 Years</option>
			<option value="3">3 Years</option>
			<option value="4">4 Years</option>
			<option value="5">5 Years</option>
			<option value="6">6 Years</option>
			<option value="7">7 Years</option>
			<option value="8">8 Years</option>
			<option value="9">9 Years</option>
			<option value="10">10 Years</option>
			<option value="11">11 Years</option>
			<option value="12">12 Years</option>
			<option value="13">13 Years</option>
			<option value="14">14 Years</option>
			<option value="15">15 Years</option>
			<option value="99">15+ Years</option>
         </select>
    </div>
    </div>
    <div class="col-6">
        <label class="form-label">Jobs Department</label>
         <select name="jobs[jobs_department]" class="form-control form-control-lg" id="">
            <option value="">-Department-</option>
		    <option value="Accounts">Accounts</option>
			<option value="Customer Services">Customer Services</option>
			<option value="Editorial">Editorial</option>
			<option value="Human Resource">Human Resource</option>
			<option value="IT">IT</option>
			<option value="Operations">Operations</option>
			<option value="Production">Production</option>
			<option value=">Sales  Marketing">Sales &amp; Marketing</option>
			<option value="Support Services">Support Services</option>
         </select>
    </div>
    <div class="col-6">
        <label class="form-label">Jobs Qualification</label>
         <select name="jobs[jobs_qualification]" class="form-control form-control-lg" id="">
            <option value="">-Qualification-</option>
		    <option value="31">Graduation</option>
			<option value="32">Post Graduation</option>
			<option value="33">Others</option>
         </select>
    </div>
    <div class="col-6">
        <label class="form-label">Jobs Status</label>
         <select name="jobs[jobs_status]" class="form-control form-control-lg" id="">
            <option value="" required>-Status-</option>
            <option value="Y">Active</option>
            <option value="N">Inactivee</option>
         </select>
    </div>
     <div class="col-6">
        <label class="form-label">Job Specialization</label>
        <textarea type="text" class="form-control form-control-lg" name="jobs[jobs_specialization]" placeholder="Enter Specialization"></textarea>
    </div>
     <div class="col-12">
        <label class="form-label">Job Details</label>
        <textarea type="text" class="form-control form-control-lg" name="jobs[jobs_detail]" placeholder="Enter Jobs Details"></textarea>
    </div>
    <input type="hidden" name"jobs[jobs_post_date]" value="<?php echo $time; ?>">

<?php } ?>