<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>🛸 ระบบฐานข้อมูลดาวอังคาร v.99 🛸</title>
    <style>
        @keyframes strobe {
            0% {
                background-color: #ff0000;
            }

            20% {
                background-color: #00ff00;
            }

            40% {
                background-color: #0000ff;
            }

            60% {
                background-color: #ffff00;
            }

            80% {
                background-color: #ff00ff;
            }

            100% {
                background-color: #00ffff;
            }
        }

        body {
            /* พื้นหลังกะพริบแบบทำลายประสาทตา */
            animation: strobe 0.1s steps(1) infinite;
            font-family: 'Kanit', 'Comic Sans MS', sans-serif;
            cursor: url('https://cur.cursors-4u.net/symbols/sym-1/sym46.cur'), auto;
            overflow-x: hidden;
            text-align: center;
        }

        /* หัวข้อที่หมุนตลอดเวลา */
        .ultra-header {
            font-size: 100px;
            font-weight: 900;
            color: white;
            text-shadow: 10px 10px 0px #000, -10px -10px 0px #ff0000;
            display: inline-block;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg) scale(1);
            }

            to {
                transform: rotate(360deg) scale(1.5);
            }
        }

        /* ตารางสไตล์รถแห่ */
        .table-hell {
            margin: 100px auto;
            border: 20px double #fff;
            background: rgba(0, 0, 0, 0.8);
            color: #0f0;
            font-size: 30px;
            box-shadow: 0 0 100px #fff, inset 0 0 50px #0f0;
            transition: 0.2s;
        }

        /* เมื่อเอาเมาส์ชี้ ตารางจะสั่นสู้ */
        .table-hell:hover {
            transform: skew(20deg) rotate(-10deg);
            filter: invert(1);
        }

        th {
            background: #ff0000;
            color: white;
            padding: 30px;
            border: 5px solid yellow;
        }

        td {
            padding: 15px;
            border: 2px solid white;
            position: relative;
        }

        /* เอฟเฟกต์ไฟวิ่งขอบจอ */
        .border-light {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 30px dashed yellow;
            pointer-events: none;
            animation: border-dance 0.2s linear infinite;
            z-index: 1000;
        }

        @keyframes border-dance {
            0% {
                border-color: yellow;
            }

            50% {
                border-color: red;
                border-style: dotted;
            }

            100% {
                border-color: lime;
            }
        }

        /* ปุ่มลบหนี้ที่หนีเมาส์ (ปุ่มกดไม่ได้) */
        #scary-button {
            position: fixed;
            padding: 20px 50px;
            background: black;
            color: white;
            font-size: 40px;
            border-radius: 50px;
            z-index: 9999;
        }

        .meme-gif {
            position: absolute;
            width: 100px;
            display: none;
        }

        td:hover .meme-gif {
            display: block;
            top: -50px;
            left: 50%;
        }
    </style>
</head>

<body onmousemove="moveButton(event)" onclick="playScarySound()">

    <div class="border-light"></div>

    <div class="ultra-header">💸 จ่ายหนี้ !!! 💸</div>

    <button id="scary-button">ลบหนี้ (คลิกให้โดนนะจ๊ะ)</button>

    <?php
    require "connect.php";
    $sql = "SELECT * FROM customer";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    ?>

    <table class="table-hell" width="95%">
        <thead>
            <tr>
                <th>รหัสลับ</th>
                <th>เหยื่อรายที่</th>
                <th>วันเกิด (เตรียมฉลอง)</th>
                <th>ที่อยู่ไซเบอร์</th>
                <th>ถิ่นฐาน</th>
                <th>ยอดเงินที่ต้องทวง</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr onmouseover="playBeep()">
                    <td>
                        <?php echo $result["CustomerID"]; ?>
                        <img src="https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExM3Z5bm5ueG5ueG5ueG5ueG5ueG5ueG5ueG5ueG5ueG5ueG5ueG5ueCZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9cw/8fxad4tvqBnS8/giphy.gif" class="meme-gif">
                    </td>
                    <td>
                        <marquee behavior="alternate" scrollamount="15"><?php echo $result["Name"]; ?></marquee>
                    </td>
                    <td><?php echo $result["Birthdate"]; ?></td>
                    <td><b><?php echo $result["Email"]; ?></b></td>
                    <td align="center">👽 <?php echo $result["CountryCode"]; ?></td>
                    <td align="right" style="color: yellow; font-family: 'Digital-7', sans-serif; font-size: 40px;">
                        <?php echo number_format($result["OutstandingDebt"], 0); ?>.-
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <marquee scrollamount="50" direction="right">
        <img src="https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExM2Z5bm5ueG5ueG5ueG5ueG5ueG5ueG5ueG5ueG5ueG5ueG5ueG5ueCZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9cw/X8YmInf7Y8SjLwB1pU/giphy.gif" width="200">
        <h1 style="display:inline; color: white; font-size: 80px;"> ข้อมูลหลุดแล้วจ้าาาาาาาาาาาา </h1>
    </marquee>

    <script>
        // ฟังก์ชันปุ่มหนีเมาส์
        function moveButton(e) {
            const btn = document.getElementById('scary-button');
            const x = Math.random() * (window.innerWidth - 200);
            const y = Math.random() * (window.innerHeight - 100);

            // ถ้าเมาส์เข้าใกล้ปุ่มในระยะ 100px ให้ปุ่มวาร์ปหนี
            let dx = Math.abs(e.pageX - btn.offsetLeft);
            let dy = Math.abs(e.pageY - btn.offsetTop);

            if (dx < 150 && dy < 150) {
                btn.style.left = x + 'px';
                btn.style.top = y + 'px';
            }
        }

        function playBeep() {
            let audio = new Audio('https://www.soundjay.com/buttons/button-10.mp3');
            audio.play();
        }

        function playScarySound() {
            let audio = new Audio('https://www.myinstants.com/media/sounds/discord-notification.mp3');
            audio.play();
        }
    </script>

</body>

</html>