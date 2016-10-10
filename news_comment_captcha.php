<?php
  session_start();
  require "/vendor/autoload.php";
  use \Gregwar\Captcha\CaptchaBuilder;

  $builder = new CaptchaBuilder;
  $builder->build();
?>
