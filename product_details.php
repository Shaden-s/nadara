<?php
include 'includes/config.php';
session_start();

$id = isset($_GET['id']) ? $_GET['id'] : 1;

$sql = "SELECT * FROM products WHERE product_id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Add to cart
if(isset($_POST['add'])) {
    $product_id = $_POST['id'];
    $qty = $_POST['qty'];

    $_SESSION['cart'][] = [
        "id" => $product_id,
        "qty" => $qty
    ];

    echo "<p style='color:black; margin:20px 40px; font-weight:600;'>Added to cart ✅</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['name']; ?></title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        :root {
            --primary: #EFD9DC;
            --primary-hover: #e6cdd1;
            --bg-color: #F9F5F3;
            --sidebar-dark: #222222;
            --white: #ffffff;
            --text-dark: #333333;
            --text-grey: #888888;
            --transition: 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--bg-color);
            font-family: Arial, sans-serif;
            color: black;
        }

        .page-wrapper {
            padding: 30px 40px 50px;
        }

        .back-btn {
            display: inline-block;
            text-decoration: none;
            background-color: var(--primary);
            color: black;
            padding: 14px 22px;
            border-radius: 18px;
            font-size: 16px;
            margin-bottom: 35px;
            transition: var(--transition);
            font-weight: 500;
        }

        .back-btn:hover {
            background-color: var(--primary-hover);
        }

        .product-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 60px;
            flex-wrap: wrap;
        }

        .product-img {
            width: 450px;
            max-width: 100%;
            border-radius: 26px;
            object-fit: cover;
            box-shadow: 0 10px 30px rgba(0,0,0,0.06);
        }

        .product-info {
            flex: 1;
            min-width: 300px;
            max-width: 550px;
        }

        .product-info h1 {
            font-size: 58px;
            color: black;
            margin-bottom: 20px;
            line-height: 1.1;
        }

        .price {
            font-size: 28px;
            color: black;
            margin-bottom: 26px;
            font-weight: bold;
        }

        .description {
            font-size: 19px;
            color: black;
            line-height: 1.7;
            margin-bottom: 28px;
        }

        .qty-row {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 28px;
            color: black;
            font-size: 18px;
        }

        .qty {
            width: 120px;
            padding: 10px 12px;
            font-size: 18px;
            border: 1px solid #d8caca;
            border-radius: 10px;
            outline: none;
            color: black;
            background-color: white;
        }

        .btn-group {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 34px;
        }

        .btn {
            background-color: var(--primary);
            color: black;
            border: none;
            padding: 16px 28px;
            border-radius: 16px;
            font-size: 18px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: var(--transition);
            font-weight: 600;
        }

        .btn:hover {
            background-color: var(--primary-hover);
        }

        .help-box {
            background-color: white;
            border: 1px solid #f0d9db;
            border-radius: 20px;
            padding: 22px 24px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.05);
            max-width: 420px;
        }

        .help-title {
            font-size: 20px;
            font-weight: bold;
            color: black;
            margin-bottom: 8px;
        }

        .help-text {
            font-size: 16px;
            color: black;
            line-height: 1.6;
        }

        .help-number {
            display: inline-block;
            margin-top: 10px;
            font-weight: bold;
            color: black;
        }

        @media (max-width: 900px) {
            .product-container {
                flex-direction: column;
                align-items: flex-start;
            }

            .product-info h1 {
                font-size: 42px;
            }

            .page-wrapper {
                padding: 24px 20px 40px;
            }

            .top-bar {
                padding: 28px 20px;
            }

            .product-img {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
<div class="navbar">

    <div class="logo">
        Nadara
    </div>

    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="checkout.php">Shopping Cart 🛒</a>
    </div>

</div>

    <div class="page-wrapper">

        <a href="index.php" class="back-btn">
            ← Back to products
        </a>

        <div class="product-container">

            <img src="images/<?php echo $row['image']; ?>" class="product-img" alt="<?php echo $row['name']; ?>">

            <div class="product-info">
                <h1><?php echo $row['name']; ?></h1>

                <h3 class="price">
                    <?php echo $row['price']; ?> SAR
                </h3>

                <p class="description"><?php echo $row['description']; ?></p>

                <form method="post">
                    <input type="hidden" name="id" value="<?php echo $row['product_id']; ?>">

                    <div class="qty-row">
                        <label>Quantity:</label>
                        <input type="number" name="qty" value="1" min="1" class="qty">
                    </div>

                    <div class="btn-group">
                        <button name="add" class="btn">
                            Add to Cart
                        </button>

                        <a href="checkout.php" class="btn">
                            Checkout
                        </a>
                    </div>
                </form>

                <div class="help-box">
                    <div class="help-title">Need help?</div>
                    <div class="help-text">
                        Contact our customer support for assistance with your order or product questions.
                    </div>
                    <span class="help-number">+966 55 123 4567</span>
                </div>
            </div>
        </div>
    </div>

</body>
</html>