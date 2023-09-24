<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $row['question_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<div class="row float-left ml-2"><h4 class="modal-title float-left" id="myModalLabel">Edit Question</h4></div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" action="question_update.php">
				<input type="hidden" class="form-control" name="question_id" value="<?php echo $row['question_id']; ?>">
                <input type="hidden" class="form-control" name="acad_id" value="<?php echo $row['acad_id']; ?>">
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Question</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="question" value="<?php echo $row['question']; ?>">
					</div>
				</div>
                <div class="row form-group">
                    <div class="col-sm-4">
                        <label class="control-label modal-label">Criteria</label>
                    </div>
                    <div class="col-sm-8">
<select class="form-control" name="criteria_ids">
<?php

        $sqlFetchClass = "SELECT *
        FROM criteria_tbl";
        $resultFetchClass = $conn->query($sqlFetchClass);

        if ($resultFetchClass->num_rows > 0) {
            
            while ($rowFetchClass = $resultFetchClass->fetch_assoc()) {

                $criteria_ids = $rowFetchClass['criteria_id'];
                $criteria = $rowFetchClass['criteria'];
                $selected = ($criteria_ids == $criteria_id) ? 'selected' : '';
                echo "<option value='$criteria_ids' $selected>$criteria</option>";
            }
            
        } else{
            echo "<option value='none' selected disabled>No criteria available</option>";
        }

?>
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

<!-- Delete -->
<div class="modal fade" id="delete_<?php echo $row['question_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<div class="row float-left ml-2"><h4 class="modal-title float-left" id="myModalLabel">Delete Criteria</h4></div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <div class="modal-body">	
            	<p class="text-center text-danger">Are you sure you want to delete?</p>
				<h5 class="text-center text-secondary">Question: <span class="text-danger"><?php echo $row['question']; ?></span></h5>
<?php
                                $criteria_id = $row['criteria_id'];
                                $sql3 = "SELECT * FROM criteria_tbl WHERE criteria_id = '$criteria_id'";
                                $result3 = mysqli_query($conn, $sql3);
                                $row2 = mysqli_fetch_assoc($result3);
                                $criteria1 = $row2["criteria"];
?>
                <h5 class="text-center text-secondary">Criteria: <span class="text-danger"><?php echo $criteria1; ?></span></h5>
				
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa-solid fa-x mr-1"></i>Cancel</button>
                <a href="question_delete.php?question_id=<?php echo urlencode($row['question_id']); ?>&acad_id=<?php echo urlencode($acad_id); ?>" class="btn btn-danger"><i class="fa fa-trash m-1"></i>Yes</a>
            </div>

        </div>
    </div>
</div>