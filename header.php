<?php
  $web_page_query = "SELECT title, permalink FROM web_page";
  $web_page_statement = $db->prepare($web_page_query);
  $web_page_statement->execute();
  $web_page_rows = $web_page_statement->fetchAll();
  
  if (isset($_GET["permalink"])) {
    $web_page_content_query = "SELECT title, content FROM web_page WHERE permalink = '$_GET[permalink]'";
    $web_page_content_statement = $db->prepare($web_page_content_query);
    $web_page_content_statement->execute();
    $web_page_content_content_rows = $web_page_content_statement->fetchAll();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Custom Music Lessons</title>
  <link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
  <script type="text/javascript" src="js/nicEdit.js"></script>
</head>
<body>
  <div id="login_menu">
    <div id="login_menu2">
      Login &raquo; <a href="login.php">Student/Teacher</a> | <a href="cms_admin.php">Admin</a>
    </div>
  </div>
  <div id="container">
    <header>
      <a href="index.php?permalink=home"><img src="images/header.png" alt="Custom Music Lessons" title="Custom Music Lessons" width="900" height="110" /></a>
    </header>
    <nav>
      <?php foreach($web_page_rows as $web_page_row): ?>
        <a href="index.php?permalink=<?= $web_page_row["permalink"]; ?>"><?= $web_page_row["title"]; ?></a> | 
      <?php endforeach; ?><a href="news.php">News</a> | <a href="student_application.php">Student</a>/<a href="teacher_application.php">Teacher</a> Application
    </nav>
    <div id="content">
      <section>
        <?php if(isset($_GET["permalink"])): ?>
          <?php foreach($web_page_content_content_rows as $web_page_content_content_row): ?>
            <h1><?= $web_page_content_content_row["title"]; ?></h1>
            <?= html_entity_decode($web_page_content_content_row["content"]); ?><br />
          <?php endforeach; ?>
        <?php elseif (basename($_SERVER["PHP_SELF"]) === "index.php"): ?>
          <?php header("Location: index.php?permalink=home"); ?>
        <?php endif; ?>
