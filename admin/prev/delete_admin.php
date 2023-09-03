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

require '../db/dbconn.php';

$admin_id = $_GET['admin_id'];

$sql = "SELECT * FROM admin_tbl WHERE admin_id ='$admin_id'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output the user's information in a form
    $row = $result->fetch_assoc();
}

$school_id = $row['school_id'];

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Delete the user from the database
    $sql = "DELETE FROM admin_tbl WHERE admin_id ='$admin_id'";
    $sql2 = "DELETE FROM user_tbl WHERE school_id ='$school_id'";

    if (mysqli_query($conn, $sql) === TRUE && mysqli_query($conn, $sql2)) {
        header("Location: manage_admin.php");
        exit;
    } else {
        echo "Error deleting admin.: ".$conn->error;
    }
}

// Select the user's information from the database
$sql3 = "SELECT * FROM admin_tbl WHERE admin_id ='$admin_id'";

$result2 = $conn->query($sql3);

// Check if there are any results
if ($result2->num_rows > 0) {
    // Output the user's information in a form
    $row2 = $result2->fetch_assoc();
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
                        <h1 class="h2 mb-0 text-gray-800"><i class="fas fa-fw fa-person-chalkboard mr-2"></i>Delete Admin</h1>
                    </div>

                                        <hr class="mb-3 bg-white1">


    <div class="container">
        <div class="row">
            <div class="card col-sm-6 shadow-sm p-3" style="margin-left: auto; margin-right: auto;">
                <br>
                <form method="post">
                    <div class="mb-3">
                        <!-- <hr class="mb-2 bg-danger"> -->
                        <p class="font-weight-bolder h5 text-danger ml-2"><i class="fa-solid fa-triangle-exclamation mr-2"></i>You are about to delete this record!</p>
                        <hr class="mb-4 bg-danger">
                        
                        <p class="text-dark font-weight-bolder">Full Name: <span class="text-dark font-weight-normal ml-1"><?php echo $row2['first_name']." ".$row2['middle_name']." ".$row2['last_name']; ?></p>
                        <p class="text-dark font-weight-bolder">School ID: <span class="text-dark font-weight-normal ml-1"><?php echo $row2['school_id']; ?></p>
                        <p class="text-dark font-weight-bolder">Email: <span class="text-dark font-weight-normal ml-1"><?php echo $row2['email']; ?></p>
                    </div>
                    
                    <p class="text-danger"><strong>Are you sure you want to delete this user?</strong></p>
                    <div class="float-right">

                    <button type="submit" name="submit" class="btn btn-danger m-1"><i class='fa fa-trash mr-1'></i>Delete</button>
                    <a href="manage_faculty.php" class="btn btn-secondary m-1"><i class="fa-solid fa-x mr-1"></i>Cancel</a>
                </div>
                </form>

            </div>
        </div>
    </div>
                    



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