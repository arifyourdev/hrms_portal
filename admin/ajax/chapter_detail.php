<?php
require_once "../private/initialize.php";

$user_id = $_SESSION['user_id'];
$user_master = BookUserMaster::find_by_custom_id('user_id', $user_id);
$user_profile = BookMaster::find_by_book_id($user_id);

if (is_post_request()) {
    $chapter = BookChapterLog::find_book_chapter($_POST['id']);
?>

          
         <div class="modal-header">
            <h4 class="modal-title">Worksheets & WorkSheets Answer</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
    
          <!-- Modal body -->
          <div class="modal-body" action="album">
             <form method="post" enctype= multipart/form-data>
                <div class="row g-3">
                 <div class="col-3">
                            <label class="form-label">Chapter</label>
                            <input type="text" class="form-control" name="chapter[clog_chapter_id]">
                        </div>
                        <input type="hidden" name="chapter[clog_book_id]" value="<?php echo $_POST['id'] ?>">
                        <div class="col-3"> 
                            <label class="form-label">Worksheet</label>
                            <input type="file" class="form-control" name="clog_worksheet">
                        </div>
                         <div class="col-3">  
                            <label class="form-label">Worksheet+Ans</label>
                            <input type="file" class="form-control" name="clog_worksheet_ans">
                        </div>
                         <div class="col-3"> 
                            <label class="form-label">Stepwise Solution</label>
                            <input type="file" class="form-control" name="clog_stepwise">
                        </div>
                        <input type="hidden" name="clog_sort_order" value="">
                       <div class="mt-3">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
              </form>
              
    
                     <div class="card-body">
                                <table class="table myDataTable2 table-hover align-middle mb-0 card-table">
                                    <thead>
                                        <tr>
                                            <th>Sn</th>
                                            <th>Chapter Name</th>
                                            <th>Sort Order</th>
                                            <th>Worksheet</th>
                                            <th>Worksheet Ans</th>
                                            <th >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php $all_worksheets = BookChapterLog::find_by_chapter_worksheet($_POST['id']);
                                            $s = 1;
                                          foreach($all_worksheets as $c){?> 
                                            <tr>
                                                <td><?php echo $s; ?></td>
                                                <td><span><?php echo substr($c->clog_chapter_id,0,15) ?></span></td>
                                                <td><input type="number" name="clog_sort_order" value="<?php echo $c->clog_sort_order?>" style="width:50px"></td>
                                                 <td><a href="images/book_brochures/<?php echo $c->clog_worksheet?>"><?php echo $c->clog_worksheet ?></a></td>
                                                 <td>
                                                 <a href="images/book_brochures/<?php echo $c->clog_worksheet_ans?>"><?php echo $c->clog_worksheet_ans ?></a>
                                                 </td>
                                                <td>
                                                    <button type="button" id="<?php echo $c->clog_id ?>" class="btn btn-sm btn-outline-danger clog_id_delete"><i class="fa fa-trash-o"></i></button>
                                                </td>
                                            </tr>
                                        <?php $s++;
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                  
              
          </div>
       
<?php } ?>