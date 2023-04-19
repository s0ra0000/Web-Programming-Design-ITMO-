<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "config.php";
    $json = file_get_contents('php://input');
    $data = json_decode($json,true);
    $id = $data['id'];
    $query = "DELETE FROM todolist WHERE id = '$id'";
    if (mysqli_query($conn, $query)) {
       echo $id;
    } else {
        echo "Something went wrong. Please try again later.";
    }
    mysqli_close($conn);
} else {
    if(isset($_GET["id"]) && !empty($_GET["id"])){
        require_once "config.php";
        $id = trim($_GET["id"]);
    }
    if (empty(trim($_GET["id"]))) {
        echo "Something went wrong. Please try again later.";
        header("location: index.php");
        exit();
    }
}
?>

