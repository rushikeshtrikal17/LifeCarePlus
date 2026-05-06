<?php
include "db.php";

$stmt = $conn->prepare(
    "INSERT INTO appointments (patient_name, age, doctor, appointment_date)
     VALUES (?, ?, ?, ?)"
);

$stmt->bind_param("siss", $name, $age, $doctor, $date);

$name   = $_POST['name'];
$age    = $_POST['age'];
$doctor = $_POST['doctor'];
$date   = $_POST['date'];

if ($stmt->execute()) {
    echo "Appointment booked successfully!";
} else {
    echo "Error booking appointment";
}

$stmt->close();
$conn->close();
?>