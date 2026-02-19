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
$disease = $_POST['disease'];
$description = $_POST['description'];

// Insert data into consultations table
$sql = "INSERT INTO consultations (patient_name, age, problem, description) 
        VALUES ('$name', '$age', '$disease', '$description')";

if ($conn->query($sql) === TRUE) {
    echo "Consultation booked successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
