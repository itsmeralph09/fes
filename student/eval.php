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

?>
<?php
// Replace with your database connection details
require '../db/dbconn.php';

// Check if the active academic year is set in the session
if (isset($_SESSION['course_id_to_evaluate']) && isset($_SESSION['faculty_id_to_evaluate'])) {
    $acad_id = $_SESSION['active_acad_yr'];
    // SQL query to fetch questions grouped by criteria_id for the active academic year
    $sql = "SELECT criteria_id, GROUP_CONCAT(question_id ORDER BY question_id ASC SEPARATOR '|') AS grouped_question_ids
            FROM question_tbl
            WHERE acad_id = $acad_id
            GROUP BY criteria_id";

    $result = $conn->query($sql);

    // Create an array to map radio button values to labels
    $radioValues = [
        4 => 'Strongly Agree',
        3 => 'Agree',
        2 => 'Disagree',
        1 => 'Strongly Disagree'
    ];

// Handle form submission
if (isset($_POST['submit'])) {

    $course_id = $_SESSION['course_id_to_evaluate'];
    $faculty_id = $_SESSION['faculty_id_to_evaluate'];
    $acad_id = $_SESSION['active_acad_yr'];
    $department = $_SESSION['department'];

    $student_id = $_SESSION['student_id'];
    $class_id = $_SESSION['class_id'];
    $eval_id = $_GET['eval_id'];

    $comments = $_POST['comments'];

    $insertEvalSql = "INSERT INTO eval_tbl (eval_id, acad_id, student_id, course_id, faculty_id, class_id, department, comments)
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmtEval = $conn->prepare($insertEvalSql);

    if ($stmtEval === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Assuming eval_id is an integer
    $stmtEval->bind_param('siiiiiss', $eval_id, $acad_id, $student_id, $course_id, $faculty_id, $class_id, $department, $comments);

    if ($stmtEval->execute()) {
        echo "Insertion successful.";
    } else {
        echo "Insertion failed: " . $stmtEval->error;
    }

    $stmtEval->close();


    // Iterate through criteria
    while ($row = $result->fetch_assoc()) {
        $criteriaId = $row['criteria_id'];
        $questionIds = explode('|', $row['grouped_question_ids']);

        // Iterate through questions
        foreach ($questionIds as $questionId) {
            // Check if a score is submitted for this question
            if (isset($_POST["question_{$questionId}"])) {
                $score = intval($_POST["question_{$questionId}"]);
                // Insert the answer into eval_answer_tbl
                $insertSql = "INSERT INTO eval_answer_tbl (eval_id, question_id, score)
                              VALUES (?, ?, ?)";
                $stmt = $conn->prepare($insertSql);
                $stmt->bind_param('sii', $eval_id, $questionId, $score);
                $stmt->execute();
            }
        }
    }
        $_SESSION['success'] = 'Evaluation submitted successfully!';
        // unset($_SESSION['course_id_to_evaluate']);
        // unset($_SESSION['faculty_id_to_evaluate']);
        header('Location: post_evaluate.php?eval_id=' . $_GET['eval_id']);
        exit;
    }

} else {
    // Handle the case where the active academic year is not set in the session
    $_SESSION['error'] = 'No faculty and subject selected!';
    header("Location: evaluate2.php");
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
                        <h1 class="h2 mb-0 text-gray-800"><i class="fa-solid fa-list-check mr-2"></i>Evaluation</h1>
                    </div>
                    <hr class="mb-3 bg-white1">


        <div class="app-content">
            <div class="">
                

                    
                <div class="row g-4 mb-4">
                    

                    <div class="col-12 col-md-12">
                        <div class="card card-settings shadow-sm pb-4">
<?php

$sqlFetchFaculty = "SELECT CONCAT_WS(' ', `first_name`, `middle_name`, `last_name`, `ext_name`) AS `faculty_name`
                   FROM `faculty_tbl`
                   WHERE `faculty_id` = " . $_SESSION['faculty_id_to_evaluate'];

$resultFetchFaculty = $conn->query($sqlFetchFaculty);

if ($resultFetchFaculty->num_rows > 0) {
    // Faculty name found
    $rowFetchFaculty = $resultFetchFaculty->fetch_assoc();
    $facultyName = $rowFetchFaculty['faculty_name'];
}

$sqlFetchCourse = "SELECT `course_name`,`course_code` FROM `course_tbl` WHERE `course_id` = ". $_SESSION['course_id_to_evaluate'];
$resultFetchCourse = $conn->query($sqlFetchCourse);

if ($resultFetchCourse->num_rows > 0) {
    $rowFetchCourse = $resultFetchCourse->fetch_assoc();
    $course = $rowFetchCourse['course_code'] . " - " . $rowFetchCourse['course_name'];
}

?>

    <div class="container mt-4">

        <fieldset class=" p-2 mb-3 w-100 rounded" style="border:2px solid #7b0d0d;">
           <legend class="w-auto text-gray-ralph font-weight-light">Evaluation Details:</legend>
           <p class="text-gray-ralph font-weight-bold">Faculty Name: <span class="text-dark font-weight-normal"><?php echo $facultyName; ?></span></p>
           <p class="text-gray-ralph font-weight-bold">Course: <span class="text-dark font-weight-normal"><?php echo $course; ?></span></p>
        </fieldset>
<!--         <hr>
        <h4 class="mb-3 text-center">Questionnaires:</h4>
        <hr> -->
<fieldset class=" p-2 mb-3 w-100 rounded" style="border:2px solid #7b0d0d;">
   <legend class="w-auto text-gray-ralph font-weight-light">Questionnaires:</legend>    
    <div class="table-responsive overflow-auto">
        <form method="POST" action="">
            <?php
            if (isset($result) && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $criteriaId = $row['criteria_id'];
                    $questionIds = explode('|', $row['grouped_question_ids']);

                        $fetchCriteriaSql = "SELECT * FROM criteria_tbl WHERE criteria_id = ?";
                        $stmtfetchCriteria = $conn->prepare($fetchCriteriaSql);

                        // You should bind the parameter to the prepared statement, not the SQL string.
                        $stmtfetchCriteria->bind_param('i', $criteriaId);
                        $stmtfetchCriteria->execute();

                        // You should use $stmtfetchCriteria to fetch the result, not the SQL string.
                        $resultCriteria = $stmtfetchCriteria->get_result();

                        if ($rowCriteria = $resultCriteria->fetch_assoc()) {
                            // Assuming 'criteria' is a column in your table, you can access it like this:
                            $criteriaIdFetch = $rowCriteria['criteria'];
                        } else {
                            // Handle the case when no row is found.
                            $criteriaIdFetch = null; // or any default value you want
                        }


                    echo '<h5 class="text-success font-weight-bold">' . $criteriaIdFetch . '</h5>';
                    echo '<table class="table table-hover"  style="width:100%">';
                    echo '<th class="bg-dark text-light">Questions</th>';
                    echo '<th class="bg-dark text-light">Ratings</th>';
                    $num = 1;
                    foreach ($questionIds as $questionId) {
                        // Fetch the actual question from the database
                        $questionSql = "SELECT question FROM question_tbl WHERE question_id = $questionId";
                        $questionResult = $conn->query($questionSql);
                        if ($questionResult->num_rows > 0) {
                            $questionData = $questionResult->fetch_assoc();
                            $questionText = $questionData['question'];
                            // Display the question as a label
                            echo '<tr>';
                            echo '<td class="col-md-6 col-sm-8">'.$num . ". " . $questionText . '</td>';
                            echo '<td class="col-md-6 col-sm-4">';
                            // Create a hidden field for the question_id
                            echo '<input type="hidden" name="question_id_' . $questionId . '" value="' . $questionId . '">';
                            // Create radio buttons for each question
                            foreach ($radioValues as $value => $label) {
                                echo '<div class="form-check form-check-inline">';
                                echo '<input class="form-check-input" type="radio" name="question_' . $questionId . '" value="' . $value . '" required>';
                                echo '<label class="form-check-label">' . $label . '</label>';
                                echo '</div>';
                            }
                            echo '</td>';
                            echo '</tr>';
                        }
                        $num++;
                    }
                    echo '</table>';
                }
            } else {
                echo 'No questions found for the active academic year.';
            }
            ?>
            </div>
        </fieldset>
            <div class="comments-field">
<!--                 <div class="comments-field-title p-2">
                    <h4>Suggestions:</h4>
                </div> -->
        <fieldset class="p-2 mb-3 w-100 rounded" style="border:2px solid #7b0d0d;">
            <legend class="w-auto text-gray-ralph font-weight-light">Suggestions:</legend>  
                <div class="col-12">
                    <p class="font-italic">Feel free to leave your suggestions and comments here. Your identity will remain anoymous.</p>
                    <textarea name="comments" class="rounded" id="" rows="3" style="width: 100%;" required></textarea>
                </div>
        </fieldset>
            </div>
            <div class="p-2">
                <button type="submit" name="submit" class="btn btn-primary float-right">Submit</button>
            </div>
        </form>
    
        <!-- Add a submit button or other form controls here if needed -->
    </div>
                            
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

    <!-- Page level plugins -->
    <script src="../assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../assets/js/demo/chart-area-demo.js"></script>
    <script src="../assets/js/demo/chart-pie-demo.js"></script>

        <!-- Datatables -->
    <script src="../assets/dataTables/jquery-3.5.1.js"></script> 
    <script src="../assets/dataTables/jquery.dataTables.min.js"></script> 
<script>
    // Get all form-check-label elements
    var labels = document.querySelectorAll('.form-check-label');

    // Add click event listener to each label
    labels.forEach(function (label) {
        label.addEventListener('click', function () {
            // Find the associated radio button
            var radioButton = this.previousElementSibling;

            // Check the radio button if it's not already checked
            if (!radioButton.checked) {
                radioButton.checked = true;
            }
        });
    });
</script>
</body>

</html>
<?php     
    // Close the database connection
    $conn->close();
?>