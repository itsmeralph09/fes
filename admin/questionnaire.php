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
                        <h1 class="h2 mb-0 text-gray-800"> <i class="fas fa-fw fa-question-circle mr-1"></i>Manage Questionnaires</h1>
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
        <div class="col-12 col-md-12">
            <div class="row">
            </div>
            <div class="container mb-3 mt-3">
                <p class="card-title text-danger">List of questionnaires for each academic year and semester</p>
            </div>
            <hr>
            <div class="container mb-4">
                <table id="myTable" class="table table-bordered nowrap" style="width:100%">
                    <thead class="table-dark">
                        <th>#</th>
                        <th>Academic Year</th>
                        <th>Semester</th>
                        
                        <th>Default</th>
                        <th>Questions</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php
                            require '../db/dbconn.php';
                            $sql = "SELECT * FROM acad_yr_tbl ORDER BY year_start ASC";

                            //use for MySQLi Procedural
                            $num = 1;
                            $query = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($query)){

                                if ($row['status'] == "started") {
                                    $status = "<td><div class='row'><div class='col text-center'><span class='badge badge-success rounded-sm badge-lg'><span class='h6'>".ucfirst($row['status'])."</span></span></div></div></td>";
                                }else if ($row['status'] == "pending"){
                                    $status = "<td><div class='row'><div class='col text-center'><span class='badge badge-warning rounded-sm badge-lg'><span class='h6'>".ucfirst($row['status'])."</span></span></div></div></td>";
                                }else{
                                    $status = "<td><div class='row'><div class='col text-center'><span class='badge badge-secondary rounded-sm badge-lg'><span class='h6'>".ucfirst($row['status'])."</span></span></div></div></td>";
                                }

                                if ($row['semester'] == 1) {
                                    $semester = "1st Semester";
                                } else if ($row['semester'] == 2){
                                    $semester = "2nd Semester";
                                } else{
                                    $semester = "Mid Year";
                                }

                                if ($row['is_default'] == "yes") {
                                    $is_default = "<div class='row'><div class='col text-center'><i class='fa-solid fa-circle-check text-primary fa-xl'></i></div></div>";
                                } else{
                                    $is_default = "<div class='row'><div class='col text-center'><i class='fa-solid fa-circle-xmark fa-xl'></i></div></div>";
                                }

                                $acad_id = $row['acad_id'];
                                $sql2 = "SELECT * FROM question_tbl WHERE acad_id = '$acad_id'";
                                $query2 = mysqli_query($conn, $sql2);
                                $questionCount = mysqli_num_rows($query2);

                                echo
                                "<tr>
                                    <td>".$num."</td>
                                    <td>".$row['year_start']. "-" .$row['year_end']."</td>
                                    <td>".$semester."</td>
                                    <td>".$is_default."</td>
                                    <td>".$questionCount."</td>
                                    <td>
                                        
                                        <a href='question.php?acad_id=".$row['acad_id']."' class='btn btn-primary btn-sm' data-toggle='modal'><i class='fa fa-sliders m-1'></i>Manage</a>
                                        
                                    </td>
                                </tr>";
                                // include('acad_yr_edit_delete_modal.php');
                                
                            $num++;}

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include('acad_yr_add_modal.php'); ?>



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
        $('#myTable').DataTable({
            // responsive: true
            scrollX: true
        })
        //hide alert
        $(document).on('click', '.close', function(){
            $('.alert').hide();
        })
        });

    </script>


</body>

</html>