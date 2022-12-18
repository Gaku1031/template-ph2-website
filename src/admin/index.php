<?php
require '../db/pdo.php';
include '../components/dashboard-header.php';

$db = new mysqli('db', 'root', 'root', 'posse');

// fetch current questions from database
$query = "SELECT id, content FROM questions";
$posts = mysqli_query($db, $query);

?>

<section class="dashboard">
  <?php if (isset($_SESSION['add-post-success'])) : // shows if add post was successful?>
        <div class="alert__message success container">
          <p>
            <?= $_SESSION['add-post-success'];
            unset($_SESSION['add-post-success']);
            ?>
          </p>
        </div>
  <?php elseif (isset($_SESSION['edit-post-success'])) : // shows if edit post was successful?>
        <div class="alert__message success container">
          <p>
            <?= $_SESSION['edit-post-success'];
            unset($_SESSION['edit-post-success']);
            ?>
          </p>
        </div>
  <?php elseif (isset($_SESSION['edit-post'])) : // shows if edit post was NOT successful?>
        <div class="alert__message error container">
          <p>
            <?= $_SESSION['edit-post'];
            unset($_SESSION['edit-post']);
            ?>
          </p>
        </div>
  <?php endif ?>
  <div class="container dashboard__container">
    <button id="show__sidebar-btn" class="button sidebar__toggle"><i class="uil uil-angle-right-b"></i></button>
    <button id="hide__sidebar-btn" class="button sidebar__toggle"><i class="uil uil-angle-left-b"></i></button>
    <aside>
      <ul>
        <li>
          <a href="<?= ROOT_URL ?>admin/questions/create.php"><i class="uil uil-pen"></i>
            <h5>Create Quiz</h5>
          </a>
        </li>
        <li>
          <a href="<?= ROOT_URL ?>admin/index.php" class="active"><i class="uil uil-user-plus"></i>
            <h5>Manage Quiz</h5>
          </a>
        </li>
        <li>
          <a href="<?= ROOT_URL ?>admin/users/invitaion.php"><i class="uil uil-user-plus"></i>
            <h5>Add User</h5>
          </a>
        </li>
        <li>
          <a href="<?= ROOT_URL ?>admin/manage-users.php"><i class="uil uil-users-alt"></i>
            <h5>Manage User</h5>
          </a>
        </li>
        <li>
          <a href="<?= ROOT_URL ?>admin/add-category.php"><i class="uil uil-edit"></i>
            <h5>Add Category</h5>
          </a>
        </li>
        <li>
          <a href="<?= ROOT_URL ?>admin/manage-categories.php"><i class="uil uil-list-ul"></i>
            <h5>Manage Categories</h5>
          </a>
        </li>
      </ul>
    </aside>
    <main>
      <h2>Manege Quiz</h2>
      <?php if(mysqli_num_rows($posts) > 0) :?>
      <table>
        <thead>
          <tr>
            <th>Id</th>
            <th>Content</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          <?php while($post = mysqli_fetch_assoc($posts)) : ?>
            <tr>
              <td><?= $post['id'] ?></td>
              <td><?= $post['content']?></td>
              <td><a href="<?= ROOT_URL ?>admin/questions/edit.php?id=<?= $post['id'] ?>" class="btn sm">Edit</a></td>
              <td><a href="<?= ROOT_URL ?>services/delete_question.php?id=<?= $post['id'] ?>" class="btn sm danger">Delete</a></td>
            </tr>
          <?php endwhile ?>
        </tbody>
      </table>
      <?php else : ?>
        <div class="alert__message error"><?= "No Quiz found" ?></div>
      <?php endif ?>
    </main>
  </div>
</section>
