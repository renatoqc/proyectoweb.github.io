<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $quantity = (int)$_POST['quantity'];

    // Verificar si el carrito está inicializado
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Agregar o actualizar la cantidad del producto en el carrito
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = $quantity;
    }

    header("Location: products.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Productos - PetShop</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Catálogo de Productos</h1>
        <a href="cart.php">Ver Carrito (<?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)</a>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="logout.php">Cerrar Sesión</a>
        <?php else: ?>
            <a href="login.php">Iniciar Sesión</a>
            <a href="register.php">Registrarse</a>
        <?php endif; ?>
    </header>

    <main>
        <section class="product-list">
            <?php
            $result = $conn->query("SELECT * FROM products");
            if ($result && $result->num_rows > 0):
                while ($row = $result->fetch_assoc()): ?>
                    <div class="product">
                        <img src="<?= htmlspecialchars($row['image_url']); ?>" alt="<?= htmlspecialchars($row['name']); ?>">
                        <h2><?= htmlspecialchars($row['name']); ?></h2>
                        <p><?= htmlspecialchars($row['description']); ?></p>
                        <p>Precio: S/ <?= htmlspecialchars($row['price']); ?></p>
                        <form method="post">
                            <input type="hidden" name="product_id" value="<?= $row['id']; ?>">
                            <input type="number" name="quantity" value="1" min="1">
                            <button type="submit">Agregar al carrito</button>
                        </form>
                    </div>
                <?php endwhile;
            else: ?>
                <p>No hay productos disponibles.</p>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
