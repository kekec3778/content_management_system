<?php
  require("cms_connect.php");
  require("header.php");
  include("news_comment_captcha.php");
  
  $news_comment_query = "SELECT * FROM news_post_comment WHERE id = $_POST[id]";
  $news_comment_statement = $db->prepare($news_comment_query);
  $news_comment_statement->execute();
  $news_comment_rows = $news_comment_statement->fetchAll();
  
  $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
  $comment_id = filter_input(INPUT_POST, "comment_id", FILTER_SANITIZE_NUMBER_INT);
  $name = trim(filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
  $comment = nl2br(trim(filter_input(INPUT_POST, "comment", FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
  date_default_timezone_set("America/Chicago");
  $date_and_time = date("F d, Y");
  $userInput = $_POST["value"];
  $invalid_create_data = false;
  $invalid_captcha = false;

  if (isset($_POST["submit"])
    && strlen($_POST["name"]) > 0
    && strlen($_POST["comment"]) > 0) {
      if($userInput == $_SESSION["phrase"]) {
        $news_comment_insert_query = "INSERT INTO news_post_comment (id, name, comment, date_and_time) VALUES (:id, :name, :comment, :date_and_time)";
        $news_comment_insert_statement = $db->prepare($news_comment_insert_query);
        
        $news_comment_insert_statement->bindValue(":id", $id);
        $news_comment_insert_statement->bindValue(":name", $name);
        $news_comment_insert_statement->bindValue(":comment", $comment);
        $news_comment_insert_statement->bindValue(":date_and_time", $date_and_time);
        $news_comment_insert_statement->execute();
        
        header("Location: news_post_show.php?id=$id");
        exit;
      } else {
        $invalid_captcha = true;
      }
  } elseif (isset($_POST["delete"])) {
    $news_comment_delete_query = "DELETE FROM news_post_comment WHERE comment_id = $comment_id";
    $news_comment_delete_statement = $db->prepare($news_comment_delete_query);
    $news_comment_delete_statement->execute();
    
    header("Location: news_post_show.php?id=$id");
    exit;
  } elseif (isset($_POST["disemvowel"])) {
    $name = disemvowel($name);
    $comment = disemvowel($comment);
    
    $news_comment_disemvowel_query = "UPDATE news_post_comment SET name = '$name', comment = '$comment' WHERE comment_id = '$comment_id'";
    $news_comment_disemvowel_statement = $db->prepare($news_comment_disemvowel_query);
    $news_comment_disemvowel_statement->execute();
    
    header("Location: news_post_show.php?id=$id");
    exit;
  } else {
    $invalid_create_data = true;
  }
  
  if (!is_numeric($_GET["id"]) || $statement->rowCount() === 0) {
    header("Location: index.php");
  }
  
  function disemvowel($string) {
    return str_replace(array('a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U'), '', $string);
  }
?>
<?php if ($_POST): ?>
  <?php if ($invalid_create_data): ?>
    <p>Both the name and comment must be at least one character.</p>
    <a href="javascript:history.back()">&laquo; Go back</a>
  <?php elseif ($invalid_captcha): ?>
    <p>Captcha text is wrong.</p>
    <a href="javascript:history.back()">&laquo; Go back</a>
  <?php endif; ?>
<?php else: ?>
  <?= header("Location: index.php"); ?>
<?php endif; ?>
<?php require("footer.php"); ?>
