<?php
  require("cms_connect.php");
  require("cms_authenticate.php");
  require("header.php");
  include("cms_image_upload.php");
  
  list($width, $height) = getimagesize("images/" . $filename);
  
  //$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
  $file = $upload_subfolder_name . "/" . $filename;
  
  if (isset($_POST["image_submit"])) {    
    $image_insert_query = "INSERT INTO image (file) VALUES (:file)";
    $statement = $db->prepare($image_insert_query);
    
    $statement->bindValue(":file", $file);
    $statement->execute();
  } else {
    header("Location: index.php");
  }
?>
<?php if ($_POST): ?>
  <?php if ($upload_error_detected): ?>
    <p>Error Number: <?= $_FILES["file"]["error"]; ?></p>
  <?php elseif ($file_upload_detected): ?>
    Filename: <a href="<?= $upload_subfolder_name; ?>/<?= $filename; ?>"><?= $_FILES["file"]["name"]; ?></a><br />
    Mime Type: <?= $_FILES["file"]["type"]; ?><br />
    Size: <?= $_FILES["file"]["size"]; ?><br />
    Resolution: <?= $width; ?>x<?= $height; ?><br />
    File has been successfully uploaded here: <a href="<?= $upload_subfolder_name; ?>/<?= $filename; ?>"><?= $_FILES["file"]["name"]; ?></a><br />
    <textarea cols="75"><img src="<?= $upload_subfolder_name; ?>/<?= $filename; ?>" alt="<?= $upload_subfolder_name; ?>/<?= $filename; ?>" /></textarea><br />
    <img src="<?= $upload_subfolder_name; ?>/<?= $filename; ?>" /><br />
    <small><a href="cms_admin.php">&laquo; Go back</a></small>
  <?php endif; ?>
<?php endif; ?>
<?php require("footer.php"); ?>
