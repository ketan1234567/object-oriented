<?php
// Establish database connection
$dsn = "mysql:host=localhost;dbname=testdb;charset=utf8mb4";
$username = "root";
$password = "";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Check if ID parameter exists in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Execute DELETE query
    $stmt = $pdo->prepare("DELETE FROM uers WHERE id = ?");
    $stmt->execute([$id]);

    echo "Record deleted successfully";
    
    // Redirect the user to a different page (e.g., homepage)
    header("Location: main.php");
    exit;
} else {
    echo "ID parameter missing";
}
?>
