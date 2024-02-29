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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>
        <!-- End of Sidebar -->

        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <?php include 'topbar.php'; ?>
                <!-- End of Topbar -->

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
                        <h1 class="h2 mb-0 text-gray-800"> <i class="fas fa-fw fa-chart-bar mr-1"></i>Evaluation Report</h1>
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
                            <div class="col-12 col-md-12">
                                <div class="row">
                                </div>
                                    <div class="container my-3">
                                        <a href="report_3.php" class="btn btn-secondary p-2"><i class="fa-solid fa-arrow-turn-down fa-rotate-90 mx-2 fa-xs"></i>Back</a>
                                    </div>
                                    <hr class="mt-1">
                                    <div class="container">
                                    <div class="container p-0">
                                        <fieldset class="p-3 my-3 w-100 rounded" style="border:2px solid #7b0d0d;">
                                            <legend class="w-auto text-gray-ralph font-weight-bolder">Select Faculty:</legend>
                                            <form method="post" id="evaluationForm">
                                                
                                                    <?php 
                                                        require '../db/dbconn.php';
                                                        $faculties = [];
                                                        $sql2 = "SELECT faculty_id, CONCAT(first_name,' ',last_name) AS faculty_name, department FROM faculty_tbl ORDER BY department ASC, faculty_name ASC";
                                                        $result2 = $conn->query($sql2);
                                                        if ($result2->num_rows > 0) {
                                                            while ($row2 = $result2->fetch_assoc()) {
                                                                // Use an associative array to store course_id as the key and course_code + course_name as the value
                                                                $faculties[$row2['faculty_id']] = $row2['faculty_name'];
                                                            }
                                                        }
                                                    ?>
                                                <div class="mb-2 form-group">
                                                    <select name="selectedFaculty" id="selectedFaculty" class="form-select form-select-sm form-control" required>
                                                        <option value="" selected disabled>Select a faculty</option>
                                                        <?php foreach ($faculties as $facultyId => $facultyName) { ?>
                                                            <option value="<?php echo $facultyId; ?>"><?php echo  $facultyName; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <hr>
                                                <div class="float-right">
                                                    <!-- <button class="btn btn-primary my-1" type="button" value="Generate" id="generateButton"><i class="fa-solid fa-gears mr-1"></i>Generate</button> -->
                                                    <button class="btn btn-success my-1" type="button" id="printButton" disabled><i class="fa-solid fa-print mr-1"></i>Print</button>
                                                </div>
                                            </form>
                                        </fieldset>
                                        
                                        
                                        <fieldset class="p-1 my-1 w-100 rounded" id="printPage" style="border:2px solid #7b0d0d;">
                                            <legend class="w-auto text-center text-gray-ralph font-weight-bolder">Evaluation Summary</legend>
                                            <div class="text-center p-2">
                                                <div class="font-italic">You are viewing report for Academic Year <span class="font-weight-bold"><?php echo $acad_year. " ". $sem; ?> for faculty <span class="font-weight-bold text-danger" id="selectedFacultySpan">(no selected faculty)</span></div>
                                            </div>
                                            <div class="text-center font-italic p-2 text-warning" id="hiddenDiv">No Faculty Selected</div>
                                        <div class="d-flex flex-lg-row flex-column py-4">
                                            <div class="container overflow-auto">
                                                <p class="font-weight-bold">Overall Average Rating: <span id="overallAverage" class="font-italic text-danger">No Faculty Selected</span></p>
                                                <table id="myTable" class="table table-bordered nowrap" width="100%" style="width: 100%;">
                                                    
                                                        <thead class="table-dark">
                                                            <th>#</th>
                                                            <th>Course</th>
                                                            <th>Course Name</th>
                                                            <th>Average</th>
                                                            <th>Descriptive Rating</th>
                                                        </thead>
                                                    
                                                    
                                                        <tbody>
                                                            
                                                        </tbody>
                                                    
                                                </table>
                                            </div>

                                        </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include 'footer.php'; ?>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button -->
    <a class="scroll-to-top bg-danger rounded-circle" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal -->
    <?php include 'logout.php'; ?>

    <!-- JavaScript and Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../assets/js/sb-admin-2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://kit.fontawesome.com/fe15f2148c.js" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        // Add change event listener to the select element
        $("#selectedFaculty").change(function() {
            var facultyId = $(this).val(); // Get the selected faculty ID
            var acadId = "<?php echo $acad_id; ?>";

            // Check if a faculty is selected
            if (facultyId) {
                $.ajax({
                    url: 'fetch_evaluation_faculty_data.php',
                    type: 'POST',
                    data: { faculty_id: facultyId, acad_id: acadId },
                    success: function(data) {
                        // Assuming data is returned in JSON format
                        // You can customize this part according to your data structure
                        if (data.trim() !== '') {
                            $("#myTable tbody").html(data);
                            $('#printButton').prop('disabled', false);
                            $('#selectedFacultySpan').text($("#selectedFaculty option:selected").text());
                            $('#hiddenDiv').hide();

                            // Calculate the overall average and descriptive rating
                            var totalAverage = 0;
                            var rowCount = 0;
                            var descriptiveRating = '';
                            $("#myTable tbody tr").each(function() {
                                var average = parseFloat($(this).find('td:eq(3)').text());
                                if (!isNaN(average)) {
                                    totalAverage += average;
                                    rowCount++;
                                }
                            });

                            if (rowCount > 0) {
                                var overallAverage = totalAverage / rowCount;
                                $("#overallAverage").text(overallAverage.toFixed(2));

                                // Set descriptive rating
                                if (overallAverage >= 1 && overallAverage <= 1.99) {
                                    descriptiveRating = "Poor";
                                } else if (overallAverage >= 2 && overallAverage <= 2.99) {
                                    descriptiveRating = "Fair";
                                } else if (overallAverage >= 3 && overallAverage <= 3.99) {
                                    descriptiveRating = "Satisfactory";
                                } else if (overallAverage === 4) {
                                    descriptiveRating = "Very Satisfactory";
                                }
                            } else {
                                $("#overallAverage").text("No Faculty Selected");
                            }

                            // Set text of overallAverage span with descriptive rating
                            $("#overallAverage").text($("#overallAverage").text() + " (" + descriptiveRating + ")");
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'No data available for the selected faculty!',
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        // Handle errors here
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'An error occurred while fetching data. Please try again later!',
                        });
                    }
                });
            } else {
                // If no faculty is selected, you can handle it here (if needed)
            }
        });
    });
</script>

<script>
document.getElementById('printButton').addEventListener('click', function() {
    var contentToPrint = document.getElementById('printPage').outerHTML;
    
    // Create a new window to render the content for printing
    var printWindow = window.open('', '_blank', 'width=800,height=800');
    printWindow.document.open();
    printWindow.document.write('<html><head><title>Faculty Evaluation System</title><style>#chartDiv1 { display: none; }</style></head><body><center>Faculty Evaluation System</center>' + contentToPrint + '</body></html>');
    printWindow.document.close();

    setTimeout(function() {
        printWindow.document.title = "Faculty Evaluation System"; // Set the title after the document is closed
        printWindow.print();
        printWindow.close(); // Close the window after printing
    }, 500);
});

</script>

</body>
</html>
