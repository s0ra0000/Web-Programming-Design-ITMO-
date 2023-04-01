<?php
header('Access-Control-Allow-Origin: *');
require_once "config.php";
$sql = "SELECT * FROM todolist";
$result =$conn->query($sql);
$array_list = [];
if($result -> num_rows > 0){
    while($row = $result -> fetch_assoc()){
        array_push($array_list,$row);
//        echo"
//                            <tr style='border-color:".$row["color"] . " '>
//                                <td>" . $row["id"] . "</td>
//                                <td><a class='link' href='index.php?id=". $row["id"]."'>" . $row["text"]. "</a></td>
//                                <td>". $row["deadline"]. "</td>
//                                <td><a href='update.php?id=".$row["id"]."'><button class='update-btn'>update</button></a></td>
//                                <td><a href='delete.php?id=".$row["id"]."'><button class='delete-btn'>delete</button></a></td>
//                            </tr>
//                        ";
    }
    echo json_encode($array_list);
}
$conn->close();
?>

