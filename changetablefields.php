<?php include "connect.php" ?>
<?php
    $table = $_POST["table"]; $i = 1; $f = 0;
    $type_define  = array ("varchar","text","int","date");
    $type_define_rus = array ("Текстовое","Большое текстовое","Числовое","Дата");

    $sql_cols = mysqli_query($link, "SELECT * FROM tables WHERE name_eng='$table'");
    $result = mysqli_fetch_array($sql_cols); $str_cols = $result["cols_name_rus"];
        
    $sql = mysqli_query( $link, "SHOW columns from $table" );
    while ( $result = mysqli_fetch_array( $sql ) ) {
        $str .= "<div class='row'>";
        
        $type = $result["Type"]; $pos = strpos($type,"("); 
        if ( empty ( $pos ) ) goto skip; else $type = substr($type,0,$pos); skip:
        
        $pos = strpos($str_cols,","); $len = strlen($str_cols);
        if ( empty ( $pos ) ) $cols_name_rus[$f] = $str_cols;
                         else $cols_name_rus[$f] = substr($str_cols,0,$pos);
        $str_cols = substr($str_cols,$pos+1,$len);
        
        $str .= "<div class='input-field col s4'><div class='punkt'>
                <input class='validate' type='text' name='changes$i'>
                <label for='changes$i'>$cols_name_rus[$f]</label>
                </div></div>";
        $str .= '<div class="col s2"><select name="coltype'.$i.'" class="act">'; $n = 0;
        while ( $n <= 3 ) {
            $str .= "<option value='$type_define[$n]' ";
            if ( $type_define[$n] == $type ) $str .= "selected >$type_define_rus[$n]</option>";
            else $str .= ">$type_define_rus[$n]</option>";
            $n++;
        }
        $str .= '</select></div>';
        $str .= "</div>";
        $i++; $f++;
    }
    echo $str;

?>