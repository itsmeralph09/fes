<?php

session_start();

if (!isset($_SESSION['name'])) {
  header('Location: login.php');
  exit;
} else{
      unset($_SESSION['name']);
      unset($_SESSION['role']);

      unset($_COOKIE['PHPSESSID']);
      setcookie('PHPSESSID', '', time() - 3600, '/');

      session_destroy();
      header("Location: login.php");
      exit;
    }

header("Location: login.php");
exit;
?>