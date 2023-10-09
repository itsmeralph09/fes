<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $row['program_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<div class="row float-left ml-2"><h4 class="modal-title float-left" id="myModalLabel">Edit Program</h4></div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" action="program_update.php">
				<input type="hidden" class="form-control" name="program_id" value="<?php echo $row['program_id']; ?>">
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Program Code</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="program_code" value="<?php echo strtoupper($row['program_code']); ?>">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Program Name</label>
					</div>
					<div class="col-sm-8">
						<textarea type="text" class="form-control" name="program_name" rows="4"><?php echo ucwords($row['program_name']); ?></textarea>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Class</label>
					</div>
					<div class="col-sm-8">
						<select class="form-control" name="program_ids">
						<?php
							    $sqlFetchDepartment = "SELECT * FROM department_tbl";
							    $resultFetchDepartment = $conn->query($sqlFetchDepartment);

							    if ($resultFetchDepartment->num_rows > 0) {
							        
							        while ($rowFetchDepartment = $resultFetchDepartment->fetch_assoc()) {

							            $department_ids = $rowFetchDepartment['department_id'];
							            $department = strtoupper($rowFetchDepartment['department_code']) . " - " . ucwords($rowFetchDepartment['department_name']);
							            $selected = ($department_ids == $department_id) ? 'selected' : '';

							            echo "<option value='$department_ids' $selected>$department</option>";
							        }
							        
							    } else{
							    	echo "<option value='none' selected disabled>No department available</option>";
							    }
						?>
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
<div class="modal fade" id="delete_<?php echo $row['program_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<div class="row float-left ml-2"><h4 class="modal-title float-left" id="myModalLabel">Delete Program</h4></div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <div class="modal-body">	
            	<p class="text-center text-danger">Are you sure you want to delete?</p>
				<h5 class="text-center text-secondary">Program: <span class="text-danger"><?php echo strtoupper($row['program_code']).' - '.ucwords($row['program_name']); ?></span></h5>
				
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa-solid fa-x mr-1"></i>Cancel</button>
                <a href=program_delete.php?program_id=<?php echo $row['program_id']; ?>" class="btn btn-danger"><i class="fa fa-trash m-1"></i>Yes</a>
            </div>

        </div>
    </div>
</div>