<?php 
  if ($_POST 
    && isset($_POST["teacher_first_name"]) 
    && isset($_POST["teacher_last_name"]) 
    && isset($_POST["teacher_date_of_birth_year"]) 
    && isset($_POST["teacher_address"]) 
    && isset($_POST["teacher_phone_number"]) 
    && isset($_POST["teacher_email_address"]) 
    && isset($_POST["teacher_neighbourhood_area"])) {
      $teacher_first_name = trim(ucwords(filter_input(INPUT_POST, "teacher_first_name", FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
      $teacher_last_name = trim(ucwords(filter_input(INPUT_POST, "teacher_last_name", FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
      $teacher_date_of_birth_year = filter_input(INPUT_POST, "teacher_date_of_birth_year", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $teacher_date_of_birth_day = filter_input(INPUT_POST, "teacher_date_of_birth_day", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $teacher_date_of_birth_month = filter_input(INPUT_POST, "teacher_date_of_birth_month", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      
      switch ($teacher_date_of_birth_day) {
        case "1":
          $teacher_date_of_birth_day = "01";
          break;
        case "2":
          $teacher_date_of_birth_day = "02";
          break;
        case "3":
          $teacher_date_of_birth_day = "03";
          break;
        return $teacher_date_of_birth_day;
      }
      
      switch ($teacher_date_of_birth_month) {
        case "January":
          $teacher_date_of_birth_month = "01";
          break;
        case "February":
          $teacher_date_of_birth_month = "02";
          break;
        case "March":
          $teacher_date_of_birth_month = "03";
          break;
        return $teacher_date_of_birth_month;
      }
      
      $teacher_date_of_birth = $teacher_date_of_birth_year . "-" . $teacher_date_of_birth_month . "-" . $teacher_date_of_birth_day;
      
      if (isset($_POST["teacher_instrument_vocals"]) 
        || isset($_POST["teacher_instrument_piano"]) 
        || isset($_POST["teacher_instrument_guitar"]) 
        || isset($_POST["teacher_instrument_bass"]) 
        || isset($_POST["teacher_instrument_ukulele"])) {
          $_POST["teacher_instrument_vocals"] = "Vocals"; 
          $_POST["teacher_instrument_piano"] = "Piano"; 
          $_POST["teacher_instrument_guitar"] = "Guitar";  
          $_POST["teacher_instrument_bass"] = "Bass";  
          $_POST["teacher_instrument_ukulele"] = "Ukulele"; 
      
      $teacher_instruments = [$_POST["teacher_instrument_vocals"], 
                  $_POST["teacher_instrument_piano"], 
                  $_POST["teacher_instrument_guitar"], 
                  $_POST["teacher_instrument_bass"], 
                  $_POST["teacher_instrument_ukulele"]];
        }

      $teacher_address = trim(ucwords(filter_input(INPUT_POST, "teacher_address", FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
      $teacher_phone_number = trim(filter_input(INPUT_POST, "teacher_phone_number", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $teacher_email_address = trim(filter_input(INPUT_POST, "teacher_email_address", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $teacher_neighbourhood_area = trim(ucwords(filter_input(INPUT_POST, "teacher_neighbourhood_area", FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
    }
?>
<pre><?= var_dump(get_defined_vars()); ?></pre>
<?php if ($_POST): ?>
  <?= $teacher_first_name; ?> <?= $teacher_last_name; ?><br />
  <?= $teacher_date_of_birth; ?><br />
  <?= $teacher_address; ?><br />
  <?= $teacher_phone_number; ?><br />
  <?= $teacher_email_address; ?><br />
  <?= $teacher_neighbourhood_area; ?><br />
  <?php foreach ($teacher_instruments as $teacher_instrument): ?>
    <?= $teacher_instrument; ?>
  <?php endforeach; ?>
<?php endif; ?>
