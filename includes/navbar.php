<style>
    @import url(http://fonts.googleapis.com/css?family=Kanit);
    body {
        font-family: 'Kanit', sans-serif;
    }
</style>
    <header class="p-3 text-bg-dark ">
    <div class="">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <svg class="bi me-10" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="#SLEEPY-PET" class="nav-link px-3 text-dark btn btn-warning text-dark me-2 "onclick="window.location.href='index.php'" >หน้าหลัก</a></li>
          <li><a href="#About" class="nav-link px-4 text-white" href="about.php" >ติดต่อ</a></li>
          <li><a href="#" class="nav-link px-4 text-white">เกี่ยวกับเรา</a></li>
          <li><a href="#SERVICE" class="nav-link px-4 text-white">บริการ</a></li>
        </ul>
        <div class="text-end">
        <?php
        if ($_SESSION == NULL) {
          ?>
          <button class="btn btn-outline-warning" type="submit" onclick="window.location.href='login.php'">เข้าสู่ระบบ</button>
          <?php
        }else{
          ?>
          <div class="btn-group">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
              <?php echo "<i class='bi bi-people'></i> ".$result_tb_user[3].' '.$result_tb_user[4].' '; ?></button>
            <ul class="dropdown-menu dropdown-menu-lg-end">
              <li><button class="dropdown-item" type="button" onclick="window.location.href='profile.php'">ข้อมูลส่วนตัว</button></li>
              <?php
              if ($_SESSION["user_level"] == "admin") {
                ?>
                <li><button class="dropdown-item" type="button" onclick="window.location.href='admin/index.php'">Admin-System</button></li>
                <?php
              }
              ?>
              <hr>
              <li><button class="dropdown-item" type="button" onclick="window.location.href='logout.php'">ออกจากระบบ</button></li>
            </ul>
          </div>
          <?php
        }
        ?>
        
      </div>
    </div>
  </div>
</nav>
