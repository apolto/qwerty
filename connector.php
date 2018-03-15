 <?php

// Create connection
$conn = new mysqli($entered_host, $entered_user, $entered_pass);
mysqli_select_db($conn, $entered_db);

echo mysqli_error($conn);



