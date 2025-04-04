<?php
require_once '../Config/database.php';

try {
    $stmt = $pdo->query("SELECT 'Database Connected Successfully!' AS message");
    $row = $stmt->fetch();
    echo $row['message'];
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}
?>