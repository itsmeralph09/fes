<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $row['course_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<div class="row float-left ml-2"><h4 class="modal-title float-left" id="myModalLabel">Edit Course</h4></div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" action="course_update.php">
				<input type="hidden" class="form-control" name="course_id" value="<?php echo $row['course_id']; ?>">
				<input type="hidden" class="form-control" name="acad_id" value="<?php echo $acad_id; ?>">
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Course Code</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="course_code" value="<?php echo $row['course_code']; ?>">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Course Name</label>
					</div>
					<div class="col-sm-8">
						<textarea type="text" class="form-control" name="course_name" rows="3"><?php echo $row['course_name']; ?></textarea>
					</div>
				</div>
            </div> 
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa-solid fa-x mr-1"></i>Cancel</button>
                <button type="submit" name="edit" class="btn btn-success"><i class="fa-solid fa-floppy-disk mr-1"></i>Update</a>
			</form>
            </div>

        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete_<?php echo $row['course_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<div class="row float-left ml-2"><h4 class="modal-title float-left" id="myModalLabel">Delete Class</h4></div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <div class="modal-body">	
            	<p class="text-center text-danger">Are you sure you want to delete?</p>
				<h5 class="text-center text-secondary">Course Code: <span class="text-danger"><?php echo $row['course_code']; ?></span></h5>
				<h5 class="text-center text-secondary">Course Name: <span class="text-danger"><?php echo $row['course_name']; ?></span></h5>
				
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa-solid fa-x mr-1"></i>Cancel</button>
                <a href="course_delete.php?course_id=<?php echo $row['course_id']; ?>" class="btn btn-danger"><i class="fa fa-trash m-1"></i>Yes</a>
            </div>

        </div>
    </div>
</div>