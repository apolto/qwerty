<?php
session_start();
if(!isset($_SESSION['user_id'])){ //if login in session is not set
    header("Location: login.php");
}
$user_id = $_SESSION['user_id'];
$percentage = 0;
include("connector.php");
mysqli_select_db($conn,$db_name);
$result = mysqli_query($conn, "SELECT goods_type,costs FROM goods as t1 JOIN expenses as t2 ON t1.id = t2.goods_type_id AND t1.user_id ='$user_id';");

?>

<html>
<head>
    <title> My Account Page</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>

        function AddRow(){
            $('#table1 tbody').append('' +
                '<tr>' +
                '   <td>' +
                '       <input type="text" name="product_name[]" style="width:100%"/>' +
                '   </td>' +
                '   <td>' +
                '       <input type="int" style="width:100%"/>' +
                '   </td>' +
                '   <td>' +
                '       <input type="int" name="all_spent[]" style="width:100%" readonly/>' +
                '   </td>' +
                '   <td>' +
                '       <input type="int" style="width:100%" readonly/>' +
                '   </td>' +
                '</tr>')
        }
        $(document).ready(function(){
            $("#calculate").click(function() {
                var grandTotal = 0;
                var price = 0;
                var percent = 0;
                    $('tr:has(td)').each(function() {
                        var price_new = +$(this).find('td input').eq(1).val();
                        var price_old = +$(this).find('td input').eq(2).val();
                        var price = price_new + price_old;
                        grandTotal += price;
                    });
                    $("#total").val(grandTotal);
                    $('tr:has(td)').each(function() {
                        var price_new = +$(this).find('td input').eq(1).val();
                        var price_old = +$(this).find('td input').eq(2).val();
                        var price = price_new + price_old;
                        var percent = (price/grandTotal)*100;
                        +$(this).find('td input').eq(3).val(percent);
                        +$(this).find('td input').eq(2).val(price);
                });
                $('tr:has(td)').each(function() {
                    $(this).find('td input').eq(1).val('');
                });
            });
        });
    </script>

</head>
<body>
    <form id="pr" method="POST" action="report.php">
        <table id="table1" style="width:100%">
            <tbody>
                <tr>
                    <th>Type</th>
                    <th>Expenses</th>
                    <th>Total Spends</th>
                    <th>%</th>
                </tr>
                <?php
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $types = $row['goods_type'];
                        $costs = $row['costs'];
                        ?>
                        <tr>
                            <td>
                                <input type="text" name="product_name[]" style="width:100%" value="<?= $types ?>"/>
                            </td>
                            <td>
                                <input type="int" id="price" style="width:100%"/>
                            </td>
                            <td>
                                <input type="int" name="all_spent[]" style="width:100%" value="<?= $costs ?>" readonly/>
                            </td>
                            <td>
                                <input type="int" style="width:100%" readonly/>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>

            </tbody>
        </table>
        <br />
        <input type="button" value="ADD ROW" id="btnAdd" onclick="AddRow()" style="width:15%";/>
        <br />
        <input type="button" id="calculate" value="Calculate" style="width:10%;";/>
        <br />
        <input type="number" id="total" readonly style="width:15%; margin-left: 1200px;"/> Total Spent
        <br />
    </form>
    <input type="submit" form="pr"/>
</body>
<br />
<a href="logout.php">Logout</a>
</html>