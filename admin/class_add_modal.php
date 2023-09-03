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
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Program Code</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="program_code" required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Program Name</label>
					</div>
					<div class="col-sm-8">
						<textarea type="text" class="form-control" name="program_name" rows="3" required></textarea>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Level or Year</label>
					</div>
					<div class="col-sm-8">
						<select name="level" class="form-select form-select-lg" aria-label=".form-select-lg example" required>
							<option value="1">1st Year</option>
							<option  value="2">2nd Year</option>
							<option value="3">3rd Year</option>
							<option  value="4">4th Year</option>
						</select>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Section</label>
					</div>
					<div class="col-sm-8">
						<select name="section" class="form-select form-select-lg" aria-label=".form-select-lg example" required>
							<option value="A">A</option>
							<option  value="B">B</option>
							<option value="C">C</option>
							<option  value="D">D</option>
						</select>
					</div>
				</div>
<!-- 				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Description</label>
					</div>
					<div class="col-sm-8">
						<textarea type="text" class="form-control" name="description" rows="3"></textarea>
					</div>
				</div> -->
				
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