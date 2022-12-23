<?php
require '../db/pdo.php';

$email = $_SESSION['signin-data']['email'] ?? null;
$password = $_SESSION['signin-data']['password'] ?? null;

unset($_SESSION['signin-data']);

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
    <h2>Sign In</h2>
    <?php if (isset($_SESSION['signup-success'])) :?>
      <div class="alert__message success">
      <p>
        <?= $_SESSION['signup-success'];
        unset($_SESSION['signup-success']);
        ?>
      </p>
    </div>
    <?php elseif (isset($_SESSION['signin'])) : ?>
    <div class="alert__message error"> 
      <p>
        <?= $_SESSION['signin'];
        unset($_SESSION['signin']);
        ?>
      </p>
    </div>
    <?php endif ?>
    <form action="<?= USER_URL ?>signin-logic.php" method="POST">
      <input type="text" name="email" value="<?= $email?>" placeholder="Email">
      <input type="password" name="password" value="<?= $password ?>" placeholder="Password">
      <button type="submit" name="submit" class="btn">Sign In</button>
      <small>Don't have an account? <a href="<?= USER_URL ?>signup.php">Sign Up</a></small>
    </form>
  </div>
</section>

</body>
</html>
