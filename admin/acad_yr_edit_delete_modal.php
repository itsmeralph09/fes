<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $row['acad_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<div class="row float-left ml-2"><h4 class="modal-title float-left" id="myModalLabel">Edit Class</h4></div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" action="acad_yr_update.php">
				<input type="hidden" class="form-control" name="acad_id" value="<?php echo $row['acad_id']; ?>">
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Year Start</label>
					</div>
					<div class="col-sm-8">
						<input type="number" min="2009" max="2099" step="1" name="year_start" value="<?php echo $row['year_start']; ?>" required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Year End</label>
					</div>
					<div class="col-sm-8">
						<input type="number" min="2009" max="2099" step="1" name="year_end" value="<?php echo $row['year_end']; ?>" required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Level or Year</label>
					</div>
					<div class="col-sm-8">
						<select name="semester" class="form-select form-select-lg" aria-label=".form-select-lg example" required>
							<option value="<?php echo $row['semester']; ?>">
							<?php if($row['semester'] == 1){
								echo "1st Semester";
							}else if ($row['semester'] == 2){
								echo "2nd Semester";
							} else{
								echo "Mid Year";
							} ?>

							</option>
							<option value="1">1st Semester</option>
							<option  value="2">2nd Semester</option>
							<option value="3">Mid Year</option>
						</select>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Section</label>
					</div>
					<div class="col-sm-8">
						<select name="status" class="form-select form-select-lg" aria-label=".form-select-lg example" required>
							<option value="<?php echo $row['status']; ?>"><?php echo ucfirst($row['status']); ?></option>
							<option value="pending">Pending</option>
							<option  value="started">Started</option>
							<option value="closed">Closed</option>
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

<!-- Start -->
<div class="modal fade" id="start_<?php echo $row['acad_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<div class="row float-left ml-2"><h4 class="modal-title float-left" id="myModalLabel">Start Academic Year and Semester</h4></div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <div class="modal-body">	
            	<p class="text-center text-success">Are you sure you want to start this academic year and semester?</p>
				<h5 class="text-center text-secondary">Academic Year: <span class="text-success"><?php echo $row['year_start'].'-'.$row['year_end']; ?></span></h5>
				<h5 class="text-center text-secondary">Semester: <span class="text-success">
					<?php

						if ($row['semester'] == 1) {
							echo '1st Semester';
						} elseif ($row['semester'] == 2) {
							echo '2nd Semester';
						} elseif ($row['semester'] == 3) {
							echo 'Mid-Year';
						}

					?>
						
					</span></h5>
				
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa-solid fa-x mr-1"></i>Cancel</button>
                <a href="acad_yr_delete.php?acad_id=<?php echo $row['acad_id']; ?>" class="btn btn-danger"><i class="fa fa-trash m-1"></i>Yes</a>
            </div>

        </div>
    </div>
</div>

<!-- Start -->
<div class="modal fade" id="stop_<?php echo $row['acad_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<div class="row float-left ml-2"><h4 class="modal-title float-left" id="myModalLabel">Start Academic Year and Semester</h4></div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <div class="modal-body">	
            	<p class="text-center text-danger">Are you sure you want to stop this academic year and semester?</p>
				<h5 class="text-center text-secondary">Academic Year: <span class="text-danger"><?php echo $row['year_start'].'-'.$row['year_end']; ?></span></h5>
				<h5 class="text-center text-secondary">Semester: <span class="text-danger">
					<?php

						if ($row['semester'] == 1) {
							echo '1st Semester';
						} elseif ($row['semester'] == 2) {
							echo '2nd Semester';
						} elseif ($row['semester'] == 3) {
							echo 'Mid-Year';
						}

					?>
						
					</span></h5>
				
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa-solid fa-x mr-1"></i>Cancel</button>
                <a href="acad_yr_delete.php?acad_id=<?php echo $row['acad_id']; ?>" class="btn btn-danger"><i class="fa fa-trash m-1"></i>Yes</a>
            </div>

        </div>
    </div>
</div>


<!-- Delete -->
<div class="modal fade" id="delete_<?php echo $row['acad_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<div class="row float-left ml-2"><h4 class="modal-title float-left" id="myModalLabel">Delete Class</h4></div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <div class="modal-body">	
            	<p class="text-center text-danger">Are you sure you want to delete?</p>
				<h5 class="text-center text-secondary">Academic Year: <span class="text-danger"><?php echo $row['year_start'].'-'.$row['year_end']; ?></span></h5>
				
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa-solid fa-x mr-1"></i>Cancel</button>
                <a href="acad_yr_delete.php?acad_id=<?php echo $row['acad_id']; ?>" class="btn btn-danger"><i class="fa fa-trash m-1"></i>Yes</a>
            </div>

        </div>
    </div>
</div>