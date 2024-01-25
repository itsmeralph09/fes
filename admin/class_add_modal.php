<!-- Add New -->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<div class="row float-left ml-2"><h4 class="modal-title float-left" id="myModalLabel">Add New Class</h4></div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>

            </div>
            <div class="modal-body">
			<div class="container-fluid">

			<form method="POST" action="class_add.php">
<!-- 				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Program</label>
					</div>
					<div class="col-sm-8">
						
						<select name="program_code" id="mod_dropdown" class="form-select form-select-lg" aria-label=".form-select-lg example" required>
							<option value="" selected disabled>Select a program</option>
							<optgroup label="Institute of Computing Studies">
								<option value="BSIT">BSIT</option>
								<option value="BSIS">BSIS</option>
								<option value="BSCS">BSCS</option>
								<option value="ACT">ACT</option>
							</optgroup>
							<optgroup label="Institute of Education">
								<option value="BEED">BEED</option>
								<option value="BCAED">BCAED</option>
								<option value="BCED">BCED</option>
							</optgroup>
						</select>
					</div>
				</div> -->
<!-- 				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Program Name</label>
					</div>
					<div class="col-sm-8">
						<textarea type="text" id="mod_textarea" class="form-control" name="program_name" rows="3" readonly></textarea>
					</div>
				</div> -->
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Program</label>
					</div>
					<div class="col-sm-8">
						<?php
						// Include the SelectOption class file
						require 'fetch_program.php';

						// Create an instance of the SelectOption class
						$selectOption = new SelectOption();

						// Get the class options
						$programOptions = $selectOption->getProgramOptions();
						?>
						<select name="program_id" class="form-select form-select-lg" aria-label=".form-select-lg example" required>
							<option value="" selected disabled>Select a program</option>
							<?php echo $programOptions; ?>
						</select>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Level or Year</label>
					</div>
					<div class="col-sm-8">
						<select name="level" class="form-select form-select-lg" aria-label=".form-select-lg example" required>
							<option value="" selected disabled>Select a year level</option>
							<option value="1">1st Year</option>
							<option  value="2">2nd Year</option>
							<option value="3">3rd Year</option>
							<option  value="4">4th Year</option>
							<option  value="11">Grade 11</option>
							<option  value="12">Grade 12</option>
						</select>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Section</label>
					</div>
					<div class="col-sm-8">
						<select name="section" class="form-select form-select-lg" aria-label=".form-select-lg example" required>
							<option value="" selected disabled>Select a section</option>
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
                <button type="submit" name="submit" class="btn btn-primary"><i class="fa-solid fa-check mr-1"></i></span>Save</a>
			</form>
            </div>

        </div>
    </div>
</div>