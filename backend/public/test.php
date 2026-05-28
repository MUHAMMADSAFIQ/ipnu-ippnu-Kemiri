<?php
$pdo = new PDO('sqlite:../database/database.sqlite');
$stmt = $pdo->query("PRAGMA table_info('comments');");
if ($stmt) {
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<pre>";
    print_r($columns);
    echo "</pre>";
} else {
    echo "No comments table found or error.";
}
