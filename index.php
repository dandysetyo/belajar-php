<?php
include 'config.php';

try {
    $pdo = new PDO($dsn, $usern, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT * FROM products";
    $stmt = $pdo->query($query);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($products as $product){
        echo $product['name']. "<br>";
    }

    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connected successfully: " . $e->getMessage();
}   
