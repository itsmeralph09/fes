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
} elseif ($_SESSION['role'] == "admin") {
    header("Location: ../admin/index.php");
    exit;
}

?>
<?php
// Replace with your database connection details
require '../db/dbconn.php';

// Check if eval_id is set
if (isset($_GET['eval_id'])) {
    $eval_id = $_GET['eval_id'];

    // Fetch evaluation data from eval_tbl
    $fetchEvalSql = "SELECT * FROM eval_tbl WHERE eval_id = ?";
    $stmtFetchEval = $conn->prepare($fetchEvalSql);
    $stmtFetchEval->bind_param('s', $eval_id);
    $stmtFetchEval->execute();
    $resultFetchEval = $stmtFetchEval->get_result();

    if ($resultFetchEval->num_rows > 0) {
        $rowFetchEval = $resultFetchEval->fetch_assoc();
        $faculty_id_to_evaluate = $rowFetchEval['faculty_id'];
        $course_id_to_evaluate = $rowFetchEval['course_id'];
        $comments = $rowFetchEval['comments'];
    }

    // Fetch faculty name from faculty_tbl
    $fetchFacultySql = "SELECT CONCAT_WS(' ', `first_name`, `middle_name`, `last_name`, `ext_name`) AS `faculty_name`
                   FROM `faculty_tbl`
                   WHERE `faculty_id` = ?";
    $stmtFetchFaculty = $conn->prepare($fetchFacultySql);
    $stmtFetchFaculty->bind_param('i', $faculty_id_to_evaluate);
    $stmtFetchFaculty->execute();
    $resultFetchFaculty = $stmtFetchFaculty->get_result();

    if ($resultFetchFaculty->num_rows > 0) {
        $rowFetchFaculty = $resultFetchFaculty->fetch_assoc();
        $facultyName = $rowFetchFaculty['faculty_name'];
    }

    // Fetch course name from course_tbl
    $fetchCourseSql = "SELECT `course_name`,`course_code` FROM `course_tbl` WHERE `course_id` = ?";
    $stmtFetchCourse = $conn->prepare($fetchCourseSql);
    $stmtFetchCourse->bind_param('i', $course_id_to_evaluate);
    $stmtFetchCourse->execute();
    $resultFetchCourse = $stmtFetchCourse->get_result();

    if ($resultFetchCourse->num_rows > 0) {
        $rowFetchCourse = $resultFetchCourse->fetch_assoc();
        $course = $rowFetchCourse['course_code'] . " - " . $rowFetchCourse['course_name'];
    }
}

// Check if eval_id exists and user has permission
if (!isset($_GET['eval_id']) || $resultFetchEval->num_rows == 0 || $faculty_id_to_evaluate != $_SESSION['faculty_id_to_evaluate'] || $course_id_to_evaluate != $_SESSION['course_id_to_evaluate']) {
    $_SESSION['error'] = 'Invalid evaluation ID or permission denied.';
    // header("Location: evaluate.php");
    // exit;
}

// SQL query to fetch questions grouped by criteria_id for the active academic year
$sql = "SELECT criteria_id, GROUP_CONCAT(question_id ORDER BY question_id ASC SEPARATOR '|') AS grouped_question_ids
        FROM question_tbl
        WHERE acad_id = ? AND course_id = ? AND faculty_id = ?
        GROUP BY criteria_id";

$stmt = $conn->prepare($sql);
$stmt->bind_param('iii', $_SESSION['active_acad_yr'], $_SESSION['course_id_to_evaluate'], $_SESSION['faculty_id_to_evaluate']);
$stmt->execute();
$result = $stmt->get_result();

// Create an array to map radio button values to labels
$radioValues = [
    4 => 'Strongly Agree',
    3 => 'Agree',
    2 => 'Disagree',
    1 => 'Strongly Disagree'
];

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
                                        <div class="container mt-4">
                                            <fieldset class=" p-2 mb-3 w-100 rounded" style="border:2px solid #7b0d0d;">
                                                <legend class="w-auto text-gray-ralph font-weight-light">Evaluation
                                                    Details:</legend>
                                                <p class="text-gray-ralph font-weight-bold">Faculty Name: <span
                                                        class="text-dark font-weight-normal"><?php echo $facultyName; ?></span>
                                                </p>
                                                <p class="text-gray-ralph font-weight-bold">Course: <span
                                                        class="text-dark font-weight-normal"><?php echo $course; ?></span>
                                                </p>
                                            </fieldset>

                                            <fieldset class=" p-2 mb-3 w-100 rounded"
                                                style="border:2px solid #7b0d0d;">
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

                                                                        // Fetch the saved score for this question
                                                                        $fetchScoreSql = "SELECT score FROM eval_answer_tbl WHERE eval_id = ? AND question_id = ?";
                                                                        $stmtFetchScore = $conn->prepare($fetchScoreSql);
                                                                        $stmtFetchScore->bind_param('si', $eval_id, $questionId);
                                                                        $stmtFetchScore->execute();
                                                                        $resultFetchScore = $stmtFetchScore->get_result();

                                                                        $savedScore = null;
                                                                        if ($resultFetchScore->num_rows > 0) {
                                                                            $rowFetchScore = $resultFetchScore->fetch_assoc();
                                                                            $savedScore = $rowFetchScore['score'];
                                                                        }

                                                                        // Display the question as a label
                                                                        echo '<tr>';
                                                                        echo '<td class="col-md-6 col-sm-8">' . $num . ". " . $questionText . '</td>';
                                                                        echo '<td class="col-md-6 col-sm-4">';
                                                                        // Create a hidden field for the question_id
                                                                        echo '<input type="hidden" name="question_id_' . $questionId . '" value="' . $questionId . '">';

                                                                        // Create radio buttons for each question
                                                                        foreach ($radioValues as $value => $label) {
                                                                            echo '<div class="form-check form-check-inline">';
                                                                            $radioName = "question_" . $questionId;
                                                                            $radioId = $radioName . "_" . $value;
                                                                            $radioChecked = ($savedScore === $value) ? 'checked' : '';
                                                                            echo '<input class="form-check-input" type="radio" name="' . $radioName . '" id="' . $radioId . '" value="' . $value . '" ' . $radioChecked . ' disabled>';
                                                                            echo '<label class="form-check-label" for="' . $radioId . '">' . $label . '</label>';
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
                                                    <fieldset class="p-2 mb-3 w-100 rounded"
                                                        style="border:2px solid #7b0d0d;">
                                                        <legend class="w-auto text-gray-ralph font-weight-light">Suggestions:</legend>
                                                        <div class="col-12">
                                                            <p class="font-italic">Feel free to leave your suggestions
                                                                and comments here. Your identity will remain anoymous.</p>
                                                            <textarea name="comments" class="rounded" id="" rows="3"
                                                                style="width: 100%;" readonly><?php echo $comments; ?></textarea>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div class="p-2">
                                                    <a href="evaluate.php" class="btn btn-primary float-right">Back</a>
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
</body>

</html>
<?php
// Close the database connection
$conn->close();
?>
