<?php
  require("cms_connect.php");
  require("header.php");
  
  $news_post_query = "SELECT * FROM news_post";
  $news_post_statement = $db->prepare($news_post_query);
  $news_post_statement->execute();
  $news_post_rows = $news_post_statement->fetchAll();
  
  $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
  $title = trim(filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
  $content = nl2br(trim(filter_input(INPUT_POST, "content", FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
  date_default_timezone_set("America/Chicago");
  $date = date("F d, Y");
  $invalid_edit_data = false;
  $invalid_create_data = false;
  
  if (isset($_POST["submit"])
    && strlen($_POST["title"]) > 0
    && strlen($_POST["content"]) > 0) {
    $news_post_insert_query = "INSERT INTO news_post (title, content, date) VALUES (:title, :content, :date)";
    $news_post_insert_statement = $db->prepare($news_post_insert_query);
    
    $news_post_insert_statement->bindValue(":title", $title);
    $news_post_insert_statement->bindValue(":content", $content);
    $news_post_insert_statement->bindValue(":date", $date);
    $news_post_insert_statement->execute();
    
    header("Location: news.php");
    exit;
  } elseif (isset($_POST["update"])
        && strlen($_POST["title"]) > 0
        && strlen($_POST["content"]) > 0) {
    $news_post_update_query = "UPDATE news_post SET title = '$title', content = '$content' WHERE id = '$id'";
    $news_post_update_statement = $db->prepare($news_post_update_query);
    $news_post_update_statement->execute();
    
    header("Location: news.php");
    exit;
  } elseif (isset($_POST["delete"])) {
    $news_post_delete_query = "DELETE FROM news_post WHERE id = $id";
    $news_post_delete_statement = $db->prepare($news_post_delete_query);
    $news_post_delete_statement->execute();
    
    header("Location: news.php");
    exit;
  } elseif (isset($_POST["id"])) {
    $invalid_edit_data = true;
  } else {
    $invalid_create_data = true;
  }
?>
<?php if ($_POST): ?>
  <p>Both the title and content must be at least one character.</p>
  <?php if ($invalid_create_data): ?>
    <a href="javascript:history.back()">&laquo; Go back</a>
  <?php elseif ($invalid_edit_data): ?>
    <?php foreach($news_post_rows as $news_post_row): ?>
      <a href="news_post_edit.php?id=<?= $news_post_row["id"] ?>">&laquo; Go back</a>
    <?php endforeach; ?>
  <?php endif; ?>
<?php else: ?>
  <?= header("Location: index.php"); ?>
<?php endif; ?>
<?php require("footer.php"); ?>
