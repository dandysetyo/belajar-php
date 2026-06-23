<?php
include 'config.php';

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT * FROM products ORDER BY id ASC";
    $stmt = $pdo->query($query);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $products = [];
    $error = $e->getMessage();
}
?>

<!DOCTYPE html>

<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>

```
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
```

</head>
<body>

<div class="container mt-5">

```
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Daftar Produk</h2>

    <a href="add.php" class="btn btn-success">
        Tambah Produk
    </a>
</div>

<?php if (isset($error)): ?>
    <div class="alert alert-danger">
        <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>

<div class="alert alert-info">
    Total Produk: <strong><?= count($products) ?></strong>
</div>

<?php if (!empty($products)): ?>

    <div class="table-responsive">

        <table class="table table-striped table-hover table-bordered align-middle">

            <thead class="table-primary">
                <tr>
                    <th width="80">No</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Stock</th>
                    <th width="300">Action</th>
                </tr>
            </thead>

            <tbody>

            <?php $no = 1; ?>

            <?php foreach ($products as $product): ?>

                <tr>

                    <td><?= $no++ ?></td>

                    <td><?= htmlspecialchars($product['name']) ?></td>

                    <td>
                        Rp <?= number_format($product['price'], 0, ',', '.') ?>
                    </td>

                    <td>
                        <span class="badge bg-success">
                            <?= $product['stock'] ?? 0 ?>
                        </span>
                    </td>

                    <td>

                        <a href="tambah_stok.php?id=<?= $product['id'] ?>"
                           class="btn btn-success btn-sm">
                            + Stok
                        </a>

                        <a href="kurang_stok.php?id=<?= $product['id'] ?>"
                           class="btn btn-warning btn-sm">
                            - Stok
                        </a>

                        <a href="edit.php?id=<?= $product['id'] ?>"
                           class="btn btn-info btn-sm text-white">
                            Edit
                        </a>

                        <a href="delete.php?id=<?= $product['id'] ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Yakin ingin menghapus produk ini?')">
                            Hapus
                        </a>

                    </td>

                </tr>

            <?php endforeach; ?>

            </tbody>

        </table>

    </div>

<?php else: ?>

    <div class="alert alert-warning">
        Tidak ada data produk.
    </div>

<?php endif; ?>
```

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
