<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $row['faculty_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<div class="row float-left ml-2"><h4 class="modal-title float-left" id="myModalLabel">Edit Faculty</h4></div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" action="faculty_update.php">
				<input type="hidden" class="form-control" name="faculty_id" value="<?php echo $row['faculty_id']; ?>">
				<input type="hidden" class="form-control" name="user_id" value="<?php echo $row['user_id']; ?>">
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">School ID</label>
					</div>
					<div class="col-sm-8">
						<input type="hidden" class="form-control" name="old_school_id" value="<?php echo $row['school_id']; ?>">
						<input type="text" class="form-control" name="school_id" value="<?php echo $row['school_id']; ?>">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">First Name</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="first_name" value="<?php echo $row['first_name']; ?>">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Middle Name</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="middle_name" value="<?php echo $row['middle_name']; ?>">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Last Name</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="last_name" value="<?php echo $row['last_name']; ?>">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Extension Name</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="ext_name" value="<?php echo $row['ext_name']; ?>">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Email</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="email" value="<?php echo $row['email']; ?>">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Department</label>
					</div>
					<div class="col-sm-8">
						<select name="department" required>
							<?php

                                    $sqlFetchDept = "SELECT * FROM department_tbl";
                                    $resultFetchDept = $conn->query($sqlFetchDept);

                                    if ($resultFetchDept->num_rows > 0) {
                                        
                                        while ($rowFetchDept = $resultFetchDept->fetch_assoc()) {

                                            $department_code = $rowFetchDept['department_code'];
                                            $department_name = ucwords($rowFetchDept['department_name']);
                                            $selected = ($department_code == $row['department']) ? 'selected' : '';
                                            echo "<option value='$department_code' $selected>$department_name</option>";
                                        }
                                        
                                    } else{
                                        echo "<option value='none' selected disabled>No department available</option>";
                                    }

                            ?>
						</select>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Password</label>
					</div>
					<div class="col-sm-8">
						<input type="password" class="form-control" id="password" name="password" >
						<small class="font-italic text-gray-ralph">*Leave blank if don't want to change!</small>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Confirm Password</label>
					</div>
					<div class="col-sm-8">
						<input type="password" class="form-control" id="confirm_password" name="confirm_password" >
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
<div class="modal fade" id="delete_<?php echo $row['faculty_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<div class="row float-left ml-2"><h4 class="modal-title float-left" id="myModalLabel">Delete Student</h4></div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <div class="modal-body">	
            	<p class="text-center text-danger">Are you sure you want to delete?</p>
				<h5 class="text-center text-secondary">Full Name: <span class="text-danger"><?php echo $row['first_name'].' '.$row['last_name']; ?></span></h5>
				<h5 class="text-center text-secondary">School ID: <span class="text-danger"><?php echo $row['school_id']?></span></h5>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa-solid fa-x mr-1"></i>Cancel</button>
                <a href="faculty_delete.php?faculty_id=<?php echo $row['faculty_id']; ?>&school_id=<?php echo $row['school_id']; ?>" class="btn btn-danger"><i class="fa fa-trash m-1"></i>Yes</a>
            </div>

        </div>
    </div>
</div>