<?php include 'connect.php' ?>
<?php
$table = $_POST["table"]; if ( empty ( $table ) ) $table = $_POST["tablen"];
$page = $_POST["page"]; if ( empty ( $page ) ) $page = $_POST["pagen"]; 
$pagesize = $_POST["pagesize"]; if ( empty ( $pagesize ) ) $pagesize = $_POST["pagesizen"];
$i = 0; $k = 1; 

$sql = mysqli_query( $link, "SELECT * FROM $table");
while ( $result = mysqli_fetch_array($sql) ) {
    $page_left = $page * $pagesize - $pagesize;
    $page_right = $page * $pagesize;
    if ( ($page_left < $k) && ($k <= $page_right) ) {
        $sql_show = mysqli_query($link, "SHOW columns from $table");
        $show_body .= "<tr>"; $n = 0;
        while ( $columns = mysqli_fetch_array($sql_show) ) {
            $show_body .= "<td><p>".$result[$columns['Field']]."</p></td>"; $n++;
        }
        $show_body .= "</tr>";
    }$k++;
}
$sql = mysqli_query( $link, "SELECT * FROM tables where name_eng='$table'");
$result = mysqli_fetch_array($sql);
$table_name = $result["name_rus"];
$str = $result["cols_name_rus"];
$show_head = "<table class='highlight' border='1px solid black'>";
while ( $i < $n ) {
    $pos = strpos($str,","); $len = strlen($str);
    if ( empty ($pos) ) $cols_name_rus[$i] = $str;
    else $cols_name_rus[$i] = substr($str,0,$pos);
    $str = substr($str,$pos+1,$len);
    $show_head .= "<td><b>$cols_name_rus[$i]</b></td>";
    $i++;
}
$show_head .= "</tr>"; $show_body .= "</table>"; 
echo $show_head.$show_body;
?>