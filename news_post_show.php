<?php
  require("cms_connect.php");
  require("header.php");
  include("news_comment_captcha.php");
  
  $news_post_query = "SELECT * FROM news_post WHERE id = $_GET[id]";
  $news_post_statement = $db->prepare($news_post_query);
  $news_post_statement->execute();
  $news_post_rows = $news_post_statement->fetchAll();
  
  $news_post_comment_query = "SELECT * FROM news_post_comment WHERE id = $_GET[id]";
  $news_post_comment_statement = $db->prepare($news_post_comment_query);
  $news_post_comment_statement->execute();
  $news_post_comment_rows = $news_post_comment_statement->fetchAll();

  if (!is_numeric($_GET["id"]) || $news_post_statement->rowCount() === 0) {
    header("Location: index.php");
  }
  
  if (!$_POST) {
    $_SESSION["phrase"] = $builder->getPhrase();
  }
?>
<?php if ($_GET): ?>
  <?php foreach($news_post_rows as $news_post_row): ?>
    <h1><?= $news_post_row["title"]; ?></h1>
    <small><?= $news_post_row["date"]; ?></small><br />
    <?= $news_post_row["content"]; ?><br /><br />
  <?php endforeach; ?>
  <small><a href="news.php">&laquo; Back to news</a></small>
  <h1>Comments</h1>
  <?php foreach($news_post_comment_rows as $news_post_comment_row): ?>
    <b><?= $news_post_comment_row["name"]; ?></b> says: 
    <small><?= $news_post_comment_row["date_and_time"]; ?> </small>
    <?php if(isset($_SERVER["PHP_AUTH_USER"]) && isset($_SERVER["PHP_AUTH_PW"])): ?>
      <small> <a href="news_post_comment_edit.php?comment_id=<?= $news_post_comment_row["comment_id"] ?>">Edit</a></small></a>
    <?php endif; ?>
    <br />
    <?= $news_post_comment_row["comment"]; ?><br /><br />
  <?php endforeach; ?>
  <h1>Leave a Comment</h1>
  <form method="post" action="news_comment_process_post.php">
    <input type="hidden" name="id" id="id" value="<?= $_GET["id"]; ?>" />
    <label for="name">Name:</label><br />
    <input type="text" id="name" name="name" /><br />
    <label for="comment">Comment:</label><br />
    <textarea id="comment" name="comment" rows="5" cols="65"></textarea><br />
    <label for="comment">Captcha:</label><br />
    <img src="<?php echo $builder->inline(); ?>" />
    <input type="text" id="value" name="value" /><br />
    <input type="submit" id="submit" name="submit" value="Submit" /><input type="reset" id="reset" name="reset" />
  </form>
<?php else: ?>
  <?= header("Location: index.php"); ?>
<?php endif; ?>
<?php require("footer.php"); ?>
