<?php //include("admin_loginchk.php");
//นำเข้าไฟล์เชื่อมต่อ DB
   include("conn.php");
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>ระบบหลังร้าน - ลงทะเบียนสมาชิก</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
    <?php
        //Sidebar
        include("sidebar.php");
       ?>
        <main class="main-content">
            <header class="header">
                <h1>ลงทะเบียนสมาชิกใหม่</h1>
            </header>
            <div class="content">
            <form id="registerForm" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="fullName">ชื่อ-สกุล:</label>
                        <input type="text" id="mname" name="mname" required>
                    </div>
                    <div class="form-group">
                        <label>เพศ:</label>
                        <div class="radio-group">
                            <label><input type="radio" name="mgender" value="m" required> ชาย</label>
                            <label><input type="radio" name="mgender" value="f" required> หญิง</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">ที่อยู่:</label>
                        <textarea id="maddress" name="maddress" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="province">จังหวัด:</label>
                        <select id="mprovince" name="mprovince" required>
                            <option value="">เลือกจังหวัด</option>
                            <option value="41">อุดรธานี</option>
                            <option value="43">หนองคาย</option>
                            <option value="42">เลย</option>
                            <!-- เพิ่มจังหวัดอื่นๆ ตามต้องการ -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="mphone">เบอร์โทรศัพท์:</label>
                        <input type="tel" id="mphone" name="mphone" required>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" id="memail" name="memail" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="mpassword" name="mpassword" required>
                    </div>
                    <div class="form-group">
                        <label for="mpicture">รูปโปรไฟล์:</label>
                        <div class="image-upload" id="imageUpload">
                            <input type="file" id="mpicture" name="mpicture" accept="image/*">
                            <p>คลิกที่นี่เพื่ออัปโหลดรูปภาพ หรือลากและวางรูปภาพ</p>
                            <img id="imagePreview" class="image-preview" src="" alt="Image preview" style="display: none;">
                        </div>
                    </div>
                    <button type="submit">บันทึก</button>
                </form>
            </div>
        </main>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const toggleSidebar = document.getElementById('toggleSidebar');
        const toggleIcon = toggleSidebar.querySelector('i');
        const navLinks = document.querySelectorAll('.nav-link span');

        toggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            if (sidebar.classList.contains('collapsed')) {
                toggleIcon.classList.remove('fa-bars');
                toggleIcon.classList.add('fa-chevron-right');
            } else {
                toggleIcon.classList.remove('fa-chevron-right');
                toggleIcon.classList.add('fa-bars');
            }
            navLinks.forEach(link => {
                link.style.display = link.style.display === 'none' ? 'inline' : 'none';
            });
        });

        const imageUpload = document.getElementById('imageUpload');
        const mpicture = document.getElementById('mpicture');
        const imagePreview = document.getElementById('imagePreview');

        imageUpload.addEventListener('click', () => mpicture.click());

        imageUpload.addEventListener('dragover', (e) => {
            e.preventDefault();
            imageUpload.style.border = '2px solid #3498db';
        });

        imageUpload.addEventListener('dragleave', () => {
            imageUpload.style.border = '2px dashed #ccc';
        });

        imageUpload.addEventListener('drop', (e) => {
            e.preventDefault();
            imageUpload.style.border = '2px dashed #ccc';
            if (e.dataTransfer.files.length > 0) {
                mpicture.files = e.dataTransfer.files;
                updateImagePreview();
            }
        });

        mpicture.addEventListener('change', updateImagePreview);

        function updateImagePreview() {
            const file = mpicture.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }
       /*
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // ที่นี่คุณสามารถเพิ่มโค้ดสำหรับส่งข้อมูลไปยัง server หรือจัดการข้อมูลตามต้องการ
            console.log('ชื่อ-สกุล:', this.mname.value);
            console.log('เพศ:', this.mgender.value);
            console.log('ที่อยู่:', this.maddress.value);
            console.log('จังหวัด:', this.mprovince.value);
            console.log('เบอร์โทรศัพท์:', this.mphone.value);
            console.log('E-mail:', this.memail.value);
            console.log('รูปโปรไฟล์:', this.mpicture.files[0]);

            alert('บันทึกข้อมูลสมาชิกเรียบร้อยแล้ว');
            this.reset();
            imagePreview.style.display = 'none'; 
        });*/
    </script>
    <?php
   if(isset($_POST['mname'])) {
    //กำหนดตัวแปร เพื่อเก็บค่า $_POST โดยวนลูปให ้ครบทุกค่าจากฟอร์ม และตั้งชอื่ ตัวแปรตามชื่อในฟอร์ม
        foreach ($_POST as $formkey => $formval) {
        ${$formkey} = $formval;
        }
//------------------------------------อัพโหลดรูป--------------------------------------------------
    if (move_uploaded_file( $_FILES['mpicture']['tmp_name']  ,
         ("photo/".$_FILES['mpicture']['name']))) {
            $mpicture = $_FILES['mpicture']['name'];
            }
            else {
            $mpicture = "";
            echo "ไม่มีไฟล์รูปภาพค่ะ";
            }
        
    //INSERT
    $table = "tb_member";
    $sql = "INSERT INTO $table
            VALUES ('',
            '$mname',
            '$mgender',
            '$maddress',
            '$mprovince',
            '$mphone',
            '$memail',
            '$mpassword',
            '$mpicture',
             NOW())";

            if (mysqli_query($conn, $sql)) { // ให้ query ทำงาน ผ่านการเชื่อมต่อ DB ด้วย $conn
            echo "เพิ่มข้อมูลสำเร็จ";
            } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            mysqli_close($conn);  //ปิดการเชื่อมต่อ DB   
   }
    ?>
</body>
</html>