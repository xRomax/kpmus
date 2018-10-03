<?php include 'register.php' ?>
<?php include "connect.php" ?>
<?php
    if (isset($_COOKIE['loginger'])) {
        $usnm = $_COOKIE["usnm"]; 
        $sql = mysqli_query ( $link, "SELECT * FROM reg WHERE login='$usnm'" );
        $result = mysqli_fetch_array($sql);
        
        if ($result["status"]=="active") {
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <link rel="shortcut icon" href="Pic/icon.png">
    <link rel="stylesheet" href="Properties/window.css">
</head>
<body>
    <div class="backgroundImageCVR"></div>
    <div class="background-image"></div>
    <div class="cont-tabl">
<!--СПИСОК ПУНКТОВ МЕНЮ-->
    <ul id="ul-toggle" class="tabs">
        <?php 
        $usnm = $_COOKIE["usnm"]; $sql_usnm = mysqli_query( $link, "SELECT * FROM reg WHERE login='$usnm'");
        $access = mysqli_fetch_array($sql_usnm); $access = $access["type"];
        ?>
        <li class="tab col s3"><a class="active" href="#test-swipe-1">Работа с таблицами</a></li>
        <li class="tab col s3 disabled"><a href="#test-swipe-5">Работа с документами</a></li>
        <li class="tab col s3 <?php if ( $access != "admin" ) echo "disabled"; ?>"><a href="#test-swipe-2" class="collection-item">
            <?php if ( $access == "admin" ) {
            $sql = mysqli_query ( $link, "SELECT COUNT(*) FROM reg WHERE status='inactive'" );
            $result = mysqli_fetch_array($sql); $kolv = $result["COUNT(*)"];
            if ( $kolv > 0 ) echo "<span class='new badge'>$kolv</span>"; } ?> Подтверждение регистрации</a>
        </li>
        <li class="tab col s3 <?php if ( $access == "user" ) echo "disabled"; ?>"><a href="#test-swipe-3">Управление таблицами</a></li>
        <li class="tab col s3 <?php if ( $access == "user" ) echo "disabled"; ?>"><a href="#test-swipe-4">Публикация новостей</a></li>
    </ul>
<!-----ЗАГРУЗКА СПИСКА ТАБЛИЦЫ----->
    <form action="option.php" method="post" class="ajax optionf"></form>
           
<!-----РАБОТА С ТАБЛИЦАМИ----->
    <div id="test-swipe-1" class="col s12">
       
        <!-----ВЫБОР КОЛИЧЕСТВО ПОЛЕЙ----->
        <div class="row">
            <?php if ($result["type"]!="user") { ?>
            <div class="col s3">
                <form action="fields.php" method="POST" class="ajax fieldsf">
                    <select name="act" class="v-tabl act">
                        <option disabled selected>Выберите действие</option>
                        <option value="add_field">Добавить</option>
                        <option value="change_field">Изменить</option>
                        <option value="delete_field">Удалить</option>
                    </select>
                  <input type="text" name="ntable" id="ntable" style="display: none">
                </form>
            </div>
            <?php } ?>       
            
            <!-----ВЫБОР ТАБЛИЦЫ----->
            <div class="col s3">
                <form action="show.php" method="POST" class="ajax showf">
                    <select id="tab" class="v-tabl act resultat8" name="table"></select>
                    <input name="page" type="text" id="pagination" style="display:none">
                    <input name="pagesize" type="text" id="page-size-show" style="display:none">
                </form>
            </div>
            <a class="waves-effect waves-light btn changeb">выполнить</a>
        </div>
        
        <!-----ИЗМИНЕНИЕ ИНФОРМАЦИИ----->
        <form action="changecols.php" method="post" class="ajax changef">
            <input type="text" name="tablen" id="tablen" style="display: none;">
            <input type="text" name="pagen" id="pagination1" style="display:none">
            <input name="pagesizen" type="text" id="page-size-shown" style="display:none">
            <div class="resultat2"></div>
        </form>
        
        <form action="pagetable.php" method="post" class="ajax pagef">
            <input type="text" name="table" id="page-table" style="display:none">
            <input name="pagesize" type="text" id="page-size-showp" style="display:none">
        </form>
        
        <div class="resultat14"></div>
        <div class="resultat1"></div>
    </div>
<!--------------------------------------------------------------------------------------------------------------------------------------------------------->
    
    <!-----ПОДТВЕРЖДЕНИЕ РЕГИСТРАЦИИ----->
    <div id="test-swipe-2" class="col s12"> 
        <center>
            <form action="reg.php" method="post" class="ajax regf">
                <div class="formreload">
                    <?php
                    $sql = mysqli_query ( $link, "SELECT * FROM reg WHERE status='inactive'" );
                    $result = mysqli_fetch_array($sql);
                        if (isset($result["login"])) {
                            $login = $result["login"]; $type = $result["type"];
                            echo "Користувач під логіном <b>$login</b> 
                                намагається зареєструватись з правами <b>$type</b> ";
                            echo '<input type="text" value="'.$login.'" name="loginn" style="display:none">
                                  <input id="getaccess" type="text" name="access" style="display:none">';
                        } else echo "Немає акаунтів які очікують підтвердження";
                    ?>
                </div>
            </form>
        
        <?php
        if (isset($result["login"])) 
        echo '<a class="waves-effect waves-light btn regb" id="allow">разрешить</a>
              <a class="waves-effect waves-light btn regb" id="ban">запретить</a>';
        ?>
        <div class="resultat3"></div></center>
        
    </div>
<!--------------------------------------------------------------------------------------------------------------------------------------------------------->

<!-----УПРАВЛЕНИЕ ТАБЛИЦАМИ----->
    <div id="test-swipe-3" class="col s12">
        <ul class="tabs" style="margin-bottom: 3%;">
            <li class="tab col s3"><a class="active" href="#test-swipe-10">Создать</a></li>
            <li class="tab col s3 <?php if ( $access != "admin" ) echo "disabled"; ?>"><a href="#test-swipe-20">Изменить структуру</a></li>
            <li class="tab col s3 <?php if ( $access != "admin" ) echo "disabled"; ?>"><a href="#test-swipe-70">Изменить название</a></li>
            <li class="tab col s3 <?php if ( $access != "admin" ) echo "disabled"; ?>"><a href="#test-swipe-50">Изменить доступ</a></li>
            <li class="tab col s3 <?php if ( $access != "admin" ) echo "disabled"; ?>"><a href="#test-swipe-40">Очистить</a></li>
            <li class="tab col s3 <?php if ( $access != "admin" ) echo "disabled"; ?>"><a href="#test-swipe-30">Удалить</a></li>
            <li class="tab col s3 <?php if ( $access != "admin" ) echo "disabled"; ?>"><a href="#test-swipe-60">Удалить новость</a></li>
        </ul>
        
        <!-----СОЗДАНИЕ ТАБЛИЦ----->
        <div id="test-swipe-10" class="col s12">
            <div class="overlay">
                <div class="window">
                    <div class="resultat13"></div>
                    <div class="close-window"></div>
                </div>
            </div>
            
            <form action="addfields.php" method="post" class="ajax addfieldsf">
                <div class="row">
                    <div class="input-field col s2">
                        <div class="punkt">
                            <input class="validate" id="number" name="number" type="text">
                            <label for="number">Количество полей</label>
                        </div>
                    </div>
               </div>
           </form>

           <form action="createtable.php" method="post" class="ajax createf">
                <div class="resultat5"></div>
                <a class="waves-effect waves-light btn createb show">Создать таблицу</a>
           </form>
        </div>
    <!------------------------------------------------------------------------------------>
        
        <!-----ИЗМИНЕНИЕ СТРУКТУРЫ ТАБЛИЦЫ----->
        <div id="test-swipe-20"><div class="row">
            <div class="overlay">
                <div class="window">
                    <div class="resultat11"></div>
                    <div class="resultat11-toggle">
                        <p>Вы уверены что хотите изменить таблицу? При изминении типа полей 
                        вы можете НАВСЕГДА потерять информацию!</p>
                        <a class="waves-effect waves-light btn change-table-b">подтвердить изминение</a>
                    </div>
                    
                    <div class="close-window"></div>
                </div>
            </div>
            
            <form action="changetablefields.php" method="post" class="ajax change-table-fields-f">
                <div class="col s3">
                    <select name="table" id="tab1" class="resultat8"></select>
                </div>

            </form>
            <a class="waves-effect waves-light btn show show11">Изменить таблицу</a>
          </div>  
            <form action="changetable.php" method="post" class="ajax change-table-f">
                <input type="text" id="table-name" name="table" style="display:none;">
                <div class="resultat10"></div>
            </form>
        </div>
    <!------------------------------------------------------------------------------------>
       
        <!-----УДАЛЕНИЕ ТАБЛИЦЫ----->
        <div id="test-swipe-30" class="row">
            <div class="overlay">
                <div class="window">
                    <div class="resultat6"></div>
                    <div class="resultat6-toggle">
                        <p>Вы уверены что хотите удалить таблицу? После удаления вся информация
                        будет стёрта и восстановить её будет НЕВОЗМОЖНО</p>
                        <a class="waves-effect waves-light btn delb">подтвердить удаление</a>
                    </div>
                    <div class="close-window"></div>
                </div>
            </div>
            
            <div class="col s3">
                <form action="deletetable.php" method="post" class="ajax delf">
                    <select name="table" class="resultat8"></select>
                </form>
            </div>
            
            <div class="col s2">
                <a class="waves-effect waves-light btn show show6">удалить</a>
            </div>
        </div>
    <!------------------------------------------------------------------------------------>
        
        <!-----ОЧИСТИТЬ ТАБЛИЦУ----->
        <div id="test-swipe-40" class="row">
            <div class="overlay">
                <div class="window">
                    <div class="resultat7"></div>
                    <div class="resultat7-toggle">
                        <p>Вы уверены что хотите очистить таблицу? После форматирования вся информация
                        будет стёрта и восстановить её будет НЕВОЗМОЖНО</p>
                        <a class="waves-effect waves-light btn clearb">подтвердить очистку</a>
                    </div>
                    
                    <div class="close-window"></div>
                </div>
            </div>
            
            <div class="col s3">
                <form action="cleartable.php" method="post" class="ajax clearf">
                    <select class="resultat8" name="table"></select>
                </form>
            </div>
            
            <div class="col s2">
                <a class="waves-effect waves-light btn show show7">очистить</a>
            </div>
        </div>
    <!------------------------------------------------------------------------------------>
       
        <!-----ИЗМИНЕНИЕ ДОСТУПА К ТАБЛИЦЕ----->
        <div id="test-swipe-50" class="row">
            <div class="overlay">
                <div class="window">
                    <div class="resultat9"></div>
                    <div class="close-window"></div>
                </div>
            </div>
            
            <form action="accesstable.php" method="post" class="ajax accessf">
                <div class="col s3">
                    <select class="resultat8" name="table"></select>
                </div>
                
                <div class="col s2">
                    <select size="10" multiple name="access[]" class="act">
                        <option value="admin">Администратора</option>
                        <option value="moder">Модераторов</option>
                        <option value="user">Пользователей</option>
                    </select>
                </div>
                
                <div class="col s2">
                    <a class="waves-effect waves-light btn accessb show">Изменить</a>
                </div>
            </form>
        </div>
    <!------------------------------------------------------------------------------------>
       
        <!-----УДАЛЕНИЕ НОВОСТНОЙ ЗАПИСИ----->
        <div id="test-swipe-60" class="row">
            <form action="delnews.php" method="post" class="ajax delnewsf">
               <div class="input-field col s3">
                <div class="punkt">
                    <input class="validate" name="news-del" type="text">
                    <label for="news-del">Название новости</label>
                </div></div>
            </form>
            
            <div class="col s2">
                <a class="waves-effect waves-light btn delnewsb">Удалить</a>
            </div>
        </div>
    <!------------------------------------------------------------------------------------>    
          
        <!-----ИЗМИНЕНИЕ НАЗВАНИЯ ТАБЛИЦЫ----->
        <div id="test-swipe-70" class="row">
            <div class="overlay">
                <div class="window">
                    <div class="resultat12"></div>
                    <div class="resultat12-toggle">
                        <p>Вы уверены что хотите изменить название таблицы?</p>
                        <a class="waves-effect waves-light btn renameb">подтвердить изминение</a>
                    </div>
                    
                    <div class="close-window"></div>
                </div>
            </div>
            
            <form action="renametable.php" method="post" class="ajax renamef">
                <div class="col s3">
                    <select class="resultat8" name="table"></select>
                </div>
            <div class="col s2">
                <a class="waves-effect waves-light btn show show12">Изменить</a>
            </div>
                <br><br>
                <div class="input-field col s3">
                    <div class="punkt">
                        <input class="validate" name="table-new" type="text">
                        <label for="table-new">Название таблицы</label>
                    </div>
                </div>
            </form>
        </div>
    <!------------------------------------------------------------------------------------>
        
    </div>
<!--------------------------------------------------------------------------------------------------------------------------------------------------------->
   
    <!-----ПУБЛИКАЦИЯ НОВОСТЕЙ----->
    <div id="test-swipe-4" class="col s12">   
        <form action="news.php" method="post" class="ajax newsf">
            <?php
            $usnm = $_COOKIE["usnm"]; $sql = mysqli_query( $link, "SELECT * FROM reg WHERE login='$usnm'");
            $result = mysqli_fetch_array($sql); 
            if ($result["type"]!="user") 
            echo '<div class="input-field row col s6">
                 <div class="punkt"><input name="n1" type="text">
                 <label for="zi6">Назва новини</label></div></div>
                 Текст новости: <br><textarea name="n3" cols="30" rows="30"></textarea><br>
                 <a class="waves-effect waves-light btn newsb">опубликовать</a>';
            ?>
        </form>
    </div>
    <!------------------------------------------------------------------------------------>
       
<!-----Работа с документами----->
    <div id="test-swipe-5" class="col s12">
        <ul class="tabs" style="margin-bottom: 3%;">
            <li class="tab col s3"><a class="active" href="#test-swipe-11">Зарузить файлы</a></li>
            <li class="tab col s3 disabled"><a href="#test-swipe-21">Поиск файлов</a></li>
        </ul>
        
        <!-----ЗАГРУЗИТЬ ФАЙЛЫ----->
        <div id="test-swipe-11" class="col s12">
        </div>
        <!------------------------------------------------------------------------------------>
        
        <!-----ПОИСК ФАЙЛОВ----->
        <div id="test-swipe-21" class="col s12">
        </div>
        <!------------------------------------------------------------------------------------>
    </div>
<!--------------------------------------------------------------------------------------------------------------------------------------------------------->
           
<!-----ВЫВЕДЕНИЕ НОВОСТНОЙ ЛЕНТЫ-----><br>
    <div class="resultat4">
        <?php
        echo "<table class='highlight' border='1px solid black'>";
        echo "<th colspan='5'>Новини</th>";
        $sql = mysqli_query( $link, "SELECT * FROM news");
        while ( $result = mysqli_fetch_array($sql) ) {
            echo "<tr><td>".$result["name"]."</td><td>".$result["username"]."</td><td>".
            $result["sodr"]."</td><td>".$result["date"]."</td></tr>";
        }
        echo "</table><br>";
        ?>
    </div>
    
    </div>
    <script type="text/javascript" src="/Properties/jquery.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="Properties/js.js"></script>
    <script type="text/javascript" src="Properties/ajax.js"></script>
    </body>
    </html>
    
<?php
        }
    }
?>