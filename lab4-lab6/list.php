<?php
require_once "config.php";
$sql = "SELECT * FROM todolist";
$result =$conn->query($sql);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LIST</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="list-wrapper">
    <div class="list-container">
        <h2>
            MY Lists
        </h2>
        <div class="btn-container">
            <a href="create.php"><button class="create-new-btn">Create new</button></a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>Text</th>
                    <th>deadline</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
                if($result -> num_rows > 0){
                    while($row = $result -> fetch_assoc()){
                        echo"
                            <tr style='border-color:".$row["color"] . " '>
                                <td>" . $row["id"] . "</td>
                                <td><a class='link' href='index.php?id=". $row["id"]."'>" . $row["text"]. "</a></td>
                                <td>". $row["deadline"]. "</td>
                                <td><a href='update.php?id=".$row["id"]."'><button class='update-btn'>update</button></a></td>
                                <td><a href='delete.php?id=".$row["id"]."'><button class='delete-btn'>delete</button></a></td>
                            </tr>
                        ";
                    }
                }
            $conn->close();
            ?>
            </tbody>
        </table>


    </div>
</div>
</body>
</html>