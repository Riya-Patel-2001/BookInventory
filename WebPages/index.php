<!DOCTYPE html>
<title>Book Inventory</title>

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <?php

    require("mysqli_connect.php");
    session_start();
    $q = "SELECT * FROM bookInventory";
    $r = mysqli_query($dbc, $q);

    while ($row = mysqli_fetch_array($r)) {
        echo "<div class='col'>";
        //echo "<div class='card'>";
        //echo "<div class='card-body'>";
        echo "<h5>" . $row['bookId'] . "</h5>";
        echo "<h5 class='card-title'><a href='checkout.php?bookId={$row['bookId']}'>" . $row['bookName'] . "</a></h5>";
    }
    ?>
    </div>

</body>

</html>