<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "QL_NhanSu";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Lấy mã nhân viên cần xóa từ URL
$maNV = $_GET['id'] ?? '';

// Kiểm tra xem mã nhân viên có tồn tại không
if (!empty($maNV)) {
    // Xóa nhân viên từ bảng NHANVIEN
    $sql = "DELETE FROM NHANVIEN WHERE Ma_NV='$maNV'";

    if ($conn->query($sql) === TRUE) {
        // Chuyển hướng người dùng về trang thông tin nhân viên sau khi xóa thành công
        header("Location: ThongtinNV_admin.php");
        exit(); // Dừng kịp thời để đảm bảo chuyển hướng hoạt động
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Mã nhân viên không hợp lệ!";
}

$conn->close();
?>
