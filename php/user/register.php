<?php
// session_start();
// include "../server.php"; 
?>

<!DOCTYPE html>
<html>

<head>
    <title>TIP Library</title>

    <?php include "../imports.php" ?>
    <link href="../../css/register.css" rel="stylesheet">
</head>

<body>

    <?php include "../navbar.php" ?>
    <div class="container">
        <center> <br> <img src="../../images/T.I.P._Logo.png" width="200" height="100"></center>
        <div class="header">
            <h2>Register</h2>
        </div>

        <form action="register.php" method="post">
            <?php include "../errors.php"; ?>
            <div class="form-group">
                <label for="username">Username: </label>
                <input type="text" class="form-control" name="username">
            </div>
            <div class="form-group">
                <label for="email">Email: </label>
                <input type="text" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password: </label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password: </label>
                <input type="password" class="form-control" name="confirmPassword">
            </div>
            <div class="form-group">
                <label for="userCode">Current Status:</label>
                <select name="userCode" class="form-control">Current Status:
                    <option value="invalid">Pick status</option>
                    <option value="undergrad">Undergrad Student</option>
                    <option value="grad">Grad Student</option>
                    <option value="professor">Professor</option>
                </select>
            </div>
            <div class="form-group">
                <center> <button type="submit" class="btn btn-primary" name="new_user">Register</button>
            </div>

            <p>
                Already a member? <a href="http://localhost:80/LibraryManager-master/php/login.php">Sign in</a>
            </p>
        </form>
    </div>
</body>

</html>