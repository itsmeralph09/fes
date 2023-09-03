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
    <link id="theme-style" rel="stylesheet" href="../assets/dataTables/jquery.dataTables.min.css">

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
                        <h1 class="h2 mb-0 text-gray-800"><i class="fas fa-fw fa-person-walking"></i>Manage Student</h1>
                    </div>
                    <hr class="mb-3 bg-white1">


                <div class="row g-4 settings-section">
                    <div class="col-12 col-md-12">
                        <div class="card card-settings shadow-sm p-4">

                            <div class="card-body">
                                <a class="btn btn-primary float-left mb-3" href="add_student.php"><i class="fa-solid fa-plus mr-1"></i>New</a>
                                <form class="settings-form">
                                    <div class="mb-3">
                                        <table id="studentTable" class="table table-hover stripe cell-border mb-0 text-left">
                                        <thead class="text-gray-ralph">
                                            <tr>
                                                <th class="cell">#</th>
                                                <th class="cell">School ID</th>
                                                <th class="cell">Full Name</th>
                                                <th class="cell">Class</th>
                                                <th class="cell">Date Created</th>
                                                <th class="cell">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                                <?php

                                                require '../db/dbconn.php';

                                                $sql = "SELECT * FROM student_tbl ORDER BY date_created DESC";

                                                $result = mysqli_query($conn, $sql);

                                                if (mysqli_num_rows($result) > 0){
                                                // Output the results in a table

                                                $num = 1;
                                                while($row = mysqli_fetch_assoc($result)) { ?>


                                                <tr>
                                                    <td class='cell text-dark'><?php echo $num; ?></td>
                                                    <td class='cell text-dark'><?php echo $row['school_id']; ?></td>
                                                    <td class='cell text-dark'><?php echo $row['first_name']." ".$row['middle_name']." ".$row['last_name']; ?></td>
                                                    <td class='cell text-dark'><?php echo $row['class_id']; ?></td>
                                                    <td class='cell text-dark'><?php echo $row['date_created']; ?></td>
                                                    <td>
                                                        <a href='view_student.php?student_id=<?php echo $row['student_id']; ?>'><i class='fa-solid fa-eye m-1 fa-lg'></i></a>
                                                        <a href='?=edit'><i class='fa fa-pen-to-square text-success m-1 fa-lg'></i></a>
                                                        <a href='delete_student.php?student_id=<?php echo $row['student_id']; ?>'><i class='fa fa-trash text-danger m-1 fa-lg'></i></a>
                                                    </td>
                                                </tr>

                                                <?php $num++;}
                                                echo "</table>";
                                                } else {
                                                
                                                }

                                                mysqli_close($conn);
                                                ?>






                                        </tbody>
                                    </table>
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

        <!-- Datatables -->
    <script src="../assets/dataTables/jquery-3.5.1.js"></script> 
    <script src="../assets/dataTables/jquery.dataTables.min.js"></script> 
    <script>
            $(document).ready( function () {
                $('#studentTable').DataTable();
                } );
    </script>

</body>

</html>