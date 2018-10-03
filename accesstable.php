<?php include "connect.php" ?>
<?php
    $table = $_POST["table"]; $type = $_POST["access"]; $k = 0;
    if ( empty ( $table ) ) { echo "<p style='color:red'>Выберите таблицу из списка!</p>"; goto skip;}

    while ($k <= 2) {
        if ( isset ($type[$k]) ) $access .= $type[$k].","; $k++;
    }
    $pos = strrpos($access,",");
    $access = substr($access,0,$pos);

    $query = "UPDATE `tables` SET `access`='$access' WHERE `name_eng`='$table'";
    mysqli_query($link, $query);

    $sql = mysqli_query( $link, "SELECT * FROM tables WHERE `name_eng` = '$table'" );
    $result = mysqli_fetch_array($sql); $table_rus = $result["name_rus"];
    echo "<p style='color:green'>Доступ к таблице <b>$table_rus</b> успешно изменён!</p>";
    skip:
?>