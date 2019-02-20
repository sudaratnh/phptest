<?php
        $servername = "127.0.0.1";
        $username = "root";
        $password = "password";

        // Create connection
        $conn = new mysqli($servername, $username, $password);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        echo "Connected successfully";
  
 
        $name = $_POST['name'];
        $level = $_POST['level'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <form action="insert.php" method="post" enctype="multipart/form-data">
        <div>
        <label for="name">ชื่อ-สกุล :</label>
        <input type="text" name="name" placeholder="กรอกชื่อ" required><br>
        </div>
    <div>
        <label for="level">ชั้นปี :</label><br>
        <select name="level" class="form-control" id="select">
                <option value="" selected>- เลือกชั้นปี -</option>
                <option value="1">ปี 1</option>
                <option value="2">ปี 2</option>
                <option value="3">ปี 3</option>
                <option value="4">ปี 4</option>
        </select><br>
    </div>
    <div>
        <label for="class">เลือกห้อง :</label><br>
        <input type="radio" name="class" value="1" /> ห้อง 1 <br>
        <input type="radio" name="class" value="2" /> ห้อง 2 <br>
    </div>
    <div>
        <button type="submit" class="btn btn-primary">เพิ่มข้อมูล</button>
        <button type="cancel" class="btn btn-secondary">ยกเลิก</button>
    </div>
    <form>


    
</body>
</html>



