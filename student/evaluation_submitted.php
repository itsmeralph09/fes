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

<!-- new css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">


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
                        <h1 class="h2 mb-0 text-gray-800"><i class="fas fa-fw fa-tasks mr-1"></i>Submitted Evaluation</h1>
                    </div>
                    <hr class="mb-3 bg-white1">

<div class="container card p-2 mb-4 shadow-sm">


<?php if(isset($success)) { ?>
<script>
Swal.fire({
  icon: 'success',
  title: 'Success!',
  text: '<?php echo $success;?>'
})
</script>
<?php } ?>

<?php if(isset($error)) { ?>
<script>
Swal.fire({
  icon: 'error',
  title: 'Error!',
  text: '<?php echo $error;?>'
})
</script>
<?php } ?> 

                            
    <div class="row">
        <div class="col-12 col-md-12 overflow-auto" style="width: 100%;">
            <div class="row">
            </div>
            <div class="container mb-3 mt-3">
                <!-- <a href="#addnew" data-toggle="modal" class="btn btn-primary"><i class="fa-solid fa-plus mr-1"></i>New</a> -->
            </div>
            <!-- <hr> -->
            <div class="container mb-4 overflow-auto">
                <table id="rap" class="table table-bordered nowrap" style="width: 100%;">
                    <thead class="table-dark">
                        <th>#</th>
                        <th>Academic Year</th>
                        <th>Faculty</th>
                        <th>Course</th>
                        <th>Date Taken</th>
                    </thead>
                    <tbody>
                        <?php
                            require '../db/dbconn.php';
                            $logged_in_student_id = $_SESSION['student_id'];

                            $sql = "SELECT * FROM eval_tbl WHERE student_id = '$logged_in_student_id' ORDER BY date_taken ASC ";

                            //use for MySQLi Procedural
                            $num = 1;
                            $query = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($query)){

                                $faculty_id = $row['faculty_id']; 
                                $sqlFetchFaculty = "SELECT CONCAT_WS(' ', `first_name`, `middle_name`, `last_name`, `ext_name`) AS `faculty_name`
                                FROM `faculty_tbl`
                                WHERE `faculty_id` = '$faculty_id'";

                                $resultFetchFaculty = $conn->query($sqlFetchFaculty);

                                if ($resultFetchFaculty->num_rows > 0) {
                                // Faculty name found
                                $rowFetchFaculty = $resultFetchFaculty->fetch_assoc();
                                $facultyName = $rowFetchFaculty['faculty_name'];
                                }

                                $course_id = $row['course_id'];
                                $sqlFetchCourse = "SELECT `course_name`,`course_code` FROM `course_tbl` WHERE `course_id` = '$course_id'";
                                $resultFetchCourse = $conn->query($sqlFetchCourse);

                                if ($resultFetchCourse->num_rows > 0) {
                                    $rowFetchCourse = $resultFetchCourse->fetch_assoc();
                                    $course = $rowFetchCourse['course_code'] . " - " . $rowFetchCourse['course_name'];
                                }

                                $datetime  = new DateTime($row['date_taken']);
                                $dateOnly = $datetime->format("d-M-Y");


                                echo
                                "<tr>
                                    <td>".$num."</td>
                                    <td>".$row['acad_id']."</td>
                                    <td>".$facultyName."</td>
                                    <td>".$course."</td>
                                   
                                   <td>".$dateOnly."</td>

                                </tr>";
                                    // <td> 
                                    //     <a href='#stop_".$row['acad_id']."' class='btn btn-primary btn-sm' data-toggle='modal'>View</a>    
                                    // </td>
                                // include('acad_yr_edit_delete_modal.php');
                                
                            $num++;}

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- <?php include('acad_yr_add_modal.php'); ?> -->



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



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>


    <!-- <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>

    <script>
        $(document).ready(function(){
        //inialize datatable
        $('#rap').DataTable({
            scrollX: true
        })
        });

    </script>


</body>

</html>