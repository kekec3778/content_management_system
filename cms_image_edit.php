<?php
  require("cms_connect.php");
  require("cms_authenticate.php");
  require "/vendor/autoload.php";
  use \Eventviva\ImageResize;
  
  $image_query = "SELECT id, file FROM image ORDER BY id";
  $image_statement = $db->prepare($image_query);
  $image_statement->execute();
  $image_rows = $image_statement->fetchAll();
  
  $id = $_GET["id"];
  $delete_id = $_GET["delete_id"];
  $file = $_GET["file"];
  $size = $_GET["size"];
  
  if (isset($_GET["id"]) && isset($_GET["file"]) && isset($_GET["size"])) {
    $image = new ImageResize($file);
    $image->scale($size);
    $image->save($_GET["file"]);
    
    header("Location: cms_admin.php");
    exit;
  } if (isset($_GET["delete_id"]) && isset($_GET["file"])) {
    $image_delete_query = "DELETE FROM image WHERE id = $delete_id";
    $statement = $db->prepare($image_delete_query);
    $statement->execute();
    
    unlink($file);
    
    header("Location: cms_admin.php");
    exit;
  } else {
    header("Location: index.php");
    exit;
  }
  
  if (!is_numeric($_GET["id"]) || $statement->rowCount() === 0) {
    header("Location: index.php");
  }
?>
