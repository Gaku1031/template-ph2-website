<?php
require '../../db/pdo.php';


if (isset($_POST['submit'])) {
  $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
  $content = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  //validate form data
  if (!$content) {
    $_SESSION['edit-post'] = "Couldn't update post. Invalid form data on edit post page.";
  } 

if ($_SESSION['edit-post']) {
  header('location: ' . ROOT_URL . 'admin/');
  die();
} else {

  $query = "UPDATE questions set content='content' WHERE id=$id LIMIT 1";
  $result = mysqli_query($db, $query);
}
  if (!mysqli_errno($db)) {
    $_SESSION['edit-post-success'] = "Post updated successfully";
  }
}

header('location: ' . ROOT_URL . 'admin/');
die();