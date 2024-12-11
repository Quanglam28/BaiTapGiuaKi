<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sinh viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #ffe4e1;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            padding: 20px;
        }
        .header {
            background-color:#f8c7cc;
            color: black;
            text-align: center;
            padding: 15px 0;
            font-size: 24px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table th, table td {
            text-align: left;
            padding: 10px;
            border: 1px solid #ddd;
        }
        table th {
            background-color: #4caf50;
            color: white;
        }
        table tr:nth-child(even) {
            background-color: #f8c7cc;
        }
        .buttons {
            text-align: center;
            margin: 20px 0;
        }
        .buttons button {
            background-color:  #d63384;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin: 5px;
        }
        .buttons button:hover {
            background-color: #45a049;
        }
        .action-buttons {
            display: flex;
            justify-content: space-around;
        }
        .action-buttons a {
            display: inline-block;
            text-decoration: none;
            margin: 0;
            padding: 5px 10px;
            color: white;
            border-radius: 5px;
            font-size: 14px;
        }
        .btn-edit {
            background-color: #ffa500;
        }
        .btn-delete {
            background-color: #f44336;
        }
        .btn-edit:hover {
            background-color: #e69500;
        }
        .btn-delete:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>

<?php
include 'connect.php'; // Kết nối cơ sở dữ liệu

$sql = "SELECT id, fullname, dob, gender, hometown, level, `group` FROM table_students";
$result = $conn->query($sql);
?>

<div class="container">
    <div class="header">DANH SÁCH SINH VIÊN</div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Họ và Tên</th>
                <th>Ngày Sinh</th>
                <th>Giới Tính</th>
                <th>Quê Quán</th>
                <th>Học Vấn</th>
                <th>Nhóm</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['fullname']}</td>
                        <td>{$row['dob']}</td>
                        <td>" . ($row['gender'] == 1 ? 'Nam' : 'Nữ') . "</td>
                        <td>{$row['hometown']}</td>
                        <td>" . ($row['level'] == 0 ? 'Tiến Sĩ' : ($row['level'] == 1 ? 'Thạc Sĩ' : ($row['level'] == 2 ? 'Kỹ Sư' : 'Khác'))) . "</td>
                        <td>{$row['group']}</td>
                        <td class='action-buttons'>
                            <a href='edit.php?id={$row['id']}' class='btn-edit'>Sửa</a>
                            <a href='delete.php?id={$row['id']}' class='btn-delete' onclick='return confirm(\"Bạn có chắc chắn muốn xóa sinh viên này?\");'>Xóa</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='8'>Không có sinh viên nào.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <div class="buttons">
        <a href="search.php">
            <button>Tìm kiếm sinh viên</button>
        </a>
        <a href="add.php">
            <button>Thêm sinh viên</button>
        </a>
    </div>
</div>

<?php
$conn->close(); // Đóng kết nối cơ sở dữ liệu
?>

</body>
</html>
