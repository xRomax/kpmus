<?php include 'connect.php' ?>
<?php
$n2 = $_COOKIE["usnm"]; $n1 = $_POST["n1"]; $n3 = $_POST["n3"]; $n4 = date("Y-m-j H:i:s");
if ( empty ( $n1 ) ) goto skip;
    mysqli_query($link, "INSERT INTO news (name, username, sodr, date) VALUES ('$n1', '$n2', '$n3', '$n4')");
skip:
echo "<table class='highlight' border='1px solid black'>";
echo "<th colspan='5'>Новини</th>";
$sql = mysqli_query( $link, "SELECT * FROM news");
while ( $result = mysqli_fetch_array($sql) ) {
    echo "<tr><td>".$result["name"]."</td><td>".$result["username"]."</td><td>".
    $result["sodr"]."</td><td>".$result["date"]."</td></tr>";
}
echo "</table><br>"; 
?>