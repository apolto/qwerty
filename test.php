<?php
/**
 * Created by PhpStorm.
 * User: apoltoratskyi
 * Date: 3/25/18
 * Time: 4:13 PM
 */

include("connector.php");
mysqli_select_db($conn, 'ddd');

$result = mysqli_query($conn, "SELECT * FROM goods;");
while ($row = $result->fetch_assoc()) {
    $types[] = $row['goods_type'];
}
?>
<html>
<head>
    <title> My Account Page</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>

        var types = <?=json_encode($types)?>;

    </script>
</head>
</html>