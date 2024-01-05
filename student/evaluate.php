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

require '../db/dbconn.php';


$fetchActiveAcadYearSQL = "SELECT * FROM acad_yr_tbl WHERE status ='started'";
$fetchActiveAcadYear = $conn->query($fetchActiveAcadYearSQL);

if ($fetchActiveAcadYear->num_rows > 0) {
    $rowAcad = $fetchActiveAcadYear->fetch_assoc();
    $_SESSION['active_acad_yr'] = $rowAcad['acad_id'];
} else {
    $_SESSION['error'] = "Evaluation for the current academic year and semester is not yet started!";
    header('Location: index.php');
    exit;
}


// Close the database connection
$conn->close();

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
    <!-- <script src="../assets/fontawesome-free-6.4.0-web/js/all.min.js"></script> -->
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
        icon: 'error',
        title: 'Error!',
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
                <div class="container-fluid justify-content-center">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h2 mb-0 text-gray-800"><i class="fa-regular fa-square-check mr-1"></i>Evaluation</h1>
                    </div>
                    <hr class="mb-3 bg-white1">


        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                

                    
                <div class="row g-4 mb-4">
                    
                    <div class="col-12 col-md-12 mb-2">
                        <div class="card card-settings shadow-sm p-4">
                            <fieldset class="p-2 mb-3 w-100 rounded" style="border:2px solid #7b0d0d;">
                                <legend class="w-auto text-gray-ralph font-weight-bolder">Evaluate:</legend>

                            <div class="app-card-body">
                                <!-- <div class="">
                                    <h4 class="app-page-title text-dark">Submit Evaluation</h4>
                                </div> -->
                                <!-- <hr> -->
                                <div class="">
                                    <form class="form" action="pre_evaluate.php" method="post">
                                        <?php
                                        // Replace with your database connection details
                                        require '../db/dbconn.php';

                                        // SQL query to fetch faculty records
                                        $sql = "SELECT faculty_id, first_name, middle_name, last_name, ext_name, department FROM faculty_tbl";

                                        $result = $conn->query($sql);

                                        // Initialize optgroup variables
                                        $icsOptions = '';
                                        $iedOptions = '';

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $full_name = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . ' ' . $row['ext_name'];
                                                $option = '<option value="' . $row['faculty_id'] . '">' . $full_name . '</option>';
                                                
                                                // Group options based on department
                                                if ($row['department'] === 'ics') {
                                                    $icsOptions .= $option;
                                                } elseif ($row['department'] === 'ied') {
                                                    $iedOptions .= $option;
                                                }
                                            }
                                        }

                                        // Close the database connection
                                        $conn->close();
                                        ?>
                                                    <div class="row"><!-- Added a row container -->
                                                        <div class="col-md-6 my-2"><!-- Added col class and added `mb-2` for spacing -->
                                                            <fieldset class="form-group input-group">
                                                                <!-- <div class="input-group-prepend">
                                                                    <span class="input-group-text bg-danger1 text-light">
                                                                        <i class="fas fa-chalkboard-user"></i>
                                                                    </span>
                                                                </div> -->
                                                                <select id="facultySelect" name="faculty_id" class="form-select form-select-sm form-control" aria-label=".form-select-sm example" required>
                                                                    <option value="" disabled selected>Select a Faculty</option>
                                                                    <optgroup label="Institute of Computing Studies">
                                                                        <?php echo $icsOptions; ?>
                                                                    </optgroup>
                                                                    <optgroup label="Institute of Education">
                                                                        <?php echo $iedOptions; ?>
                                                                    </optgroup>
                                                                </select>
                                                            </fieldset>
                                                        </div>
                                        <?php
                            // Replace with your database connection details
                            require '../db/dbconn.php';
                            $student_id = $_SESSION['student_id'];

                            // SQL query to fetch course records
                            $sql = "SELECT c.course_id, c.course_code, c.course_name
                                    FROM course_tbl AS c
                                    LEFT JOIN eval_tbl AS e ON c.course_id = e.course_id AND e.student_id = '$student_id'
                                    WHERE e.course_id IS NULL
                                    ORDER BY c.course_code ASC, c.course_name ASC;
                                    ";

                            $result = $conn->query($sql);

                            // Generate the select options
                            $options = '<option value="" disabled selected>Select a Course</option>';

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $options .= '<option value="' . $row['course_id'] . '">' . $row['course_code'] . ' - ' . $row['course_name'] . '</option>';
                                }
                            }

                            // Close the database connection
                            $conn->close();
                            ?>
                                            <div class="col-md-6 my-2"><!-- Added col class and added `mb-2` for spacing -->
                                                <fieldset class="form-group input-group">
                                                    <!-- <div class="input-group-prepend">
                                                         <span class="input-group-text bg-danger1 text-light">
                                                            <i class="fas fa-sticky-note"></i>
                                                        </span>
                                                    </div> -->
                                                    <select id="courseSelect" name="course_id" class="form-select form-select-sm form-control" aria-label=".form-select-sm example" required>
                                                        <?php echo $options; ?>
                                                    </select>
                                                </fieldset>
                                            </div>
                                        </div>
                                        </div>
                                        
                                        
                                            <button type="submit" name="submit" value="submit" class="btn btn-primary float-right">Select</button>
                                        
                                    </form>
                                
                            </div><!--//app-card-body-->
                            </fieldset>



                        </div><!--//app-card-->
                    </div>

                </div><!--//row-->
            </div><!--//container-fluid-->
        </div><!--//app-content-->                



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

<script>
    // // Get references to the select elements
    // var facultySelect = document.getElementById('facultySelect');
    // var courseSelect = document.getElementById('courseSelect');

    // // Add an event listener to the faculty select element
    // facultySelect.addEventListener('change', function() {
    //     // Enable or disable the course select element based on whether an option is selected in the faculty select
    //     courseSelect.disabled = !facultySelect.value;
    // });

$(document).ready(function() {
    // When the "Select" button is clicked
    $("#submitBtn").click(function(event) {
        // Prevent the default form submission
        event.preventDefault();

        // Get the selected faculty_id and course_id
        var faculty_id = $("#facultySelect").val();
        var course_id = $("#courseSelect").val();

        // Check if both faculty_id and course_id are selected
        if (faculty_id !== "" && course_id !== "") {
            // Make an AJAX request to pre_evaluate.php
            $.ajax({
                type: "POST",
                url: "pre_evaluate.php",
                data: {
                    faculty_id: faculty_id,
                    course_id: course_id
                },
                success: function(response) {
                    // Handle the response from pre_evaluate.php here (if needed)
                    console.log(response);
                    
                    // Redirect to pre_evaluate.php after a successful AJAX request
                    window.location.href = "pre_evaluate.php";
                },
                error: function(xhr, status, error) {
                    // Handle errors here (if needed)
                    console.error(xhr.responseText);
                }
            });
        } else {
            // If faculty_id or course_id is not selected, display an error message
            alert("Please select both a faculty and a course.");
        }
    });
});



</script>

</body>

</html>