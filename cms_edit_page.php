<?php 
  require("cms_connect.php");
  require("cms_authenticate.php");
  require("header.php");
  
  if (isset($_GET["id"])) {
    $query = "SELECT * FROM web_page WHERE id = $_GET[id]";
    $statement = $db->prepare($query);
    $statement->execute();
    $rows = $statement->fetchAll();
  }
  
  if (!is_numeric($_GET["id"]) || $statement->rowCount() === 0) {
    header("Location: index.php");
  }
?>
<h1>Edit Page</h1>
<div class="cms">
  <?php if ($_GET): ?>
    <form method="post" action="cms_process_post.php">
      <fieldset>
        <legend>Edit Page</legend>
        <?php foreach($rows as $row): ?>
          <label for="title">Page Title</label><br />
          <input type="text" id="title" name="title" value="<?= $row["title"] ?>" /><br />
          <label for="permalink">Permalink</label><br />
          <input type="text" id="permalink" name="permalink" value="<?= $row["permalink"] ?>" /><br />
          <script type="text/javascript">
            bkLib.onDomLoaded(function() {
              new nicEditor({fullPanel : true}).panelInstance('page_content'); 
            });
          </script>
          <label for="page_content">Content</label><br />
          <textarea id="page_content" name="page_content"><?= $row["content"] ?></textarea><br />
          <input type="submit" id="update" name="update" value="Update" /><input type="submit" id="delete" name="delete" onclick="return confirm('Are you sure you wish to delete this post?')" value="Delete" /><input type="hidden" id="id" name="id" value="<?= $row["id"] ?>" />
        <?php endforeach; ?>
      </fieldset>
    </form>
  <?php else: ?>
    <?= header("Location: index.php"); ?>
  <?php endif; ?>
</div>
<?php require("footer.php"); ?>
