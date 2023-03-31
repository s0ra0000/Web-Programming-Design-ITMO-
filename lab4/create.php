<?php
require_once "config.php";

$text=$deadline=$color="";
$text_error=$deadline_error=$color_error="";
if($_SERVER["REQUEST_METHOD"] == "POST"){
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
        $sql = "INSERT INTO `todolist` (`text`, `deadline`, `color`) VALUES ('$text', '$deadline', '$color')";
        foreach ($xml -> children() as $item){
            $last_id = 0;
            if($item["id"] > $last_id){
                $last_id = $item["id"];
            }
        }
        $last_id = $last_id + 1;
        $item = $xml->addChild("item");
        $item["id"] = $last_id;
        $item->addChild("text",$text);
        $item->addChild("deadline",$deadline);
        $item->addChild("color",$color);
        $xml->saveXML("database.xml");
        header("location: index.php?id=".$last_id."");
        if (mysqli_query($conn, $sql)) {
            $last_id = mysqli_query($conn, "SELECT id FROM todolist ORDER BY id DESC LIMIT 1;");
            if ($todolist = mysqli_fetch_assoc($last_id)){

            }
        } else {
            echo "Something went wrong. Please try again later.";
        }
    }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create List</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="wrapper">
    <div class="container">
        <div class="content">
            <div class="page-header">
                <h2>Create list</h2>
            </div>
            <form action="" method="post">
                <div class="form-group">
                    <label>Text</label>
                    <input type="text" name="text" id="text" class="form-control" value="">
                    <span class="help-block"><?php echo $text_error;?></span>
                </div>

                <div class="form-group ">
                    <label>Deadline</label>
                    <input type="date" id="deadline" name="deadline" class="form-control" value="">
                    <span class="help-block"><?php echo $deadline_error;?></span>
                </div>

                <div class="form-group">
                    <label>Color</label>
                    <input type="color" id="color" name="color" class="form-control" value="#d57474">
                    <span class="help-block"><?php echo $color_error;?></span>
                </div>

                <input type="submit" class="btn" value="Add" onclick="create()">
                <a href="index.php" class="btn-cancel">Cancel</a>
            </form>
        </div>
    </div>
</div>
<script src="js/script.js"></script>
</body>
</html>
