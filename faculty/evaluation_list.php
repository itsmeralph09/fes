<?php
session_start();

if (!isset($_SESSION['school_id'])) {
    header("Location: ../login.php");
    $_SESSION['error'] = "You must login first!";
    exit;
}

if ($_SESSION['role'] != "faculty") {
    header("Location: ../login.php");
    $_SESSION['error'] = "You must login first!";
    exit;
} elseif ($_SESSION['role'] == "student") {
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

    <title>PCB FES - Faculty Dashboard</title>

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
<?php
    require '../db/dbconn.php';

    $acad_id = $_GET['acad_id'];
    $sql = "SELECT * FROM acad_yr_tbl WHERE acad_id='$acad_id'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);
    $acad_year = $row['year_start']."-".$row['year_end'];
    $sem = $row['semester'];
?>

                        <h1 class="h2 mb-0 text-gray-800"><i class="fas fa-fw fa-list mr-1"></i>Evaluation List</h1>
                        <h5 class="h5 mb-0 text-dark">Academic Year <?php echo $acad_year; ?>
                        <?php
                            if ($sem == 1) {
                                $sem = "1st Semester";
                            } else if ($sem == 2) {
                                $sem = "2nd Semester";
                            } else{
                                $sem = "Mid-Year";
                            }
                        ?>
                            <?php echo $sem; ?>
                        </h5>
                    </div>
                    <hr class="mb-3 bg-white1">

<div class="container card p-2 mb-4 shadow-sm">
                          
    <div class="row">
        <div class="col-12 col-md-12 overflow-auto" style="width: 100%;">
            <div class="row">
            </div>
                <div class="container my-3">
                    <a href="evaluation.php" class="btn btn-secondary p-2"><i class="fa-solid fa-arrow-turn-down fa-rotate-90 mx-2 fa-xs"></i>Back</a>
                </div>
            <hr class="mt-1">
            <div class="container mb-4 overflow-auto">
                <table id="rap" class="table table-bordered nowrap text-center" style="width: 100%;">
                    <thead class="table-dark">
                        <th>#</th>
                        <th>Average Score</th>
                        <th>Rating</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php
                            require '../db/dbconn.php';
                            $logged_in_faculty_id = $_SESSION['faculty_id'];
                            $acad_id = $_GET['acad_id'];

                            $sql = "
                                SELECT AVG(course_avg.average) AS avg_score
                                FROM (
                                    SELECT AVG(eat.score) AS average
                                    FROM eval_tbl et
                                    INNER JOIN eval_answer_tbl eat ON et.eval_id = eat.eval_id
                                    WHERE et.faculty_id = '$logged_in_faculty_id' 
                                    AND et.acad_id = '$acad_id' 
                                    AND et.deleted = 0
                                    GROUP BY et.course_id
                                ) AS course_avg;

                                ";

                            //use for MySQLi Procedural
                            $num = 1;
                            $query = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($query)){

                                // $datetime  = new DateTime($row['date_taken']);
                                // $dateOnly = $datetime->format("d-M-Y");

                                if ($row['avg_score'] >= 1 AND $row['avg_score'] <= 1.99) {
                                    $rating = "<span class='text-danger'>Poor</span>";
                                }else if ($row['avg_score'] >= 2 AND $row['avg_score'] <= 2.99){
                                    $rating = "<span class='text-warning'>Fair</span>";
                                }else if ($row['avg_score'] >= 3 AND $row['avg_score'] <= 3.99){
                                    $rating = "<span class='text-primary'>Satisfactory</span>";
                                }else if ($row['avg_score'] == 4){
                                    $rating = "<span class='text-success'>Very Satisfactory</span>";
                                }else{
                                    $rating = "<span class='text-secondary'>No data</span>";
                                }

                                if ($row['avg_score'] == "") {
                                    $avg_score = "No data";
                                }else{
                                    $avg_score = round($row['avg_score'], 2);
                                }

                                echo
                                "<tr>
                                    <td class='text-center font-weight-bold'>".$acad_year.' '.$sem."</td>
                                    <td class='text-center font-weight-bold font-italic'>".$avg_score."</td>
                                    
                                    <td class='text-center font-weight-bold font-italic'>
                                        ".$rating."
                                    </td>
                                    <td class='text-center'>
                                        <a href='#view_comments".$acad_id."' class='btn btn-success' data-toggle='modal'><i class='fa fa-comment m-1'></i>View Comments</a>
                                    </td>

                                </tr>";
                                include('view_comments_modal.php');
                            $num++;}

                        ?>
                    </tbody>
                </table>
            </div>
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