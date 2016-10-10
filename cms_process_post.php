<?php
  require("cms_connect.php");
  require("cms_authenticate.php");
  require("header.php");
  
  /*if (isset($_POST["id"])) {
    $query = "SELECT * FROM web_page WHERE id = $_POST[id]";
    $statement = $db->prepare($query);
    $statement->execute();
    $rows = $statement->fetchAll();
  }*/
  
  $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
  $title = trim(filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
  $permalink = trim(filter_input(INPUT_POST, "permalink", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
  $content = trim(filter_input(INPUT_POST, "page_content", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
  date_default_timezone_set("America/Chicago");
  $create_date_and_time = date("F d, Y, G:i a");
  $invalid_edit_data = false;
  $invalid_create_data = false;
  
  if (isset($_POST["submit"])
    && strlen($_POST["title"]) > 0
    && strlen($_POST["page_content"]) > 0
    && strlen($_POST["permalink"]) > 0) {
    
    $page_insert_query = "INSERT INTO web_page (title, permalink, content, create_date_and_time, update_date_and_time) VALUES (:title, :permalink, :content, :create_date_and_time, :update_date_and_time)";
    $statement = $db->prepare($page_insert_query);
    
    $statement->bindValue(":title", $title);
    $statement->bindValue(":permalink", $permalink);
    $statement->bindValue(":content", $content);
    $statement->bindValue(":create_date_and_time", $create_date_and_time);
    $statement->bindValue(":update_date_and_time", $create_date_and_time);
    $statement->execute();
    
    header("Location: cms_admin.php");
    exit;
  } elseif (isset($_POST["update"])
        && strlen($_POST["title"]) > 0
        && strlen($_POST["page_content"]) > 0
        && strlen($_POST["permalink"]) > 0) {
    $page_update_query = "UPDATE web_page SET title = '$title', permalink = '$permalink', content = '$content', update_date_and_time = '$create_date_and_time' WHERE id = $id";
    $statement = $db->prepare($page_update_query);
    $statement->execute();
    
    header("Location: cms_admin.php");
    exit;
  } elseif (isset($_POST["delete"])) {
    $page_delete_query = "DELETE FROM web_page WHERE id = $id";
    $statement = $db->prepare($page_delete_query);
    $statement->execute();
    
    header("Location: cms_admin.php");
    exit;
  } elseif (isset($_POST["id"])) {
    $invalid_edit_data = true;
  } else {
    $invalid_create_data = true;
  }
?>
<?php if ($_POST): ?>
  <?php if ($invalid_create_data): ?>
    <p>Fields need to be at least one character.</p>
    <a href="javascript:history.back()">&laquo; Go back</a>
  <?php elseif ($invalid_edit_data): ?>
    <?php foreach($rows as $row): ?>
      <a href="edit.php?id=<?= $row["id"] ?>">&laquo; Go back</a>
    <?php endforeach; ?>
  <?php endif; ?>
<?php else: ?>
  <?= header("Location: cms_admin.php"); ?>
<?php endif; ?>
<?php require("footer.php"); ?>
