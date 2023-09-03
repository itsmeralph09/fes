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
                        <h1 class="h2 mb-0 text-gray-800"><i class="fa-solid fa-user-pen mr-2"></i>Manage Admin</h1>
                    </div>
                    <hr class="mb-3 bg-white1">

<div class="container card p-2 mb-4 shadow-sm">
            <?php if(isset($_SESSION['error'])) { ?>
                <div class="alert alert-warning  alert-dismissible fade show" id="alert" role="alert">
                    <strong class="text-danger mb-0"><i class="fas fa-circle-exclamation mr-1"></i><?php echo $_SESSION['error']; ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['error']); ?>                
            <?php } ?> 

            <?php if(isset($_SESSION['success'])) { ?>
                <div class="alert alert-success alert-dismissible fade show" id="alert" role="alert">
                    <strong class="text-success mb-0"><i class="fas fa-circle-check mr-1"></i><?php echo $_SESSION['success']; ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['success']); ?>  
            <?php } ?> 
                            
    <div class="row">
        <div class="col-12 col-md-12">
<!--             <div class="row">
            </div> -->
            <div class="container mb-2 mt-2">
                <a href="#addnew" data-toggle="modal" class="btn btn-primary"><i class="fa-solid fa-plus mr-1"></i>New</a>
            </div>
            <hr>
            <div class="container mb-4 border-danger">
                <!-- <a href="#addnew" data-toggle="modal" class="btn btn-primary mb-3"><span class="glyphicon glyphicon-plus"></span>New</a> -->
                <table id="myTable" class="table table-bordered nowrap dt-responsive" style="width:100%">
                    <thead class="table-dark">
                        <th data-priority="1">#</th>
                        <th>Full Name</th>
                        <th>School ID</th>
                        <th>Email</th>
                        <th data-priority="1">Action</th>
                    </thead>
                    <tbody>
                        <?php
                            require '../db/dbconn.php';
                            $sql = "SELECT * FROM admin_tbl ORDER BY date_created ASC";

                            //use for MySQLi Procedural
                            $num = 1;
                            $query = mysqli_query($conn, $sql);


                            while($row = mysqli_fetch_assoc($query)){
                                echo
                                "<tr>
                                    <td>".$num."</td>
                                    <td>".$row['first_name']. " " .$row['middle_name']. " " .$row['last_name']."</td> 
                                    <td>".$row['school_id']."</td>
                                    <td>".$row['email']."</td>
                                    <td>
                                        <a href='#edit_".$row['admin_id']."' class='btn btn-success btn-sm' data-toggle='modal'><i class='fa fa-pen-to-square m-1'></i>Edit</a>
                                        <a href='#delete_".$row['admin_id']."' class='btn btn-danger btn-sm' data-toggle='modal'><i class='fa fa-trash m-1'></i>Delete</a>
                                    </td>
                                </tr>";
                                include('admin_edit_delete_modal.php');

                            $num++;}

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include('admin_add_modal.php') ?>




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


    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>

    <script>
        $(document).ready(function(){
        //inialize datatable
        $('#myTable').DataTable({
        responsive: true
        })
        //hide alert
        $(document).on('click', '.close', function(){
            $('.alert').hide();
        })
        });

    </script>
    <script type="text/javascript">
        setTimeout(function () {

            // Closing the alert
            $('#alert').alert('close');
        }, 4000);
    </script>


</body>

</html>