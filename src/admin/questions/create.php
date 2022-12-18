<?php
require '../../db/pdo.php';


// get back form data if form was invalid
$body = $_SESSION['add-post-data']['body'] ?? null;
$choice1 = $_SESSION['add-post-data']['choice1'] ?? null;
$choice2 = $_SESSION['add-post-data']['choice2'] ?? null;
$choice3 = $_SESSION['add-post-data']['choice3'] ?? null;
$correct_choice = $_SESSION['add-post-data']['correct-choice'] ?? null;
$supplement = $_SESSION['add-post-data']['supplement'] ?? null;


// delete form data session
unset($_SESSION['add-post-data']);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>POSSE 管理画面ダッシュボード</title>
  <!-- スタイルシート読み込み -->
  <link rel="stylesheet" href="../admin.css">
  <!-- Google Fonts読み込み -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&family=Plus+Jakarta+Sans:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="../assets/scripts/common.js" defer></script>
</head>



<section class="form__section">
  <div class="container form__section-container">
    <h2>問題作成</h2>
    <?php if (isset($_SESSION['add-post'])) : ?>
      <div class="alert__message error">
        <p>
          <?= $_SESSION['add-post'];
          unset($_SESSION['add-post']);
          ?>
        </p>
      </div>
    <?php endif ?>
    <form action="<?= ROOT_URL ?>admin/questions/create-question-logic.php" enctype="multipart/form-data" method="POST">
      <label for="body">問題文</label>
      <textarea rows="10" name="body" placeholder="Content"><?= $body ?></textarea>

      <label for="choice1">選択肢1</label>
      <input type="text" name="choice1" value="<?= $choice1 ?>" placeholder="選択肢１">
      <label for="choice2">選択肢2</label>
      <input type="text" name="choice2" value="<?= $choice2 ?>" placeholder="選択肢2">
      <label for="choice3">選択肢3</label>
      <input type="text" name="choice3" value="<?= $choice3 ?>" placeholder="選択肢3">

      <label for="correct-choice[]" multiple>正解の選択肢</label>
      <select name="correct-choice">
        <option name="check1" value="1">選択肢１</option>
        <option name="check2" value="2">選択肢２</option>
        <option name="check3" value="3">選択肢３</option>
      </select>
      
      <!-- <div class="correct-choice">
        <input class="correct-choice" type="radio" name="correctChoice" id="correctChoice1" checked value="1">
        <label class="form-check-label" for="correctChoice1">
          選択肢1
        </label>
      </div>
      <div class="correct-choice">
        <input class="correct-choice" type="radio" name="correctChoice" id="correctChoice2" value="2">
        <label class="form-check-label" for="correctChoice2">
          選択肢2
        </label>
      </div>
      <div class="correct-choice">
        <input class="correct-choice" type="radio" name="correctChoice" id="correctChoice2" value="3">
        <label class="form-check-label" for="correctChoice2">
          選択肢3
        </label>
      </div> -->

      <div class="form__control">
        <label for="thumbnail">画像</label>
        <input type="file" name="thumbnail" id="thumbnail">
      </div>

      <label for="supplement">補足</label>
      <input type="text" name="supplement" value="<?= $supplement ?>" placeholder="補足">

      <button type="submit" name="submit" class="create-btn">問題作成</button>
    </form>
  </div>
</section>
