<?php
require_once "config.php";
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LIST</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="list-wrapper">
    <div class="list-container">
        <h2>
            MY Lists
        </h2>
        <div class="btn-container">
            <a href="create.php"><button class="create-new-btn">Create new</button></a>
        </div>
        <table>
            <thead>
            <tr>
                <th>id</th>
                <th>Text</th>
                <th>deadline</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
<?php
foreach($xml -> children() as $item){
    echo"
                            <tr style='border-color:".$item->color . " '>
                                <td>" . $item["id"] . "</td>
                                <td><a class='link' href='index.php?id=". $item["id"]."'>" . $item->text. "</a></td>
                                <td>". $item->deadline. "</td>
                                <td><a href='update.php?id=".$item["id"]."'><button class='update-btn'>update</button></a></td>
                                <td><a href='delete.php?id=".$item["id"]."'><button class='delete-btn'>delete</button></a></td>
                            </tr>
                        ";
}
?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>