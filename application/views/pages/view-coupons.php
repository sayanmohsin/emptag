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
    
    $stmt = $con->prepare("SELECT * FROM coupon");
    $stmt->execute();
    $row_count = $stmt->rowCount();
    $row = $stmt->fetchAll();
?>    
<!DOCTYPE html>
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Lato:100,200,300,400,500,600,700,800" rel="stylesheet"/>
        <style>
            *{
                font-family: Lato;
            }
            table tr *{
                height: 30px;
                text-align: center;
            }
            table tr th{
                background: #898989;
                color: white;
            }
            table tr td{
                background: #DEDEDE;
            }
        </style>
    </head>
    <body>
        <table width="100%">
            <tr>
                <th>S No.</th>
                <th>Coupon code</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Discount (%)</th>
                <th>Action</th>
            </tr>
            <?php for($i=0; $i<$row_count; $i++){ ?>
            <tr>
                <td><?php echo $i+1; ?></td>
                <td><?php echo $row[$i]['code']; ?></td>
                <td><?php echo $row[$i]['start_date']; ?></td>
                <td><?php echo $row[$i]['end_date']; ?></td>
                <td><?php echo $row[$i]['discount']; ?></td>
                <td>
                    <select onchange="getAction(this.value,<?php echo $row[$i]['id']?>)">
                        <option value="0">Select action</option>
                        <option value="1">Change</option>
                        <option value="2">Delete</option>
                    </select>
                </td>
            </tr>
            <?php } ?>
        </table>
    </body>