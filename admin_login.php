<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_user = "admin";
    $admin_pass = "admin123";

    if ($_POST['username'] == $admin_user && $_POST['password'] == $admin_pass) {
        $_SESSION['admin'] = true;
        header("Location: admin_dashboard.php");
    } else {
        echo "Invalid Admin Login";
    }
}
?>

<form method="post">
    <h2>Admin Login</h2>
    <input type="text" name="username" placeholder="Admin Username" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit">Login</button>
</form>