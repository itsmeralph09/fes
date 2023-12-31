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
        icon: 'warning',
        // title: 'info!',
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
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h2 mb-0 text-gray-800"><i class="fas fa-fw fa-tachometer-alt"></i>Dashboard</h1>
<!--                         <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <?php

                        require '../db/dbconn.php';

                            $sql = "SELECT * FROM acad_yr_tbl WHERE is_default = 'yes'";

                            $result = mysqli_query($conn, $sql);

                        ?>

                        <!-- Academic Year Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-gray text-uppercase mb-1">
                                                Academic Year: 
                                                <?php 
                                                    if (mysqli_num_rows($result) >= 1) { 
                                                        $row = mysqli_fetch_assoc($result); 
                                                    ?>
                                                        <p class="text-danger">
                                                        <?php 
                                                            echo $row['year_start']."-".$row['year_end']; 
                                                        ?>
                                                        <?php if ($row['semester'] == 1) {
                                                            echo "First Semester";
                                                        } else if($row['semester'] == 2){
                                                            echo "Second Semester";
                                                        } else{
                                                            echo "Mid-Year";
                                                        }
                                                        ?>
                                                        </p>
                                                <?php
                                                    } else{
                                                        echo "No default academic year set!";
                                                    }
                                                ?>
 
                                            </div>
                                            
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="h6 mb-0 font-weight-bold text-gray">Evaluation Status: <p class="text-danger">
                                        <?php
                                            if ($row['status'] == 'started') {
                                                 echo "Started";
                                             } else{
                                                echo "Closed";
                                             }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Total Faculty Card -->
                        <?php

                            require '../db/dbconn.php';

                            $sql = "SELECT * FROM faculty_tbl ORDER BY date_created ASC";

                            $result = mysqli_query($conn, $sql);
                            $total_faculties = mysqli_num_rows($result);
                        ?>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                                Total Faculties</div>
                                            <div class="h5 mb-0 font-weight-bold text-success"><?php echo $total_faculties; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-person-chalkboard fa-2x text-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Students Card -->
                        <?php

                            require '../db/dbconn.php';

                            $sql = "SELECT * FROM student_tbl ORDER BY class_id ASC";

                            $result = mysqli_query($conn, $sql);
                            $total_students = mysqli_num_rows($result);
                        ?>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Total Students
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-info"><?php echo $total_students; ?></div>
                                                </div>
                                                <div class="col">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-person-walking fa-2x text-info"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Users Card -->
                                                <?php

                            require '../db/dbconn.php';

                            $sql = "SELECT * FROM user_tbl";

                            $result = mysqli_query($conn, $sql);
                            $total = mysqli_num_rows($result);
                        ?>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                                Total Users</div>
                                            <div class="h5 mb-0 font-weight-bold text-warning"><?php echo $total; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-warning"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-danger">Faculty Evaluation Overview</h6>
<!--                                     <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div> -->
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

<!-- Polar Area Chart -->
<div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-danger">Number of Users</h6>
<!--             <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                    aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Dropdown Header:</div>
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </div> -->
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-pie pt-4 pb-2">
                <canvas id="myPolarChart"></canvas>
            </div>
            <div class="mt-4 text-center small">
                <span class="mr-2">
                    <i class="fas fa-circle" style="color: #7b0d0d;"></i> Student
                </span>
                <span class="mr-2">
                    <i class="fas fa-circle" style="color: #7b6d6d;"></i> Faculty
                </span>
                <span class="mr-2">
                    <i class="fas fa-circle" style="color: #F65b78;"></i> Admin
                </span>
            </div>
        </div>
    </div>
</div>


                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                        </div>

                        <div class="col-lg-6 mb-4">

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
<script>
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito, -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Function to fetch data from PHP script
function fetchDataFromDatabase() {
    return fetch('polar_chart_fetch.php')
        .then(response => response.json())
        .then(data => {
            console.log(data);
            return data.map(Number); // Convert strings to numbers
        });
}

// Create the polar area chart when the data is fetched
async function createPolarChart() {
    const data = await fetchDataFromDatabase();
    console.log(data);

    // Polar Area Chart Example
    var ctx = document.getElementById("myPolarChart");
    var myPolarChart = new Chart(ctx, {
        type: 'polarArea',
        data: {
            labels: ["Student", "Faculty", "Admin"],
            datasets: [{
                data: data, // Use the fetched data here
                backgroundColor: ['rgba(123, 13, 13, 0.5)', 'rgba(123, 109, 109, 0.5)', 'rgba(246, 91, 120, 0.5)'],
                hoverBackgroundColor: ['rgba(155, 45, 45, 0.7)', 'rgba(123, 61, 61, 0.7)', 'rgba(245, 75, 80, 0.7)'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false
            },
            scale: {
                gridLines: {
                    color: "#e3e3e3"
                },
                ticks: {
                    beginAtZero: true
                }
            },
            layout: {
                padding: {
                    left: 0,
                    right: 0,
                    top: 0,
                    bottom: 0
                }
            },
            plugins: {
                legend: {
                    position: 'right',
                },
                datalabels: {
                    formatter: function (value, ctx) {
                        var sum = ctx.chart.data.datasets[0].data.reduce(function (a, b) {
                            return a + b;
                        }, 0);
                        var percentage = (value * 100 / sum).toFixed(2) + "%";
                        return percentage;
                    },
                    color: '#fff',
                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                    borderRadius: 6,
                    anchor: 'center',
                    align: 'center',
                    offset: 0,
                    font: {
                        weight: 'bold',
                        size: 14,
                    },
                    padding: 6,
                }
            }
        },
    });
}

// Call the function to create the chart
document.addEventListener('DOMContentLoaded', function () {
    createPolarChart();
});

</script>
</body>
</html>