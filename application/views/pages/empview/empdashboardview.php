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

<link rel="stylesheet" href="<?= $base_url ?>/assets/SemanticUI/semantic.min.css">
<!-- Font Awesome -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

<!-- Refer http://silviomoreto.github.io/bootstrap-select/ -->
<!-- Latest compiled and minified CSS -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css"> -->
<!-- Latest compiled and minified JavaScript -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script> -->



<link rel="stylesheet" href="https://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

<!-- All Page Style Sheet -->
<link rel="stylesheet" type="text/css" href="<?= $css ?>/allpage.css">

<!-- Admin Custom Style Sheet -->
<link rel="stylesheet" type="text/css" href="<?= $css ?>/empview/empdashboardviewstyle.css">

<script type="text/javascript">
var path = "<?= $path; ?>";
var username = "<?= $username; ?>";
var uid = "<?= $uid; ?>";
var name = "<?= $name; ?>";
var loginstatus = "<?= $loggedIn; ?>";

$(document).ready(function() {

});

$(document).on('click', '.navbar li', function() {
    $(".navbar li").removeClass("active");
    $(this).addClass("active");
});

</script>
</head>
<body>

<!-- <nav class="navbar navbar-default"> -->
    <!-- Brand and toggle get grouped for better mobile display -->
    <!-- <div class="navbar-header">
        <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a href="#" class="navbar-brand">TAG</a>
    </div> -->
    <!-- Collection of nav links and other content for toggling -->
    <!-- <div id="navbarCollapse" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <h5 class="visible-xs">VIEWS</h5>
            <li class="active"><a class="viewBtn" id="bookingviewbtn" href="#">Profile</a></li>
            <li><a class="viewBtn" id="promoviewbtn" href="#">Reports</a></li>
        </ul>
        <hr class="visible-xs">
        <ul class="nav navbar-nav navbar-right">
          <h5 class="visible-xs">ACCOUNT</h5>
          <li><a class="statusBtn" id="1" href="#"><span class="glyphicon glyphicon-user"></span> <?= $name ?></a></li>
          <li><a href="<?= $path?>/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
    </div>
</nav> -->


<header class="header-nav">
  <div class="burger">
    <div class="burgerpatty"></div>
    <div class="burgerpatty"></div>
    <div class="burgerpatty"></div>
  </div>

  <nav class="menu">
    <div class="menubrand">
      <a href=""><div class="logo"></div></a>
    </div>
    <ul class="menulist">
      <li class="menuitem"><a href="" class="menulink">Work</a></li>
      <li class="menuitem"><a href="" class="menulink">About</a></li>
      <li class="menuitem">
        <a href="https://twitter.com/ettrics" target="_blank" class="menulink menulink--social"><i class="fa fa-twitter"></i></a>
      </li>
      <li class="menuitem">
        <a href="https://dribbble.com/ettrics" target="_blank" class="menulink menulink--social">
          <i class="fa fa-dribbble"></i></a>
      </li>
      <li class="menuitem"><a href="<?= $path?>/logout" class="menulink">Logout</a></li>
    </ul>
  </nav>
  <a id="emptagbtn" class="tagbtn" href="#">Tag</a>
</header>


<main class="">
    <header id="headerInfo"><h1>Hello <?=$name?></h1></header>
    <div id="tagStatus">
      <p>You are not tagged in</p>
    </div>

    <div class="ui basic modal">
    <div class="ui icon header">
    <i class="hand peace icon"></i>
    </div>
    <div class="content">
      <p>You are tagged at 11am</p>
    </div>
    <div class="actions">
      <div class="ui red basic cancel inverted button tagOut">
        <i class="remove icon"></i>
        TagOut
      </div>
      <div class="ui green ok inverted button tagIn">
        <i class="checkmark icon"></i>
        TagIn
      </div>
    </div>
  </div>

</main>



<script src="<?= $js ?>/allpage.js"></script>
<script src="<?= $js ?>/empview/emploginviewscript.js"></script>
<script src="<?= $js ?>/empview/empdashboardviewscript.js"></script>
</body>
</html>
