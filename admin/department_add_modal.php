<!-- Add New -->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<div class="row float-left ml-2"><h4 class="modal-title float-left" id="myModalLabel">Add New Department</h4></div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>

            </div>
            <div class="modal-body">
			<div class="container-fluid">

			<form method="POST" action="program_add.php">
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Department Code</label>
					</div>
					<div class="col-sm-8">
						<!-- <input type="text" class="form-control" name="program_code" required> -->
						<input type="text" name="department_code" id="mod_dropdown" class="form-control" aria-label=".form-select-lg example" required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Department Name</label>
					</div>
					<div class="col-sm-8">
						<textarea type="text" id="mod_textarea" class="form-control" name="program_name" rows="4"></textarea>
					</div>
				</div>
<!--  				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Department</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="department" required>
					</div>
				</div>  -->
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