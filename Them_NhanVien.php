<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
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
    <div class="container">
        <h2>Thêm Nhân Viên</h2>
        <form action="Them_NhanVien.php" method="post">
            <div class="form-group">
                <label for="Ma_NV">Mã Nhân Viên:</label>
                <input type="text" id="Ma_NV" name="Ma_NV">
            </div>
            <div class="form-group">
                <label for="Ten_NV">Tên Nhân Viên:</label>
                <input type="text" id="Ten_NV" name="Ten_NV">
            </div>
            <div class="form-group">
                <label for="Phai">Giới Tính:</label>
                <input type="text" id="Phai" name="Phai">
            </div>
            <div class="form-group">
                <label for="Noi_Sinh">Nơi Sinh:</label>
                <input type="text" id="Noi_Sinh" name="Noi_Sinh">
            </div>
            <div class="form-group">
                <label for="Ma_Phong">Mã Phòng:</label>
                <input type="text" id="Ma_Phong" name="Ma_Phong">
            </div>
            <div class="form-group">
                <label for="Luong">Lương:</label>
                <input type="text" id="Luong" name="Luong">
            </div>
            <input type="submit" value="Thêm Nhân Viên" class="btn-submit">
        </form>
        <?php
        // Kiểm tra và xử lý dữ liệu từ form
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "QL_NhanSu";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $maNV = $_POST['Ma_NV'] ?? '';
            $tenNV = $_POST['Ten_NV'] ?? '';
            $phai = $_POST['Phai'] ?? '';
            $noiSinh = $_POST['Noi_Sinh'] ?? '';
            $maPhong = $_POST['Ma_Phong'] ?? '';
            $luong = $_POST['Luong'] ?? '';

            if (!empty($maNV) && !empty($tenNV) && !empty($phai) && !empty($noiSinh) && !empty($maPhong) && !empty($luong)) {
                $sql = "INSERT INTO NHANVIEN (Ma_NV, Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong) VALUES ('$maNV', '$tenNV', '$phai', '$noiSinh', '$maPhong', $luong)";

                if ($conn->query($sql) === TRUE) {
                    header("Location: ThongtinNV_admin.php");
                    exit(); 
                } else {
                    echo "Lỗi: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "<div class='error-message'>Vui lòng điền đầy đủ thông tin vào form.</div>";
            }
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
