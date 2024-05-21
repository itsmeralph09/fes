<!-- Add New -->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<div class="row float-left ml-2"><h4 class="modal-title float-left" id="myModalLabel">Add New Course</h4></div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>

            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" action="course_add.php">
				<input type="hidden" class="form-control" name="acad_id" value="<?php echo $acad_id; ?>" required>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Course Code</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="course_code" required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Course Name</label>
					</div>
					<div class="col-sm-8">
						<textarea type="text" id="mod_textarea" class="form-control" name="course_name" rows="3" required></textarea>
					</div>
				</div>				
            </div> 
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa-solid fa-x mr-1"></i>Cancel</button>
                <button type="submit" name="submit" class="btn btn-primary"><i class="fa-solid fa-check mr-1"></i></span>Save</a>
			</form>
            </div>

        </div>
    </div>
</div>