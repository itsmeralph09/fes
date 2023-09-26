<?php 
session_start();
require './db/dbconn.php';

if (isset($_SESSION['name'])) {
    if ($_SESSION['role'] == "student") {
    header("Location: ./student/index.php");
    $_SESSION['error'] = "You must login first!";
    exit;
    } elseif ($_SESSION['role'] == "faculty") {
    header("Location: ./faculty/index.php");
    exit;
    } elseif ($_SESSION['role'] == "admin"){
    header("Location: ./admin/index.php");
    exit;
    }
}


if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}

$school_id = "";
$password = "";

if (isset($_POST['submit'])) {

    $school_id = $_POST['school_id'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user_tbl WHERE school_id = '$school_id'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {

            $row = mysqli_fetch_assoc($result);

            $hashed_pass = $row['password'];

            if (password_verify($password, $hashed_pass)) {
            $_SESSION['school_id'] = $row['school_id'];
            $_SESSION['role'] = $row['role'];

                // check ng role
                if ($row['role'] == "admin") {
                        $query1 = "SELECT * FROM admin_tbl WHERE school_id = '$school_id'";
                        $result1 = mysqli_query($conn, $query1);
                        $row1 = mysqli_fetch_assoc($result1);
                        $_SESSION['name'] = ucfirst($row1['first_name'])." ".ucfirst($row1['last_name']);
                        header("Location: ./admin/index.php");
                        exit;
                }elseif ($row['role'] == "faculty") {
                        $query1 = "SELECT * FROM faculty_tbl WHERE school_id = '$school_id'";
                        $result1 = mysqli_query($conn, $query1);
                        $row1 = mysqli_fetch_assoc($result1);
                        $_SESSION['name'] = ucfirst($row1['first_name'])." ".ucfirst($row1['last_name']);
                        header("Location: ./faculty/index.php");
                        exit;
                }else{
                        $query1 = "SELECT * FROM student_tbl WHERE school_id = '$school_id'";
                        $result1 = mysqli_query($conn, $query1);
                        $row1 = mysqli_fetch_assoc($result1);
                        $_SESSION['name'] = ucfirst($row1['first_name'])." ".ucfirst($row1['last_name']);
                        $_SESSION['student_id'] = $row1['student_id'];
                        $_SESSION['class_id'] = $row1['class_id'];
                        header("Location: ./student/index.php");
                        exit;
                }

            } else{
            $error = "Incorrect Password!";
            $_SESSION['error'] = $error;
            header("Location: login.php");
            }
    } else{
        $error = "School ID not found!";
        $_SESSION['error'] = $error;
        header("Location: login.php");
    }

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
    <title>FES - Login Page</title>
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/fe15f2148c.js" crossorigin="anonymous"></script>


</head>

<body class="bg-gradient-danger body-class">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image1"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h3 mb-2 text-gray-ralph">Welcome to PCB Faculty Evaluation System!</h1>
                                        <h1 class="h5 mb-4 text-gray">Login</h1>
                                    </div>

                            <?php if(isset($error)) { ?>
                            <p class="text-danger" role="alert"><i class="fa-solid fa-triangle-exclamation mr-2"></i><?php echo $error; ?></p>
                            <?php } ?>



                                    <form class="user" method="post" action="login.php">
                                        <div class="form-group">
                                            <input type="text" name="school_id" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter School ID..." value="<?php echo $school_id; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Enter Password..." required>
                                        </div>
<!--                                         <div class="form-group">
                                            <select name="program" class="form-control form-select-sm half-width fs-6" required>
                                                <option value="1" selected>Sign in as</option>
                                                <option value="Admin" class="fs-6">Admin</option>
                                                <option value="Student" class="fs-6">Student</option>
                                                <option  value="Faculty" class="fs-6">Faculty</option>
                                            </select>
                                        </div> -->
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <input type="submit" name="submit" value="Login" class="btn btn-user btn-block btn-ralph">
                                    </form>



                                    <hr>
                                    <div class="text-center">
                                        <a class="small small-ralph" href="forgot-password.html">Forgot Password?</a>
                                    </div>
<!--                                     <div class="text-center">
                                        <a class="small small-ralph" href="register.html">Create an Account!</a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="assets/js/sb-admin-2.min.js"></script>

</body>

</html>