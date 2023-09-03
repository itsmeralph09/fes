<?php
session_start();
if (!isset($_SESSION['school_id'])) {
    header("Location: ../login.php");
    $_SESSION['error'] = "You must login first!";
    exit;
}

if ($_SESSION['role'] != "admin") {
    header("Location: ../login.php");
    $_SESSION['error'] = "You must login first!";
    exit;
} elseif ($_SESSION['role'] == "faculty") {
    header("Location: ../faculty/index.php");
    exit;
} elseif ($_SESSION['role'] == "student"){
    header("Location: ../student/index.php");
    exit;
}

if (isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}


$first_name = "";
$middle_name = "";
$last_name = "";
$class_id = "";
$school_id = "";
$email = "";
$password = "";
$confirm_password = "";

if (isset($_POST['submit'])) {
    require '../db/dbconn.php';

    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $school_id = $_POST['school_id'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

        if ($password == $confirm_password) {
            $hashed_pass = password_hash($password, PASSWORD_BCRYPT);
            
            $query = "INSERT INTO admin_tbl(school_id, first_name, middle_name, last_name, email) VALUES ('$school_id', '$first_name', '$middle_name', '$last_name', '$email')";
            $result = mysqli_query($conn, $query);

            $query2 = "INSERT INTO user_tbl(school_id, password, role, status) VALUES ('$school_id', '$hashed_pass', 'admin', 'active')";
            $result2 = mysqli_query($conn, $query2);

            if (!$result || !$result2) {
                $error = "Error adding admin!";
                $_SESSION['error'] = $error;
            } else{
                $success="Admin added successfully!";
                $_SESSION['success'] = $success;
                header('Location: manage_admin.php');
                exit;
            }
        }else{
            $error = "Passwords do not match!";
        }

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

    <title>PCB FES - Admin Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../assets/css/custom.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/fe15f2148c.js" crossorigin="anonymous"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
            <?php include 'sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                    <?php include 'topbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid justify-content-center">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h2 mb-0 text-gray-800"><i class="fa-solid fa-user-pen mr-2"></i>Add Admin</h1>
                    </div>

                    <hr class="mb-3 bg-white1">


                <div class="row g-4 settings-section align-items-center">
                    <div class="col-12 col-md-12">
                        <div class="card card-settings col-md-6 shadow-sm p-4 mb-4 align-self-center" style="margin-left: auto; margin-right: auto;">
            <?php if(isset($error)) { ?>
                <div class="text-danger"><p class="text-danger"><?php echo $error; ?></p></div>                
            <?php } ?> 

            <?php if(isset($success)) { ?>
                <div class="text-success"><p class="text-success"><?php echo $success; ?></p></div>                
            <?php } ?> 
                            
                            <div class="card-body">

                                <form class="settings-form" method="post" action="add_admin.php">
                                    <div class="mb-3 row">
                                        <div class="col-4"><label for="setting-input-1" class="form-label text-dark">First Name</label></div>
                                        <div class="col"><input type="text" class="form-control form-control" id="setting-input-1" name="first_name" value="<?php echo $first_name; ?>" required></div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-4"><label for="setting-input-2" class="form-label text-dark">Middle Name</label></div>
                                        <div class="col"><input type="text" class="form-control form-control" id="setting-input-2" name="middle_name" value="<?php echo $middle_name; ?>"></div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-4"><label for="setting-input-3" class="form-label text-dark">Last Name</label></div>
                                        <div class="col"><input type="text" class="form-control form-control" id="setting-input-3" name="last_name"  value="<?php echo $last_name; ?>" required></div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-4"><label for="setting-input-4" class="form-label text-dark">School ID</label></div>
                                        <div class="col"><input type="text" class="form-control form-control" id="  setting-input-4" name="school_id"  value="<?php echo $school_id; ?>" required></div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-4"><label for="setting-input-5" class="form-label text-dark">Email</label></div>
                                        <div class="col"><input type="email" class="form-control form-control" id="setting-input-5" name="email"  value="<?php echo $email; ?>" required></div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-4"><label for="setting-input-3" class="form-label text-dark">Password</label></div>
                                        <div class="col"><input type="password" class="form-control form-control" id="setting-input-3" name="password" value="" required></div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-4"><label for="setting-input-3" class="form-label text-dark">Confirm Password</label></div>
                                        <div class="col"><input type="password" class="form-control form-control" id="setting-input-3" name="confirm_password" value="" required></div>
                                    </div>
                                    <div class="float-right">
                                    <button type="submit" name="submit" class="btn btn-primary"><i class="fa-solid fa-check mr-1"></i>Save</button>
                                    <a type="submit" class="btn btn-secondary" href="manage_admin.php"><i class="fa-solid fa-x mr-1"></i>Cancel</a>
                                </div>
                                </form>

                            </div><!--//app-card-body-->
                            
                        </div><!--//app-card-->
                    </div>
                </div><!--//row-->                    



                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include 'footer.php'; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top bg-danger rounded-circle" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
        <?php include 'logout.php'; ?>

    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../assets/js/demo/chart-area-demo.js"></script>
    <script src="../assets/js/demo/chart-pie-demo.js"></script>

</body>

</html>