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

    // Fetch data for the specified ID
    $stmt = $pdo->prepare("SELECT * FROM uers WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        echo "Record not found";
        exit;
    }
} else {
    echo "ID parameter missing";
    exit;
}

// Process form submission
// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Update the record in the database
    $stmt = $pdo->prepare("UPDATE uers SET username = ?, email = ? WHERE id = ?");
    $stmt->execute([$username, $email, $id]);

    echo "Record updated successfully";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>
    <form method="post">
        <label for="name">Name:</label><br>
        <input type="text" id="username" name="username" value="<?php echo $row['username']; ?>"><br><br>
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email" value="<?php echo $row['email']; ?>"><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
