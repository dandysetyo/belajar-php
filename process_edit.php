<?php

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

$id = $_POST['id'];
$name = $_POST['product_name'];
$price = $_POST['product_price'];

try {

$pdo = new PDO($dsn, $user, $pass);

$stmt = $pdo->prepare("
UPDATE products
SET name = ?, price = ?
WHERE id = ?
");

$stmt->execute([
$name,
$price,
$id
]);

header("Location: index.php");
exit;

} catch(PDOException $e) {

echo $e->getMessage();

}

}