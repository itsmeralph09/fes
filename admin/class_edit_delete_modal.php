<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $row['class_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<div class="row float-left ml-2"><h4 class="modal-title float-left" id="myModalLabel">Edit Class</h4></div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" action="class_update.php">
				<input type="hidden" class="form-control" name="class_id" value="<?php echo $row['class_id']; ?>">
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Program Code</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="program_code" value="<?php echo $row['program_code']; ?>">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Program Name</label>
					</div>
					<div class="col-sm-8">
						<textarea type="text" class="form-control" name="program_name" rows="3"><?php echo $row['program_name']; ?></textarea>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Level or Year</label>
					</div>
					<div class="col-sm-8">
						<select name="level" class="form-select form-select-lg" aria-label=".form-select-lg example" required>
							<option value="<?php echo $row['level']; ?>" selected>
								<?php 
									if ($row['level'] == 1) {
										echo $row['level']."st Year"; 
									}elseif ($row['level'] == 2) {
										echo $row['level']."nd Year"; 
									}elseif ($row['level'] == 3) {
										echo $row['level']."rd Year"; 
									}elseif ($row['level'] == 4) {
										echo $row['level']."th Year"; 
									}
								?>
									
								</option>
							<option value="1">1st Year</option>
							<option value="2">2nd Year</option>
							<option value="3">3rd Year</option>
							<option value="4">4th Year</option>
						</select>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Section</label>
					</div>
					<div class="col-sm-8">
						<select name="section" class="form-select form-select-lg" aria-label=".form-select-lg example" required>
							<option value="<?php echo $row['section']; ?>" selected><?php echo $row['section']; ?></option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="C">C</option>
							<option value="D">D</option>
						</select>
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
<div class="modal fade" id="delete_<?php echo $row['class_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<div class="row float-left ml-2"><h4 class="modal-title float-left" id="myModalLabel">Delete Class</h4></div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <div class="modal-body">	
            	<p class="text-center text-danger">Are you sure you want to delete?</p>
				<h5 class="text-center text-secondary">Class Name: <span class="text-danger"><?php echo $row['program_code'].' '.$row['level'].'-'.$row['section']; ?></span></h5>
				
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa-solid fa-x mr-1"></i>Cancel</button>
                <a href="class_delete.php?class_id=<?php echo $row['class_id']; ?>" class="btn btn-danger"><i class="fa fa-trash m-1"></i>Yes</a>
            </div>

        </div>
    </div>
</div>