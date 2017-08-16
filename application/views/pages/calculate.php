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

$course = $_GET['course'];
$time = $_GET['time'];
$date = $_GET['date'];
$length = $_GET['length'];
$coupon_code = $_GET['coupon'];

//echo $course;

switch($time){
    case 1: $table = "fees_morning";
        break;
    case 2: $table = "fees_afternoon";
        break;
    case 3: $table = "fees_evening";
        break;
    default: $table = "fees_hours";
        break;
}
//echo $table."  ";

    $stmt = $con->prepare("SELECT * FROM reg_fees");
    $stmt->execute();
    $row = $stmt->fetchAll();
    $reg_fees = $row[0]['price'];
    
    $stmt = $con->prepare("SELECT * FROM $table WHERE course=:course");
    $stmt->bindParam(":course", $course, PDO::PARAM_INT);
    $stmt->execute();
    $fees_row = $stmt->fetchAll();
    $fees_row_count = $stmt->rowCount();
    
//echo $fees_row_count;    
    for($i = 0; $i < $fees_row_count; $i++){
        $length_arr = explode(",",$fees_row[$i]['length']);
        for($j = 0; $j < sizeof($length_arr); $j++){
            if($length_arr[$j] === $length){
                $fees = $fees_row[$i]['price'];
                break;
            }
        }
    }
    $total_fees = $fees+$reg_fees;
    
    if($coupon_code != ""){
    $stmt = $con->prepare("SELECT * FROM coupon WHERE code=:code");
    $stmt->bindParam(":code", $coupon_code, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetchAll();
    $coupon = $row[0]['discount'];
    
    $discount = ($total_fees * $coupon) / 100;
    $total_fees -=$discount;
    }
    
    echo $fees.",".$reg_fees.",".$total_fees;
