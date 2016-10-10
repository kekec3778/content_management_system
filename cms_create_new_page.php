<?php 
  require("cms_connect.php");
  require("cms_authenticate.php");
  require("header.php");
  
  $query = "SELECT * FROM web_page";
  $statement = $db->prepare($query);
  $statement->execute();
  $rows = $statement->fetchAll();
?>
<h1>Create A New Page</h1>
<div class="cms">
  <form method="post" action="cms_process_post.php">
    <fieldset>
      <legend>Create A New Page</legend>
      <label for="title">Page Title</label><br />
      <input type="text" id="title" name="title" /><br />
      <label for="permalink">Permalink</label><br />
      <input type="text" id="permalink" name="permalink" /><br />
      <script type="text/javascript">
        bkLib.onDomLoaded(function() {
          new nicEditor({fullPanel : true}).panelInstance('page_content'); 
        });
      </script>
      <label for="page_content">Content</label><br />
      <textarea id="page_content" name="page_content" rows="25"></textarea><br />
      <input type="submit" id="submit" name="submit" value="Submit" />
    </fieldset>
  </form>
</div>
<br />
<a href="cms_admin.php">Go Back</a>
<?php require("footer.php"); ?>
