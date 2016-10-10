<?php
  require("cms_connect.php");
  require("header.php");
  
  $news_post_query = "SELECT * FROM news_post ORDER BY id DESC";
  $news_post_statement = $db->prepare($news_post_query);
  $news_post_statement->execute();
  $news_post_rows = $news_post_statement->fetchAll();
?>
<h1>News</h1>
<?php foreach($news_post_rows as $news_post_row): ?>
  <b><u><a href="news_post_show.php?id=<?= $news_post_row["id"] ?>"><?= $news_post_row["title"]; ?></a></u></b> 
  <?php if(isset($_SERVER["PHP_AUTH_USER"]) && isset($_SERVER["PHP_AUTH_PW"])): ?>
    <small><a href="news_post_edit.php?id=<?= $news_post_row["id"] ?>">Edit</a></small>
  <?php endif; ?>
  <br />
  <small><?= $news_post_row["date"]; ?></small><br />
  <?= html_entity_decode($news_post_row["content"]); ?><br /><br />
<?php endforeach; ?>
<?php if(isset($_SERVER["PHP_AUTH_USER"]) && isset($_SERVER["PHP_AUTH_PW"])): ?>
  <a href="news_post_create.php"><small>[+] Create News Post</small></a>
<?php endif; ?>
<?php require("footer.php"); ?>
