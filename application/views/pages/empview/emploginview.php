<!DOCTYPE html>
<html>
<head>

<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

<!-- Latest compiled and minified CSS -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
<!-- Optional theme -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"> -->
<!-- Latest compiled and minified JavaScript -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

<!-- SemanticUI CSS -->
<link rel="stylesheet" href="<?= $base_url ?>/assets/SemanticUI/semantic.min.css">
<!-- SemanticUI JS -->
<script src="<?= $base_url ?>/assets/SemanticUI/semantic.min.js"></script>

<!-- Refer http://silviomoreto.github.io/bootstrap-select/ -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>

<!-- Login Custom Style Sheet -->
<!-- <link rel="stylesheet" type="text/css" href="<?= $css ?>/adminviewstyle.css"> -->
<!-- Admin Custom Style Sheet -->
<link rel="stylesheet" type="text/css" href="<?= $css ?>/empview/emploginviewstyle.css">
<script>var path = "<?= $path?>"</script>
</head>
<body>
<div class="ui center aligned grid">
  <div id="login-form" class="ui container">
    <h1 class="ui huge header">
      Please sign in 
    </h1>
    <form class="ui large form">
      <div class="field">
        <div class="ui left icon input">
          <i class="user icon"></i><input name="username" placeholder="Username" type="text" id="login-name">
        </div>
      </div>
      <div class="field">
        <div class="ui left icon input">
          <i class="lock icon"></i><input name="password" placeholder="Password" type="password" id="login-pass">
        </div>
      </div>
      <p id="message"></p>
      <div id="empInBtn" class="ui fluid large primary submit button">
        Sign in
      </div>
    </form>
  </div>
</div>
 
<script src="<?= $js ?>/empview/emploginviewscript.js"></script>

<script src="<?= $js ?>/empview/empdashboardviewscript.js"></script>

</body>
</html>
