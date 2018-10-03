<?php include "connect.php" ?>
<?php
    $table = $_POST["table"];
    if ( empty ( $table ) ) { echo "<p style='color:red'>Выберите таблицу из списка!</p>"; goto skip;}
    $query = "TRUNCATE `$table`"; mysqli_query($link, $query);

    $sql = mysqli_query( $link, "SELECT * FROM tables WHERE `name_eng` = '$table'" );
    $result = mysqli_fetch_array($sql); $table_rus = $result["name_rus"];
    echo "<p style='color:green'>Таблица <b>$table_rus</b> успешно очищена!</p>";
    skip:
?>