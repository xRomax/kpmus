<?php include "connect.php" ?> <?php include "translit.php" ?>
<?php
$table_rus = $_POST["tablename"]; $table = translit($table_rus);
$table = str_replace(" ","_",$table); $n = $_COOKIE["num"]; $i = 0; $k = 0;
$type = $_POST["access"]; 
if ( empty ($table) ) {  
    echo "<p style='color:red'>Введите название таблицы!</p>"; goto skip;
} 
$sql = mysqli_query( $link, "SELECT * FROM tables" );
while ( $result = mysqli_fetch_array($sql) ) {
    if ($table == $result["name_eng"]) {
        echo "<p style='color:red'>Таблица с таким названием уже существует!</p>"; goto skip;
    }
}
while ($k <= 2) {
    if ( isset ($type[$k]) ) $access .= $type[$k].",";  $k++;
}
$pos = strrpos($access,","); $access = substr($access,0,$pos);
echo "<p style='color:green'>Таблица <b>$table_rus</b> успешно создана</p>";
$query = "CREATE TABLE `$table` ( `id` int(11) NOT NULL,"; $k = 0;
while ( $i < $n ) {
    $k = $i + 1;
    $coltype[$i] = $_POST["coltype$k"];
    $colname_rus[$i] = $_POST["colname$k"];
    if ( empty ( $colname_rus[$i] ) ) {
        echo "<p style='color:red'>Заполните все поля!</p>"; goto skip;
    }
    $colname[$i] = translit($colname_rus[$i]);
    $colname[$i] = str_replace(" ","_",$colname[$i]);
    $str_colname .= $colname[$i].",";
    $str_colname_rus .= $colname_rus[$i].",";
    switch ($coltype[$i]) {
        case "varchar": $query .= "`$colname[$i]` $coltype[$i](255) CHARACTER SET utf8 NOT NULL,"; break;
        case "int":     $query .= "`$colname[$i]` $coltype[$i](255) NOT NULL,"; break;
        case "date":    $query .= "`$colname[$i]` $coltype[$i] NOT NULL,"; break;
        case "text":    $query .= "`$colname[$i]` $coltype[$i] NOT NULL,"; break;
    } $i++;
}
$pos = strrpos($query,",");
$query = substr($query,0,$pos); $query .= ")";
$pos = strrpos($str_colname,",");
$str_colname = substr($str_colname,0,$pos);
$pos = strrpos($str_colname_rus,",");
$str_colname_rus = substr($str_colname_rus,0,$pos);
$str_colname = str_replace(" ","_",$str_colname);
$str_colname = "id,".$str_colname;
$str_colname_rus = "№,".$str_colname_rus;


$query2 = "INSERT INTO `tables`(`name_rus`, `name_eng`, `access`, `cols_name_rus`, `cols_name`) 
           VALUES ('$table_rus','$table','$access','$str_colname_rus','$str_colname')";

mysqli_query( $link, $query ); mysqli_query( $link, $query2 );
mysqli_query( $link, "ALTER TABLE `$table` ADD PRIMARY KEY (`id`)" );  skip:
?>