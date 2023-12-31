<?php
session_start();

if (!isset($_SESSION['school_id'])) {
    header("Location: ../login.php");
    $_SESSION['error'] = "You must login first!";
    exit;
}

if ($_SESSION['role'] != "student") {
    header("Location: ../login.php");
    $_SESSION['error'] = "You must login first!";
    exit;
} elseif ($_SESSION['role'] == "faculty") {
    header("Location: ../faculty/index.php");
    exit;
} elseif ($_SESSION['role'] == "admin"){
    header("Location: ../admin/index.php");
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

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PCB FES - Student Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../assets/css/custom.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/fe15f2148c.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-borderless@5/borderless.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

</head>
<?php if(isset($success)) { ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '<?php echo $success;?>'
    });
});
</script>
<?php } ?>

<?php if(isset($error)) { ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
        icon: 'warning',
        // title: 'info!',
        text: '<?php echo $error;?>'
    });
});
</script>
<?php } ?>
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
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h2 mb-0 text-gray-800"><i class="fas fa-fw fa-tachometer-alt"></i>Dashboard</h1>
<!--                         <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <?php

                        require '../db/dbconn.php';
                        $school_id = $_SESSION['school_id'];

                            $sql = "SELECT CONCAT(st.first_name, ' ', st.last_name) as name, CONCAT(ct.program_code, ' ', ct.level, '-', ct.section) as class FROM student_tbl st
                                INNER JOIN class_tbl ct on ct.class_id = st.class_id
                                WHERE school_id = '$school_id'";

                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);

                        ?>
                        <!-- Profile Card -->
                        <div class="col-xl-12 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="font-weight-bold text-gray mb-1 text-uppercase">
                                                <p>Welcome to Faculty Evaluation System!
                                                </p>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="h6 mb-0 font-weight-bold text-gray">
                                        <p>Hello,
                                            <span class="text-primary font-italic"><?php echo $_SESSION['name']; ?></span>,
                                            <span class="text-primary font-italic"><?php echo $school_id; ?></span>, of
                                            <span class="text-primary font-italic"><?php echo $row['class']; ?></span>.
                                        </p>
                                        <small class="font-italic">
                                            * Check if your Name, School ID, Program, Year and Section is correct before submitting evaluation!
                                        </small>
                                        <br>
                                        <hr class="bg-primary">
                                        <small class="font-italic">
                                            <span class="">* If your class section is incorrect, </span>
                                            <a class="" href="#" data-toggle="modal" data-target="#updateClassModal"><u>update class section.</u></a>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                        <?php

                        require '../db/dbconn.php';

                            $sql = "SELECT * FROM acad_yr_tbl WHERE is_default = 'yes'";

                            $result = mysqli_query($conn, $sql);

                        ?>
                        <!-- Academic Year Card -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-gray text-uppercase mb-1">
                                                Academic Year: 
                                                <?php 
                                                    if (mysqli_num_rows($result) >= 1) { 
                                                        $row = mysqli_fetch_assoc($result); 
                                                    ?>
                                                        <p class="text-danger">
                                                        <?php 
                                                            echo $row['year_start']."-".$row['year_end']; 
                                                        ?>
                                                        <?php if ($row['semester'] == 1) {
                                                            echo "First Semester";
                                                        } else if($row['semester'] == 2){
                                                            echo "Second Semester";
                                                        } else{
                                                            echo "Mid-Year";
                                                        }
                                                        ?>
                                                        </p>
                                                <?php
                                                    } else{
                                                        echo "No default academic year set!";
                                                    }
                                                ?>
 
                                            </div>
                                            
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="h6 mb-0 font-weight-bold text-gray">Evaluation Status: <p class="text-danger">
                                        <?php
                                            if ($row['status'] == 'started') {
                                                 echo "Started";
                                             } else{
                                                echo "Closed";
                                             }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Users Card -->
                        <?php

                            require '../db/dbconn.php';

                            $fetchActiveAcadYearSQL = "SELECT * FROM acad_yr_tbl WHERE is_default ='yes'";
                            $fetchActiveAcadYearSQLResult = mysqli_query($conn, $fetchActiveAcadYearSQL);
                            $res = mysqli_fetch_assoc($fetchActiveAcadYearSQLResult);
                            $default_acad_yr = $res['acad_id'];

                            $student_id = $_SESSION['student_id'];

                            $sql = "SELECT * FROM eval_tbl WHERE student_id = '$student_id' AND acad_id = '$default_acad_yr'";

                            $result = mysqli_query($conn, $sql);
                            $eval_submitted = mysqli_num_rows($result);
                        ?>
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                                Total Submitted Evaluation This Semester</div>
                                            <div class="h5 mb-0 font-weight-bold text-warning"><?php echo $eval_submitted; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-check fa-2x text-warning"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">

                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">

                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                        </div>

                        <div class="col-lg-6 mb-4">

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
    <!-- <script src="../assets/vendor/chart.js/Chart.min.js"></script> -->

    <!-- Page level custom scripts -->
    <!-- <script src="../assets/js/demo/chart-area-demo.js"></script> -->
    <!-- <script src="../assets/js/demo/chart-pie-demo.js"></script> -->

</body>

</html>