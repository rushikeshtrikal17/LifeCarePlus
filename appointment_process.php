<?php
// Database connection
$servername = "localhost";
$username = "root";   // XAMPP default
$password = "";       // XAMPP default
$dbname = "lifecare_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data from POST
$name = $_POST['name'];
$age = $_POST['age'];
$doctor = $_POST['doctor'];
$date = $_POST['date'];

// Insert data into appointments table
$sql = "INSERT INTO appointments (patient_name, age, doctor, appointment_date) 
        VALUES ('$name', '$age', '$doctor', '$date')";

if ($conn->query($sql) === TRUE) {
    echo "Appointment booked successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
