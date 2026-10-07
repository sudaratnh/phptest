<?php //include("admin_loginchk.php");
//นำเข้าไฟล์เชื่อมต่อ DB
   include("conn.php");
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบหลังร้าน - รายชื่อสมาชิก</title>
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
                <h1>รายชื่อสมาชิก</h1>
                <a href="member_fm.php">
                <button class="btn btn-primary" id="addProductBtn">
                    <i class="fas fa-plus"></i> เพิ่มสมาชิกใหม่
                </button>
                </a>
            </header>
            <div class="content">
                <form class="search-form" id="searchForm">
                    <input type="text" name="search" id="searchInput" placeholder="ค้นหาสมาชิกจากชื่อ">
                    <button type="submit" class="btn btn-primary">ค้นหา</button>
                </form>
                <table id="productTable">
                    <thead>
                        <tr>
                            <th>รหัสสมาชิก</th>
                            <th>ชื่อ-สกุล</th>
                            <th>เพศ</th>
                            <th>จังหวัด</th>
                            <th>เบอร์โทรศัพท์</th>
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
    <?php
    //คำสั่ง Query ข้อมูล มาแสดง
     $table = 'tb_member';
     if(isset($_POST['search'])) {
        $search = $_POST['search'];
        $where = " WHERE mname LIKE '%$search%'";
     }else{
        $where ="";
     }   
     $sql_select = "SELECT * FROM $table".$where;

     //สั่งให้ Query ทำงาน
     $result = mysqli_query($conn,$sql_select);
    //ถ้าได้ผลลัพธ์ อย่างน้อย 1 แถว
     if (mysqli_num_rows($result)>0) {
    
    ?>
    <script>
      // ข้อมูลตัวอย่างสินค้า (ในการใช้งานจริง ข้อมูลนี้ควรมาจาก backend)
        const member = [
          <?php  
           while($row=mysqli_fetch_array($result)){
            switch ($row[2]) {
                case 'm': $gname="ชาย"; break;   
                case 'f': $gname="หญิง"; break;   
            }
            //จังหวัด 39-41-42-43
            switch ($row[4]) {
                case '39': $pname="หนองบัวลำภู"; break;   
                case '41': $pname="อุดรธานี"; break;   
                case '42': $pname="เลย"; break;   
                case '43': $pname="หนองคาย"; break;   
            }
            echo "
                { id: '$row[0]', 
                name: '$row[1]', 
                gender: '$gname', 
                province: '$pname', 
                phone: '$row[5]' },";    
        } // ปิด loop while
       ?>
        ];

        const itemsPerPage = 10;
        let currentPage = 1;
        let filteredmember = [...member];

        const productTable = document.getElementById('productTable');
        const prevPageBtn = document.getElementById('prevPage');
        const nextPageBtn = document.getElementById('nextPage');
        const searchForm = document.getElementById('searchForm');
        const searchInput = document.getElementById('searchInput');

        function rendermember() {
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const paginatedmember = filteredmember.slice(startIndex, endIndex);

            const tbody = productTable.querySelector('tbody');
            tbody.innerHTML = '';

            paginatedmember.forEach(member => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${member.id}</td>
                    <td>${member.name}</td>
                    <td>${member.gender}</td>
                    <td>${member.province}</td>
                    <td>${member.phone}</td>
                    <td>
                        <div class="action-buttons">
                         <a href="member_edit.php?mid=${member.id}">
                            <button class="btn btn-primary"><i class="fas fa-edit"></i> แก้ไข</button>
                        </a> 
                            <a href="member_list.php?mid=${member.id}">
                              <button class="btn btn-danger"><i class="fas fa-trash"></i> ลบ</button>
                            </a>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });

            updatePaginationButtons();
        }

        function updatePaginationButtons() {
            prevPageBtn.disabled = currentPage === 1;
            nextPageBtn.disabled = currentPage === Math.ceil(filteredmember.length / itemsPerPage);
        }

        prevPageBtn.addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                rendermember();
            }
        });

        nextPageBtn.addEventListener('click', () => {
            if (currentPage < Math.ceil(filteredmember.length / itemsPerPage)) {
                currentPage++;
                rendermember();
            }
        });

        searchForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const searchTerm = searchInput.value.toLowerCase();
            filteredmember = member.filter(member => 
                member.name.toLowerCase().includes(searchTerm)
            );
            currentPage = 1;
            rendermember();
        });

        // เริ่มต้นแสดงสินค้า
        rendermember();

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
   <?php   } //ปิด if num rows ?>
     
   <?php
    if(isset($_GET['mid'])){
        //GET รับค่าตัวแปรที่ส่งผ่าน URL
        $mid = $_GET['mid'];
        $sql_delete = "DELETE FROM $table WHERE mid = '$mid'";
        //สั่งให้ query ทำงานและตรวจสอบ
        if(mysqli_query($conn, $sql_delete)){
            echo "<script>alert('ลบข้อมูลเรียบร้อย')</script>"; //popupแจ้ง
            echo "<script>window.location='$_SERVER[PHP_SELF]'</script>"; //Refresh
        }else{
            echo "Error:".$sql_delete."<br>".mysqli_error($conn);
        }
        mysqli_close(); //ปิดการเชื่อมต่อ DB
    }
   ?>
</body>
</html>