<!-- View Comments -->
<div class="modal fade" id="view_comments<?php echo $acad_id; ?>" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<div class="row float-left ml-2"><h6 class="modal-title float-left" id="myModalLabel">Comments for <span class="font-italic"><?php echo $acad_year.' '.$sem ?></span></h6></div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <div class="modal-body">

<div class="row d-flex justify-content-center">
  <div class="col-md-12 col-lg-12">
    <div class="card shadow-0 border" style="background-color: #f0f2f5;">
      <div class="card-body p-4">            	
<?php
    require '../db/dbconn.php';

    $logged_in_faculty_id = $_SESSION['faculty_id'];

    
	$sqlQueryComments = "SELECT *  FROM `eval_tbl` WHERE faculty_id='$logged_in_faculty_id' AND acad_id = '$acad_id'";

    $queryComments = mysqli_query($conn, $sqlQueryComments);
    while($rowQueryComments = mysqli_fetch_assoc($queryComments)){
      $random_id = rand(1,9999).$rowQueryComments['student_id'];
?>

        <div class="card mb-2 rounded">
          <div class="card-body">
            <p class="text-dark font-italic">"<?php echo $rowQueryComments['comments']; ?>"</p>
          </div>
        </div>

<?php } ?>      
	 </div>
    </div>
  </div>
</div>          	
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><i class="fa-solid fa-x mr-1"></i>Close</button>
            </div>

        </div>
    </div>
</div>
