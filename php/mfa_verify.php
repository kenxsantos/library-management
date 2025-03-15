<?php
require 'config.php';
require 'vendor/autoload.php';
use RobThree\Auth\TwoFactorAuth;

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$tfa = new TwoFactorAuth('MyApp');
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT mfa_secret FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $otp = $_POST['otp'];

    if ($tfa->verifyCode($user['mfa_secret'], $otp)) {
        $_SESSION['mfa_verified'] = true;
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Invalid OTP.";
    }
}
?>

<form method="POST">
    <label>Enter OTP:</label>
    <input type="text" name="otp" required>
    <button type="submit">Verify</button>
</form>