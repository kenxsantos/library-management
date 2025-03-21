<?php
// session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <?php include "../../imports.php" ?>
    <link href="../../../css/form.css" rel="stylesheet">
</head>

<body>
    <?php include "../../navbar.php"; ?>
    <div class="container">
        <br>
        <form action="userOverDue.php" method="post">
            <div class="heading">
                <h2>User Profile Page</h2>
            </div>
            <div class="issuedBooks__body">
                <h2>Overdue Books:</h2>

                <?php
                $db = mysqli_connect("localhost", "remote_user", "", "library_management");
                $user_id = (isset($_SESSION["user_id"]));
                $query = "SELECT * FROM loans WHERE user_id='$user_id' AND returned_on IS NULL AND return_by < CURDATE()";
                $results = mysqli_query($db, $query);
                if (mysqli_num_rows($results) == 0) {
                    echo "<p>You currently have no overdue books(You might still have fees due, check <a href='http://localhost:80/LibraryManager-master/php/user/userProfile/userDueFunds.php'>here</a>)</p>";
                } else {
                    //print list of issued books is a table
                    echo "
                <table>
                <thead>
                    <th>Book Title</th>
                    <th>Issued On</th>
                    <th>Return By</th>
                    <th>Returned On</th>
                </thead>
                <tbody>
                ";
                    while ($row = mysqli_fetch_assoc($results)) {
                        $currentDate = date("Y-m-d");

                        $book_id = $row["book_id"];
                        $book_loaned_on = rtrim($row["loaned_on"], '00:00:00');
                        $book_return_by = rtrim($row["return_by"], '00:00:00');
                        $book_returned_on = "NOT RETURNED";
                        $book_query = "SELECT * FROM books WHERE book_id='$book_id' LIMIT 1";
                        $book_result = mysqli_query($db, $book_query);
                        $book = mysqli_fetch_assoc($book_result);
                        $book_title = $book["title"];
                        echo "<tr class=" . "book" . $book_id . ">
                        <td>$book_title</td>
                        <td>$book_loaned_on</td>
                        <td>$book_return_by</td>
                        <td>$book_returned_on</td>
                        </tr>";
                        //   }     
                    }
                    echo "
                </tbody>
                </table>
                ";
                }
                ?>

            </div>
    </div>


</body>

</html>