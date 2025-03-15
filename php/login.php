<!DOCTYPE html>
<html>

<head>
    <?php include "imports.php"; ?>
    <link href="../css/register.css" rel="stylesheet">
</head>

<body>
    <?php include "navbar.php"; ?>
    <div class="container">
        <center><br><img src="../images/T.I.P._Logo.png" width="200" height="100"></center>
        <div class="header">
            <h2>Login</h2>
        </div>

        <form action="login.php" method="post">
            <?php include "errors.php"; ?>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <center> <button class="btn btn-primary" name="login_user" type="submit">Login</button>
            </div>
            <p>
                Not a member? <a href="http://localhost:80/LibraryManager-master/php/user/register.php">Sign up</a>
            </p>
        </form>
    </div>
</body>

</html>