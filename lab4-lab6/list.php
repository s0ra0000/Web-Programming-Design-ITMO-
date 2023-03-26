<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LIST</title>
</head>
<body>
<?php
    require_once "config.php";
    $sql = "SELECT * FROM todolist";
    $result =$conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"]. " - Name: " . $row["text"]. " -Deadline " . $row["deadline"]. "-Color". $row["color"]."<br>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();
?>
</body>
</html>