<?php
// require '../db/pdo.php';
// $db = new mysqli('db', 'root', 'root', 'posse');

if(isset($_SESSION['user-id'])) {
  $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
  // $query = "SELECT  avatar FROM users WHERE id = $id";
  // $result = mysqli_query($db, $query);
  // $avatar = mysqli_fetch_assoc($result);
}
?>

<header id="js-header" class="l-header p-header">
    <div class="p-header__logo"><img src="./assets/img/logo.svg" alt="POSSE"></div>
    <button class="p-header__button" id="js-headerButton"></button>
    <div class="p-header__inner">
      <nav class="p-header__nav">
        <ul class="p-header__nav__list">
          <li class="p-header__nav__item">
            <a href="./" class="p-header__nav__item__link">POSSEとは</a>
          </li>
          <li class="p-header__nav__item">
            <a href="./quiz/" class="p-header__nav__item__link">クイズ</a>
          </li>
          <li class="p-header__nav__item">
            <a href="<?= ROOT_URL ?>admin/index.php">Dashboard</a>
          </li>
        </ul>
      </nav>
      <ul class="p-header__sns p-sns">
        <li class="p-sns__item">
          <a href="https://twitter.com/posse_program" target="_blank" rel="noopener noreferrer" class="p-sns__item__link"
            aria-label="Twitter">
            <i class="u-icon__twitter"></i>
          </a>
        </li>
        <li class="p-sns__item">
          <a href="https://www.instagram.com/posse_programming/" target="_blank" rel="noopener noreferrer"
            class="p-sns__item__link" aria-label="instagram">
            <i class="u-icon__instagram"></i>
          </a>
        </li>
      </ul>
    </div>
  </header>
