<?php
// session_start();
// include "../server.php" ?>
<!doctype html>
<html lang="en">

<head>
  <title>Library Manager</title>
  <!-- Required meta tags -->

  <?php include "../imports.php" ?>
  <link href="../../css/form.css" rel="stylesheet">
  <!-- Bootstrap CSS -->
</head>

<body>
  <?php include "../navbar.php"; ?>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <br>
        <form action="returnBook.php" method="post">
          <div class="form-group" id="return_book_select_container">
            <?php
            $con = mysqli_connect("localhost", "remote_user", "", "library_management");
            //check if book is not already issued
            $user_id = (isset($_SESSION["user_id"]));
            $issued_book_id = array();
            $loan_query = "SELECT * FROM loans WHERE user_id='$user_id'";
            $results = mysqli_query($con, $loan_query);
            while ($row = mysqli_fetch_assoc($results)) {
              if (!$row["returned_on"]) {
                array_push($issued_book_id, $row["book_id"]);
              }
            }
            $issued_book_id = array_unique($issued_book_id);
            if (count($issued_book_id) == 0) {
              //user has no loaned books
              echo "<p>You have no issued books. <a href='http://localhost:80/LibraryManager-master/php/user/issueBook.php'>Click here</a> to issue books</p>";
            } else {
              //user has loaned books
              echo "
                <label>Choose book to return :</label>
              
                <select name='return_book_id' id='return_book_select'>
                ";
              foreach ($issued_book_id as $value) {
                $book_query = "SELECT * FROM books WHERE book_id='$value' LIMIT 1";
                $book_result = mysqli_query($db, $book_query);
                $book = mysqli_fetch_assoc($book_result);
                $book_author = $book["author"];
                $book_title = $book["title"];
                $book_category = $book["category"];
                $book_year = $book["year"];
                $book_id = $book["book_id"];
                echo "
                        <option value='$book_id'>
                          Title: $book_title | Author: $book_author | Category: $book_category | Year: $book_year
                        </option>
                        ";
              }
              echo "
                </select>
                <div class='input-group'>
                <br><button type='submit' class='btn btn-primary' name='returnBook'>Submit</button>
                </div>
                
                
                ";
            }
            //get book info from books table
            //display all book_ids
            

            ?>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>