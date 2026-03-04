<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Customer</title>
</head>

<body>
    <h1>แก้ไขข้อมูลลูกค้า</h1>

    <?php
    require 'connect.php';

    // ตรวจสอบว่ามีการส่งค่า CustomerID มาหรือไม่
    if (isset($_GET['CustomerID'])) {
        $customerID = $_GET['CustomerID'];

        // 1. ดึงข้อมูลลูกค้าคนปัจจุบัน
        $sql_customer = "SELECT * FROM customer WHERE CustomerID = :id";
        $stmt = $conn->prepare($sql_customer);
        $stmt->bindParam(':id', $customerID);
        $stmt->execute();
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);

        // 2. ดึงข้อมูลประเทศทั้งหมดมาแสดงใน Dropdown
        $sql_countries = "SELECT CountryCode, CountryName FROM country ORDER BY CountryName ASC";
        $stmt_countries = $conn->prepare($sql_countries);
        $stmt_countries->execute();
        $countries = $stmt_countries->fetchAll(PDO::FETCH_ASSOC);

        if (!$customer) {
            echo "ไม่พบข้อมูลลูกค้า";
            exit;
        }
    } else {
        header("Location: index.php");
        exit;
    }
    ?>

    <form action="updateCustomer_script.php" method="POST">

        <input type="hidden" name="CustomerID" value="<?= htmlspecialchars($customer['CustomerID']) ?>">

        รหัสลูกค้า: <b><?= htmlspecialchars($customer['CustomerID']) ?></b> <br><br>

        ชื่อ-นามสกุล: <br>
        <input type="text" name="Name" value="<?= htmlspecialchars($customer['Name']) ?>" required>
        <br><br>

        วันเดือนปีเกิด: <br>
        <input type="date" name="Birthdate" value="<?= htmlspecialchars($customer['Birthdate']) ?>" required>
        <br><br>

        อีเมล: <br>
        <input type="email" name="Email" value="<?= htmlspecialchars($customer['Email']) ?>" required>
        <br><br>

        ประเทศ: <br>
        <select name="CountryCode" required>
            <option value="">-- Select Country --</option>
            <?php foreach ($countries as $country) { ?>
                <option value="<?= htmlspecialchars($country['CountryCode']) ?>"
                    <?= ($country['CountryCode'] == $customer['CountryCode']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($country['CountryName']) ?> (<?= htmlspecialchars($country['CountryCode']) ?>)
                </option>
            <?php } ?>
        </select>
        <br><br>

        ยอดหนี้: <br>
        <input type="number" step="0.01" name="OutstandingDebt" value="<?= htmlspecialchars($customer['OutstandingDebt']) ?>" required>
        <br><br>

        <input type="submit" value="บันทึกการแก้ไข">
        <a href="index.php"><button type="button">ยกเลิก</button></a>
    </form>

</body>

</html>