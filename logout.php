<?php
    if (isset($_POST["logout"])) {
        setcookie("loginger","",time() - 3600*2, "/");
        setcookie("usnm","",time() - 3600*2, "/");
        setcookie("type_field","",time() - 3600*2, "/");
        header("Location: index.html");
    }
?>