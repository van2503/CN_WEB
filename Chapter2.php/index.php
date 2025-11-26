<!DOCTYPE html> 
<html lang="vi"> 
<head> 
<meta charset="UTF-8"> 
<title>PHT Chương 2 - PHP Căn Bản</title> 
</head> 
<body> 
<h1>Kết quả PHP Căn Bản</h1> 
<?php 
//TODO 1: Khai báo 3 biến 
    $ho_ten = "Trinh Thi Van";
    $diem_tb = 7.75;
    $co_di_hoc_chuyen_can = true;
// TODO 2: In ra thông tin sinh viên 
    echo "Ho va ten: $ho_ten<br>";
    echo "Diem trung binh: $diem_tb<br>";
 // TODO 3: Viết cấu trúc IF/ELSE IF/ELSE (2.2) 
   if ($diem_tb >= 8.5 && $co_di_hoc_chuyen_can == true){
    echo "Xep loai: Gioi";
   }else if ($diem_tb >= 6.5 && $co_di_hoc_chuyen_can == true){
    echo "Xep loai: Kha";
   }else if ($diem_tb >= 5.0 && $co_di_hoc_chuyen_can == true){
    echo "Xep loai: Trung binh";
   }else{
    echo "Xep loai: Yeu(Can co gang them)";
   }
 // TODO 4: Viết 1 hàm đơn giản (2.3) 
   function chaoMung(){
    echo "<br>Chuc mung ban da hoan thanh PHP chuong 2!";
   }
//TODO 5: Gọi tên hàm vừa tạo
   chaoMung();
   ?>
   </body>
   </html>

