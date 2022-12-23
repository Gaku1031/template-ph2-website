<?php
require '../db/pdo.php';


// get back form data if there was a registration error
$name = $_SESSION['signup-data']['firstname'] ?? null;
$email = $_SESSION['signup-data']['email'] ?? null;
$password = $_SESSION['signup-data']['createpassword'] ?? null;

//delete signup data session
unset($_SESSION['signup-data']);
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP & MySQL Blog Application with Admin Panel</title>
  <link rel="stylesheet" href="../admin/admin.css">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap">
</head>
<body>


<section class="form__section">
  <div class="container form__section-container">
    <h2>Sign Up</h2>
    <?php if(isset($_SESSION['signup'])):?>
      <div class="alert__message error">
        <p>
          <?= $_SESSION['signup'];
          unset($_SESSION['signup']);
          ?>
        </p>
      </div>
    <?php endif ?>
    <form action="<?=USER_URL ?>signup-logic.php" enctype="multipart/form-data" method="POST">
      <input type="text" name="name" value="<?= $name ?>" placeholder="Name">
      <input type="email" name="email" value="<?= $email ?>" placeholder="Email">
      <input type="password" name="password" value="<?= $password ?>" placeholder="Create Password">
      <button type="submit" name="submit" class="btn">Sign Up</button>
      <small>Already have an account? <a href="signin.php">Sign In</a></small>
    </form>
  </div>
</section>

</body>
</html>
