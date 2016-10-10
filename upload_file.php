<?php
  require("common.php");
  require("header.php");
  
  $upload_subfolder_name = "uploads";
  
  function file_upload_path($original_filename, $upload_subfolder_name = "uploads") {
    $current_folder = dirname(__FILE__);
    
    $path_segments = [$current_folder, $upload_subfolder_name, basename($original_filename)];
    
    return join(DIRECTORY_SEPARATOR, $path_segments);
  }
  
  function file_is_valid($temporary_path, $new_path) {
    $allowed_mime_types      = ["image/gif", "image/jpeg", "image/png", "application/pdf", "text/plain"];
    $allowed_file_extensions = ["gif", "jpg", "jpeg", "png", "pdf", "txt"];
    
    $actual_file_extension   = pathinfo($new_path, PATHINFO_EXTENSION);
    $actual_mime_type        = $_FILES["file"]["type"];
    
    $file_extension_is_valid = in_array($actual_file_extension, $allowed_file_extensions);
    $mime_type_is_valid      = in_array($actual_mime_type, $allowed_mime_types);
    
    return $file_extension_is_valid && $mime_type_is_valid;
  }
  
  $file_upload_detected = isset($_FILES["file"]) && ($_FILES["file"]["error"] === 0);
  $upload_error_detected = isset($_FILES["file"]) && ($_FILES["file"]["error"] > 0);
  
  if ($file_upload_detected) { 
    $filename             = $_SESSION["user"]["username"] . "_" . $_FILES["file"]["name"];
    $temporary_file_path  = $_FILES["file"]["tmp_name"];
    $new_file_path        = file_upload_path($filename);
    
    if (file_is_valid($temporary_file_path, $new_file_path)) {
      move_uploaded_file($temporary_file_path, $new_file_path);
    }
  }
?>
<h1>File Upload</h1>
<form method="post" enctype="multipart/form-data">
    <label for="file">File:</label>
    <input type="file" name="file" id="file">
    <input type="submit" name="submit" value="Upload file">
</form>
<?php if ($upload_error_detected): ?>
  <p>Error Number: <?= $_FILES["file"]["error"]; ?></p>
<?php elseif ($file_upload_detected): ?>
  <p>Client-Side Filename: <a href="<?= $upload_subfolder_name; ?>/<?= $filename; ?>"><?= $_FILES["file"]["name"]; ?></a></p>
  <p>Apparent Mime Type: <?= $_FILES["file"]["type"]; ?></p>
  <p>Size in Bytes: <?= $_FILES["file"]["size"]; ?></p>
  <p>File has been successfully uploaded here: <a href="<?= $upload_subfolder_name; ?>/<?= $filename; ?>"><?= $_FILES["file"]["name"]; ?></a></p>
  <textarea cols="75"><img src="<?= $upload_subfolder_name; ?>/<?= $filename; ?>" /></textarea>
<?php endif; ?>
<?php require("footer.php"); ?>
