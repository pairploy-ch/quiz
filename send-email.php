<?php
// ส่งอีเมลด้วย Gmail SMTP

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/SMTP.php";
require_once "PHPMailer/Exception.php";

// ข้อมูล Gmail ของคุณ
$gmail_username = 'purposech@gmail.com';
$gmail_password = 'ymvylggsirpsxdgk';  // App Password ที่ใช้งานได้
$to_email = $_POST['email'];
$to_name = $_POST['name'];
$detail = htmlspecialchars_decode($_POST['detail']);

function sendEmail($to_email, $to_name, $subject, $message, $is_html = true) {
    global $gmail_username, $gmail_password;
    
    $mail = new PHPMailer(true);
    
    try {
        // ตั้งค่า SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $gmail_username;
        $mail->Password = $gmail_password;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $to_email = $_POST['email'];
        $to_name = $_POST['name'];
        
        // ตั้งค่าผู้ส่งและผู้รับ
        $mail->setFrom($gmail_username, 'ผลลัพธ์แบบทดสอบจักระ'); // เปลี่ยนชื่อผู้ส่งตรงนี้
        $mail->addAddress($to_email, $to_name);
        
        // ตั้งค่าเนื้อหาอีเมล
        $mail->CharSet = 'UTF-8';
        $mail->isHTML($is_html);
        $mail->Subject = $subject;
        $mail->Body = $message;
        
        // ส่งอีเมล
        $mail->send();
        return ['success' => true, 'message' => 'ส่งอีเมลสำเร็จ!'];
        
    } catch (Exception $e) {
        return ['success' => false, 'message' => "ส่งอีเมลไม่สำเร็จ: {$mail->ErrorInfo}"];
    }
}



// ส่งอีเมลทดสอบ
$result = sendEmail(
    $to_email,  // อีเมลผู้รับ
    $to_name,            // ชื่อผู้รับ
    'ผลลัพธ์แบบทดสอบจักระ', // หัวข้อ
    `<div style="font-family: 'Mitr', sans-serif;">`.$detail.'</div>',
    true // ส่งเป็น HTML
);

// แสดงผลลัพธ์
if ($result['success']) {
    echo "<div style='color: green; padding: 10px; border: 1px solid green; background: #f0fff0;'>";
    echo "✅ " . $result['message'];

    echo "</div>";
} else {
    echo "<div style='color: red; padding: 10px; border: 1px solid red; background: #fff0f0;'>";
    echo "❌ " . $result['message'];
    echo "</div>";
}

// // ตัวอย่างส่งอีเมลแบบ Text ธรรมดา
// echo "<h3>ส่งอีเมล Text ธรรมดา</h3>";

// $result2 = sendEmail(
//     'purposech@gmail.com',
//     'Test User',
//     'ทดสอบ Text Email',
//     'นี่คือข้อความแบบ Text ธรรมดา
    
// ไม่มี HTML tags
// วันที่: ' . date('d/m/Y H:i:s'),
//     false // ส่งเป็น Text ธรรมดา
// );

// if ($result2['success']) {
//     echo "<div style='color: green;'>✅ ส่งอีเมล Text สำเร็จ!</div>";
// } else {
//     echo "<div style='color: red;'>❌ " . $result2['message'] . "</div>";
// }
?>