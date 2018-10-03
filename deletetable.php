<?php include "connect.php" ?>
<?php
    $table = $_POST["table"];
    if ( empty ( $table ) ) { echo "<p style='color:red'>Выберите таблицу из списка!</p>"; goto skip;}
    $sql = mysqli_query( $link, "SELECT * FROM tables WHERE `name_eng` = '$table'" );
    $result = mysqli_fetch_array($sql); $table_rus = $result["name_rus"];
    echo "<p style='color:green'>Таблица <b>$table_rus</b> успешно удалена!</p>";

    $query = "DROP TABLE `$table`"; mysqli_query($link, $query);
    $query = "DELETE FROM `tables` WHERE `name_eng` = '$table'"; mysqli_query($link, $query);
    skip:
?>