<!-- Add New -->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<div class="row float-left ml-2"><h4 class="modal-title float-left" id="myModalLabel">Add New Question</h4></div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>

            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" action="question_add.php">
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Criteria</label>
					</div>
					<div class="col-sm-8">
<?php
// Include the SelectOption class file
require 'fetch_criteria.php';

// Create an instance of the SelectOption class
$selectOption = new SelectOption();

// Get the class options
$criteriaOptions = $selectOption->getCriteriaOptions();

?>
						<select name="criteria_id" class="form-select form-select-lg" aria-label=".form-select-lg example" required>
							<option value="" selected disabled>Select a criteria</option>
						<?php echo $criteriaOptions; ?>
						</select>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Question</label>
					</div>
					<div class="col-sm-8">
						<!-- <input type="text" class="form-control" name="question" required> -->
						<textarea type="text" class="form-control" name="question" rows="3" required></textarea>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Academic Year</label>
					</div>
					<div class="col-sm-8">
<?php

	require '../db/dbconn.php';
	$sql = "SELECT * FROM acad_yr_tbl WHERE acad_id = '$acad_id'";
	$query = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($query);
	$acad = $row['year_start']."-".$row['year_end'];
	$semester = $row['semester'];

	if ($semester == 1) {
		$semester = "1st Semester";
	} else if ($semester == 2) {
		$semester = "2nd Semester";
	} else {
		$semester = "Mid-Year";
	}
	
?>

						<input type="text" class="form-control" name="acad" value="<?php echo $acad; ?>" readonly>
						<input type="text" class="form-control" name="acad_id" value="<?php echo $acad_id; ?>" hidden>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Semester</label>
					</div>
					<div class="col-sm-8">

						<input type="text" class="form-control" name="semester" value="<?php echo $semester; ?>" readonly>
						
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