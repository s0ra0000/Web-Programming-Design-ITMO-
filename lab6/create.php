<?php
require_once "config.php";
$text=$deadline=$color="";
$text_error=$deadline_error=$color_error="";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $json = file_get_contents('php://input');
    $data = json_decode($json,true);
    $text = $data['text'];
    if (empty($text)) {
        $text_error = "Text is required.";
    } elseif (!filter_var($text, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"(.*?)")))) {
        $text_error = "Text is invalid.";
    } else {
        $text = $text;
    }
    $deadline = $data['deadline'];
    if (empty($deadline)) {
        $deadline_error = "deadline is required.";
    } elseif (!filter_var($deadline, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"(.*?)")))) {
        $deadline_error = "deadline is invalid.";
    } else {
        $deadline = $deadline;
    }

    $color = $data['color'];
    if (empty($color)) {
        $color_error = "color is required.";
    } elseif (!filter_var($color, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"(.*?)")))) {
        $color_error = "color is invalid.";
    } else {
        $color = $color;
    }

    if (empty($text_error) && empty($deadline_error) && empty($color_error)) {
        $sql = "INSERT INTO `todolist` (`text`, `deadline`, `color`) VALUES ('$text', '$deadline', '$color')";

        if (mysqli_query($conn, $sql)) {
            $last_id = mysqli_query($conn, "SELECT id FROM todolist ORDER BY id DESC LIMIT 1;");
            if ($todolist = mysqli_fetch_assoc($last_id)){
               echo $todolist["id"];
            }
        } else {
            echo "Something went wrong. Please try again later.";
        }
    }
    mysqli_close($conn);
}
?>

