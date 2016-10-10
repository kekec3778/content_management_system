<?php
  require("cms_authenticate.php");
  require("cms_connect.php");
  require("header.php");
  
  $news_comment_edit_query = "SELECT * FROM news_post_comment WHERE comment_id = $_GET[comment_id]";
  $news_comment_edit_statement = $db->prepare($news_comment_edit_query);
  $news_comment_edit_statement->execute();
  $news_comment_edit_rows = $news_comment_edit_statement->fetchAll();
  
  if (!is_numeric($_GET["comment_id"]) || $news_comment_edit_statement->rowCount() === 0) {
    header("Location: index.php");
  }
?>
<?php if ($_GET): ?>
  <form method="post" action="news_comment_process_post.php">
    <fieldset>
      <legend>Edit News Comment</legend>
      <?php foreach($news_comment_edit_rows as $news_comment_edit_row): ?>
        <input type="hidden" id="id" name="id" value="<?= $news_comment_edit_row["id"]; ?>" />
        <input type="hidden" id="comment_id" name="comment_id" value="<?= $news_comment_edit_row["comment_id"]; ?>" />
        <input type="text" id="name" name="name" value="<?= $news_comment_edit_row["name"]; ?>" readonly /><br />
        <textarea id="comment" name="comment" rows="5" cols="65" readonly><?= $news_comment_edit_row["comment"]; ?></textarea><br />
      <?php endforeach; ?>
      <input type="submit" id="delete" name="delete" onclick="return confirm('Are you sure you wish to delete this comment post?')" value="Delete" />
      <input type="submit" id="disemvowel" name="disemvowel" onclick="return confirm('Are you sure you wish to disemvowel this comment post?')" value="Disemvowel" />
    </fieldset>
  </form>
<?php else: ?>
  <?= header("Location: index.php"); ?>
<?php endif; ?>
<?php require("footer.php"); ?>
