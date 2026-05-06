<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<h2>Admin Panel – Life Care Plus</h2>

<ul>
    <li><a href="view_users.php">👤 View Users</a></li>
    <li><a href="view_appointments.php">📅 View Appointments</a></li>
    <li><a href="admin_logout.php">🚪 Logout</a></li>
</ul>