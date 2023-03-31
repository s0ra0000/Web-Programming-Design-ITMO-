<?php
if(isset($_GET["id"]) && !empty($_GET["id"])){
    require_once "config.php";

    $id = $_GET["id"];
    $query = mysqli_query($conn,"SELECT * FROM todolist WHERE id = '$id'");
    if($todolist = mysqli_fetch_assoc($query)){
        $text = $todolist["text"];
        $deadline = $todolist["deadline"];
        $color = $todolist["color"];
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create User</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .wrapper {
            width: 1200px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container">
        <div class="main">
            <div class="page-header">
                <h2><?php if(!isset($todolist)){
                        echo "Welcome to ";
                    }?>MY TODOLIST</h2>
            </div>
            <?php
            if(isset($todolist)){
                echo '
                    <div class="list" style="border:4px dotted '.$color.'">
                        <p class="text">'.$text.'</p>
                       <p class="deadline">'.$deadline.'</p>
                       <a href="update.php?id='.$id.'"><button class="update-btn">UPDATE</button></a>
                       <a href="delete.php?id='.$id.'"><button class="delete-btn">DELETE</button></a>
                   </div>
                    
                ';
            }
            ?>

            <a href="create.php"><button class="create-new-btn">Create new</button></a>
            <a href="list.php"><button class="to-list-btn">Watch list</button></a>
        </div>
    </div>
</div>
<script src="js/script.js"></script>
</body>
</html>