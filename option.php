<?php include "connect.php" ?>
<?php
    $usnm = $_COOKIE["usnm"];
    $sql_usnm = mysqli_query( $link, "SELECT * FROM reg WHERE login='$usnm'");
    $access = mysqli_fetch_array($sql_usnm);
    $sql = mysqli_query( $link, "SELECT * FROM tables");
    echo "<option selected disabled>Выберите таблицу</option>";
    while ($res = mysqli_fetch_array($sql)){
        $name_eng = $res["name_eng"]; $name_rus = $res["name_rus"];
        $pos = strpos( $res["access"], $access["type"] );
        if ($access["type"] == "admin") echo "<option value='$name_eng'>$name_rus</option>";
        else if ($pos == true) echo "<option value='$name_eng'>$name_rus</option>";
    }
?>