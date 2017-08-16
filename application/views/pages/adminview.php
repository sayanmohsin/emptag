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

<!-- Login Custom Style Sheet -->
<link rel="stylesheet" type="text/css" href="<?= $css ?>/adminviewstyle.css">
<!-- Admin Custom Style Sheet -->
<!-- <link rel="stylesheet" type="text/css" href="<?= $css ?>/dashboardviewstyle.css"> -->
<script>var path = "<?= $path?>"</script>
</head>
<body>

  <div class="login">
    <div class="login-screen">
      <div class="app-title">
        <h1>Admin Login</h1>
      </div>

      <div class="login-form">
        <div class="control-group">
        <input type="text" class="login-field" value="" placeholder="username" id="login-name">
        <label class="login-field-icon fui-user" for="login-name"></label>
        </div>

        <div class="control-group">
        <input type="password" class="login-field" value="" placeholder="password" id="login-pass">
        <label class="login-field-icon fui-lock" for="login-pass"></label>
        </div>

        <div class="checkbox">
          <label><input type="checkbox" name="remember_me"> Remember me</label>
        </div>

        <p id="message" class="bg-danger"></p>

        <a id="loginbtn" class="btn btn-primary btn-large btn-block" href="#">login</a>
        <a class="login-link" href="#">Lost your password?</a>
      </div>
    </div>
  </div>

<script src="<?= $js ?>/adminviewscript.js"></script>

<script src="<?= $js ?>/dashboardviewscript.js"></script>

</body>
</html>
