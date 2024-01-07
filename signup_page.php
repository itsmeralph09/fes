<?php
session_start();
require './db/dbconn.php';

if (isset($_SESSION['name'])) {
    $_SESSION['error'] = "You are still logged in!";
    if ($_SESSION['role'] == "student") {
        header("Location: ./student/index.php");
        exit;
    } elseif ($_SESSION['role'] == "faculty") {
        header("Location: ./faculty/index.php");
        exit;
    } elseif ($_SESSION['role'] == "admin") {
        header("Location: ./admin/index.php");
        exit;
    }
}


if (isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>FES - Login Page</title>
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/fe15f2148c.js" crossorigin="anonymous"></script>


</head>

<body class="bg-gradient-danger body-class">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image2"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h3 mb-2 text-gray-ralph">Welcome to PCB Faculty Evaluation System!</h1>
                                <h1 class="h5 mb-4 text-gray">Create Account</h1>
                            </div>
                                <?php if(isset($error)) { ?>
                                    <p class="text-danger" role="alert"><i class="fa-solid fa-triangle-exclamation mr-2"></i><?php echo $error; ?></p>
                                    <?php } ?>
                                    <?php if(isset($success)) { ?>
                                    <p class="text-success" role="alert"><i class="fa-solid fa-triangle-exclamation mr-2"></i><?php echo $success; ?></p>
                                <?php } ?>

                            <form class="user" method="POST" action="signup.php" oninput='confirm_password.setCustomValidity(password.value != confirm_password.value ? "Passwords do not match." : "")'>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleInputSchoolID"
                                        placeholder="School ID" name="school_id" required>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="First Name" name="first_name" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleMiddleName"
                                            placeholder="Middle Name" name="middle_name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleLastName"
                                            placeholder="Last Name" name="last_name" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleExtName"
                                            placeholder="Extension Name" name="ext_name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email Address" name="email" required>
                                        <small class="text-warning float-left mb-1">*Use your PCB email address!</small>
                                </div>
                                <div class="form-group">
                                    <?php
                                    // Include the SelectOption class file
                                    require 'fetch_class.php';

                                    // Create an instance of the SelectOption class
                                    $selectOption = new SelectOption();

                                    // Get the class options
                                    $classOptions = $selectOption->getClassOptions();

                                    ?>

                                    <select name="class_id" class="form-select form-select-lg form-c" aria-label=".form-select-lg example" required style="border-radius: 10rem; height: 50px; padding-left: 1rem;">
                                        <option value="" selected disabled>Select a class section</option>
                                        <?php echo $classOptions; ?>
                                    </select>

                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="password" placeholder="Password" name="password" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="confirm_password" placeholder="Repeat Password" name="confirm_password" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="termsCheckbox" required>
                                        <label class="form-check-label small-ralph" for="termsCheckbox">I hereby confirm the above informations are correct.</label>
                                    </div>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary btn-user btn-block btn-ralph">Register</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <p class="small mb-0">Alread Have an Account?</p>
                                <a href="login.php" class="small small-ralph">Login Account!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Get references to the relevant elements
        var firstNameInput = document.querySelector('input[name="first_name"]');
        var lastNameInput = document.querySelector('input[name="last_name"]');
        var emailInput = document.querySelector('input[name="email"]');

        // Attach an input event listener to both first name and last name inputs
        firstNameInput.addEventListener("input", updateEmail);
        lastNameInput.addEventListener("input", updateEmail);

        // Function to update the email input based on first name and last name
        function updateEmail() {
            // Get the values from first name and last name inputs
            var firstName = firstNameInput.value.trim().toLowerCase();
            var lastName = lastNameInput.value.trim().toLowerCase();

            // Create the email by concatenating the first name, last name, and domain
            var email = firstName + lastName + "@pcb.edu.ph";

            // Set the value of the email input
            emailInput.value = email;
        }
    });
</script>

</body>

</html>