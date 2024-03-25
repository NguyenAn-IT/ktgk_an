<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Information (Admin)</title>
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

        .add-btn {
            text-decoration: none;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
            margin-bottom: 10px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <h2>Thông Tin Nhân Viên (Dành cho Admin)</h2>
    <a href='Them_NhanVien.php' class='add-btn'>Thêm Nhân Viên</a>
    <table>
        <tr>
            <th>Mã Nhân Viên</th>
            <th>Tên Nhân Viên</th>
            <th>Giới Tính</th>
            <th>Nơi Sinh</th>
            <th>Tên Phòng</th>
            <th>Lương</th>
            <th>Thao Tác</th>
        </tr>
        <?php
        $servername = "localhost";
        $username = "root"; 
        $password = ""; 
        $dbname = "QL_NhanSu";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql_count = "SELECT COUNT(*) AS total FROM NHANVIEN";
        $result_count = $conn->query($sql_count);
        $row_count = $result_count->fetch_assoc();
        $total_records = $row_count['total'];

        $limit = 5;

        $total_pages = ceil($total_records / $limit);

        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

        $start = ($current_page - 1) * $limit;

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
            echo "<td>" . $row['Ten_Phong'] . "</td>";
            echo "<td>" . $row['Luong'] . "</td>";
            echo "<td><a href='Edit_NhanVien.php?id=" . $row['Ma_NV'] . "'>Sửa</a> | <a href='Delete_NhanVien.php?id=" . $row['Ma_NV'] . "'>Xoá</a></td>";
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
