<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'config.php';
?>


$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Órdenes - PetShop</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Mis Órdenes</h1>
        <a href="products.php">Volver a Productos</a>
    </header>

    <main>
        <section class="orders-list">
            <?php
            $result = $conn->query("SELECT orders.*, products.name, products.price FROM orders JOIN products ON orders.product_id = products.id WHERE user_id = $user_id");
            if ($result->num_rows > 0): ?>
                <ul>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <li>
                            Producto: <?= $row['name']; ?> | Cantidad: <?= $row['quantity']; ?> | Total: S/ <?= $row['quantity'] * $row['price']; ?> | Fecha: <?= $row['order_date']; ?>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p>No tienes órdenes realizadas.</p>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
