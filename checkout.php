<?php
include 'includes/config.php';
session_start();

// delete single item
if(isset($_GET['delete'])) {
    $index = $_GET['delete'];
    unset($_SESSION['cart'][$index]);
}

// clear all cart
if(isset($_POST['clear'])) {
    unset($_SESSION['cart']);
}

// update quantity (MODIFY)
if(isset($_POST['update'])) {
    $index = $_POST['index'];
    $qty = $_POST['qty'];

    $_SESSION['cart'][$index]['qty'] = $qty;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<h2 style="padding:20px;">Shopping Cart</h2>

<!-- 🔙 Back Button -->
<a href="index.php" class="back-btn">← Back to Home</a>

<div class="cart">

<?php
$total = 0;

if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {

    foreach($_SESSION['cart'] as $index => $item) {

        $id = $item['id'];
        $qty = $item['qty'];

        $sql = "SELECT * FROM products WHERE product_id = $id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $item_total = $row['price'] * $qty;
        $total += $item_total;
?>

    <!-- cart item -->
    <div class="cart-item">

        <img src="images/<?php echo $row['image']; ?>">

        <h3><?php echo $row['name']; ?></h3>

        <p>Price: <?php echo $row['price']; ?> SAR</p>
        <p>Total: <?php echo $item_total; ?> SAR</p>

        <!-- MODIFY -->
        <form method="post">
            <input type="hidden" name="index" value="<?php echo $index; ?>">
            <input type="number" name="qty" value="<?php echo $qty; ?>" min="1">
            <button name="update">Modify</button>
        </form>

        <!-- DELETE -->
        <a href="checkout.php?delete=<?php echo $index; ?>">Delete</a>

    </div>

<?php
    }
} else {
    echo "<p style='padding:20px;'>Your cart is empty</p>";
}
?>

</div>

<!-- summary -->
<div class="summary">

    <h3>Total Price: <?php echo $total; ?> SAR</h3>

    <form method="post">
        <button name="clear">Delete All</button>
    </form>

    <button onclick="alert('Order placed successfully!')">Buy</button>

    <!-- Continue shopping -->
    <a href="index.php" class="btn">Continue Shopping</a>

</div>

</body>
</html>