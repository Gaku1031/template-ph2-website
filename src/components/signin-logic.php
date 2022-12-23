<?php
require '../db/pdo.php';

$db = new mysqli('db', 'root', 'root', 'posse');

if (isset($_POST['submit'])) {
  $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  
  if (!$email) {
    $_SESSION['signin'] = "Email required";
  } elseif (!$password) {
    $_SESSION['signin'] = "Password Required";
  } else {
    //fetch user from database
    $fetch_user_query = "SELECT * FROM users WHERE email = '$email'";
    $fetch_user_result = mysqli_query($db, $fetch_user_query);
    if (mysqli_num_rows($fetch_user_result) == 1) {
      //convert the record into assoc array
      $user_record = mysqli_fetch_assoc($fetch_user_result);
      $db_password = $user_record['password'];
      // compare from password with database password 
      if (password_verify($password, $db_password)) {
        // set section for access control
        $_SESSION['user-id'] = $user_record['id'];
      //   // set session if user is admin

        //log user in 
        header('location: ' . ROOT_URL);
      } else {
        $_SESSION['signin'] = "Please check your input";
      }
    } else {
      $_SESSION['signin'] = "User not found";
    }
  }

  // if any problem, redirect back to signin page with login data
  if (isset($_SESSION['signin'])) {
    $_SESSION['signin-data'] = $_POST;
    header('location: ' . USER_URL . 'signin.php');
    die();
  }

} else {
  header('location: ' . USER_URL . 'signin.php');
  die();
}
