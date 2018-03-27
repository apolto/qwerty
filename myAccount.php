<?php
$percentage = 0;
//$user_id = $_SESSION['user_id'];
$user_id =1;
include("connector.php");
mysqli_select_db($conn, 'ddd');
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
                '       <input type="text" style="width:100%"/>' +
                '   </td>' +
                '   <td>' +
                '       <input type="int" style="width:100%"/>' +
                '   </td>' +
                '   <td>' +
                '       <input type="int" style="width:100%" readonly/>' +
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
    <form id="pr" action="report.php">
        <table id="table1" style="width:100%">
            <tbody>
                <tr>
                    <th>Type</th>
                    <th>Expenses</th>
                    <th>Summ</th>
                    <th>%</th>
                </tr>
                <?php
                while ($row = $result->fetch_assoc()) {
                    $types = $row['goods_type'];
                    $costs = $row['costs'];
                    ?>
                    <tr>
                        <td>
                            <input type="text" style="width:100%" value="<?=$types ?>"/>
                        </td>
                        <td>
                            <input type="int" id="price" style="width:100%"/>
                        </td>
                        <td>
                            <input type="text" style="width:100%" value="<?=$costs ?>" readonly/>
                        </td>
                        <td>
                            <input type="int" style="width:100%" readonly/>
                        </td>
                    </tr>
                <?php
                }
                $insert_goods = "INSERT IGNORE INTO goods (user_id,goods_type)
                                  VALUES (1,'bread');";
                $insert_expenses = "INSERT INTO expenses (costs,goods_type_id)
                VALUES (500,(SELECT id FROM goods WHERE user_id = 1 AND goods_type = 'meat'))
                ON DUPLICATE KEY UPDATE costs = costs + 5;"
                ?>

            </tbody>
        </table>
        <input type="button" id="calculate" value="Calculate"/>
        <br />
        <input type="number" id="total" style="width:15%; margin-left: 1400px;"/> Total Spent
    </form>
    <input type="button" value="ADD ROW" id="btnAdd" onclick="AddRow()"/>
    <br />
    <input type='submit' value='Save to a hard drive' name='save' />
</body>
<br />
<a href="login.php">Back to Login page</a>
</html>