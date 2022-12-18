<?php
require '../../db/pdo.php';

$db = new mysqli('db', 'root', 'root', 'posse');

$questions = "SELECT * FROM questions";
$question_number = mysqli_query($db, $questions);
$number = mysqli_fetch_all($question_number);

if (isset($_POST['submit'])) {
  $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $choice1 = filter_var($_POST['choice1'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $choice2 = filter_var($_POST['choice2'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $choice3 = filter_var($_POST['choice3'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $correct_choice = filter_var($_POST['correct-choice'], FILTER_SANITIZE_NUMBER_INT);
  $supplement = filter_var($_POST['supplement'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $image = $_FILES['thumbnail'];

  //validate form data
  if (!$body) {
    $_SESSION['add-post'] = "問題文を入力してください";
  } elseif (!$choice1) {
    $_SESSION['add-post'] = "選択肢1を入力してください";
  } elseif (!$choice2) {
    $_SESSION['add-post'] = "選択肢2を入力してください";
  } elseif (!$choice3) {
    $_SESSION['add-post'] = "選択肢3を入力してください";
  } elseif (!$correct_choice) {
    $_SESSION['add-post'] = "正解の選択肢を選択してください";
  } elseif (!$image['name']) {
    $_SESSION['add-post'] = "画像を選択してください";
  } else {
    // WORK ON THUMBNAIL
    // rename the image
    $image_name = "img-quiz0".count($number) + 1 .".png";
    $image_tmp_name = $image['tmp_name'];
    $image_destination_path = '../../assets/img/quiz/' . $image_name;

        // upload thumbnail
    move_uploaded_file($image_tmp_name, $image_destination_path);

  if(isset($_POST["correct-choice"])) {
    // セレクトボックスで選択された値を受け取る
    $correct_answer = $_POST["correct-choice"];
  }

  // redirect back (with form data) to add-post page if there is any problem
  if (isset($_SESSION['add-post'])) {
    $_SESSION['add-post-data'] = $_POST;
    header('location: ' . ROOT_URL . 'admin/questions/create.php');
    die();
  }

    // insert post into database
    $query1 = "INSERT INTO questions (content, image, supplement) VALUES ('$body', '$image_name', '$supplement')";
    $result = mysqli_query($db, $query1);

    if ($correct_answer == 1) {
      $query2 = "INSERT INTO choices (name, valid) VALUES ('$choice1', 1), ('$choice2', 0), ('$choice3', 0)";
      $result2 = mysqli_query($db, $query2);
    } elseif ($correct_answer == 2) {
      $query3 = "INSERT INTO choices (name, valid) VALUES ('$choice1', 0), ('$choice2', 1), ('$choice3', 0)";
      $result3 = mysqli_query($db, $query3);
    } elseif ($correct_answer == 3) {
      $query4 = "INSERT INTO choices (name, valid) VALUES ('$choice1', 0), ('$choice2', 0), ('$choice3', 1)";
      $result4 = mysqli_query($db, $query4);
    }

    if (!mysqli_errno($db)) {
      $_SESSION['add-post-success'] = "New Quiz added successfully";
      header('location: ' . ROOT_URL . 'admin/');
      die();
    }
  }
}

// header('location: ' . ROOT_URL . 'admin/questions/create.php');
// die();
