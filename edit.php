<?php
require_once 'config.php';

$pdo = new PDO($dsn, $user, $pass);

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);

$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    die("Produk tidak ditemukan");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<h2>Edit Produk</h2>

<form action="process_edit.php" method="POST">

<input type="hidden" name="id"
value="<?= $product['id'] ?>">

<div class="mb-3">
<label>Nama Produk</label>
<input type="text"
name="product_name"
class="form-control"
value="<?= $product['name'] ?>"
required>
</div>

<div class="mb-3">
<label>Harga</label>
<input type="number"
name="product_price"
class="form-control"
value="<?= $product['price'] ?>"
required>
</div>

<button class="btn btn-warning">
Update
</button>

<a href="index.php"
class="btn btn-secondary">
Kembali
</a>

</form>

</div>
</body>
</html>