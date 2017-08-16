<!DOCTYPE html>
<html>
<head>

<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- Refer http://silviomoreto.github.io/bootstrap-select/ -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>

<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<!-- jquery.validate -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>
<!-- validatorjs -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>

<!-- All Page Style Sheet -->
<link rel="stylesheet" type="text/css" href="<?= $css ?>/allpage.css">
<!-- Custom Style Sheet -->
<link rel="stylesheet" type="text/css" href="<?= $css ?>/mainviewstyle.css">
<!-- Custom Style Sheet -->
<link rel="stylesheet" type="text/css" href="<?= $css ?>/confirmviewstyle.css">

<script>var path = "<?= $path?>"</script>
</head>
<body>
<div id="options" class="container">
<div class="row">
<div class="col-sm-6">
  <div id="course-select" class="select">
            <p>The course I'd like to take is...</p>
            <select id='course-names' class='course-names' onchange="showTimings(this.value)">
      <option value="0">Please select...</option>
      <?php
                      $stmnt = $con->prepare('SELECT * FROM course_names');
                      $stmnt->execute();
                      if($stmnt->rowCount() > 0){
                          $row = $stmnt->fetchAll();
                          for($i=0;$i<$stmnt->rowCount();$i++){ ?>
      <option value="<?php echo $row[$i]["id"];?>"><?php echo $row[$i]["name"];?></option>
      <?php } }?>
    </select>
  </div>
</div>

<div class="col-sm-6">
  <div id="time-select" class="select" style='display:none'>
            <p>My preferred timeslot is...</p>
            <select id='time-slots' class='time-slots' onchange="showDates(this.value)">
      <option value="0">Please select...</option>
    </select>
  </div>
</div></div>

<div class="row">
<div class="col-sm-6">
  <div id="date-select" class="select" style='display:none'>
            <p>I would like to start on...</p>
            <select id='start-dates' class='start-dates' onchange="showLength(this.value)">
      <option value="0">Please select...</option>
      <?php
                      $stmnt = $con->prepare('SELECT * FROM dates');
                      $stmnt->execute();
                      if($stmnt->rowCount() > 0){
                          $row = $stmnt->fetchAll();
                          for($i=0;$i<$stmnt->rowCount();$i++){ ?>
      <option value="<?php echo $row[$i]["id"];?>"><?php echo date("d M Y", strtotime($row[$i]["dates"]));?></option>
      <?php } }?>
    </select>
  </div>
</div>

<div class="col-sm-6">
  <div id="length-select" class="select" style='display:none'>
            <p>My preferred length of course is...</p>
            <select id='course-length' class='course-length' onchange="calculate()">
      <option value="0">Please select...</option>
      <?php
                      $stmnt = $con->prepare('SELECT * FROM length_of_course');
                      $stmnt->execute();
                      if($stmnt->rowCount() > 0){
                          $row = $stmnt->fetchAll();
                          for($i=0;$i<$stmnt->rowCount();$i++){ ?>
      <option value="<?php echo $row[$i]["id"];?>"><?php echo $row[$i]["length"];?></option>
      <?php } }?>
    </select>
  </div>
  </div></div>

<div class="row">
<div class="col-sm-6">
  <div id='apply-coupon' class='apply-coupon select' style='display:none'  >
  <p>Promo Code</p>
  <input type="text" id='coupon-code' class="coupon-code" />
  <button class="mainview-btn" id="code-button" onclick="calculate()">Apply Code</button>
  <div id="discount"></div>
  </div>
</div></div>

<div class="row">
<div class="col-sm-6">
  <div id="fees-calculated" style="display: none;">
            <div id="course-fees"></div>
            <div id="reg-fees"></div>
            <div id="total-fees"></div>
            <button id="reviewAllBtn" class="mainview-btn">Make Payment</button>
   </div>
</div></div>
</div> <!-- options container -->
<script src="<?= $js ?>/mainviewscript.js"></script>
</body>
</html>
