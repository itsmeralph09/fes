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
                                        <a href="report.php" class="btn btn-secondary p-2"><i class="fa-solid fa-arrow-turn-down fa-rotate-90 mx-2 fa-xs"></i>Back</a>
                                    </div>
                                    <hr class="mt-1">
                                    <div class="container">
                                    <div class="container p-0">
                                        <fieldset class="p-3 my-3 w-100 rounded" style="border:2px solid #7b0d0d;">
                                            <legend class="w-auto text-gray-ralph font-weight-bolder">Select Course:</legend>
                                            <form method="post" id="evaluationForm">
                                                
                                                    <?php 
                                                        require '../db/dbconn.php';
                                                        // Get a list of courses for the dropdown
                                                        // $courses = [];
                                                        // $sql = "SELECT course_id, course_code, course_name FROM course_tbl";
                                                        // $result = $conn->query($sql);
                                                        // if ($result->num_rows > 0) {
                                                        //     while ($row = $result->fetch_assoc()) {
                                                        //         // Use an associative array to store course_id as the key and course_code + course_name as the value
                                                        //         $courses[$row['course_id']] = $row['course_code'] . ' - ' . $row['course_name'];
                                                        //     }
                                                        // }

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
                                                <div class="form-group">
                                                    <select name="selectedCourse" id="selectedCourse" class="form-select form-select-sm form-control" required disabled>
                                                        <option value="" selected disabled>Select a faculty first</option>
                                                    </select>
                                                </div>
                                                <hr>
                                                <div class="float-right">
                                                    <button class="btn btn-primary my-1" type="button" value="Generate" id="generateButton"><i class="fa-solid fa-gears mr-1"></i>Generate</button>
                                                    <button class="btn btn-success my-1" type="button" id="printButton" disabled><i class="fa-solid fa-print mr-1"></i>Print</button>
                                                </div>
                                            </form>
                                        </fieldset>
                                        
                                        
                                        <fieldset class="p-1 my-1 w-100 rounded" id="printPage" style="border:2px solid #7b0d0d;">
                                            <legend class="w-auto text-center text-gray-ralph font-weight-bolder">Evaluation Summary</legend>
                                            <div class="text-center p-2">
                                                <div class="font-italic">You are viewing report for Academic Year <span class="font-weight-bold"><?php echo $acad_year. " ". $sem; ?> </span> for course: <span class="font-weight-bold" id="selectedCourseSpan">(no course selected)</span> for faculty <span class="font-weight-bold" id="selectedFacultySpan">(no selected faculty)</span></div>
                                            </div>
                                            <div class="text-center font-italic p-2 text-warning" id="hiddenDiv">No Course Selected</div>
                                        <div class="d-flex flex-lg-row flex-column py-4" id="chartDiv1">
                                                    <div class="col-lg-6 col-12 justify-content-center align-content-center" id="chart-container">
                                                            <canvas class="p-1" id="polarAreaChart"></canvas>
                                                    </div>
                                                    <div class="col-lg-6 col-12" id="table-container">
                                                        <canvas class="p-1" id="donutChart"></canvas>
                                                    </div>
                                        </div>
                                        <div class="d-flex flex-lg-row flex-column py-2 justify-content-center" id="dataTableScore">
                                                        
                                                        <div class="card shadow-sm border-left-danger col-lg-4 col-12 text-center p-2 rounded">
                                                            <h5 class="text-gray-ralph">Total Evaluation Score</h5>
                                                            
                                                            <div class="text-center font-weight-bolder font-italic h1" id="facultyScore"></div>
                                                            <div class="text-center font-weight-bold font-italic h6" id="facultyRate"></div>
                                                            
                                                        </div>
                                                        <div class="card shadow-sm border-left-danger col-lg-3 col-12 text-center p-2 rounded mx-lg-4 my-sm-2 my-lg-0">
                                                            <h5 class="text-gray-ralph">Evaluation Score Breakdown</h5>
                                                            <div class="text-center font-italic" id="scoreBreakDown"></div>
                                                        </div>
                                                        <div class="card shadow-sm border-left-danger col-lg-4 col-12 text-center p-2 rounded">
                                                            <h5 class="text-gray-ralph">Class Submission Breakdown</h5>
                                                            <div class="text-center font-italic" id="studentCountBreakDown"></div>
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
// Function to update the chart
function updateChart(criteriaNames, avgScores) {
        // Check if there is data to display
        if (criteriaNames.length === 0 || avgScores.length === 0) {
            // No data, show the hiddenDiv and hide the chart and table containers
            $('#hiddenDiv').show();
            return;
        }

        // Data is available, hide the hiddenDiv and show the chart and table containers
        $('#hiddenDiv').hide();

    var data = {
        labels: criteriaNames,
        datasets: [{
            label: 'Average Score',
            data: avgScores,
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
            ],
            borderWidth: 1
        }]
    };

    var ctx = document.getElementById('polarAreaChart').getContext('2d');

    // Check if polarAreaChart is already defined and is an instance of Chart
    if (typeof polarAreaChart !== 'undefined' && polarAreaChart instanceof Chart) {
        polarAreaChart.destroy(); // Destroy the existing chart
    }

    polarAreaChart = new Chart(ctx, {
        type: 'polarArea',
        data: data,
        options: {
            scale: {
                ticks: {
                    beginAtZero: true,
                    max: 100 // Set the maximum value to 100 (percentage)
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            return context.label + ': ' + context.formattedValue;
                        }
                    }
                }
            }
        }
    });
}


    // AJAX request when the "Generate" button is clicked
    $(document).ready(function () {
        $('#generateButton').click(function () {
            var selectedCourse = $('#selectedCourse').val();
            // var selectedFaculty = <?php echo $_GET['faculty_id']; ?>;
            var selectedFaculty = $('#selectedFaculty').val();
            var selectedAcadYear = <?php echo $_GET['acad_id']; ?>;


            // Make an AJAX request to fetch evaluation data
            $.ajax({
                url: 'fetch_evaluation_data_per_faculty.php', // Replace with the correct URL
                type: 'POST',
                data: { selectedCourse: selectedCourse,
                        selectedFaculty: selectedFaculty,
                        selectedAcadYear: selectedAcadYear
                     },
                success: function (response) {
                    // Parse the JSON response
                    console.log(response);
                    var data = JSON.parse(response);


                    // Check if the classData array is empty
                    if (data.criteriaNames.length === 0) {
                        // Display a SweetAlert2 notification for empty data
                        Swal.fire({
                            icon: 'info',
                            title: 'No Data Available',
                            text: 'There is no data available for the selected course.',
                        });
                    } else {
                        // Update the chart with the new data
                        updateChart(data.criteriaNames, data.avgScores);
                        $('#selectedCourseSpan').text($('#selectedCourse option:selected').text());
                        $('#selectedFacultySpan').text($('#selectedFaculty option:selected').text());
                        // Calculate the total score
                        var totalScore = calculateAverage(data.avgScores);
                        // console.log(totalScore);
                        // Set the text of the facultyScore
                        $('#facultyScore').text(totalScore.toFixed(2)); // Assuming 2 decimal places
                        var average = totalScore;

                        if (average >= 1 && average <= 1.99) {
                            $('#facultyRate').text("Poor");
                        } else if (average >= 2 && average <= 2.99) {
                            $('#facultyRate').text("Fair");
                        } else if (average >= 3 && average <= 3.99) {
                            $('#facultyRate').text("Satisfactory");
                        } else if (average === 4) {
                            $('#facultyRate').text("Very Satisfactory");
                        }
                        // Get the scoreBreakDown element
                        var scoreBreakDown = document.getElementById('scoreBreakDown');

                        // Clear the content of the div
                        scoreBreakDown.innerHTML = "";

                        // Loop through the data and append each element with a line break to the div
                        for (let i = 0; i < data.criteriaNames.length; i++) {
                            scoreBreakDown.innerHTML += data.criteriaNames[i] + ' ' + data.avgScores[i] + '<br>';
                        }
                        document.getElementById('printButton').disabled = false;

                    }
                    

                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error fetching data',
                    });
                }

            });
function calculateAverage(scores) {
    // Filter out any non-numeric values or undefined elements
    var filteredScores = scores.filter(function(score) {
        return !isNaN(score) && score !== undefined;
    });

    if (filteredScores.length === 0) {
        return 0; // If there are no valid scores
    }

    var total = filteredScores.reduce(function(acc, val) {
        return acc + parseFloat(val); // Parsing scores to float
    }, 0);

    return total / filteredScores.length;
}

        });
        

