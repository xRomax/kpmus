<?php include 'connect.php' ?>
<?php
    $number = $_POST["number"]; $i = 1; 
    if ( empty ( $number ) ) goto a;
    setcookie("num", $number, time() + 3600*2, "/");
    while ($i <= $number) {
        $s .= "<div class='row'>";
        $s .= "<div class='input-field col s3'><div class='punkt'>
                <input class='validate' name='colname$i' type='text'>
                <label for='colname$i'>Название поля $i</label></div></div>";
        $s .= '<div class="col s2"><select required name="coltype'.$i.'" class="act">
                    <option value="varchar">Текстовое</option>
                    <option value="text">Большое текстовое</option>
                    <option value="int">Числовое</option>
                    <option value="date">Дата</option>
                </select></div>';
        $s .= "</div>"; $i++;
    }
    echo "<div class='row'>
          <div class='input-field col s4'><div class='punkt'>
          <input class='validate' name='tablename' type='text'>
          <label for='colname'>Название таблицы</label></div></div>";

    echo '<div class="col s2"><select size="10" multiple name="access[]" class="act">
                    <option value="admin">Администраторов</option>
                    <option value="moder">Модераторов</option>
                    <option value="user">Пользователей</option>
                </select></div></div>';
    echo $s; a:
?>
