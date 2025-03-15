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
$secret = $tfa->createSecret();

$_SESSION['mfa_secret'] = $secret;
$qrCodeUrl = $tfa->getQRCodeImageAsDataUri('MyApp', $secret);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE users SET mfa_secret = ?, is_mfa_enabled = 1 WHERE id = ?");
    $stmt->execute([$secret, $_SESSION['user_id']]);
    header("Location: dashboard.php");
    exit;
}
?>

<h3>Scan the QR Code with Google Authenticator</h3>
<img src="<?= $qrCodeUrl ?>" alt="QR Code">
<form method="POST">
    <button type="submit">Enable MFA</button>
</form>