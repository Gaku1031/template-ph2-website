
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>POSSE 管理画面ダッシュボード</title>
  <!-- スタイルシート読み込み -->
  <link rel="stylesheet" href="../admin/admin.css">
  <!-- Google Fonts読み込み -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&family=Plus+Jakarta+Sans:wght@400;700&display=swap"
    rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="../assets/scripts/common.js" defer></script>
</head>

<body>
  <nav>
    <div class="container nav__container">
      <a href="<?= ROOT_URL ?>" class="nav__logo">POSSE</a>
      <ul class="nav__items">
        <li><a href="<?= ROOT_URL ?>blog.php">Blog</a></li>
        <li><a href="<?= ROOT_URL ?>about.php">About</a></li>
        <li><a href="<?= ROOT_URL ?>services.php">Services</a></li>
        <li><a href="<?= ROOT_URL ?>contact.php">Contact</a></li>
        <?php if(isset($_SESSION['user-id'])) :?>
            <li class="nav__profile">
            <div class="avatar">
              <img src="<?= ROOT_URL . './images/' . $avatar['avatar']?>">
            </div>
            <ul>
              <li><a href="<?= ROOT_URL ?>admin/index.php">Dashboard</a></li>
              <li><a href="<?= ROOT_URL ?>logout.php">Logout</a></li>
            </ul>
          </li>
        <?php else :?>
            <li><a href="<?= ROOT_URL ?>signin.php">Signin</a></li>
        <?php endif ?>
      </ul>

      <button id="open__nav-btn"><i class="uil uil-bars"></i></button>
      <button id="close__nav-btn"><i class="uil uil-multiply"></i></button>
    </div>
  </nav>