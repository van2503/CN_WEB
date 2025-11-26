<?php
// Đường dẫn đến tệp CSV của bạn
$file_path = '65HTTT_Danh_sach_diem_danh.csv'; 
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách Sinh viên CSV</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background-color: #f4f4f4; /* Nền xám nhạt */
            padding: 20px;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15); /* Thêm đổ bóng */
        }
        /* Tiêu đề bảng (sử dụng màu đen) */
        thead tr {
            background-color: #000000; /* Màu đen */
            color: #ffffff; /* Chữ trắng */
            text-align: left;
        }
        th, td {
            padding: 12px 15px;
            border: 1px solid #dddddd; /* Viền mờ */
        }
        /* Dữ liệu hàng */
        tbody tr {
            border-bottom: 1px solid #dddddd;
            color: #333;
            transition: background-color 0.3s ease;
        }
        /* Tạo hiệu ứng sọc ngựa vằn: màu xám nhạt cho hàng chẵn */
        tbody tr:nth-of-type(even) {
            background-color: #f3f3f3; 
        }
        /* Hiệu ứng di chuột */
        tbody tr:hover {
            background-color: #e0e0e0;
            cursor: pointer;
        }
        /* Hàng cuối cùng không có viền dưới */
        tbody tr:last-of-type {
            border-bottom: 2px solid #000000;
        }
    </style>
</head>
<body>

<?php
echo "<h1>Danh sách Sinh viên</h1>";

// Kiểm tra xem tệp có tồn tại không
if (!file_exists($file_path)) {
    die("Lỗi: Không tìm thấy tệp CSV tại đường dẫn: " . htmlspecialchars($file_path));
}

// Mở tệp để đọc
// Sử dụng hàm die() thay vì htmlspecialchars() cho đường dẫn trong thông báo lỗi
$handle = fopen($file_path, "r");

if ($handle === FALSE) {
    die("Lỗi: Không thể mở tệp.");
}

// Bắt đầu tạo bảng HTML (đã loại bỏ style inline)
echo "<table>";

// Biến cờ để kiểm tra hàng đầu tiên (tiêu đề)
$header = true;

// Lặp qua từng dòng của tệp CSV
while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    // 1. Xử lý Hàng Tiêu đề
    if ($header) {
        echo "<thead><tr>";
        // Lặp qua các cột để tạo tiêu đề
        foreach ($data as $col_name) {
            // Đã loại bỏ style inline
            echo "<th>" . strtoupper(htmlspecialchars($col_name)) . "</th>";
        }
        echo "</tr></thead><tbody>";
        // Đánh dấu đã đọc xong tiêu đề
        $header = false;
        continue; // Bỏ qua lần lặp này và sang dòng tiếp theo (dữ liệu)
    }

    // 2. Xử lý Hàng Dữ liệu
    echo "<tr>";
    // Lặp qua các cột để tạo dữ liệu
    foreach ($data as $col_value) {
        // Đã loại bỏ style inline
        echo "<td>" . htmlspecialchars($col_value) . "</td>";
    }
    echo "</tr>";
}

// Kết thúc bảng
echo "</tbody></table>";

// Đóng tệp sau khi hoàn thành
fclose($handle);

?>
</body>
</html>