$('#selectedFaculty').change(function () {
    var selectedFaculty = $('#selectedFaculty').val();
    var selectedAcadYear = <?php echo $_GET['acad_id']; ?>;
    var selectedCourseSelect = $('#selectedCourse');

        if (selectedFaculty === '') {
            selectedCourseSelect.prop('disabled', true);
            selectedCourseSelect.val('');
        } else {
            selectedCourseSelect.prop('disabled', false);
        }

    $.ajax({
        url: 'fetch_course.php',
        type: 'POST',
        data: {
            selectedFaculty: selectedFaculty,
            selectedAcadYear: selectedAcadYear
        },
        success: function (response) {
            // Parse the JSON response
            var data = JSON.parse(response);

            // Clear existing course options
            $('#selectedCourse').empty();

            if ($.isEmptyObject(data)) {
                var selectedFacultyName = $('#selectedFaculty option:selected').text();
                selectedCourseSelect.prop('disabled', true);
                // If data is empty, add a disabled "No available subjects" option
                $('#selectedCourse').append($('<option>', {
                    value: '',
                    text: 'No evaluated subjects available for '+ selectedFacultyName,
                    disabled: true,
                    selected: true
                }));
            } else {
                // Add new course options
                $.each(data, function (courseId, courseName) {
                    $('#selectedCourse').append($('<option>', {
                        value: courseId,
                        text: courseName
                    }));
                });
            }
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error fetching data',
            });
        }
    });
});


    });

