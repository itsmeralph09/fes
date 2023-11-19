    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Do you want to logout?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Click "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" href="../logout_action.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

<!-- Update Profile Modal -->
<div class="modal fade" id="updateProfileModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row float-left ml-2"><h4 class="modal-title float-left" id="myModalLabel">Update Profile</h4></div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>

            </div>
            <div class="modal-body">
            <div class="container-fluid">


            <form method="POST" action="../profile_update.php" oninput='confirm_password.setCustomValidity(password.value != confirm_password.value ? "Passwords do not match." : "")'>

                <input type="hidden" class="form-control" name="school_id" value="<?php echo $_SESSION['school_id']; ?>">


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
                <button type="submit" name="edit" class="btn btn-primary"><i class="fa-solid fa-check mr-1"></i></span>Save</a>
            </form>
            </div>

        </div>
    </div>
</div>