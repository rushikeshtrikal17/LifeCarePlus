<?php
session_start();
include "db.php";

$email = $_POST['email'];
$pass  = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
$stmt->bind_param("s",$email);
$stmt->execute();
$result = $stmt->get_result();

if($row = $result->fetch_assoc()){
    if(password_verify($pass,$row['password'])){
        $_SESSION['user_id'] = $row['id'];
        header("Location: profile.php");
    }else{
        echo "Wrong password";
    }
}else{
    echo "User not found";
}
?>