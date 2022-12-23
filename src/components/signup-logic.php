<?php
require '../db/pdo.php';

// mysqlへの接続処理
$db = new mysqli('db', 'root', 'root', 'posse');
// get signup form data if signup button was clicked
if (isset($_POST['submit'])) {
  //バリデーション
  $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
  $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  //validate input values
  if (!$name) {
    $_SESSION['signup'] = "Please enter your Name";
  } elseif (!$email) {
    $_SESSION['signup'] = "Please enter your a valid email";
  } elseif (strlen($password) < 8) {
    $_SESSION['signup'] = "Password should be 8+ characters";
  } else {
      // hash password
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      //check if username or email already exist in database
      // global $connection;
      $user_check_query = "SELECT * FROM users WHERE email = '$email'";
      $user_check_result = mysqli_query($db, $user_check_query);
      if (mysqli_num_rows($user_check_result) > 0) {
        $_SESSION['signup'] = "Email already exist";
      } 
    }
    //redirect back to signup page if there was any problem
    if (isset($_SESSION['signup'])) {
      //pass form data back to sign up page
      $_SESSION['signup-data'] = $_POST;
      header('location: ' . USER_URL . 'signup.php');
      die();
    } else {
      // insert new user into users table
      $insert_user_query = "INSERT INTO users SET name='$name', email='$email', password='$hashed_password'";
      $insert_user_result = mysqli_query($db, $insert_user_query);

      if (!mysqli_errno($db)) {
        // redirect to login page with success message
        $_SESSION['signup-success'] = "Registration successful. Please log in";
        header('location: ' . USER_URL . 'signin.php');
        die();
      }
    }
  } else {
  // if button was not clicked, bounce back to signup page
  header('location: ' . USER_URL . 'signup.php');
  die();
}
