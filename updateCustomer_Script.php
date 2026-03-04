<?php
require 'connect.php';

// ตรวจสอบว่ามีการกดปุ่ม Submit ส่งข้อมูลมาหรือไม่
if (isset($_POST['CustomerID'])) {

    // รับค่าตัวแปรทั้งหมดจาก Form
    $customerID = $_POST['CustomerID'];
    $name = $_POST['Name'];
    $birthdate = $_POST['Birthdate'];
    $email = $_POST['Email'];
    $countryCode = $_POST['CountryCode'];
    $outstandingDebt = $_POST['OutstandingDebt'];

    try {
        // คำสั่ง SQL สำหรับอัปเดตข้อมูลทุกฟิลด์ ตาม CustomerID
        $sql = "UPDATE customer 
                SET Name = :Name, 
                    Birthdate = :Birthdate, 
                    Email = :Email, 
                    CountryCode = :CountryCode, 
                    OutstandingDebt = :OutstandingDebt 
                WHERE CustomerID = :CustomerID";

        $stmt = $conn->prepare($sql);

        // ผูกตัวแปร (Bind Parameters) ป้องกัน SQL Injection
        $stmt->bindParam(':Name', $name);
        $stmt->bindParam(':Birthdate', $birthdate);
        $stmt->bindParam(':Email', $email);
        $stmt->bindParam(':CountryCode', $countryCode);
        $stmt->bindParam(':OutstandingDebt', $outstandingDebt);
        $stmt->bindParam(':CustomerID', $customerID);

        // ถ้าอัปเดตสำเร็จ ให้แสดงแจ้งเตือนและกลับหน้าหลัก
        if ($stmt->execute()) {
            echo "<script>
                    alert('อัปเดตข้อมูลสำเร็จแล้ว');
                    window.location.href = 'index.php';
                  </script>";
        }
    } catch (PDOException $e) {
        // ถ้ามี Error ให้แจ้งเตือนและย้อนกลับ
        echo "<script>
                alert('เกิดข้อผิดพลาด: " . $e->getMessage() . "');
                window.history.back();
              </script>";
    }
} else {
    // ถ้าไม่มีข้อมูล POST ส่งมาเลย ให้เด้งกลับหน้า index
    header("Location: index.php");
}
