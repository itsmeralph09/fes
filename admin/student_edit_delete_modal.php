<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $row['student_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<div class="row float-left ml-2"><h4 class="modal-title float-left" id="myModalLabel">Edit Student</h4></div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" action="student_update.php">
				<input type="hidden" class="form-control" name="student_id" value="<?php echo $row['student_id']; ?>">
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">School ID</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="school_id" value="<?php echo $row['school_id']; ?>" readonly>
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
						<label class="control-label modal-label">Class</label>
					</div>
					<div class="col-sm-8">

<?php

// Function to retrieve values and mark the selected option
function generateDropdown($conn, $selectedValue = null)
{
    $sql = "SELECT *,
    CONCAT(program_code, ' ', level, '-', section) AS class_name
    FROM class_tbl";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<select class="form-control" name="class_id">';
        while ($row = $result->fetch_assoc()) {
            $class_id = $row['class_id'];
            $class_name = $row['class_name'];
            $selected = ($class_id == $selectedValue) ? 'selected' : '';
            echo "<option value='$class_id' $selected>$class_name</option>";
        }
        echo '</select>';
    } else {
        echo 'No options available.';
    }
}

?>
            <?php

                $selectedValue = $row['class_id'];
                generateDropdown($conn, $selectedValue);
            ?>

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
<div class="modal fade" id="delete_<?php echo $row['student_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                <a href="student_delete.php?student_id=<?php echo $row['student_id']; ?>&school_id=<?php echo $row['school_id']; ?>" class="btn btn-danger"><i class="fa fa-trash m-1"></i>Yes</a>
            </div>

        </div>
    </div>
</div>