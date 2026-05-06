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

// Get form data from POST and sanitize
$name = mysqli_real_escape_string($conn, $_POST['name']);
$age = intval($_POST['age']); // Convert to integer for safety
$disease = mysqli_real_escape_string($conn, $_POST['disease']);
$description = mysqli_real_escape_string($conn, $_POST['description']);

// Use prepared statement to prevent SQL injection
$sql = "INSERT INTO consultations (patient_name, age, problem, description) 
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("siss", $name, $age, $disease, $description);

if ($stmt->execute()) {
    // Show success message instead of redirect (so you can see it worked)
    echo "<!DOCTYPE html>";
    echo "<html><head><title>Consultation Submitted</title>";
    echo "<style>";
    echo "body{font-family:Arial;text-align:center;padding:50px;background:#f4f6f9}";
    echo ".success{background:#d4edda;color:#155724;padding:20px;border-radius:5px;max-width:500px;margin:0 auto}";
    echo "a{display:inline-block;margin-top:20px;padding:10px 20px;background:#5f1782;color:white;text-decoration:none;border-radius:5px}";
    echo "</style>";
    echo "</head><body>";
    echo "<div class='success'>";
    echo "<h2>✓ Consultation Booked Successfully!</h2>";
    echo "<p><strong>Name:</strong> $name</p>";
    echo "<p><strong>Age:</strong> $age</p>";
    echo "<p><strong>Problem:</strong> $disease</p>";
    echo "<p><strong>Description:</strong> $description</p>";
    echo "<p>Our doctor will contact you soon.</p>";
    echo "<a href='consultation.html'>Back to Consultation Form</a>";
    echo "</div></body></html>";
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>