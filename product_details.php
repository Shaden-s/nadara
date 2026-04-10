<?php
include 'includes/config.php';
session_start();

$id = $_GET['id'];

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

    echo "<p style='color:green; margin-left:40px;'>Added to cart ✅</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $row['name']; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Back Button -->
<a href="javascript:history.back()" class="back-btn">
    ← Back to products
</a>

<div class="product-container">

    <img src="images/<?php echo $row['image']; ?>" class="product-img">

    <div class="product-info">
        <h1><?php echo $row['name']; ?></h1>

        <h3 class="price">
            <?php echo $row['price']; ?> SAR
        </h3>

        <p><?php echo $row['description']; ?></p>

        <form method="post">
            <input type="hidden" name="id" value="<?php echo $row['product_id']; ?>">

            <label>Quantity:</label>
            <input type="number" name="qty" value="1" min="1" class="qty">

            <br><br>

            <button name="add" class="btn">
                Add to Cart
            </button>
        </form>
    </div>

</div>

</body>
</html>