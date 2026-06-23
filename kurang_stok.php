<?php
include 'config.php';

$id = $_GET['id'];

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("
        UPDATE products
        SET stock = CASE
            WHEN stock > 0 THEN stock - 1
            ELSE 0
        END
        WHERE id = ?
    ");

    $stmt->execute([$id]);

    header("Location: index.php");
    exit;

} catch (PDOException $e) {
    die($e->getMessage());
}
?>