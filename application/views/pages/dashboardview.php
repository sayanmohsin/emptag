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

<!-- Font Awesome -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

<!-- Refer http://silviomoreto.github.io/bootstrap-select/ -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>

<!-- DataTables -->
<!-- <link rel="stylesheet" type="text/css" href="<?= $base_url ?>/assets/DataTables/datatables.min.css"/>
<script type="text/javascript" src="<?= $base_url ?>/assets/DataTables/datatables.min.js"></script> -->

<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script> -->

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>

<!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css">

<script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.print.min.js"></script> -->

<!-- Login Custom Style Sheet -->
<!-- <link rel="stylesheet" type="text/css" href="<?= $css ?>/adminviewstyle.css"> -->

<!-- All Page Style Sheet -->
<link rel="stylesheet" type="text/css" href="<?= $css ?>/allpage.css">

<!-- Admin Custom Style Sheet -->
<link rel="stylesheet" type="text/css" href="<?= $css ?>/dashboardviewstyle.css">

<script type="text/javascript">
var path = "<?= $path; ?>";
var promoData;
var bookingData;
$(document).ready(function() {
  $('[data-toggle="tooltip"]').tooltip();
  promoData = initPromoDataTable();
  bookingData = initBookingDataTable();

  $(".viewBtn").click(function(){
    var btnid = $(this).attr("id");
    if (btnid == 'bookingviewbtn') {
      $("#promoview").hide(100,"linear");
      $("#bookingview").show(100,"linear");
    } else if (btnid == 'promoviewbtn'){
      $("#bookingview").hide(100,"linear");
      $("#promoview").show(100,"linear");
    }

  });
});

$(document).on('click', '.navbar li', function() {
    $(".navbar li").removeClass("active");
    $(this).addClass("active");
});

</script>
</head>
<body>

<nav class="navbar navbar-default">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a href="#" class="navbar-brand">UKCE Booking Console</a>
    </div>
    <!-- Collection of nav links and other content for toggling -->
    <div id="navbarCollapse" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <h5 class="visible-xs">VIEWS</h5>
            <li class="active"><a class="viewBtn" id="bookingviewbtn" href="#">BOOKING</a></li>
            <li><a class="viewBtn" id="promoviewbtn" href="#">PROMO</a></li>
        </ul>
        <hr class="visible-xs">
        <ul class="nav navbar-nav navbar-right">
          <h5 class="visible-xs">ACCOUNT</h5>
          <li><a class="statusBtn" id="1" href="#"><span class="glyphicon glyphicon-user"></span> <?= $name ?></a></li>
          <li><a href="<?= $path?>/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
    </div>
</nav>


<?php $this->load->view('pages/bookingview'); ?>
<?php $this->load->view('pages/promoview'); ?>

<script src="<?= $js ?>/adminviewscript.js"></script>

<script src="<?= $js ?>/dashboardviewscript.js"></script>
<script src="<?= $js ?>/bookingviewscript.js"></script>
<script src="<?= $js ?>/promoviewscript.js"></script>

</body>
</html>
