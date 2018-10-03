<?php include "connect.php" ?> <?php include "translit.php" ?>
<?php
    $table = $_POST["table"]; $i = 1; $n = 0; $query = "ALTER TABLE `$table` "; 
    $sql = mysqli_query($link, "SHOW columns from $table");
    while ( $result = mysqli_fetch_array( $sql ) ) {
        if ( empty ( $_POST["changes$i"] ) ) goto skip;
        $name_old[$n] = $result["Field"];
        $name_new_rus[$n] = $_POST["changes$i"];
        $name_new[$n] = translit($name_new_rus[$n]);
        $name_new[$n] = str_replace(" ","_",$name_new[$n]);
        $type_new[$n] = $_POST["coltype$i"];
        
        $query .= "CHANGE `$name_old[$n]` `$name_new[$n]` ";
        if ( ( $type_new[$n] == "varchar" ) || ( $type_new[$n] == "int" ) )
            $query .= "$type_new[$n](255) NOT NULL,";
        else 
            $query .= "$type_new[$n] NOT NULL,";
        skip: $i++; $n++;
    }
    $pos = strrpos($query,","); $query = substr($query,0,$pos);

    $sql = mysqli_query($link, "SELECT * FROM tables WHERE `name_eng`='$table'"); 
    $result = mysqli_fetch_array( $sql );
    $table_rus = $result["name_rus"];
    $str_cols_name = $result["cols_name"];
    $str_cols_name_rus = $result["cols_name_rus"];
    
    $sql = mysqli_query($link, "SHOW columns from $table"); $i = 1; $n = 0;
    while ( $result = mysqli_fetch_array( $sql ) ) { 
        $pos = strpos($str_cols_name,","); $len = strlen($str_cols_name);
        if ( empty ( $pos ) ) $cols_name[$n] = $str_cols_name;
                         else $cols_name[$n] = substr($str_cols_name,0,$pos);
        $str_cols_name = substr($str_cols_name,$pos+1,$len);
        if ( empty ( $_POST["changes$i"] ) ) $str_cols_name_new .= "$cols_name[$n],";
                                        else $str_cols_name_new .= "$name_new[$n],";
        
        $pos = strpos($str_cols_name_rus,","); $len = strlen($str_cols_name_rus);
        if ( empty ( $pos ) ) $cols_name_rus[$n] = $str_cols_name_rus;
                         else $cols_name_rus[$n] = substr($str_cols_name_rus,0,$pos);
        $str_cols_name_rus = substr($str_cols_name_rus,$pos+1,$len);
        if ( empty ( $_POST["changes$i"] ) ) $str_cols_name_rus_new .= "$cols_name_rus[$n],";
                                        else $str_cols_name_rus_new .= "$name_new_rus[$n],";
        $i++; $n++;
    }
    $pos = strrpos($str_cols_name_new,",");
    $str_cols_name_new = substr($str_cols_name_new,0,$pos);
    $pos = strrpos($str_cols_name_rus_new,",");
    $str_cols_name_rus_new = substr($str_cols_name_rus_new,0,$pos);

    $query1 = "UPDATE `tables` SET `cols_name`='$str_cols_name_new',
              `cols_name_rus`='$str_cols_name_rus_new' WHERE `name_eng` ='$table'";
    echo "<p style='color:green'>Таблица <b>$table_rus</b> успешно изменена</p>";
    mysqli_query($link,$query); mysqli_query($link,$query1);
?>