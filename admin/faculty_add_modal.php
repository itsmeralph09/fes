<!-- Add New -->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<div class="row float-left ml-2"><h4 class="modal-title float-left" id="myModalLabel">Add New Faculty</h4></div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>

            </div>
            <div class="modal-body">
			<div class="container-fluid">


			<form method="POST" action="faculty_add.php" oninput='confirm_password.setCustomValidity(password.value != confirm_password.value ? "Passwords do not match." : "")'>
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
						<label class="control-label modal-label">Email</label>
					</div>
					<div class="col-sm-8">
						<input type="email" class="form-control" name="email" required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Department</label>
					</div>
					<div class="col-sm-8">
						<select name="department" required>
							<option value="" disabled selected>Select a department</option>
							<option value="ics">Institute of Computing Studies</option>
							<option value="ied">Institute of Education</option>
							<option value="shs">Senior High School</option>
						</select>
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
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa-solid fa-x mr-1"></i>Cancel</button>
                <button type="submit" name="submit" class="btn btn-primary"><i class="fa-solid fa-check mr-1"></i></span>Save</a>
			</form>
            </div>

        </div>
    </div>
</div>