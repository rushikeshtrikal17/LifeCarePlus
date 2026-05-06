<?php
include "db.php";

$name  = $_POST['name'];
$age   = $_POST['age'];
$city  = $_POST['city'];
$mobile= $_POST['mobile'];
$email = $_POST['email'];
$pass  = password_hash($_POST['password'], PASSWORD_DEFAULT);

// image upload
$img = $_FILES['profile_image']['name'];
$tmp = $_FILES['profile_image']['tmp_name'];
move_uploaded_file($tmp, "uploads/".$img);

$stmt = $conn->prepare(
"INSERT INTO users (name, age, city, mobile, email, password, profile_image)
 VALUES (?,?,?,?,?,?,?)"
);

$stmt->bind_param("sisssss",
    $name,$age,$city,$mobile,$email,$pass,$img
);

if($stmt->execute()){
    header("Location: login.html");
}else{
    echo "Register failed";
}
?>