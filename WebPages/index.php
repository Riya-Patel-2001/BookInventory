<!--Git Hub Link : https://github.com/Riya-Patel-2001/BookInventory.git-->


<!DOCTYPE html>
<title>Book Inventory</title>

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body style="background-color:khaki">
    <br><br>
    <h1 class="text-center">Welcome to Book Inventory</h1>
    <h3 class="text-center">Collection of Books</h3>
    <br><br><br><br>

    <?php
    //connect to SQL 
    require("mysqli_connect.php");
    //starting the session 
    session_start();

    $q = "SELECT * FROM bookInventory";
    $r = mysqli_query($dbc, $q);

    //put a loop to fetch and print all data from SQL
    while ($row = mysqli_fetch_array($r)) {
        echo "<div style='height:20px;width:20px;'>" . $row['img'] . "</div>";
        echo "<div class='text-center'>";
        //giving link to bookname for checkout page and setting bookId variable to take clicked book's id
        echo "<h5><a href='checkout.php?bookId={$row['bookId']}'>" . $row['bookName'] . "</a></h5><br>";
    }
    ?>
    </div>

</body>

</html>