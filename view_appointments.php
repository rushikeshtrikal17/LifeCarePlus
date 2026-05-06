<?php
session_start();
include "../db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$result = $conn->query("SELECT * FROM appointments");
?>

<h2>All Appointments</h2>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Patient Name</th>
    <th>Age</th>
    <th>Doctor</th>
    <th>Date</th>
    <th>Created</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['patient_name'] ?></td>
    <td><?= $row['age'] ?></td>
    <td><?= $row['doctor'] ?></td>
    <td><?= $row['appointment_date'] ?></td>
    <td><?= $row['created_at'] ?></td>
</tr>
<?php } ?>

</table>