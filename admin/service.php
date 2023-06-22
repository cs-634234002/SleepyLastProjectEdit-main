<?php
require 'config.php';
if(isset($_POST['submit'])){
  $service = $_POST["service"];
  $status = $_POST["status"];
  $description = $_POST["description"];
  if($_FILES["image"]["error"] === 4){
    echo "<script>alert('ไม่พบรูปภาพ')</script>";
  }else{
    $fileName = $_FILES["image"]["name"];
    $fileSize = $_FILES["image"]["size"];
    $tmpName = $_FILES["image"]["tmp_name"];

    $validImageExtension = ['jpg','jpeg','png'];
    $imageExtension = explode('.',$fileName);
    $imageExtension = strtolower(end($imageExtension));
    if(!in_array($imageExtension,$validImageExtension)){
      echo "<script>alert('นามสกุลรูปภาพไม่ถูกต้อง')</script>";
    }
    else if($fileSize>1000000){
      echo "<script>alert('ขนาดรูปภาพใหญ่เกินไป')</script>";
    }else{
      $newImageName = uniqid();
      $newImageName .= '.' . $imageExtension;
      
      move_uploaded_file($tmpName, 'img/' . $newImageName);
      $query = "INSERT INTO tb_service VALUES ('$service','$status','$description','$newImageName')";
      mysqli_query($conn,$query);
      echo "<script>alert('บันทึกข้อมูลสำเร็จ')</script>";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/dashboard.css">
    <title>Document</title>
</head>
<body>
<style>
    @import url(http://fonts.googleapis.com/css?family=Kanit);
    body {
        font-family: 'Kanit', sans-serif;
    }
</style>
    <?php include 'include/header.php'; ?>
    <div class="container-fluid">
      <div class="row">
        <?php include 'include/sidebarMenu.php'; ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">ข้อมูลผู้บริการ</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <!-- เพิ่มข้อมูล -->
              <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#add_data">เพิ่มข้อมูลบริการ</button>
              <div class="modal fade" id="add_data" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                
            

                <form class="modal-content" method="post" action="" enctype="multipart/form-data">
                    <div class="modal-header">
                      <h5 class="modal-title">เพิ่มข้อมูลบริการ</h5>
                    </div>
                    <div class="modal-body">


                    <div class="mb-3">
                    <label for="service" class="form-label">ชื่อบริการ</label>
                    <input type="text" class="form-control" id="service" name="service" required>
                    </div>

                        <!-- <div class="mb-3">
                        <label class="form-label">จำนวน</label>
                        <select class="form-select" name="" id="quantity-select">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                          <option value="9">9</option>
                          <option value="10">10</option>
                        </select>
                      </div>

                      <div class="mb-3">
                      <label class="form-label">ราคา</label>
                      <input type="text" class="form-control" name="price" id="price-input" required/>
                    </div>

                    <div class="mb-3">
                    <label class="form-label">วันที่ฝาก</label>
                    <input type="date" class="form-control" name="user_date" required>
                    </div>

                    <div class="mb-3">
                    <label class="form-label">วันที่รับกลับ</label>
                    <input type="date" class="form-control" name="user_date" required>
                    </div>

                      <div class="mb-3">
                        <label class="form-label">เวลา</label>
                        <select class="form-select" name="user_time" onchange="checkTimeAvailability(this)">
                          <option value="9.00-10.00">9.00-11.00</option>
                          <option value="10.00-11.00">10.00-11.00</option>
                          <option value="11.00-12.00">11.00-12.00</option>
                          <option value="13.00-14.00">13.00-14.00</option>
                          <option value="14.00-15.00">14.00-15.00</option>
                          <option value="15.00-16.00">15.00-16.00</option>
                          <option value="16.00-17.00">16.00-17.00</option>
                        </select>
                      </div> -->

                      <div class="mb-3">
                      <label for="status" class="form-label">สถานะบริการ</label>
                      <input type="text" class="form-control" id="status" name="status" required>
                      </div>



                      <div class="mb-3">
                      <label class="form-label">รูปภาพ</label>
                      <input type="file" class="form-control" name="image" id="image" accept=".jpg, .jpeg, .png" value=""/>
                      </div>

                      <div class="mb-3">
                      <label for="description" class="form-label">คำอธิบายบริการ</label>
                      <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                      </div>
                      </div>


                    
                     <!-- บันทึกข้อมูลเข้าไปในตาราง -->
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                      <button type="submit" name="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          
          <table class="table table-bordered table-hover"> <!-- table-sm -->
            <thead>
              <tr class="table-warning">
                <th scope="col" style="text-align: center;" width="100px">ลำดับที่</th>
                <th scope="col" style="text-align: center;" width="150px">รูปภาพ</th>
                <th scope="col" style="text-align: center;" width="100px">ประเภทบริการ</th>
                <th scope="col" style="text-align: center;" width="200px">รายละเอียด</th>
                <th scope="col" style="text-align: center;" width="100px">สถานะ</th>
              </tr>
            </thead>
            <tbody>
          <script src="../assets/js/bootstrap.bundle.min.js"></script>
          <script src="../assets/js/bootstrap.bundle.min.js"></script>
          <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
          <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
          <script src="assets/dashboard.js"></script>
          <script>
            // ค้นหา element ของ select และ input
            const quantitySelect = document.getElementById('quantity-select');
            const priceInput = document.getElementById('price-input');

            // เพิ่มเหตุการณ์เมื่อมีการเปลี่ยนแปลงใน select
            quantitySelect.addEventListener('change', function() {
              const selectedQuantity = parseInt(quantitySelect.value); // ค่าจำนวนที่เลือก
              const additionalPrice = 300; // ราคาเพิ่มเติมที่ต้องการให้เพิ่ม

              const totalPrice = selectedQuantity * additionalPrice; // คำนวณราคารวม

              priceInput.value = totalPrice; // กำหนดค่าราคาให้กับ input
            });
          </script>

          <script>
            function checkTimeAvailability(selectElement) {
              const selectedTime = selectElement.value;
              const selectOptions = selectElement.getElementsByTagName('option');

              // ตรวจสอบตัวเลือกทั้งหมด
              for (let i = 0; i < selectOptions.length; i++) {
                const option = selectOptions[i];
                if (option.value !== selectedTime) {
                  option.disabled = false; // เปิดใช้งานตัวเลือกที่ไม่ซ้ำกัน
                } else {
                  option.disabled = true; // ปิดใช้งานตัวเลือกที่ซ้ำกัน
                }
              }
            }
          </script>

</body>
</html>
