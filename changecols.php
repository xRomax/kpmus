<?php include 'connect.php' ?>
<?php
$table = $_POST['tablen']; 
if (empty($table)) goto c;
//Изминение таблиц
$sql_show = mysqli_query($link, "SHOW columns from $table");
switch ($_COOKIE['type_field']) {
    case "add_field":
        if (empty($_POST["add1"])) goto a1;
        $i = 0;
        $query1 = "INSERT INTO $table ("; $query2 = "VALUES (";
        while ( $columns = mysqli_fetch_array($sql_show) ) {
                $p = $i+1;  $fields[$i] = $_POST["add".$p];
                $query1 .= $columns["Field"].",";
                $query2 .= "'$fields[$i]',";
                $i++;
        }
        $pos1 = strrpos($query1,",");         $pos2 = strrpos($query2,"'");
        $query1 = substr($query1,0,$pos1);    $query2 = substr($query2,0,$pos2);
        $query1 .= ")";                       $query2 .= "')";
        $query = $query1.$query2;
        mysqli_query($link,$query); a1:
    break;
        
    case "change_field":
        $query = "UPDATE $table SET "; $i = 0;
        while ( $columns = mysqli_fetch_array($sql_show) ) {
                $p = $i+1;  $fields[$i] = $_POST["ch".$p];
                if (empty($fields[$i])) goto a;
                $query .= $columns["Field"]."='".$fields[$i]."',";
                a: $i++;
        }
        $sql_show = mysqli_query($link, "SHOW columns from $table");
        $columns = mysqli_fetch_array($sql_show); $id = $columns["Field"];
        $pos = strrpos($query,",");
        $query = substr($query,0,$pos);
        $field = $_POST["change"];
        $query .= " WHERE $id='$field'"; 
        mysqli_query($link,$query);
    break;
        
    case "delete_field":
        $sql_show = mysqli_query($link, "SHOW columns from $table");
        $columns = mysqli_fetch_array($sql_show); $id = $columns["Field"];
        $field = $_POST["del"];
        if (empty($field)) goto a2;
        $query = "DELETE FROM $table WHERE $id = '$field'";
        mysqli_query($link,$query); a2:
    break;
    default: echo "Выберите действие<br>"; break;
}
c:
//Выведение таблиц
?>
<?php include 'show.php' ?>