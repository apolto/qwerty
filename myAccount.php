<?php session_start();
$percentage = 0;
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
                '       <input type="text" style="width:100%"/>' +
                '   </td>' +
                '   <td>' +
                '       <input type="text" style="width:100%" readonly/>' +
                '   </td>' +
                '</tr>')
        }
        $(document).ready(function(){
            $("#calculate").click(function() {
                var grandTotal = 0;
                var price = 0;
                var prices = [];
                var percent = 0;
                    $('tr:has(td)').each(function() {
                        var price = +$(this).find('td input').eq(1).val();
                        grandTotal += price;
                    });
                    $("#total").val(grandTotal);
                    $('tr:has(td)').each(function() {
                        var price = +$(this).find('td input').eq(1).val();
                        var percent = (price/grandTotal)*100;
                        +$(this).find('td input').eq(2).val(percent);
                });
            });
        });
    </script>
<!--    --><?php
//    $user = $_SESSION['user_name'];
//
//    echo "Welcome ".$user;
//
//    require_once ("connector.php");
//    mysqli_select_db($conn,$db_name);
//    $results = mysqli_query($conn, "select * from expenses;");
//    ?>
</head>
<body>
    <form id="pr" action="report.php">
        <table id="table1" style="width:100%">
            <tbody>
                <tr>
                    <th>Type</th>
                    <th>Expenses</th>
                    <th>%</th>
                </tr>
            </tbody>
        </table>
        <input type="button" id="calculate" value="Calculate"/>
        <br />
        <input type="number" id="total" style="width:15%; margin-left: 1400px;"/> Total Spent
    </form>
    <input type="button" value="ADD ROW" id="btnAdd" onclick="AddRow()"/>
</body>
<br />
<a href="login.php">Back to Login page</a>
</html>