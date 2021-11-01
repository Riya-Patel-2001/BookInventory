<?php
//connecting to SQL
require("mysqli_connect.php");
session_start();

//using $_GET to check if we are receiving bookId or not 
if (!isset($_GET["bookId"])) {
    if (!$_SESSION["bookId"]) {
        echo "<br>Book id is not set.<br>";
    }
} else {
    $_SESSION["bookId"] =  $_GET["bookId"];
}

//to check we have received data from form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $check = TRUE;

    //put validation for all fields of form
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

    if (empty($_POST['email'])) {
        $check = FALSE;
        echo "Please enter email.";
    } else {
        $lastname = mysqli_real_escape_string($dbc, $_POST['email']);
    }

    if (isset($_POST['payment'])) {
        $payment =  mysqli_real_escape_string($dbc, $_POST['payment']);
    } else {
        $check = FALSE;
        echo "Please select payment method.";
    }
    if ($check == TRUE) {
        //using intval to convert session id to int 
        $id = intval($_SESSION['bookId']);

        //write insert query to add data from checkout form to SQL database
        $placeOrder = "INSERT INTO orders (`firstName`,`lastName`,`paymentType`,`book_purchased`)
        VALUES 
        ('{$_POST['firstname']}',
        '{$_POST['lastname']}',
        '{$_POST['payment']}',
        '{$id}')";
        $bookOrder = @mysqli_query($dbc, $placeOrder);

        //to redirect to other page
        header("location:confirm.php");

        //write update query to after placing order change the quantity of book
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

<body style="background-color:khaki">
    <br><br>
    <form action="checkout.php" method="POST" style="margin:auto;width:50%;margin-top:20px;padding:20px">
        <div class="form-group row">
            <label for="firstname" class="col-sm-2 col-form-label">FirstName</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="" name="Fname" placeholder="First name">
            </div>
        </div>
        <br>
        <div class="form-group row">
            <label for="lastname" class="col-sm-2 col-form-label">LastName</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="" name="Lname" placeholder="Last name">
            </div>
        </div>
        <br>
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="" name="Email" placeholder="Email">
            </div>
        </div>
        <br>
        <div class="form-group row">
            <label for="payment" class="col-sm-2 col-form-label">Payment Type</label>
            <div class="col-sm-10">
                <input type="radio" name="payment" value="creditcard">
                Credit card
                <input type="radio" name="payment" value="gogglepay">
                Google Pay
            </div>
        </div>
        <br>
        <div class="form-group row">
            <div class="offset-sm-2 col-sm-10 text-center">
                <input type="submit" value="Place order" name="submit" class="btn btn-primary" />
            </div>
        </div>


    </form>
</body>

</html>