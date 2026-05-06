<?php
session_start();
include "../db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$result = $conn->query("SELECT * FROM users");
?>

<h2>All Registered Users</h2>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Profile</th>
    <th>Name</th>
    <th>Age</th>
    <th>City</th>
    <th>Email</th>
    <th>Sub</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?= $row['id'] ?></td>

    <td>
        <?php if($row['profile']) { ?>
            <img src="../uploads/<?= $row['profile'] ?>" width="50">
        <?php } else { ?>
            No Image
        <?php } ?>
    </td>

    <td><?= $row['name'] ?></td>
    <td><?= $row['age'] ?></td>
    <td><?= $row['city'] ?></td>
    <td><?= $row['email'] ?></td>
    <td><?= $row['sub'] ?></td>
</tr>
<?php } ?>

</table>