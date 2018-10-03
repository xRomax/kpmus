<?php include "connect.php" ?>
<?php include "translit.php" ?>
<?php
    $table = $_POST["table"];
    $table_rus_new = $_POST["table-new"];
    $table_new = translit($table_rus_new);
    $table_new = str_replace(" ","_",$table_new);
    
    if ( empty ( $table ) ) { echo "<p style='color:red'>Выберите таблицу из списка!</p>"; goto skip;}
    if ( empty ( $table_rus_new ) ) { echo "<p style='color:red'>Введите новое название таблицы!</p>"; goto skip;}

    $sql = mysqli_query( $link, "SELECT * FROM tables WHERE `name_eng` = '$table'" );
    $result = mysqli_fetch_array($sql); $table_rus = $result["name_rus"];
    echo "<p style='color:green'>Таблица <b>$table_rus</b> успешно сменила название на<b> $table_rus_new</b>!</p>";
    $query = "RENAME TABLE `$table` TO `$table_new`"; mysqli_query($link, $query);
    $query = "UPDATE `tables` SET `name_rus`='$table_rus_new',`name_eng`='$table_new' WHERE `name_eng` = '$table'";
    mysqli_query($link, $query);
    skip:
?>