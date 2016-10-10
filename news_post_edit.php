<?php
  require("cms_authenticate.php");
  require("cms_connect.php");
  require("header.php");
  
  $news_post_query = "SELECT * FROM news_post WHERE id = $_GET[id]";
  $news_post_statement = $db->prepare($news_post_query);
  $news_post_statement->execute();
  $news_post_rows = $news_post_statement->fetchAll();
  
  if (!is_numeric($_GET["id"]) || $news_post_statement->rowCount() === 0) {
    header("Location: index.php");
  }
?>
<?php if ($_GET): ?>
  <form method="post" action="news_process_post.php">
    <fieldset>
      <legend>Edit News Post</legend>
      <label for="title">Title</label><br />
      <?php foreach($news_post_rows as $news_post_row): ?>
        <input type="hidden" id="id" name="id" value="<?= $news_post_row["id"] ?>" />
        <input type="text" id="title" name="title" value="<?= $news_post_row["title"] ?>" /><br />
        <label for="content">Content</label><br />
        <textarea name="content" id="content" name="content" rows="10" cols="55"><?= $news_post_row["content"] ?></textarea><br />
        <input type="submit" id="update" name="update" value="Update" /><input type="submit" id="delete" name="delete" onclick="return confirm('Are you sure you wish to delete this post?')" value="Delete" />
      <?php endforeach; ?>
    </fieldset>
  </form>
<?php else: ?>
  <?= header("Location: index.php"); ?>
<?php endif; ?>
<?php require("footer.php"); ?>
