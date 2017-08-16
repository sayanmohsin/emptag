<?php
$server = "localhost";
$username = "root";
$password = "";
try {
    $con = new PDO("mysql:host=$server;dbname=courses", $username, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

$code = $_GET['code'];
$sdate = $_GET['sdate'];
$edate = $_GET['edate'];
$discount = $_GET['discount'];


//echo $code." ".$sdate." ".$edate." ".$discount;

$stmt = $con->prepare("SELECT * FROM coupon WHERE code=:code");
$stmt->bindParam(":code", $code, PDO::PARAM_INT);
$stmt->execute();
$exists = $stmt->rowCount();
if($exists > 0){
    echo "Already exists.";
}
else{
    $stmt = $con->prepare("INSERT INTO coupon (code, start_date, end_date, discount) VALUES (:code, :sdate, :edate, :discount)");
    $stmt->bindParam(":code", $code, PDO::PARAM_INT);
    $stmt->bindParam(":sdate", $sdate, PDO::PARAM_INT);
    $stmt->bindParam(":edate", $edate, PDO::PARAM_INT);
    $stmt->bindParam(":discount", $discount, PDO::PARAM_INT);
    $stmt->execute();
    echo "Coupon created successfully.";
}
