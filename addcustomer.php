<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Customer</title>
</head>

<body>

    <h1>Add Customer</h1>

    <?php
    require 'connect.php';

    if (!empty($_POST['customerID']) && !empty($_POST['Name'])) {
        $sql_insert = "INSERT INTO customer (CustomerID, Name, Birthdate, Email, CountryCode, OutstandingDebt) 
                       VALUES (:customerID, :Name, :birthdate, :email, :countryCode, :outstandingDebt)";

        $stmt = $conn->prepare($sql_insert);
        $stmt->bindParam(':customerID', $_POST['customerID']);
        $stmt->bindParam(':Name', $_POST['Name']);
        $stmt->bindParam(':birthdate', $_POST['birthdate']);
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':countryCode', $_POST['countryCode']);
        $stmt->bindParam(':outstandingDebt', $_POST['outstandingDebt']);

        try {
            if ($stmt->execute()) {
                echo "<script>
                        alert('เพิ่มข้อมูลลูกค้าสำเร็จ!');
                        window.location.href = 'index.php';
                      </script>";
            }
        } catch (PDOException $e) {
            echo "<script>
                    alert('เกิดข้อผิดพลาด: " . $e->getMessage() . "');
                    window.history.back();
                  </script>";
        }
    }

    $sql_countries = "SELECT CountryCode, CountryName FROM country ORDER BY CountryName ASC";
    $stmt_countries = $conn->prepare($sql_countries);
    $stmt_countries->execute();
    $countries = $stmt_countries->fetchAll();
    ?>

    <form action="addcustomer.php" method="POST">
        Customer ID: <br>
        <input type="text" name="customerID" placeholder="Enter Customer ID" required maxlength="6">
        <br><br>

        Name: <br>
        <input type="text" name="Name" placeholder="Enter Name" required>
        <br><br>

        Birthdate: <br>
        <input type="date" name="birthdate" required>
        <br><br>

        Email: <br>
        <input type="email" name="email" placeholder="Enter Email" required>
        <br><br>

        Country: <br>
        <select name="countryCode" required>
            <option value="">-- Select Country --</option>
            <?php foreach ($countries as $country) { ?>
                <option value="<?= $country['CountryCode'] ?>">
                    <?= htmlspecialchars($country['CountryName']) ?> (<?= $country['CountryCode'] ?>)
                </option>
            <?php } ?>
        </select>
        <br><br>

        Outstanding Debt: <br>
        <input type="number" step="0.01" name="outstandingDebt" placeholder="0.00" required>
        <br><br>

        <input type="submit" value="Submit">
    </form>

</body>

</html>