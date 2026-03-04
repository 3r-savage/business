<?php
require 'connect.php';

if (isset($_POST['CustomerID'])) {

    $customerID = $_POST['CustomerID'];
    $name = $_POST['Name'];
    $birthdate = $_POST['Birthdate'];
    $email = $_POST['Email'];
    $countryCode = $_POST['CountryCode'];
    $outstandingDebt = $_POST['OutstandingDebt'];

    try {
        $sql = "UPDATE customer 
                SET Name = :Name, 
                    Birthdate = :Birthdate, 
                    Email = :Email, 
                    CountryCode = :CountryCode, 
                    OutstandingDebt = :OutstandingDebt 
                WHERE CustomerID = :CustomerID";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':Name', $name);
        $stmt->bindParam(':Birthdate', $birthdate);
        $stmt->bindParam(':Email', $email);
        $stmt->bindParam(':CountryCode', $countryCode);
        $stmt->bindParam(':OutstandingDebt', $outstandingDebt);
        $stmt->bindParam(':CustomerID', $customerID);

        if ($stmt->execute()) {
            echo "<script>
                    alert('อัปเดตข้อมูลสำเร็จแล้ว');
                    window.location.href = 'index.php';
                  </script>";
        }
    } catch (PDOException $e) {
        echo "<script>
                alert('เกิดข้อผิดพลาด: " . $e->getMessage() . "');
                window.history.back();
              </script>";
    }
} else {
    header("Location: index.php");
}
