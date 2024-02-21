<!-- Delete -->
<div class="modal fade" id="delete_<?php echo $row['eval_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<div class="row float-left ml-2"><h4 class="modal-title float-left" id="myModalLabel">Delete Submitted Evaluation</h4></div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <div class="modal-body">	
            	<h4 class="text-center text-danger">Are you sure you want to delete submitted evaluation? </h4>
				<h6 class="text-left text-secondary">Name: <span class="text-danger"><?php echo $row['student_name']; ?></span></h6>
                <h6 class="text-left text-secondary">Course: <span class="text-danger"><?php echo $row['course']; ?></span></h6>
				<h6 class="text-left text-secondary">Class: <span class="text-danger"><?php echo $row['class']; ?></span></h6>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa-solid fa-x mr-1"></i>Cancel</button>
                <a href="submitted_evaluation_delete.php?acad_id=<?php echo $acad_id; ?>&eval_id=<?php echo $row['eval_id']; ?>" class="btn btn-danger"><i class="fa fa-trash m-1" id="delete_btn"></i>Yes</a>
            </div>
        </div>
    </div>
</div>