</script>
<script>
// AJAX request when the "Generate" button is clicked
$(document).ready(function () {
    $('#generateButton').click(function () {
        var selectedCourse = $('#selectedCourse').val();
        var facultyId = $('#selectedFaculty').val();

            // AJAX request to fetch evaluation summary (total number of students per class)
            $.ajax({
                url: 'fetch_total_students.php', // Replace with the correct URL
                type: 'POST',
                data: { selectedCourse: selectedCourse, facultyId: facultyId },
                success: function (response) {
                    // Parse the JSON response
                    console.log(response);
                    var data = JSON.parse(response);

                    // Check if the classData array is empty
                    if (data.classData.length === 0) {
                        // Display a SweetAlert2 notification for empty data
                        Swal.fire({
                            icon: 'info',
                            title: 'No Data Available',
                            text: 'There is no data available for the selected course.',
                        });
                    } else {
                        // Update the donut chart with the new data
                        updateDonutChart(data.classData);
                    }
                },
                error: function () {
                    // Handle the error more gracefully here
                    // Example using SweetAlert2:
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error fetching data',
                    });
                }
            });
    });
});
// Modify the updateDonutChart function
var donutChart;

// Function to update the donut chart
function updateDonutChart(classData) {
    // Check if there is data to display
    if (classData.length === 0) {
        // No data, show the hiddenDiv and hide the chart container
        $('#hiddenDiv').show();
        return;
    }

    // Data is available, hide the hiddenDiv and show the chart container
    $('#hiddenDiv').hide();

    // Extract class names and student counts
    var classNames = [];
    var studentCounts = [];
    classData.forEach(function (item) {
        classNames.push(item.className);
        studentCounts.push(item.totalStudents);
    });

    var studentCountBreakDown = document.getElementById('studentCountBreakDown');
    // Clear the content of the div
    studentCountBreakDown.innerHTML = "";

    // Using a for loop to iterate through the array and append each element with a line break to the div
    for (let i = 0; i < classNames.length; i++) {
        studentCountBreakDown.innerHTML += classNames[i] + ': ' + studentCounts[i] + ' student(s) submitted<br>';
    }
    // Create the donut chart or update the existing one
    if (typeof donutChart === 'undefined') {
        var ctxDonut = document.getElementById('donutChart').getContext('2d');
        donutChart = new Chart(ctxDonut, {
            type: 'doughnut',
            data: {
                labels: classNames,
                datasets: [{
                    data: studentCounts,
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
            ],
            borderWidth: 1
                }],
            },
            options: {
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                            var label = context.label;
                            var value = context.raw;
                            var percentage = ((value / studentCounts.reduce((a, b) => a + b, 0)) * 100).toFixed(2) + '%';
                            return label + ': ' + value + ' student(s) (' + percentage + ')';
                        },
                        },
                    },
                },
            },
        });
    } else {
        // Update the existing chart with new data
        donutChart.data.labels = classNames;
        donutChart.data.datasets[0].data = studentCounts;
        donutChart.update();
    }
}
</script>
<script>
document.getElementById('printButton').addEventListener('click', function() {
    var contentToPrint = document.getElementById('printPage').outerHTML;
    
    // Create a new window to render the content for printing
    var printWindow = window.open('', '_blank', 'width=800,height=800');
    printWindow.document.open();
    printWindow.document.write('<html><head><title>Faculty Evaluation System</title><style>#chartDiv1 { display: none; }</style></head><body><center>Faculty Evaluation System</center>' + contentToPrint + '</body></html');
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
