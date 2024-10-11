<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config.php';
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop - Inicio</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Pacifico&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Barra de Soporte al Cliente -->
    <div class="customer-support-bar">
        <div class="container">
            <div class="support">
                <i class="fa-solid fa-headset"></i>
                <span>Soporte al cliente: 976628511</span>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <header class="navbar">
        <div class="container">
            <h1 class="logo"><a href="index.php">PetShop</a></h1>
            <nav class="nav">
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="products.php">Accesorios</a></li>
                    <li><a href="ropa.php">Ropa</a></li>
                    <li><a href="cuidado.php">Cuidado e Higiene</a></li>
                    <li><a href="ofertas.php">Ofertas</a></li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li><a href="logout.php">Cerrar Sesión</a></li>
                    <?php else: ?>
                        <li><a href="login.php">Iniciar Sesión</a></li>
                        <li><a href="register.php">Registrarse</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
            <div class="cart-icon">
                <a href="cart.php">
                    <i class="fa-solid fa-shopping-cart"></i>
                    <span class="cart-count"><?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?></span>
                </a>
            </div>
        </div>
    </header>

    <!-- Banner Principal -->
    <section class="banner">
        <div class="container">
            <h2>Engríe a tu mascota con nuevos accesorios</h2>
            <p>Encuentra lo mejor para tu mascota, desde alimentos hasta los accesorios más divertidos.</p>
            <a href="products.php" class="btn btn-primary">Comprar Ahora</a>
        </div>
    </section>

    <!-- Productos Destacados -->
    <section class="featured-products">
        <div class="container">
            <h2>Productos Destacados</h2>
            <div class="product-grid">
                <div class="product-card">
                    <img src="img/acc.1.png" alt="Accesorio 1">
                    <h3>Cama para Mascotas</h3>
                    <p>Precio: S/ 150.00</p>
                    <a href="products.php" class="btn btn-secondary">Comprar Ahora</a>
                </div>
                <div class="product-card">
                    <img src="img/rop.1.png" alt="Ropa 1">
                    <h3>Suéter para Perros</h3>
                    <p>Precio: S/ 80.00</p>
                    <a href="products.php" class="btn btn-secondary">Comprar Ahora</a>
                </div>
                <div class="product-card">
                    <img src="img/cui.1.png" alt="Cuidado 1">
                    <h3>Shampoo para Mascotas</h3>
                    <p>Precio: S/ 30.00</p>
                    <a href="products.php" class="btn btn-secondary">Comprar Ahora</a>
                </div>
            </div>
        </div>
    </section>

    
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="info-section">
                <div class="info-box" style="background-color: #f1c40f; padding: 15px; border-radius: 8px; margin: 10px 0;">
                    <h3>Envío gratuito a nivel mundial</h3>
                    <p>En pedidos superiores a S/.100</p>
                </div>
                <div class="info-box" style="background-color: #f1c40f; padding: 15px; border-radius: 8px; margin: 10px 0;">
                    <h3>Ofertas</h3>
                    <p>Ofrece hasta 50% de descuento en productos seleccionados.</p>
                </div>
                <div class="info-box" style="background-color: #f1c40f; padding: 15px; border-radius: 8px; margin: 10px 0;">
                    <h3>Servicio al cliente 24/7</h3>
                    <p>Estamos aquí para ayudarte en cualquier momento.</p>
                </div>
            </div>
            <p>© 2024 PetShop - Todos los derechos reservados | <a href="contact.php">Contáctanos</a></p>
        </div>
    </footer>
</body>
</html>
