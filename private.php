<?php
  require("common.php");
  require("header.php");
  
  if (empty($_SESSION["user"])) {
    header("Location: login.php");
    
    die("Redirecting to login.php");
  } 
?>
<h1>User Account</h1>
Hello <?php echo htmlentities($_SESSION["user"]["username"], ENT_QUOTES, "UTF-8"); ?>!<br />
<ul>
  <li><a href="edit_account.php">Edit Account</a></li>
  <li><a href="upload_file.php">Upload File</a></li>
  <li><a href="logout.php">Logout</a></li>
</ul>
<?php require("footer.php"); ?>
