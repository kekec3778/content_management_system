<?php
  require("common.php");
  require("cms_authenticate.php");
  require("header.php");
  
  /*if (empty($_SESSION["user"])) {
    header("Location: login.php");
    
    die("Redirecting to login.php");
  }*/
  
  $member_list_query = "SELECT id, username, email FROM users;";
  
  try {
    $statement = $db->prepare($member_list_query);
    $statement->execute();
  }
  catch(PDOException $ex) {
    die("Failed to run query: " . $ex->getMessage());
  }
  
  $member_list_rows = $statement->fetchAll();
?>
<h1>Memberlist</h1>
<table>
  <tr>
    <th>ID</th>
    <th>Username</th>
    <th>E-Mail Address</th>
  </tr>
  <?php foreach($member_list_rows as $member_list_row): ?>
    <tr>
      <td><?php echo $member_list_row["id"]; ?></td>
      <td><?php echo htmlentities($member_list_row["username"], ENT_QUOTES, "UTF-8"); ?></td>
      <td><?php echo htmlentities($member_list_row["email"], ENT_QUOTES, "UTF-8"); ?></td>
    </tr>
  <?php endforeach; ?>
</table>
<br />
<a href="cms_admin.php">Go Back</a>
<?php require("footer.php"); ?>
