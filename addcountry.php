<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Country</title>
</head>

<body>
    <!--Country-->
    <h1>Add Country</h1>
    <form action="addcountry.php" method="POST">
        <input type="text" placeholder="Enter Country code" name="CountryCode" required>
        <br><br>
        <input type="text" placeholder="Enter Country name" name="CountryName" required>
        <br><br>
        <input type="submit" value="Submit">
    </form>
</body>

</html>

<?php
//Country
if (!empty($_POST['CountryCode']) && !empty($_POST['CountryName'])):
    require 'connect.php';

    $sql_insert = "insert into country values (:CountryCode, :CountryName)";
    $stmt = $conn->prepare($sql_insert);

    $stmt->bindParam(':CountryCode', $_POST['CountryCode']);
    $stmt->bindParam(':CountryName', $_POST['CountryName']);

    if ($stmt->execute()):
        $message = 'Successfully added new country';
    // header("Location: /business/selectCountry1.php");
    else:
        $message = 'Failed to add new country';
    endif;

    echo $message;

    $conn = null;
endif;
?>