<?php
require("mysqli_connect.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['firstname'])) {
        echo "Please enter firstname.";
    } else {
        $firstname = mysqli_real_escape_string($dbc, $_POST['firstname']);
    }

    if (empty($_POST['lastname'])) {
        echo "Please enter lastname.";
    } else {
        $lastname = mysqli_real_escape_string($dbc, $_POST['lastname']);
    }

    if (isset($_POST['payment'])) {
        $payment =  mysqli_real_escape_string($dbc, $_POST['payment']);
    } else {
        echo "Please select payment method.";
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
    <form action="checkout.php" method="post">
        <p>First Name: <input type="text" name="firstname" value="
        <?php
        if (isset($firstname)) {
            echo $firstname;
        }
        ?>
        "></p>


        <p>Last Name: <input type="text" name="lastname" value="
        <?php
        if (isset($lastname)) {
            echo $lastname;
        }
        ?>
        "></p>

        <p><label for="payment">Payment Options:</label>
            <input type="radio" name="payment" value="creditcard"
                <?php if (isset($_POST['payment']) && $_POST['payment'] == 'creditcard') echo 'checked="checked"' ?>>
            Credit card
            <input type="radio" name="payment" value="gogglepay"
                <?php if (isset($_POST['payment']) && $_POST['payment'] == 'gogglepay') echo 'checked="checked"' ?>>
            Google Pay
        </p>

        <p><input type="button" name="submit" value="Place order"></p>

    </form>
</body>

</html>