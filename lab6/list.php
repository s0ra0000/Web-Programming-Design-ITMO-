<?php
header('Access-Control-Allow-Origin: *');
require_once "config.php";
$sql = "SELECT * FROM todolist";
$result =$conn->query($sql);
$array_list = [];
if($result -> num_rows > 0){
    while($row = $result -> fetch_assoc()){
        array_push($array_list,$row);
    }
    echo json_encode($array_list);
}
$conn->close();
?>

