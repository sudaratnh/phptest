<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ - Admin SUDA SHOP</title>
    <style>
        body {
            font-family: 'Kanit', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            width: 300px;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            width: 80px;
            height: 80px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        input {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background-color: #000;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #333;
        }
        .forgot-password {
            text-align: center;
            margin-top: 15px;
        }
        .forgot-password a {
            color: #666;
            text-decoration: none;
        }
        .register {
            text-align: center;
            margin-top: 20px;
        }
        .register a {
            color: #000;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <img src="img/suda.png" alt="SUDA SHOP Logo">
        </div>
        <h1>เข้าสู่ระบบAdmin</h1>
        <form action="login_process.php" method="post">
            <label for="username">ชื่อผู้ใช้หรืออีเมล</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">รหัสผ่าน</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">เข้าสู่ระบบ</button>
        </form>
        <div class="forgot-password">
            <a href="forgot_password.php">ลืมรหัสผ่าน?</a>
        </div>
     </div>
     
   </html> 
