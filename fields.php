<?php include 'connect.php' ?>
<?php
    $act = $_POST['act']; $ntable = $_POST["ntable"];
    $i = 1; $f = 0; $n = 0;  
    setcookie("type_field", $act, time() + 3600*2, "/");

    if ( empty ( $ntable ) || empty ( $act ) ) goto skip;
    switch ($act){
        case 'add_field': $do = 'add'; break;
        case 'change_field': $do = 'ch'; break;
        case 'delete_field': $do = 'del'; break;
    }

    $sql = mysqli_query($link, "SHOW columns from $ntable");
    while ( $result = mysqli_fetch_array($sql)) { $n++; }
    
    $sql_cols = mysqli_query($link, "SELECT * FROM tables WHERE name_eng='$ntable'");
    $result = mysqli_fetch_array($sql_cols);
    $str = $result["cols_name_rus"];
    if ($do == 'del') $n = 1;

    $s = '<div class="row">';
    while ($i <= $n) {
        $pos = strpos($str,","); $len = strlen($str);
        if ( empty ( $pos ) ) 
             $cols_name_rus[$f] = $str;
        else $cols_name_rus[$f] = substr($str,0,$pos);
        $str = substr($str,$pos+1,$len);
        
        if ( $do != 'del' ) $k = $do.$i; else $k = $do;
        
        $s .= "<div class='input-field col s4'><div class='punkt'>
                <input class='validate' name='$k' type='text'>
                <label for='$k'>$cols_name_rus[$f]</label></div></div>";
        
        if ( $i%3 == 0 ) $s .= '</div><div class="row">'; 
        $i++; $f++;
    }
    if ($act == 'change_field') 
        $s .= '<div class="input-field col s3"><div class="punkt">
               <input name="change" type="text"><label for="change">№ поля яке змінюється</label></div></div>';
    $s .= "</div>"; echo $s;
    skip:
?>