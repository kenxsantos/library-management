<?php 
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html>
    <head>
    <?php include "imports.php" ?>
    <link href="../css/home.css" rel="stylesheet">
    </head>
    <body>
      <?php include "navbar.php"; ?>
    <br><center>  <img src="../images/T.I.P._Logo.png" width="200" height="100">
      <div class="heading">
        
        <h1 class="heading__main">Welcome to TIP's Library Management System</h1>
        <h3 class="heading-sub">Made for CIT 304 - Advanced Database Systems Final Project</h3>
         <h4>Please log in or register to get started.</h4>
     </div>
  
    </body>
</html>