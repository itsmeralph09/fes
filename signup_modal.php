<!-- Add New -->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<div class="row float-left ml-2"><h4 class="modal-title float-left" id="myModalLabel">Create an Account</h4></div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>

            </div>
            <div class="modal-body">
			<div class="container-fluid">


			<form method="POST" action="signup.php" oninput='confirm_password.setCustomValidity(password.value != confirm_password.value ? "Passwords do not match." : "")'>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">School ID</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="school_id" required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">First Name</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="first_name" required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Middle Name</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="middle_name">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Last Name</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="last_name" required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Extension Name</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="ext_name">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Program and Class Section</label>
					</div>
					<div class="col-sm-8">

<?php
// Include the SelectOption class file
require 'fetch_class.php';

// Create an instance of the SelectOption class
$selectOption = new SelectOption();

// Get the class options
$classOptions = $selectOption->getClassOptions();

?>


						<select name="class_id" class="form-select form-select-lg" aria-label=".form-select-lg example" required>
							<option value="" selected disabled>Select a class section</option>
						<?php echo $classOptions; ?>
						</select>
					</div>
				</div>



				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Email</label>
					</div>
					<div class="col-sm-8">
						<input type="email" class="form-control" name="email" required>
						<small class="text-warning float-left">*Use your PCB email address!</small>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Password</label>
					</div>
					<div class="col-sm-8">
						<input type="password" class="form-control" id="password" name="password" required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Confirm Password</label>
					</div>
					<div class="col-sm-8">
						<input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
					</div>
				</div>
            </div> 
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" name="submit" class="btn btn-primary">Signup</button>
			</form>
            </div>

        </div>
    </div>
</div>