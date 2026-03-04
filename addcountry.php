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

    try {
        $sql_insert = "INSERT INTO country (CountryCode, CountryName) VALUES (:CountryCode, :CountryName)";
        $stmt = $conn->prepare($sql_insert);

        $stmt->bindParam(':CountryCode', $_POST['CountryCode']);
        $stmt->bindParam(':CountryName', $_POST['CountryName']);

        if ($stmt->execute()):
            // ถ้าเพิ่มสำเร็จ ให้โชว์ Alert แล้วกลับไปหน้า index.php
            echo "<script>
                    alert('เพิ่มข้อมูลประเทศสำเร็จ!');
                    window.location.href = 'index.php';
                  </script>";
        else:
            echo "<script>alert('ไม่สามารถเพิ่มข้อมูลประเทศได้');</script>";
        endif;
    } catch (PDOException $e) {
        // ดักจับ Error เช่น กรณีใส่รหัสประเทศซ้ำ
        echo "<script>
                alert('เกิดข้อผิดพลาด: " . $e->getMessage() . "');
                window.history.back();
              </script>";
    }
endif;
?>