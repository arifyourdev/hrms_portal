<?php
if (isset($_GET['id'])) {
     $board_id = $_GET['id'];
     $board = Board::find_by_id($board_id);
?>
    <div class="col-md-6">
        <label class="form-label">Board Title</label>
        <input type="text" class="form-control form-control-lg" name="board[board_title]" value="<?php echo $board->board_title ?>">
    </div>
    
     <div class="col-6">
        <label class="form-label">Board Status</label>
         <select name="board[board_status]" class="form-control form-control-lg" id="">
             <?php if ($board->board_status == 'Y') echo $Y="Active";
                else {
                    echo $Y="Inactive";
                } ?>
            <option value="<?php echo $board->board_status ?>"<?php if($board->board_status == $board->board_status){ echo "selected"; } ?>><?php echo $Y ?></option>
            <option value="N">Inactive</option>
             <option value="Y">Active</option>
         </select>
    </div>
      
<?php } else { ?>
     
    <div class="col-md-6">
        <label class="form-label">Board Title</label>
        <input type="text" class="form-control form-control-lg" name="board[board_title]" placeholder="Enter Level Title" required>
    </div>
     
    <div class="col-6">
        <label class="form-label">Board Status</label>
         <select name="board[board_status]" class="form-control form-control-lg" id="">
            <option value="" required>-Status-</option>
            <option value="Y">Active</option>
            <option value="N">Inactive</option>
         </select>
    </div>
    

<?php } ?>