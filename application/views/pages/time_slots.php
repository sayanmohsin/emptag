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

    $course = $_GET['q'];
    $stmt = $con->prepare("SELECT * FROM time_slots");
    $stmt->execute();
    $row=$stmt->fetchAll();
    if($stmt->rowCount()>0){
        $count = $stmt->rowCount();
        for($i=0;$i<$count;$i++){
            $row_arr_com = $row[$i]['courses'];
            $row_arr = explode(",",$row_arr_com);
            $count_arr = sizeof($row_arr);
            for($j=0; $j<$count_arr; $j++){
                if($row_arr[$j] === $course){
                    if($hint === ""){
                    $hint = "<option value='".$row[$i]["id"]."'>".$row[$i]["time_slots"]."</option>";
                    }
                    else {
                    $hint = $hint."<option value='".$row[$i]["id"]."'>".$row[$i]["time_slots"]."</option>";
                    }
                }
            }
        }
        if($hint !== ""){
            echo $hint;
        }
    }
