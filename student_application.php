<?php
  require("cms_connect.php");
  require("header.php");
?>
<h1>Student Application</h1>
<?php if ($_POST): ?>
  Application received! You will be contacted within 2-3 business days.<br /><br />
<?php endif; ?>
<div class="registration">
  <form id="registration_form" method="post">
    <fieldset>
    <legend>Student Application</legend>
      <label for="teacher_first_name">First Name: </label><input type="text" id="teacher_first_name" name="teacher_first_name" autofocus required />
      <label for="teacher_last_name">Last Name: </label><input type="text" id="teacher_last_name" name="teacher_last_name" required />
      <label for="teacher_date_of_birth_year">Date of Birth: </label>
      <select id="teacher_date_of_birth_month" name="teacher_date_of_birth_month">
        <option>January</option>
        <option>February</option>
        <option>March</option>
        <option>April</option>
        <option>May</option>
        <option>June</option>
        <option>July</option>
        <option>August</option>
        <option>September</option>
        <option>October</option>
        <option>November</option>
        <option>December</option>
      </select>
      <select id="teacher_date_of_birth_day" name="teacher_date_of_birth_day">
        <?php for ($i = 01; $i < 31; $i++): ?>
          <option><?= $i; ?></option>
        <?php endfor; ?>
      </select>
      <select id="teacher_date_of_birth_year" name="teacher_date_of_birth_year">
        <?php for ($i = (date("Y") - 18); $i >= 1930; $i--): ?>
          <option><?= $i; ?></option>
        <?php endfor; ?>
      </select>
      <!-- <input type="number" id="teacher_date_of_birth_year" name="teacher_date_of_birth_year" min="1930" max="<?= date("Y") - 18; ?>" /><input type="number" id="teacher_date_of_birth_month" name="teacher_date_of_birth_month" min="01" max="12" /><input type="number" id="teacher_date_of_birth_day" name="teacher_date_of_birth_day" min="01" max="31" /> -->
      <label>Instrument(s): </label>
      <div id="teacher_instrument">
        <input type="checkbox" id="teacher_instrument_vocals" name="teacher_instrument_vocals" /><label for="teacher_instrument_vocals">Vocals </label><br />
        <input type="checkbox" id="teacher_instrument_piano" name="teacher_instrument_piano" /><label for="teacher_instrument_piano">Piano </label><br />
        <input type="checkbox" id="teacher_instrument_guitar" name="teacher_instrument_guitar" /><label for="teacher_instrument_guitar">Guitar </label><br />
        <input type="checkbox" id="teacher_instrument_bass" name="teacher_instrument_bass" /><label for="teacher_instrument_bass">Bass </label><br />
        <input type="checkbox" id="teacher_instrument_ukulele" name="teacher_instrument_ukulele" /><label for="teacher_instrument_ukulele">Ukulele </label><br />
      </div>
      <label> </label>
      <label for="teacher_address">Address: </label><input type="text" id="teacher_address" name="teacher_address" />
      <label for="teacher_phone_number">Phone Number: </label><input type="text" id="teacher_phone_number" name="teacher_phone_number" size="15" required />
      <label for="teacher_email_address">E-mail Address: </label><input type="text" id="teacher_email_address" name="teacher_email_address" required />
      <label for="teacher_neighbourhood_area">Neighborhood / Area: </label><input type="text" id="teacher_neighbourhood_area" name="teacher_neighbourhood_area" />
      <br />
      <button type="submit">Submit</button> <button type="reset">Reset</button>
    </fieldset>
  </form>
</div>
<?php require("footer.php"); ?>
