<?php
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    require_once "config.php";
    $id = trim($_POST["id"]);

    $query = "DELETE FROM todolist WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        header("location: list.php");
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

