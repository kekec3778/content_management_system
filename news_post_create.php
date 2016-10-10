<?php
  require("cms_authenticate.php");
  require("cms_connect.php");
  require("header.php");
?>
<form method="post" action="news_process_post.php">
  <fieldset>
    <legend>New Post</legend>
    <label for="title">Title</label><br />
    <input type="text" name="title" id="title" /><br />
    <label for="content">Content</label><br />
    <textarea name="content" id="content" rows="10" cols="55"></textarea><br />
    <input type="submit" name="submit" id="submit" value="Submit" /><input type="reset" id="reset" name="reset" />
  </fieldset>
</form>
<?php require("footer.php"); ?>
