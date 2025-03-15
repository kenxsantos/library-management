<?php
session_start();
include "../server.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['verify_otp'])) {
    $entered_otp = $_POST['otp'];

    if (!isset($_SESSION['otp']) || time() > $_SESSION['otp_expiration']) {
        $_SESSION['error'] = "OTP expired! Please register again.";
        header("Location: register.php");
        exit();
    }

    if ($entered_otp == $_SESSION['otp']) {
        // OTP correct - Insert user into database
        $user = $_SESSION['temp_user'];
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, user_code, is_verified) VALUES (?, ?, ?, ?, 1)");
        $stmt->bind_param("ssss", $user['username'], $user['email'], $user['password'], $user['user_code']);
        $stmt->execute();
        $stmt->close();

        // Clean up session
        unset($_SESSION['otp'], $_SESSION['otp_expiration'], $_SESSION['temp_user']);

        $_SESSION['success'] = "Account verified! You can now log in.";
        header("Location: login.php");
        exit();
    } else {
        $_SESSION['error'] = "Invalid OTP. Try again!";
        header("Location: verify_otp.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Verify OTP</title>
    <?php include "../imports.php"; ?>
</head>

<body>
    <div class="container">
        <h2>Enter OTP</h2>
        <?php if (isset($_SESSION['error'])) {
            echo "<p style='color: red;'>" . $_SESSION['error'] . "</p>";
            unset($_SESSION['error']);
        } ?>
        <form action="verify_otp.php" method="post">
            <label>OTP Code:</label>
            <input type="text" name="otp" required>
            <button type="submit" name="verify_otp">Verify</button>
        </form>
    </div>
</body>

</html>