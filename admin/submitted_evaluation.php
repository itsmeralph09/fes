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

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" integrity="sha256-h2Gkn+H33lnKlQTNntQyLXMWq7/9XI2rlPCsLsVcUBs=" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js" integrity="sha256-+0Qf8IHMJWuYlZ2lQDBrF1+2aigIRZXEdSvegtELo2I=" crossorigin="anonymous"></script>


<script>
document.addEventListener('DOMContentLoaded', function () {
    // Check if the URL has a success parameter (insertion succeeded)
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('success')) {
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Questions inserted successfully.',
        }).then(function() {
            // Refresh the page to reflect the changes
            location.reload();
        });
    }

    // Check if the URL has an error parameter (insertion failed)
    if (urlParams.has('error')) {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Failed to insert questions. Please try again.',
        }).then(function() {
            // Refresh the page to reflect the changes
            location.reload();
        });
    }
});
</script>
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

                        <h1 class="h2 mb-0 text-gray-800"> <i class="fas fa-fw fa-chart-bar mr-1"></i>Submitted Evaluation List</h1>
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
                                    <div class="container my-3">
                                        <a href="evaluation_list.php" class="btn btn-secondary p-2"><i class="fa-solid fa-arrow-turn-down fa-rotate-90 mx-2 fa-xs"></i>Back</a>
                                    </div>
                                    <hr class="mt-1">
            <div class="container mb-4 overflow-auto">
                <table id="rap" class="table table-bordered nowrap" style="width: 100%;">
                    <thead class="table-dark">
                        <th>#</th>
                        <th>Student</th>
                        <th>Course</th>
                        <th>Faculty</th>
                        <th>Class</th>
                        <th>Date Taken</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php
                            require '../db/dbconn.php';
                            $acad_id = $_GET['acad_id'];

                            $sql = "SELECT et.eval_id,st.school_id, CONCAT(st.first_name, ' ', st.last_name) as student_name, CONCAT(ct.course_code, ' ', ct.course_name) as course, CONCAT(ft.first_name, ' ', ft.last_name) as faculty_name, CONCAT(clt.program_code, ' ', clt.level, '-',clt.section) AS class, et.date_taken
                                    FROM eval_tbl as et
                                    INNER JOIN student_tbl AS st ON et.student_id = st.student_id
                                    INNER JOIN course_tbl AS ct ON et.course_id = ct.course_id
                                    INNER JOIN faculty_tbl AS ft ON et.faculty_id = ft.faculty_id
                                    INNER JOIN class_tbl AS clt ON et.class_id = clt.class_id
                                    WHERE et.acad_id = '$acad_id' AND et.deleted = 0";

                            //use for MySQLi Procedural
                            $num = 1;
                            $query = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($query)){

                                $datetime  = new DateTime($row['date_taken']);
                                $dateOnly = $datetime->format("d-M-Y");

                                echo
                                "<tr>
                                    <td>".$num."</td>
                                    <td>".$row['student_name']."</td>
                                    <td>".$row['course']."</td>
                                    <td>".$row['faculty_name']."</td>
                                    <td>".$row['class']."</td>
                                   <td>".$dateOnly."</td>
                                   <td>
                                        <button class='btn btn-danger btn-sm' onclick='confirmDelete(\"" . $row['eval_id'] . "\", \"" . $row['student_name'] . "\", \"" . $row['course'] . "\", \"" . $row['class'] . "\")'><i class='fa fa-trash m-1'></i>Delete</button>
                                    </td>
                                </tr>";
                                include('submitted_evaluation_delete_modal.php');
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
<script>
    // Function to handle deletion confirmation
    function confirmDelete(eval_id, student_name, course, class_name) {
        Swal.fire({
            title: 'Delete Submitted Evaluation',
            html: `<h4 class="text-center text-danger">Are you sure you want to delete submitted evaluation?</h4>
                    <h6 class="text-left text-secondary">Name: <span class="text-danger">${student_name}</span></h6>
                    <h6 class="text-left text-secondary">Course: <span class="text-danger">${course}</span></h6>
                    <h6 class="text-left text-secondary">Class: <span class="text-danger">${class_name}</span></h6>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, send AJAX request to delete
                deleteEvaluation(eval_id);
            }
        });
    }

    // Function to send AJAX request to delete evaluation
    function deleteEvaluation(eval_id) {
        $.ajax({
            type: 'POST',
            url: 'submitted_evaluation_delete.php',
            data: { eval_id: eval_id },
            success: function(response) {
                // Handle success response here
                // For example, you can show a success SweetAlert popup
                Swal.fire({
                    icon: 'success',
                    title: 'Deletion Successful',
                    text: 'The evaluation has been deleted successfully!',
                    timer: 3000 // Auto close timer in milliseconds
                }).then(function() {
                    // Reload the page after the popup is closed
                    location.reload();
                });
            },
            error: function(xhr, status, error) {
                // Handle error here
                // For example, you can show an error SweetAlert popup
                Swal.fire({
                    icon: 'error',
                    title: 'Deletion Failed',
                    text: 'Failed to delete the evaluation. Please try again later.'
                });
                console.error(xhr.responseText);
            }
        });
    }
</script>


</body>
</html>