<?php
require("mysqli_connect.php");
session_start();

if (!isset($_GET["bookId"])) {
    if (!$_SESSION["bookId"]) {
        echo "<br>Book id is not set.<br>";
    }
} else {
    $_SESSION["bookId"] =  $_GET["bookId"];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $check = TRUE;

    if (empty($_POST['firstname'])) {
        $check = FALSE;
        echo "Please enter firstname.";
    } else {
        $firstname = mysqli_real_escape_string($dbc, $_POST['firstname']);
    }

    if (empty($_POST['lastname'])) {
        $check = FALSE;
        echo "Please enter lastname.";
    } else {
        $lastname = mysqli_real_escape_string($dbc, $_POST['lastname']);
    }

    if (isset($_POST['payment'])) {
        $payment =  mysqli_real_escape_string($dbc, $_POST['payment']);
    } else {
        $check = FALSE;
        echo "Please select payment method.";
    }
    if ($check == TRUE) {
        $id = intval($_SESSION['bookId']);

        $placeOrder = "INSERT INTO orders (`firstName`,`lastName`,`paymentType`,`book_purchased`)
        VALUES 
        ('{$_POST['firstname']}',
        '{$_POST['lastname']}',
        '{$_POST['payment']}',
        '{$id}')";
        $bookOrder = @mysqli_query($dbc, $placeOrder);

        header("location:store.php");
        echo "Your order has been placed.";

        $updateData = "UPDATE bookInventory SET quantity = quantity - 1 WHERE bookId={$id}";
        $updateBooks = mysqli_query($dbc, $updateData);

        unset($_SESSION['bookId']);
        session_destroy();
    }
}


?>

<!DOCTYPE html>
<title>Book Inventory</title>

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <form action="checkout.php" method="POST">
        <p>First Name: <input type="text" name="firstname"></p>

        <p>Last Name: <input type="text" name="lastname"></p>

        <p><label for="payment">Payment Options:</label>
            <input type="radio" name="payment" value="creditcard">
            Credit card
            <input type="radio" name="payment" value="gogglepay">
            Google Pay
        </p>

        <p><input type="submit" name="submit" value="Place order"></p>

    </form>
</body>

</html>