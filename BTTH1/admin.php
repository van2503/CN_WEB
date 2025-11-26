<?php
require_once 'data.php'; 

$page_title = 'Trang Admin - Danh sách các loài hoa';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 20px; 
            background-color: #f4f7f6;
            color: #333;
        }
        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
        }
        .add-new { 
            margin-bottom: 20px; 
            display: inline-block; 
            background-color: #28a745; 
            color: white; 
            padding: 10px 15px; 
            border-radius: 5px; 
            text-decoration: none; 
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .add-new:hover {
            background-color: #218838;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
            background-color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden; /* Đảm bảo góc bo tròn hoạt động */
        }
        th, td { 
            border: 1px solid #e0e0e0; 
            padding: 12px 15px; 
            text-align: left; 
            vertical-align: middle; /* Căn giữa nội dung ô theo chiều dọc */
        }
        th { 
            background-color: #f8f8f8; 
            font-weight: bold;
            color: #555;
            text-transform: uppercase;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <h1><?php echo $page_title; ?></h1>
    <a class="add-new" href="add_data.php">Thêm Hoa Mới</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Hoa</th>
                <th>Mô Tả</th>
                <th>Hình Ảnh</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($flowers as $flower): ?>
            <tr>
                <td><?php echo $flower['id']; ?></td>
                <td><?php echo $flower['ten_hoa']; ?></td>
                <td><?php echo substr($flower['mo_ta'], 0, 100) . '...'; ?></td>
               <td>
                    <img src="<?php echo $flower['hinh_anh']; ?>" alt="<?php echo $flower['ten_hoa']; ?>" class="flower-image">
                </td>
                <td>
                    <a href="edit_flower.php?id=<?php echo $flower['id']; ?>">Sửa</a> | 
                    <a href="delete_flower.php?id=<?php echo $flower['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa hoa này?');">Xóa</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p class="back-link"><a href="user.php">Quay lại Trang Khách</a></p>
</body>
</html>
