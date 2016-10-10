<?php
  require("cms_connect.php");
  require("header.php");
?>
<script type="text/javascript" src="js/script.js"></script>
<h1>Contact</h1>
<div class="registration">
  <form id="contact_form" method="post">
    <fieldset>
      <legend>Contact Form</legend>
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" autofocus /><br />
      <div class="error" id="name_error">* Required field</div>
      <label for="phonenumber">Phone Number:</label>
      <input type="tel" id="phonenumber" name="phonenumber" /><br />
      <div class="error" id="phonenumber_error">* Required field</div>
      <div class="error" id="phonenumberformat_error">* Invalid phone number</div>
      <label for="emailaddress">E-mail Address:</label>
      <input type="text" id="emailaddress" name="emailaddress" /><br />
      <div class="error" id="emailaddress_error">* Required field</div>
      <div class="error" id="emailaddressformat_error">* Invalid e-mail address</div>
      <br />
      <label for="commentarea">Comments:</label>
      <textarea id="commentarea" name="commentarea" rows="5"></textarea>
      <div class="error" id="commentarea_error">* Required field</div><br />
      <button type="submit" id="submit">Submit</button><button type="reset" id="clear">Reset</button>
    </fieldset>
  </form>
</div>
<?php require("footer.php"); ?>
