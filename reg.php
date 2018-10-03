<?php include 'connect.php' ?>
<?php
$loginn = $_POST["loginn"]; $access = $_POST["access"];
switch ($access) {
    case "allow":
        echo "Запит на підтвердження реєстрації<br>Реєстрація аккаунта<b> ".$loginn."</b> схвалена.";
        mysqli_query( $link, "UPDATE reg SET status='active' WHERE login='$loginn'");
    break;
        
    case "ban":
        echo "Запит на підтвердження реєстрації<br>Реєстрація аккаунта<b> ".$loginn."</b> не схвалена.";
        mysqli_query( $link, "DELETE FROM reg WHERE login='$loginn'");
    break;
}
?>