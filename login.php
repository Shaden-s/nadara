<?php
session_start();
include 'db.php'; 

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['admin_email']);
    $password = $_POST['admin_pass'];

    $query = "SELECT * FROM admins WHERE email = '$email' AND password = '$password' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $admin = mysqli_fetch_assoc($result);
        
        // --- Remember Me ---
        if (isset($_POST['remember_me'])) {
            setcookie("admin_login", $email, time() + (86400 * 30), "/"); 
        } else {
            if (isset($_COOKIE["admin_login"])) {
                setcookie("admin_login", "", time() - 3600, "/");
            }
        }

        $_SESSION['admin_id'] = $admin['admin_id'];
        $_SESSION['admin_name'] = $admin['username'];
        
        header("Location: dashbord.php");
        exit();
    } else {
        $error_message = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NADARA | Admin Login</title>
    <link rel="stylesheet" href="style1.css">
    <style>
        .error-msg {
            background-color: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #f5c6cb;
            margin-bottom: 20px;
            text-align: center;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    <div class="login-body">
        <div class="login-card">
            <header>
                <h1>NADARA</h1>
                <h2>Admin Login</h2>
                <p>Welcome back, Admin!</p>
            </header>
            
            <?php if ($error_message): ?>
                <div class="error-msg"><?php echo $error_message; ?></div>
            <?php endif; ?>

            <form action="login.php" method="POST">
                <div class="input-field">
                    <label>Email</label>
                    <input type="email" name="admin_email" placeholder="adminlogin@nadara.com" 
                           value="<?php echo $_COOKIE['admin_login'] ?? ''; ?>" required
                           oninvalid="this.setCustomValidity('Please enter a valid email address')" 
                           oninput="this.setCustomValidity('')">
                </div>

                <div class="input-field">
                    <label>Password</label>
                    <input type="password" name="admin_pass" placeholder="••••••••" required
                           oninvalid="this.setCustomValidity('Password is required')" 
                           oninput="this.setCustomValidity('')">
                </div>

                <div class="options">
                    <label>
                        <input type="checkbox" name="remember_me" <?php if(isset($_COOKIE["admin_login"])) echo "checked"; ?>> Remember me
                    </label>
                    <a href="javascript:void(0)" onclick="alert('System Admin: Please check the database credentials or contact support.');">Forgot Password?</a>
                </div>

                <button type="submit" class="btn-login">Login</button>
            </form>

            <footer>
                <p>© 2026 NADARA. All rights reserved.</p>
            </footer>
        </div>
    </div>

</body>
</html>