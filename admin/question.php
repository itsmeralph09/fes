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
<?php
    require '../db/dbconn.php';

    $acad_id = $_GET['acad_id'];
    $sql = "SELECT * FROM acad_yr_tbl WHERE acad_id='$acad_id'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);
    $acad_year = $row['year_start']."-".$row['year_end'];
    $sem = $row['semester'];
?>

                        <h1 class="h2 mb-0 text-gray-800"> <i class="fas fa-fw fa-question mr-1"></i>Manage Questions</h1>
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

<?php
// Step 2: Create a database connection


// Step 3: Retrieve academic years for the dropdown
$sql_years = "SELECT DISTINCT acad_id FROM acad_yr_tbl";
$result_years = $conn->query($sql_years);

$academic_years = array();
if ($result_years->num_rows > 0) {
    while ($row = $result_years->fetch_assoc()) {
        $academic_years[] = $row['acad_id'];
    }
}

// Step 4: Create the Bootstrap modal structure
?>
                            
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="row">
            </div>
            <div class="container mb-3 mt-3">
                <a href="#addnew" data-toggle="modal" class="btn btn-primary"><i class="fa-solid fa-plus mr-1"></i>New</a>
                <a href="#" class="btn btn-success" data-toggle="modal" data-target="#previousQuestionnairesModal"><i class="fa-solid fa-clock-rotate-left mr-1"></i>Previous Questionnaires</a>
                <a href="questionnaire.php" class="btn btn-secondary float-right"><i class="fa-solid fa-chevron-left mr-1"></i>Back</a>


    <!-- Display the questionnaire data in the modal -->
    <div class="modal" id="previousQuestionnairesModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Previous Questionnaires</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- Step 6: Dropdown selection of academic years -->
                    <div class="form-group">
                        <label for="academicYear">Select Academic Year:</label>
                        <select class="form-control" id="academicYear" name="acad">
                            <option value="" selected disabled>Select an academic year</option>
                            <?php foreach ($academic_years as $year) : ?>
                                <?php
                                    require '../db/dbconn.php';
                                    $fetchAcad = "SELECT * FROM acad_yr_tbl WHERE acad_id='$year'";
                                    $fetchAcadQuery = mysqli_query($conn, $fetchAcad);
                                    $fetchRow = mysqli_fetch_assoc($fetchAcadQuery);
                                    if ($fetchRow['semester'] == 1) {
                                        $semester = "1st Semester";
                                    } elseif ($fetchRow['semester'] == 2) {
                                        $semester = "2nd Semester";
                                    } elseif ($fetchRow['semester'] == 3) {
                                        $semester = "Mid-Year";
                                    }
                                    $acad = $fetchRow['year_start']."-".$fetchRow['year_end']." ".$semester;
                                ?>

                                <option value="<?php echo $year; ?>"><?php echo $acad; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Step 7: Text div to display questions -->
                    <div id="questionList">
                        <!-- Questions will be loaded here -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="insertQuestionsBtn">Use Questions</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


            </div>
            <hr>
            <div class="container mb-4">
                <h6 class="h6 text-center">  You are viewing questions for Aademic Year <?php echo $acad_year; ?>
                        <?php
                            if ($sem == 1) {
                                $sem = "1st Semester";
                            } else if ($sem == 2) {
                                $sem = "2nd Semester";
                            } else if ($sem == 3) {
                                $sem = "Mid-Year";
                            }

                            echo $sem;
                        ?>
                </h6>                
                <table id="myTable" class="table table-bordered nowrap" style="width:100%">
                    <thead class="table-dark">
                        <th>#</th>
                        <th>Question</th>
                        <th>Criteria</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php
                            require '../db/dbconn.php';

                            $acad_id = $_GET['acad_id'];

                            $sql = "SELECT * FROM question_tbl WHERE acad_id='$acad_id'";

                            //use for MySQLi Procedural
                            $num = 1;
                            $query = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($query)){

                                $criteria_id = $row['criteria_id'];
                                $sql2 = "SELECT * FROM criteria_tbl WHERE criteria_id = '$criteria_id'";
                                $result2 = mysqli_query($conn, $sql2);
                                $row1 = mysqli_fetch_assoc($result2);
                                $criteria = $row1["criteria"];

                                echo
                                "<tr>
                                    <td>".$num."</td>
                                    <td>".$row['question']."</td>
                                    <td>".$criteria."</td>
                                    <td>
                                        
                                        <a href='#edit_".$row['question_id']."' class='btn btn-success btn-sm' data-toggle='modal'><i class='fa fa-pen-to-square m-1'></i>Edit</a>
                                        <a href='#delete_".$row['question_id']."' class='btn btn-danger btn-sm' data-toggle='modal'><i class='fa fa-trash m-1'></i>Delete</a>
                                        
                                    </td>
                                </tr>";
                                include('question_edit_delete_modal.php');
                                
                            $num++;}

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include('question_add_modal.php'); ?>



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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
<script>
$(document).ready(function() {
    // Step 8: Handle dropdown change event
    $('#academicYear').change(function() {
        var selectedYear = $(this).val();
        
        // Step 9: Fetch questions for the selected academic year using AJAX
        $.ajax({
            type: 'POST',
            url: 'fetch_questions.php', // Create a separate PHP file to handle this AJAX request
            data: { academic_year: selectedYear },
            success: function(response) {
                $('#questionList').html(response);
            }
        });
    });

    // Step 10: Handle the insertQuestionsBtn click event
    $('#insertQuestionsBtn').click(function() {
        var selectedYear = $('#academicYear').val();
        
        // Collect all questions and their associated criteria_id
        var questionData = [];
        $('.criteria-id').each(function() {
            var question = $(this).prev().text().trim(); // Get the question text
            var criteriaId = $(this).val(); // Get the associated criteria_id
            questionData.push({ question: question, criteria_id: criteriaId });
        });

        // Step 11: Send an AJAX request to insert_questions.php
        $.ajax({
            type: 'POST',
            url: 'insert_prev_questions.php', // Create a separate PHP file to handle this AJAX request
            data: { academic_year: selectedYear, questions: JSON.stringify(questionData) },
            success: function(response) {
                // Handle the response if needed
                alert(response);
            }
        });
    });

});
</script>



</body>

</html>