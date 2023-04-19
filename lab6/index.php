<?php
if(isset($_GET["id"]) && !empty($_GET["id"])){
    require_once "config.php";

    $id = $_GET["id"];
    $query = mysqli_query($conn,"SELECT * FROM todolist WHERE id = '$id'");
    if($todolist = mysqli_fetch_assoc($query)){
        $text = $todolist["text"];
        $deadline = $todolist["deadline"];
        $color = $todolist["color"];
        $arr = array("text"=>$text,"deadline"=>$deadline,"color"=>$color);
        echo json_encode($arr);
    }else{
        echo "Something went wrong.";
        header("location: index.php");
        exit();
    }
    mysqli_close($conn);
}
else{
    $id = null;
    $text = "";
    $deadline = "";
    $color = "";
}
?>
