<?php
define('DB_SERVER', 'mysql.railway.internal'); // Railway MySQL host
define('DB_USER', 'root'); // Railway MySQL username
define('DB_PASS', 'bHfEAViCgGwleFihLjvuCIpZYUFseDTx'); // Railway MySQL password
define('DB_NAME', 'railway'); // Railway MySQL database name
define('DB_PORT', 3306); // Railway MySQL port

// Create connection
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME, DB_PORT);

// Check connection
if (!$con) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}
?>
