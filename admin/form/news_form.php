<?php
if (isset($_GET['news_id'])) {
     $news_id = $_GET['news_id'];
     $news = BookNews::find_by_custom_id('news_id',$news_id);
?>
    <div class="col-md-6">
        <label class="form-label">news Title</label>
        <input type="text" class="form-control form-control-lg" name="news[news_title]" value="<?php echo $news->news_title ?>">
    </div>
    <div class="col-md-6">
        <label class="form-label">Sort Order</label>
        <input type="text" class="form-control form-control-lg" name="news[news_sort_order]" value="<?php echo $news->news_sort_order ?>">
    </div>
    <div class="col-6">
        <label class="form-label">Show On Home Page</label>
         <select name="news[news_on_homepage]" class="form-control form-control-lg" id="">
            <option value="<?php echo $news->news_on_homepage ?>"<?php if($news->news_on_homepage == $news->news_on_homepage){ echo "selected"; } ?>><?php echo $news->news_on_homepage ?></option>
            <option value="N">No</option>
             <option value="Y">Yes</option>
         </select>
    </div>
    <div class="col-6">
        <label class="form-label">news Status</label>
         <select name="news[news_status]" class="form-control form-control-lg" id="">
            <option value="<?php echo $news->news_status ?>"<?php if($news->news_status == $news->news_status){ echo "selected"; } ?>><?php echo $news->news_status ?></option>
            <option value="N">Non Active</option>
             <option value="Y">Active</option>
         </select>
    </div>
      
<?php } else { ?>
     
    <div class="col-md-6">
        <label class="form-label">News Title</label>
        <input type="text" class="form-control form-control-lg" name="news[news_title]" placeholder="Enter Title" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Date (yyyy-mm-dd)</label>
        <input type="text" class="form-control form-control-lg" name="news[news_date]" placeholder="Enter Date" required>
    </div>
     <div class="col-6">
        <label class="form-label">News Type</label>
         <select name="news[news_type]" class="form-control form-control-lg" id="">
            <option value="" required>-Select News-</option>
            <option value="N">News</option>
            <option value="E">Events</option>
         </select>
    </div>
    <div class="col-6">
        <label class="form-label">News Status</label>
         <select name="news[news_status]" class="form-control form-control-lg" id="">
            <option value="" required>-Status-</option>
            <option value="Y">Active</option>
            <option value="N">Non Active</option>
         </select>
    </div>
    <div class="col-md-12">
        <label class="form-label">News Image</label>
        <input type="file" class="form-control" name="news_image" placeholder="Enter Title" required>
    </div>
     <div class="col-md-12">
        <label class="form-label">News Detail</label>
        <textarea class="form-control" name="news[news_detail]" placeholder="Enter Details" required></textarea>
    </div>
      <input type="hidden" name="news['news_date']" value="<?php echo $time ?>" >
     <input type="hidden" name="new['news_time']" value="<?php echo $time ?>" >
 
<?php } ?>