<?php include "connect.php" ?>
<?php
$pagesize = $_POST["pagesize"]; $table = $_POST["table"];
$sql = mysqli_query ($link, "SELECT COUNT(*) FROM $table"); $i = 1;
$result = mysqli_fetch_array($sql);
$number = $result["COUNT(*)"]; $num = intdiv($number, 10);
if ( $pagesize > $number ) { $num = 0; }
if ( $num >= 1 ) {
    $show_footer = "<ul style='position:absolute;' class='pagination'>
    <li class='waves-effect waves-light col s3 active pageb'><a>$i</a></li>"; $i++;
    if ( $number/10 <= $num ) {
        while ( $i <= $num ) {
            $show_footer .= "<li class='waves-effect waves-light col s1 pageb'><a>$i</a></li>"; $i++;
        }
    } else {
        while ( $i <= $num + 1 ) {
            $show_footer .= "<li class='waves-effect waves-light col s1 pageb'><a>$i</a></li>"; $i++;
        }
    }
    $show_footer .= "</ul>
    <select style='width:60px;' class='right' name='page-size' id='page-size'>
        <option value='10'>10</option>
        <option value='20'>20</option>
        <option value='50'>50</option>
        <option value='100'>100</option>
        <option value='9999999'>Все</option>
    </select>";
    $show_footer .= "
    <script>
        $('.showf').submit();
        $('.pagination li').click(function(){
            $('.pagination li').removeClass('active');
            $(this).toggleClass('active');
            $('#pagination').val($(this).index() + 1);
            $('#pagination1').val($(this).index() + 1);
            $('.showf').submit();
        });

        $('#page-size').change(function(){
            $('#page-size-show').val($('#page-size').val());
            $('#page-size-shown').val($('#page-size').val());
            $('#page-size-showp').val($('#page-size').val());
            $('.showf').submit();
        });
    </script>";
    echo $show_footer;
} else {
    echo "</ul>
    <select style='width:60px;display:none;' class='right' name='page-size' id='page-size'>
        <option value='10'>10</option>
    </select>
    ";
    echo "<script>$('.showf').submit();</script>";
}
?>