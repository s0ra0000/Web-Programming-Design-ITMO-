<?php
require_once "config.php";

$text=$deadline=$color="";
$text_error=$deadline_error=$color_error="";

if(isset($_POST["id"]) && !empty($_POST["id"])){
    $id = $_POST["id"];

    $text = trim($_POST["text"]);
    if (empty($text)) {
        $text_error = "Text is required.";
    } elseif (!filter_var($text, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"(.*?)")))) {
        $text_error = "Text is invalid.";
    } else {
        $text = $text;
    }

    $deadline = trim($_POST["deadline"]);
    if (empty($deadline)) {
        $deadline_error = "deadline is required.";
    } elseif (!filter_var($deadline, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"(.*?)")))) {
        $deadline_error = "deadline is invalid.";
    } else {
        $deadline = $deadline;
    }

    $color = trim($_POST["color"]);
    if (empty($color)) {
        $color_error = "color is required.";
    } elseif (!filter_var($color, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"(.*?)")))) {
        $color_error = "color is invalid.";
    } else {
        $color = $color;
    }
    if (empty($text_error) && empty($deadline_error) && empty($color_error)) {

        $sql = "UPDATE `todolist` SET `text`= '$text', `deadline`= '$deadline', `color`= '$color' WHERE id='$id'";

        if (mysqli_query($conn, $sql)) {
            header("location: index.php?id=".$id."");
        } else {
            echo "Something went wrong. Please try again later.";
        }

    }
    mysqli_close($conn);
}else{
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        $id = trim($_GET["id"]);
        $query = mysqli_query($conn,"SELECT * FROM todolist WHERE id = '$id'");
        if ($todolist = mysqli_fetch_assoc($query)) {
            $text   = $todolist["text"];
            $deadline  = $todolist["deadline"];
            $color  = $todolist["color"];
        } else {
            echo "Something went wrong. Please try again later.";
            header("location: index.php");
            exit();
        }
        mysqli_close($conn);
    }else{
        echo "Something went wrong. Please try again later.";
        header("location: index.php");
        exit();
    }
}
?>

