<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Nhân Viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            background-color: #fff;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            width: 50px;
            height: auto;
        }

        .pagination {
            text-align: center;
            margin-top: 20px;
        }

        .pagination a {
            color: #000;
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color .3s;
            border: 1px solid #ddd;
            margin: 0 4px;
        }

        .pagination a.active {
            background-color: #4CAF50;
            color: white;
            border: 1px solid #4CAF50;
        }

        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <h2>Thông Tin Nhân Viên</h2>
    <table>
        <tr>
            <th>Mã Nhân Viên</th>
            <th>Tên Nhân Viên</th>
            <th>Giới Tính</th>
            <th>Nơi Sinh</th>
            <th>Tên Phòng</th>
            <th>Lương</th>
        </tr>
        <?php
        $servername = "localhost";
        $username = "root"; // Tên người dùng mặc định cho XAMPP
        $password = ""; // Mật khẩu rỗng hoặc không cần thiết lập mật khẩu
        $dbname = "QL_NhanSu";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Lấy số lượng nhân viên
        $sql_count = "SELECT COUNT(*) AS total FROM NHANVIEN";
        $result_count = $conn->query($sql_count);
        $row_count = $result_count->fetch_assoc();
        $total_records = $row_count['total'];

        // Số nhân viên mỗi trang
        $limit = 5;

        // Tính số trang
        $total_pages = ceil($total_records / $limit);

        // Xác định trang hiện tại
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

        // Xác định bản ghi đầu tiên của trang
        $start = ($current_page - 1) * $limit;

        // Lấy dữ liệu nhân viên cho trang hiện tại
        $sql = "SELECT n.Ma_NV, n.Ten_NV, n.Phai, n.Noi_Sinh, p.Ten_Phong, n.Luong 
                FROM NHANVIEN n 
                INNER JOIN PHONGBAN p ON n.Ma_Phong = p.Ma_Phong 
                LIMIT $start, $limit";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['Ma_NV'] . "</td>";
            echo "<td>" . $row['Ten_NV'] . "</td>";
            echo "<td>";
            if ($row['Phai'] == 'NU') {
                echo "<img src='woman.png' alt='Woman'>";
            } else {
                echo "<img src='man.png' alt='Man'>";
            }
            echo "</td>";
            echo "<td>" . $row['Noi_Sinh'] . "</td>";
            echo "<td>" . $row['Ten_Phong'] . "</td>"; // Hiển thị tên phòng
            echo "<td>" . $row['Luong'] . "</td>";
            echo "</tr>";
        }
        $conn->close();
        ?>
    </table>
    <div class="pagination">
        <?php
        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<a href='?page=$i'>$i</a> ";
        }
        ?>
    </div>
</body>
</html>
