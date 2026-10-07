<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบหลังร้าน - เพิ่มสินค้า</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <?php
        //Sidebar
        include("sidebar.php");
    ?>
        <main class="main-content">
            <header class="header">
                <h1>เพิ่มสินค้าใหม่</h1>
            </header>
            <div class="content">
                <form id="addProductForm" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="productName">ชื่อสินค้า:</label>
                        <input type="text" id="pname" name="pname" required>
                    </div>
                    <div class="form-group">
                        <label for="productDescription">รายละเอียดสินค้า:</label>
                        <textarea id="pdetail" name="pdetail" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="productPrice">ราคา:</label>
                        <input type="number" id="pprice" name="pprice" min="0" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="productCategory">หมวดหมู่:</label>
                        <select id="ptype" name="ptype" required>
                            <option value="">เลือกหมวดหมู่</option>
                            <option value="1">เสื้อ</option>
                            <option value="2">กระโปรง</option>
                            <option value="3">ชุดเดรส</option>
                            <option value="4">กางเกง</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="productStock">จำนวนสินค้าในคลัง:</label>
                        <input type="number" id="pqty" name="pqty" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="productStock">หน่วยนับ:</label>
                        <input type="text" id="punit" name="punit" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="productImage">รูปภาพสินค้า 1:</label>
                        <div class="image-upload" id="imageUpload">
                            <input type="file" id="ppic1" name="ppic1" accept="image/*">
                            <p>คลิกที่นี่เพื่ออัปโหลดรูปภาพ หรือลากและวางรูปภาพ</p>
                            <img id="imagePreview" class="image-preview" src="" alt="Image preview" style="display: none;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="productImage2">รูปภาพสินค้า 2:</label>
                        <div class="image-upload" id="imageUpload2">
                            <input type="file" id="ppic2" name="ppic2" accept="image/*">
                            <p>คลิกที่นี่เพื่ออัปโหลดรูปภาพ หรือลากและวางรูปภาพ</p>
                            <img id="imagePreview2" class="image-preview" src="" alt="Image preview" style="display: none;">
                        </div>
                    </div>
                    <button type="submit">เพิ่มข้อมูลสินค้า</button>
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

        // Image upload 1
        const imageUpload = document.getElementById('imageUpload');
        const productImage = document.getElementById('ppic1');
        const imagePreview = document.getElementById('imagePreview');

        imageUpload.addEventListener('click', () => productImage.click());

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
                productImage.files = e.dataTransfer.files;
                updateImagePreview();
            }
        });

        productImage.addEventListener('change', updateImagePreview);

        function updateImagePreview() {
            const file = productImage.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }

        // Image upload 2
        const imageUpload2 = document.getElementById('imageUpload2');
        const productImage2 = document.getElementById('ppic2');
        const imagePreview2 = document.getElementById('imagePreview2');

        imageUpload2.addEventListener('click', () => productImage2.click());

        imageUpload2.addEventListener('dragover', (e) => {
            e.preventDefault();
            imageUpload2.style.border = '2px solid #3498db';
        });

        imageUpload2.addEventListener('dragleave', () => {
            imageUpload2.style.border = '2px dashed #ccc';
        });

        imageUpload2.addEventListener('drop', (e) => {
            e.preventDefault();
            imageUpload2.style.border = '2px dashed #ccc';
            if (e.dataTransfer.files.length > 0) {
                productImage2.files = e.dataTransfer.files;
                updateImagePreview2();
            }
        });

        productImage2.addEventListener('change', updateImagePreview2);

        function updateImagePreview2() {
            const file = productImage2.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    imagePreview2.src = e.target.result;
                    imagePreview2.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }

        // Form submission
        document.getElementById('addProductForm').addEventListener('submit', function(e) {
            e.preventDefault();
            console.log('ชื่อสินค้า:', this.pname.value);
            console.log('รายละเอียดสินค้า:', this.pdetail.value);
            console.log('ราคา:', this.pprice.value);
            console.log('หมวดหมู่:', this.ptype.value);
            console.log('จำนวนสินค้าในคลัง:', this.pqty.value);
            console.log('หน่วยนับ:', this.punit.value);
            console.log('รูปภาพสินค้า 1:', this.ppic1.files[0]);
            console.log('รูปภาพสินค้า 2:', this.ppic2.files[0]);

            alert('บันทึกข้อมูลสินค้าเรียบร้อยแล้ว');
            this.reset();
            imagePreview.style.display = 'none';
            imagePreview2.style.display = 'none';
        });
    </script>
</body>
</html>