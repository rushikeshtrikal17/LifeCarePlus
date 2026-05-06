<?php
session_start();
include "db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.html");
    exit();
}

$id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM users WHERE id=$id");
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Life Care Plus</title>
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #8b6cb0 100%);
            min-height: 100vh;
            padding: 40px 20px;
            position: relative;
        }
        
        /* Decorative Background Elements */
        body::before {
            content: "❤️";
            position: absolute;
            font-size: 300px;
            opacity: 0.05;
            bottom: 0;
            right: 0;
            pointer-events: none;
        }
        
        body::after {
            content: "🏥";
            position: absolute;
            font-size: 250px;
            opacity: 0.05;
            top: 0;
            left: 0;
            pointer-events: none;
        }
        
        /* Navigation Bar */
        .nav-bar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 50px;
            padding: 12px 30px;
            max-width: 1200px;
            margin: 0 auto 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        
        .logo {
            font-size: 24px;
            font-weight: 800;
            background: linear-gradient(135deg, #1e3c72, #8b6cb0);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .logo span {
            background: linear-gradient(135deg, #ff6b6b, #ee5a24);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .nav-links {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }
        
        .nav-btn {
            text-decoration: none;
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: 500;
            transition: 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .nav-btn-home {
            background: #1e3c72;
            color: white;
        }
        
        .nav-btn-home:hover {
            background: #2a5298;
            transform: translateY(-2px);
        }
        
        .nav-btn-appoint {
            background: #8b6cb0;
            color: white;
        }
        
        .nav-btn-appoint:hover {
            background: #9b7bc0;
            transform: translateY(-2px);
        }
        
        .nav-btn-consult {
            background: #ff6b6b;
            color: white;
        }
        
        .nav-btn-consult:hover {
            background: #ee5a24;
            transform: translateY(-2px);
        }
        
        .nav-btn-logout {
            background: #dc3545;
            color: white;
        }
        
        .nav-btn-logout:hover {
            background: #c82333;
            transform: translateY(-2px);
        }
        
        /* ID Card Container */
        .id-card-container {
            display: flex;
            justify-content: center;
            align-items: center;
            perspective: 1000px;
        }
        
        /* ID Card */
        .id-card {
            width: 500px;
            background: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%);
            border-radius: 25px;
            box-shadow: 0 30px 50px rgba(0,0,0,0.3), 0 0 0 8px rgba(255,255,255,0.3), 0 0 0 12px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
            animation: cardFloat 3s ease-in-out infinite;
        }
        
        .id-card:hover {
            transform: translateY(-10px) scale(1.02);
        }
        
        @keyframes cardFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
        
        /* Card Header (College Style) */
        .card-header {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            padding: 25px 20px 15px;
            text-align: center;
            position: relative;
        }
        
        .institution-name {
            font-size: 22px;
            font-weight: 800;
            color: white;
            letter-spacing: 2px;
        }
        
        .institution-tag {
            font-size: 12px;
            color: rgba(255,255,255,0.8);
            margin-top: 5px;
        }
        
        .card-type {
            background: #ffd700;
            display: inline-block;
            padding: 5px 20px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 800;
            color: #1e3c72;
            margin-top: 10px;
            text-transform: uppercase;
        }
        
        /* Photo Section */
        .photo-section {
            text-align: center;
            margin-top: -40px;
            position: relative;
            z-index: 10;
        }
        
        .photo-frame {
            width: 120px;
            height: 120px;
            background: white;
            border-radius: 50%;
            margin: 0 auto;
            padding: 4px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.3);
            border: 3px solid #ffd700;
        }
        
        .photo-frame img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .photo-placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #1e3c72, #8b6cb0);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 50px;
            color: white;
        }
        
        /* Card Body */
        .card-body {
            padding: 20px 25px 25px;
        }
        
        .student-id {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px dashed #e0e0e0;
        }
        
        .id-label {
            font-size: 11px;
            color: #999;
            letter-spacing: 1px;
        }
        
        .id-number {
            font-size: 18px;
            font-weight: 800;
            color: #1e3c72;
            font-family: monospace;
        }
        
        /* Info Grid */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .info-field {
            background: #f0f2f5;
            padding: 10px 12px;
            border-radius: 12px;
            transition: 0.3s;
        }
        
        .info-field:hover {
            background: #e8ebf0;
            transform: translateX(3px);
        }
        
        .info-icon {
            font-size: 14px;
            color: #8b6cb0;
            margin-right: 8px;
        }
        
        .info-label-text {
            font-size: 10px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .info-value-text {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-top: 3px;
        }
        
        /* Full width field */
        .info-field-full {
            grid-column: span 2;
        }
        
        /* Status Badge */
        .status-section {
            text-align: center;
            margin: 15px 0;
        }
        
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #d4edda;
            color: #155724;
            padding: 8px 20px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
        }
        
        /* Signature Line */
        .signature-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #e0e0e0;
        }
        
        .signature {
            text-align: center;
        }
        
        .signature-line {
            width: 100px;
            height: 1px;
            background: #333;
            margin-top: 5px;
        }
        
        .signature-text {
            font-size: 10px;
            color: #666;
        }
        
        .validity {
            text-align: center;
            font-size: 10px;
            color: #999;
        }
        
        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
            flex-wrap: wrap;
        }
        
        .action-btn {
            padding: 12px 25px;
            border-radius: 40px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: 0.3s;
            border: none;
            cursor: pointer;
        }
        
        .btn-book {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: white;
            box-shadow: 0 5px 15px rgba(30,60,114,0.3);
        }
        
        .btn-book:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(30,60,114,0.4);
        }
        
        .btn-consult {
            background: linear-gradient(135deg, #8b6cb0, #9b7bc0);
            color: white;
            box-shadow: 0 5px 15px rgba(139,108,176,0.3);
        }
        
        .btn-consult:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(139,108,176,0.4);
        }
        
        .btn-edit {
            background: linear-gradient(135deg, #ffd700, #ffb347);
            color: #333;
            box-shadow: 0 5px 15px rgba(255,193,7,0.3);
        }
        
        .btn-edit:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255,193,7,0.4);
        }
        
        /* Footer Note */
        .footer-note {
            text-align: center;
            margin-top: 30px;
            color: rgba(255,255,255,0.7);
            font-size: 12px;
        }
        
        /* Responsive */
        @media (max-width: 600px) {
            .id-card {
                width: 95%;
                margin: 0 auto;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .info-field-full {
                grid-column: span 1;
            }
            
            .nav-bar {
                flex-direction: column;
                gap: 15px;
                border-radius: 20px;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .action-btn {
                justify-content: center;
            }
        }
    </style>
</head>
<body>

<div class="nav-bar">
    <div class="logo">
        <i class="fas fa-heartbeat"></i> Life Care <span>Plus</span>
    </div>
    <div class="nav-links">
        <a href="index.html" class="nav-btn nav-btn-home"><i class="fas fa-home"></i> Home</a>
        <a href="appointment.html" class="nav-btn nav-btn-appoint"><i class="fas fa-calendar-check"></i> Appointment</a>
        <a href="consultation.html" class="nav-btn nav-btn-consult"><i class="fas fa-video"></i> Consultation</a>
        <a href="logout.php" class="nav-btn nav-btn-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</div>

<div class="id-card-container">
    <div class="id-card">
        <!-- Card Header - College ID Style -->
        <div class="card-header">
            <div class="institution-name">
                <i class="fas fa-hospital-user"></i> LIFE CARE PLUS
            </div>
            <div class="institution-tag">Your Health, Our Priority</div>
            <div class="card-type">
                <i class="fas fa-id-card"></i> PATIENT IDENTITY CARD
            </div>
        </div>
        
        <!-- Photo Section -->
        <div class="photo-section">
            <div class="photo-frame">
                <?php if(!empty($user['profile_image']) && file_exists("uploads/".$user['profile_image'])): ?>
                    <img src="uploads/<?php echo $user['profile_image']; ?>" alt="Profile Photo">
                <?php else: ?>
                    <div class="photo-placeholder">
                        <i class="fas fa-user-circle"></i>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Card Body -->
        <div class="card-body">
            <!-- Patient ID -->
            <div class="student-id">
                <div class="id-label">PATIENT ID NUMBER</div>
                <div class="id-number">
                    <i class="fas fa-hashtag"></i> LCP<?php echo str_pad($user['id'], 6, "0", STR_PAD_LEFT); ?>
                </div>
            </div>
            
            <!-- Information Grid -->
            <div class="info-grid">
                <div class="info-field">
                    <div class="info-label-text">
                        <i class="fas fa-user info-icon"></i> Full Name
                    </div>
                    <div class="info-value-text"><?php echo htmlspecialchars($user['name']); ?></div>
                </div>
                
                <div class="info-field">
                    <div class="info-label-text">
                        <i class="fas fa-calendar-alt info-icon"></i> Age
                    </div>
                    <div class="info-value-text"><?php echo $user['age']; ?> Years</div>
                </div>
                
                <div class="info-field">
                    <div class="info-label-text">
                        <i class="fas fa-map-marker-alt info-icon"></i> City
                    </div>
                    <div class="info-value-text"><?php echo htmlspecialchars($user['city']); ?></div>
                </div>
                
                <div class="info-field">
                    <div class="info-label-text">
                        <i class="fas fa-phone-alt info-icon"></i> Mobile Number
                    </div>
                    <div class="info-value-text"><?php echo $user['mobile']; ?></div>
                </div>
                
                <div class="info-field info-field-full">
                    <div class="info-label-text">
                        <i class="fas fa-envelope info-icon"></i> Email Address
                    </div>
                    <div class="info-value-text"><?php echo htmlspecialchars($user['email']); ?></div>
                </div>
            </div>
            
            <!-- Status -->
            <div class="status-section">
                <div class="status-badge">
                    <i class="fas fa-check-circle"></i> ACTIVE MEMBER
                    <i class="fas fa-shield-alt"></i>
                </div>
            </div>
            
            <!-- Signature and Validity -->
            <div class="signature-section">
                <div class="signature">
                    <div class="signature-line"></div>
                    <div class="signature-text">Patient Signature</div>
                </div>
                <div class="validity">
                    <i class="fas fa-calendar-alt"></i> Valid Till: Dec 2027
                </div>
                <div class="signature">
                    <div class="signature-line"></div>
                    <div class="signature-text">Authorized Signatory</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Action Buttons Below ID Card -->
<div class="action-buttons">
    <a href="book_appointment.php" class="action-btn btn-book">
        <i class="fas fa-calendar-plus"></i> Book Appointment
    </a>
    <a href="consultation.html" class="action-btn btn-consult">
        <i class="fas fa-headset"></i> Online Consultation
    </a>
    <a href="edit_profile.php" class="action-btn btn-edit">
        <i class="fas fa-edit"></i> Edit Profile
    </a>
</div>

<div class="footer-note">
    <i class="fas fa-lock"></i> This is a digitally verified identity card · For any changes, contact hospital administration
</div>

</body>
</html>