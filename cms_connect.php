<?php 
  define("DATABASE_DSN", "mysql:host=your_host; dbname=your_dbname; charset=utf8");
  define("DATABASE_USERNAME", "your_username");
  define("DATABASE_PASSWORD", "your_password");
  
  try {
    $db = new PDO(DATABASE_DSN, DATABASE_USERNAME, DATABASE_PASSWORD);
  } catch (PDOException $e) {
    print "Error: " . $e->getMessage();
    die();
  }
?>
