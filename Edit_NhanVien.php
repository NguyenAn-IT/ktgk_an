<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "QL_NhanSu";
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$maNV = $_GET['id'] ?? '';

if (empty($maNV)) {
    echo "Lỗi: Không tìm thấy mã nhân viên!";
    exit;
}


$sql = "SELECT * FROM NHANVIEN WHERE Ma_NV='$maNV'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Lỗi: Không tìm thấy thông tin nhân viên!";
    exit;
}


$row = $result->fetch_assoc();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tenNV = $_POST['Ten_NV'];
    $phai = $_POST['Phai'];
    $noiSinh = $_POST['Noi_Sinh'];
    $maPhong = $_POST['Ma_Phong'];
    $luong = $_POST['Luong'];

    // Thực hiện cập nhật dữ liệu nhân viên
    $sql_update = "UPDATE NHANVIEN SET Ten_NV='$tenNV', Phai='$phai', Noi_Sinh='$noiSinh', Ma_Phong='$maPhong', Luong=$luong WHERE Ma_NV='$maNV'";
    if ($conn->query($sql_update) === TRUE) {
        // Chuyển hướng người dùng trở lại trang thông tin nhân viên
        header("Location: ThongtinNV_admin.php");
        exit;
    } else {
        echo "Lỗi: " . $sql_update . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .btn-submit {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        .btn-submit:hover {
            background-color: #45a049;
        }
        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<h2>Sửa Thông Tin Nhân Viên</h2>
<form action="Edit_NhanVien.php?id=<?php echo $maNV; ?>" method="post">
            <input type="hidden" name="Ma_NV" value="<?php echo $row['Ma_NV']; ?>">
            <div class="form-group">
                <label for="Ten_NV">Tên Nhân Viên:</label>
                <input type="text" id="Ten_NV" name="Ten_NV" value="<?php echo $row['Ten_NV']; ?>">
            </div>
            <div class="form-group">
                <label for="Phai">Giới Tính:</label>
                <input type="text" id="Phai" name="Phai" value="<?php echo $row['Phai']; ?>">
            </div>
            <div class="form-group">
                <label for="Noi_Sinh">Nơi Sinh:</label>
                <input type="text" id="Noi_Sinh" name="Noi_Sinh" value="<?php echo $row['Noi_Sinh']; ?>">
            </div>
            <div class="form-group">
                <label for="Ma_Phong">Mã Phòng:</label>
                <input type="text" id="Ma_Phong" name="Ma_Phong" value="<?php echo $row['Ma_Phong']; ?>">
            </div>
            <div class="form-group">
                <label for="Luong">Lương:</label>
                <input type="text" id="Luong" name="Luong" value="<?php echo $row['Luong']; ?>">
            </div>
            <input type="submit" value="Lưu Thay Đổi" class="btn-submit">
        </form>
    </body>
</html>