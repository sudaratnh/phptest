<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบหลังร้าน - รายการสินค้า</title>
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
                <h1>รายการสินค้า</h1>
                <a href="product_fm.php">
                    <button class="btn btn-primary" id="addProductBtn">
                        <i class="fas fa-plus"></i> เพิ่มสินค้าใหม่
                    </button>
                </a>
            </header>
            <div class="content">
                <form class="search-form" id="searchForm">
                    <input type="text" id="searchInput" placeholder="ค้นหาสินค้าจากชื่อ">
                    <button type="submit" class="btn btn-primary">ค้นหา</button>
                </form>
                <table id="productTable">
                    <thead>
                        <tr>
                            <th>รหัสสินค้า</th>
                            <th>ชื่อสินค้า</th>
                            <th>ราคา</th>
                            <th>หมวดหมู่</th>
                            <th>จำนวนคงเหลือ</th>
                            <th>การดำเนินการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- ข้อมูลสินค้าจะถูกเพิ่มที่นี่ด้วย JavaScript -->
                    </tbody>
                </table>
                <div class="pagination">
                    <button id="prevPage" disabled>ก่อนหน้า</button>
                    <button id="nextPage">ถัดไป</button>
                </div>
            </div>
        </main>
    </div>

    <script>
        // ข้อมูลตัวอย่างสินค้า (ในการใช้งานจริง ข้อมูลนี้ควรมาจาก backend)
        const products = [
            { id: 'P001', name: 'สินค้า A', price: 100, category: 'อิเล็กทรอนิกส์', stock: 50 },
            { id: 'P002', name: 'สินค้า B', price: 200, category: 'เสื้อผ้า', stock: 30 },
            { id: 'P003', name: 'สินค้า C', price: 150, category: 'อาหาร', stock: 100 },
            { id: 'P004', name: 'สินค้า D', price: 300, category: 'อิเล็กทรอนิกส์', stock: 20 },
            { id: 'P005', name: 'สินค้า E', price: 250, category: 'เสื้อผ้า', stock: 40 },
            { id: 'P006', name: 'สินค้า F', price: 180, category: 'อาหาร', stock: 60 },
            { id: 'P007', name: 'สินค้า G', price: 220, category: 'อิเล็กทรอนิกส์', stock: 35 },
            { id: 'P008', name: 'สินค้า H', price: 190, category: 'เสื้อผ้า', stock: 45 },
            { id: 'P009', name: 'สินค้า I', price: 280, category: 'อาหาร', stock: 25 },
            { id: 'P010', name: 'สินค้า J', price: 350, category: 'อิเล็กทรอนิกส์', stock: 15 },
            { id: 'P011', name: 'สินค้า K', price: 270, category: 'เสื้อผ้า', stock: 55 },
            { id: 'P012', name: 'สินค้า L', price: 210, category: 'อาหาร', stock: 70 },
        ];

        const itemsPerPage = 10;
        let currentPage = 1;
        let filteredProducts = [...products];

        const productTable = document.getElementById('productTable');
        const prevPageBtn = document.getElementById('prevPage');
        const nextPageBtn = document.getElementById('nextPage');
        const searchForm = document.getElementById('searchForm');
        const searchInput = document.getElementById('searchInput');

        function renderProducts() {
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const paginatedProducts = filteredProducts.slice(startIndex, endIndex);

            const tbody = productTable.querySelector('tbody');
            tbody.innerHTML = '';

            paginatedProducts.forEach(product => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${product.id}</td>
                    <td>${product.name}</td>
                    <td>${product.price}</td>
                    <td>${product.category}</td>
                    <td>${product.stock}</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-primary"><i class="fas fa-edit"></i> แก้ไข</button>
                            <button class="btn btn-danger"><i class="fas fa-trash"></i> ลบ</button>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });

            updatePaginationButtons();
        }

        function updatePaginationButtons() {
            prevPageBtn.disabled = currentPage === 1;
            nextPageBtn.disabled = currentPage === Math.ceil(filteredProducts.length / itemsPerPage);
        }

        prevPageBtn.addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                renderProducts();
            }
        });

        nextPageBtn.addEventListener('click', () => {
            if (currentPage < Math.ceil(filteredProducts.length / itemsPerPage)) {
                currentPage++;
                renderProducts();
            }
        });

        searchForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const searchTerm = searchInput.value.toLowerCase();
            filteredProducts = products.filter(product => 
                product.name.toLowerCase().includes(searchTerm)
            );
            currentPage = 1;
            renderProducts();
        });

        // เริ่มต้นแสดงสินค้า
        renderProducts();

        // Sidebar toggle functionality
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

        // Add Product button functionality (you can implement this to show a modal or navigate to a new page)
        document.getElementById('addProductBtn').addEventListener('click', () => {
            alert('เปิดฟอร์มเพิ่มสินค้าใหม่');
            // Implement your logic to show add product form
        });
    </script>
</body>
</html>