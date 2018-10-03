<?php include "connect.php" ?>
<?php
    if (isset($_POST['logined'])) {
        $elogin = $_POST['elogin']; $epass = md5($_POST['epass']);
        $query = mysqli_query($link, "SELECT * FROM reg WHERE login = '$elogin'");
        $user_data = mysqli_fetch_array($query);
        if ($user_data['pass'] == $epass) {
            setcookie("loginger", "true", time() + 3600*2, "/");
            setcookie("usnm", $elogin, time() + 3600*2, "/");
            header("Location: ".$_SERVER["REQUEST_URI"]);
        } else { echo '<html><head></head><body>
        <script>alert("Перевірте правильність введених даних!")</script></body></html>'; }
    }

    if (isset($_POST['regist'])) {
        $username = $_POST['username']; $login = $_POST['login']; 
        $pass = $_POST['pass']; $rpass = $_POST['rpass']; $type = $_POST['type'];
        if ($pass == $rpass){
            $pass = md5($pass);
            mysqli_query($link, "INSERT INTO reg (username,login,pass,type,status) VALUES ('$username', '$login', '$pass', '$type','inactive')");
            echo '<html><head></head><body>
        <script>alert("Аккаунт зареєстрований і очікує підтвердження!")</script></body></html>';
        } else { echo '<html><head></head><body>
        <script>alert("Перевірте правильність введених даних!")</script></body></html>'; } 
    }

    if (isset($_COOKIE['loginger'])) {
        $usnm = $_COOKIE["usnm"];
        $sql_usnm = mysqli_query( $link, "SELECT * FROM reg WHERE login='$usnm'");
        $access = mysqli_fetch_array($sql_usnm);
        $access = $access["type"];
        echo 
        '<div class="cont-tabl"><form action="logout.php" method="post">'."Ви авторизувалися під логіном <b>".$_COOKIE["usnm"].'</b>
            с правами <b>'.$access.'</b>
            <input class="waves-light btn" name="logout" value="Вийти" type="submit">
        </form></div>';
    } else { ?>
       
        <div class="backgroundImageCVR"></div>
        <div class="background-image"></div>
        <div class="kubik_forma">
            <ul class="collapsible" data-collapsible="accordion">
                <li>
                    <div class="collapsible-header active"><i class="material-icons">lock_open</i>Авторизуватись!</div>
                    <div class="collapsible-body">
                    <div class="row">
                        <form action="index.php" method="post">
                            <div class="row">
                                <div class="input-field col s12">
                                    <input required name="elogin" type="text" class="validate">
                                    <label for="elogin">Логін</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input required name="epass" type="password" class="validate">
                                    <label for="epass">Пароль</label>
                                </div>
                            </div>
                            <input class="waves-light btn" name="logined" type="submit" value="Вхід">
                        </form>
                    </div>
                    </div>
                </li>

                <li>
                    <div class="collapsible-header"><i class="material-icons">vpn_key</i>Немає аккаунту? Зареєструйтесь!</div>
                    <div class="collapsible-body">
                        <div class="row">
                            <form  action="register.php" method="post" class="col s12">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input required name="username" type="text" class="validate">
                                        <label for="username">Ім'я</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input required name="login" type="text" class="validate">
                                        <label for="login">Логін</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                          <input required name="type" type="text" class="validate" list="type1">
                                          <datalist id="type1">
                                          <option value="admin">
                                          <option value="moder">
                                          <option value="user">
                                          </datalist>
                                          <label for="type">Тип користувача</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                          <input required name="pass" type="password" class="validate">
                                          <label for="pass">Пароль</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input required name="rpass" type="password" class="validate">
                                        <label for="rpass">Повторити пароль</label>
                                    </div>
                                </div>
                                <input class="waves-light btn" name="regist" type="submit" value="Зареєструватись">
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
   <?php } 
    mysqli_close($link);  
    ?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>КП МУС</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="materialize/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="materialize/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="Properties/cubs.css" rel="stylesheet">
    <link rel="shortcut icon" href="../Pic/icon.png"/>
</head>
<body>
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="materialize/js/materialize.js"></script>
<script src="materialize/js/init.js"></script>
<script type="text/javascript" src="Properties/ajax.js"></script>
</body>