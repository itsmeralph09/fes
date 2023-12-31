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


        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                

                    
                <div class="row g-4 mb-4">
                    
                    <div class="col-12 col-md-12 mb-2">
                        <div class="card card-settings shadow-sm p-4">
                            <div class="app-card-body">
                <h4 class="app-page-title">Select Evaluation</h4>
                                <form class="form">
                                    <div class="mb-3">
                                        <fieldset class="form-group">
                                            <select class="form-select form-select-sm form-control" aria-label=".form-select-sm example">
                                              <option selected>Select Faculty and Course..</option>
                                              <option value="1">Maria Theresa Bayani - ITE 3</option>
                                              <option value="2">Lester Angelo Dela Cruz - ITH 108</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Select</button>
                                </form>
                            </div><!--//app-card-body-->
                            
                        </div><!--//app-card-->
                    </div>
                    <div class="col-12 col-md-12">
                        <div class="card card-settings shadow-sm p-4">
                            <div class="card-body">
                                <form class="settings-form">
                                    <div class="mb-3">
                                        <fieldset class="border p-2 w-100">
                       <legend  class="w-auto">Rating Legend</legend>
                       <p>5 = Strongly Agree, 4 = Agree, 3 = Uncertain, 2 = Disagree, 1 = Strongly Disagree</p>
                    </fieldset><br>
                                        <label for="setting-input-2" class="form-label text-dark">Attendance</label>
                                        <table class="table app-table-hover mb-0 text-left">
                                        <thead>
                                            <tr>
                                                <th class="cell">Questions</th>
                                                <th class="cell">5</th>
                                                <th class="cell">4</th>
                                                <th class="cell">3</th>
                                                <th class="cell">2</th>
                                                <th class="cell">1</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="cell">Start classes on time.</td>
                                                <td>
                                                    <input type="radio" name="answer" id="answer" value="yes" required>
                                                </td>
                                                <td>
                                                    <input type="radio" name="answer" id="answer" value="yes" required>
                                                </td>
                                                <td>
                                                    <input type="radio" name="answer" id="answer" value="yes" required>
                                                </td>
                                                <td>
                                                    <input type="radio" name="answer" id="answer" value="yes" required>
                                                </td>
                                                <td>
                                                    <input type="radio" name="answer" id="answer" value="yes" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="cell">Always attend classes schedule.</td>
                                                <td>
                                                    <input type="radio" name="answer1" id="answer1" value="yes" required>
                                                </td>
                                                <td>
                                                    <input type="radio" name="answer1" id="answer1" value="yes" required>
                                                </td>
                                                <td>
                                                    <input type="radio" name="answer1" id="answer1" value="yes" required>
                                                </td>
                                                <td>
                                                    <input type="radio" name="answer1" id="answer1" value="yes" required>
                                                </td>
                                                <td>
                                                    <input type="radio" name="answer1" id="answer1" value="yes" required>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    </div><br>
                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label text-dark">Preparedness</label>
                                        <table class="table app-table-hover mb-0 text-left">
                                        <thead>
                                            <tr>
                                                <th class="cell">Questions</th>
                                                <th class="cell">5</th>
                                                <th class="cell">4</th>
                                                <th class="cell">3</th>
                                                <th class="cell">2</th>
                                                <th class="cell">1</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="cell">Mastered the lesson.</td>
                                                <td>
                                                    <input type="radio" name="answer2" id="answer2" value="yes" required>
                                                </td>
                                                <td>
                                                    <input type="radio" name="answer2" id="answer2" value="yes" required>
                                                </td>
                                                <td>
                                                    <input type="radio" name="answer2" id="answer2" value="yes" required>
                                                </td>
                                                <td>
                                                    <input type="radio" name="answer2" id="answer2" value="yes" required>
                                                </td>
                                                <td>
                                                    <input type="radio" name="answer2" id="answer2" value="yes" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="cell">Prepare a well-structured lesson.</td>
                                                <td>
                                                    <input type="radio" name="answer4" id="answer4" value="yes" required>
                                                </td>
                                                <td>
                                                    <input type="radio" name="answer4" id="answer4" value="yes" required>
                                                </td>
                                                <td>
                                                    <input type="radio" name="answer4" id="answer4" value="yes" required>
                                                </td>
                                                <td>
                                                    <input type="radio" name="answer4" id="answer4" value="yes" required>
                                                </td>
                                                <td>
                                                    <input type="radio" name="answer4" id="answer4" value="yes" required>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    </div>
                                </form>
                            </div><!--//app-card-body-->
                            
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