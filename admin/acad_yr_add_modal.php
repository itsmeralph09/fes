<!-- Add New -->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<div class="row float-left ml-2"><h4 class="modal-title float-left" id="myModalLabel">Add New Academic Year</h4></div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>

            </div>
            <div class="modal-body">
			<div class="container-fluid">


			<form method="POST" action="acad_yr_add.php">
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Year Start</label>
					</div>
					<div class="col-sm-8">
						<input type="number" min="2009" max="2099" step="1" name="year_start" required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Year End</label>
					</div>
					<div class="col-sm-8">
						<input type="number" min="2009" max="2099" step="1" name="year_end" required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Semester</label>
					</div>
					<div class="col-sm-8">
						<select name="semester" class="form-select form-select-lg" aria-label=".form-select-lg example" required>
							<option value="1">1st Semester</option>
							<option  value="2">2nd Semester</option>
							<option value="3">Mid Year</option>
						</select>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Evaluation Status</label>
					</div>
					<div class="col-sm-8">
						<select name="status" class="form-select form-select-lg" aria-label=".form-select-lg example" required>
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
                <button type="submit" name="submit" class="btn btn-primary"><i class="fa-solid fa-check mr-1"></i></span>Save</a>
			</form>
            </div>

        </div>
    </div>
</div>