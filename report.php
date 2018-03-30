<?php
session_start();
$user_id = $_SESSION['user_id'];
include("connector.php");
mysqli_select_db($conn, $db_name);


foreach($_POST as $key=>$value) {
    switch ($key) {
        case 'product_name':
            foreach($value as $product_name) {
                if (mysqli_query($conn, "INSERT IGNORE INTO goods (user_id,goods_type) VALUES ($user_id,'$product_name');")) {
                }
            }
            echo "Product data saved successfully";
            break;
        case 'all_spent':
            $array_key = 0;
            foreach($value as $all_spent) {
                $product = $_POST['product_name'][$array_key];
                $array_key++;
                if (mysqli_query($conn, "INSERT INTO expenses (costs,goods_type_id) VALUES ($all_spent,(SELECT id FROM goods WHERE user_id = $user_id AND goods_type = '$product'))
                  ON DUPLICATE KEY UPDATE costs = $all_spent;")) {
                }
            }
            echo "Expenses data saved successfully";
            break;
    }
}
?>
<br />
<a href="login.php">Back to Login page</a>
