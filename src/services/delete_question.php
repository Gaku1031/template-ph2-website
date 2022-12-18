<?php
require '../db/pdo.php';

$db = new mysqli('db', 'root', 'root', 'posse');

if(isset($_GET['id'])) {
  $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

  // fetch post from database in order to delete thumbnail from images folder
  $query = "SELECT * FROM questions WHERE id=$id";
  $result = mysqli_query($db, $query);

  // make sure only 1 record/post was fetched
      // delete post from database
      $delete_post_query = "DELETE FROM questions WHERE id=$id LIMIT 1";
      $delete_post_result = mysqli_query($db, $delete_post_query);

      if(!mysqli_errno($db)) {
        $_SESSION['delete-post-success'] = "Post deleted successfully";
      }
    }

header('location: ' . ROOT_URL . 'admin/');
die();
