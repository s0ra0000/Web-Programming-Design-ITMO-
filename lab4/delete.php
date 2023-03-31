<?php
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    include_once "config.php";
    $id = trim($_POST["id"]);
    $delete_item = null;
    foreach($xml -> children() as $item){
        if($item["id"] == $id){
            unset($xml->item[$id]);
        }
    }
    $xml->saveXML("database.xml");
    header("location: list.php");
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container-delete">
        <div class="page-header">
            <h1>Delete list</h1>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="delete">
                <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                <p>Are you sure you want to delete this list?</p><br>
                <p>
                    <input type="submit" value="Delete" class="btn delete-btn dlt">
                    <?php echo '<a href="index.php?id=' . $id . '"class="cancel cancel-btn">Back</a>'; ?>
                </p>
            </div>
        </form>
    </div>
</div>
<script src="js/script.js"></script>
</body>
</html>
