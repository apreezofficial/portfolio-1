<?php
// Database connection settings
$host = "localhost"; 
$dbname = "admin_panel"; 
$username = "root"; 
$password = ""; 

// Try connecting to the database using PDO (for better security & performance).This is actually optional , we can remove it.
try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4", // DSN (Database Source Name)
        $username, 
        $password, 
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Enable error reporting
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Fetch data as an associative array
            PDO::ATTR_EMULATE_PREPARES => false // Prevent SQL injection
        ]
    );

} catch (PDOException $e) {
    // Error Handling 
    die("Database connection failed: " . $e->getMessage());
}
?>
