<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "./config.inc.php";
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed");
}

if (isset($_GET['meal'])) {
    $meal = $_GET['meal'];

    $stmt = $conn->prepare("SELECT price FROM menu_items WHERE name = ?");
    $stmt->bind_param("s", $meal);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo "$" . $row['price'];
    } else {
        echo "❌ الوجبة غير موجودة";
    }

    $stmt->close();
}

$conn->close();
?>
