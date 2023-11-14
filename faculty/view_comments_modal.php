<!-- View Comments -->
<div class="modal fade" id="view_comments<?php echo $row['evalID']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<div class="row float-left ml-2"><h4 class="modal-title float-left" id="myModalLabel">Comments</h4></div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <div class="modal-body">

<div class="row d-flex justify-content-center">
  <div class="col-md-12 col-lg-12">
    <div class="card shadow-0 border" style="background-color: #f0f2f5;">
      <div class="card-body p-4">            	
<?php
    require '../db/dbconn.php';
    
	$sqlQueryComments = "SELECT student_id, comments, CONCAT(acad_id, '-', faculty_id, '-', course_id, '-', class_id) AS evalID
        FROM eval_tbl
        WHERE CONCAT(acad_id, '-', faculty_id, '-', course_id, '-', class_id) = '" . $row['evalID'] . "'";

    $queryComments = mysqli_query($conn, $sqlQueryComments);
    while($rowQueryComments = mysqli_fetch_assoc($queryComments)){
      $random_id = rand(1,9999).$rowQueryComments['student_id'];
?>

        <div class="card mb-2 rounded">
          <div class="card-body">
            <p class="text-dark font-italic">"<?php echo $rowQueryComments['comments']; ?>"</p>

            <div class="d-flex justify-content-between">
              <div class="d-flex flex-row align-items-center">
                <img src="https://api.multiavatar.com/<?php echo $random_id; ?>.svg" alt="avatar" width="25"
                  height="25" />
                <p class="small mb-0 ms-2 ml-2">Anonymous</p>
              </div>
            </div>
          </div>
        </div>

<?php } ?>      
	 </div>
    </div>
  </div>
</div>          	
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa-solid fa-x mr-1"></i>Close</button>
            </div>

        </div>
    </div>
</div>
