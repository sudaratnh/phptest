<aside class="sidebar" id="sidebar">
    
            <button id="toggleSidebar">
                <i class="fas fa-bars"></i>
            </button>
            
            <div class="logo"><div><img src="img/suda.png" width="40%" alt=""></div>ADMIN</div>
            <div><?php // echo "คุณ ".$_SESSION["aname"]; ?></div>
            <br>
            <ul class="nav-menu">
                <li class="nav-item"><a href="admin_index.php" class="nav-link"><i class="fas fa-home"></i> <span>หน้าหลัก</span></a></li>
                <li class="nav-item"><a href="product_list.php" class="nav-link"><i class="fas fa-box"></i> <span>สินค้า</span></a></li>
                <li class="nav-item"><a href="member_list.php" class="nav-link"><i class="fas fa-users"></i> <span>สมาชิก</span></a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-shopping-cart"></i> <span>คำสั่งซื้อ</span></a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-chart-bar"></i> <span>รายงาน</span></a></li>
                <li class="nav-item"><a href="logout.php" class="nav-link"><span>ออกจากระบบ</span></a></li>
            </ul>
        </aside>