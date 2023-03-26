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

        if (mysqli_query($conn, $sql)) {
//            header("location: index.php");
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
    <title>Create User</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style>
        .wrapper {
            width: 1200px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h2>Create User</h2>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($text_error)) ? 'has-error' : ''; ?>">
                        <label>Text</label>
                        <input type="text" name="text" class="form-control" value="">
                        <span class="help-block"><?php echo $text_error;?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($deadline_error)) ? 'has-error' : ''; ?>">
                        <label>Deadline</label>
                        <input type="text" name="deadline" class="form-control" value="">
                        <span class="help-block"><?php echo $deadline_error;?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($color_error)) ? 'has-error' : ''; ?>">
                        <label>Color</label>
                        <input type="text" name="color" class="form-control" value="">
                        <span class="help-block"><?php echo $color_error;?></span>
                    </div>

                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="index.php" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>