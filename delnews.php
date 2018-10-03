<?php include "connect.php" ?>
<?php
    $name = $_POST["news-del"];
    $query = "DELETE FROM `news` WHERE `name` = '$name'"; mysqli_query($link, $query);
?>