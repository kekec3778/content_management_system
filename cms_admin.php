<?php 
  require("cms_connect.php");
  require("cms_authenticate.php");
  require("header.php");
  include("cms_image_upload.php");
  
  $page_query = "SELECT id, title, permalink, create_date_and_time, update_date_and_time FROM web_page";
  $page_statement = $db->prepare($page_query);
  $page_statement->execute();
  $rows_order_by = $page_statement->fetchAll();
  
  $image_query = "SELECT id, file FROM image ORDER BY id";
  $image_statement = $db->prepare($image_query);
  $image_statement->execute();
  $image_rows = $image_statement->fetchAll();
  
  if (isset($_GET["page_select_query"])) {
    $page_select_query = "SELECT id, title, permalink, create_date_and_time, update_date_and_time FROM web_page ORDER BY title";
    $statement = $db->prepare($page_select_query);
    $statement->execute();
    $rows_order_by = $statement->fetchAll();
  } elseif (isset($_GET["page_create_date_and_time"])) {
    $page_select_query = "SELECT id, title, permalink, create_date_and_time, update_date_and_time FROM web_page ORDER BY create_date_and_time";
    $statement = $db->prepare($page_select_query);
    $statement->execute();
    $rows_order_by = $statement->fetchAll();
  } elseif (isset($_GET["page_update_date_and_time"])) {
    $page_select_query = "SELECT id, title, permalink, create_date_and_time, update_date_and_time FROM web_page ORDER BY update_date_and_time DESC";
    $statement = $db->prepare($page_select_query);
    $statement->execute();
    $rows_order_by = $statement->fetchAll();
  }
?>
<h1>Pages</h1>
<h4><a href="cms_create_new_page.php">[+] Create a New Page</a></h4>
<table class="cms">
  <tr>
    <th class="cms"><a href="cms_admin.php?page_select_query">Page Title</a></th>
    <th class="cms"><a href="cms_admin.php?page_create_date_and_time">Date Created</a></th>
    <th class="cms"><a href="cms_admin.php?page_update_date_and_time">Date Last Updated</a></th>
  </tr>
  <?php foreach($rows_order_by as $row): ?>
  <tr>
    <td><a href="index.php?permalink=<?= $row["permalink"]; ?>"><?= $row["title"]; ?></a> <a href="cms_edit_page.php?id=<?= $row["id"] ?>"><small>&#91;edit/delete&#93;</small></a></td>
    <td><?= $row["create_date_and_time"]; ?></td>
    <td><?= $row["update_date_and_time"]; ?></td>
  </tr>
  <?php endforeach; ?>
</table>
<h1>Images</h1>
<form method="post" action="cms_image_upload_process.php" enctype="multipart/form-data">
  <label for="file">File:</label>
  <input type="file" id="file" name="file" />
  <input type="submit" id="image_submit" name="image_submit" value="Upload file" /><br />
</form>
<br />
<table class="cms">
  <tr>
    <th class="cms">File</th>
    <th class="cms">Resize</th>
    <th class="cms">Delete</th>
    <th class="cms">HTML Tag</th>
  </tr>
  <?php foreach($image_rows as $image_row): ?>
  <tr>
    <td><a href="<?= $image_row["file"]; ?>"><?= $image_row["file"]; ?></a></td>
    <td><a href="cms_image_edit.php?id=<?= $image_row["id"]; ?>&file=<?= $image_row["file"]; ?>&size=75">75%</a> / <a href="cms_image_edit.php?id=<?= $image_row["id"]; ?>&file=<?= $image_row["file"]; ?>&size=50">50%</a> / <a href="cms_image_edit.php?id=<?= $image_row["id"]; ?>&file=<?= $image_row["file"]; ?>&size=25">25%</a></td>
    <td><a href="cms_image_edit.php?delete_id=<?= $image_row["id"]; ?>&file=<?= $image_row["file"]; ?>">Delete</a></td>
    <td class="html_tag"><textarea cols="30"><img src="<?= $image_row["file"]; ?>" alt="<?= $image_row["file"]; ?>" /></textarea></td>
  </tr>
  <?php endforeach; ?>
</table>
<h1>Members</h1>
<h3><a href="register.php">[+] Create a New User</a></h3>
<ul>
  <li><a href="memberlist.php">Memberlist</a></li>
</ul>
<?php require("footer.php"); ?>
