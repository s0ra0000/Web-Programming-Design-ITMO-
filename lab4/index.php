<?php
require_once "config.php";
if(isset($_GET["id"]) && !empty($_GET["id"])){
    $id = $_GET["id"];
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
                    foreach($xml -> children() as $item){
                        if($item["id"] == $id){
                            echo '
                                <div class="list" style="border:4px dotted '.$item->color.'">
                                    <p class="text">'.$item->text.'</p>
                                   <p class="deadline">'.$item->deadline.'</p>
                                   <a href="update.php?id='.$item["id"].'"><button class="update-btn">UPDATE</button></a>
                                   <a href="delete.php?id='.$item["id"].'"><button class="delete-btn">DELETE</button></a>
                               </div>
                            ';
                        }
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