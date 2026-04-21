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

// update quantity
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

<h2 class="page-title">Shopping Cart</h2>

<!-- 🔙 Back -->
<div class="top-actions">
    <a href="index.php" class="btn">← Back to Home</a>
</div>

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

    <div class="cart-item">

        <img src="images/<?php echo $row['image']; ?>">

        <h3><?php echo $row['name']; ?></h3>

        <p>Price: <?php echo $row['price']; ?> SAR</p>
        <p>Total: <?php echo $item_total; ?> SAR</p>

        <!-- MODIFY -->
        <form method="post" class="cart-actions">
            <input type="hidden" name="index" value="<?php echo $index; ?>">
            <input type="number" name="qty" value="<?php echo $qty; ?>" min="1" class="qty">
            <button name="update" class="btn">Modify</button>
        </form>

        <!-- DELETE -->
        <a href="checkout.php?delete=<?php echo $index; ?>" class="btn danger">Delete</a>

    </div>

<?php
    }
} else {
    echo "<p class='empty'>Your cart is empty</p>";
}
?>

</div>

<!-- 🧾 Summary -->
<div class="summary">

    <h3>Total Price: <?php echo $total; ?> SAR</h3>

    <div class="summary-actions">

        <form method="post">
            <button name="clear" class="btn danger-all">Delete All</button>
        </form>

        <button onclick="alert('Order placed successfully!')" class="btn">Buy</button>

        <a href="index.php" class="btn">Continue Shopping</a>

    </div>

</div>

</body>
</html>