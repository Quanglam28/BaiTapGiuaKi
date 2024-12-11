<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sinh Viên</title>
    <style>
        /* Cơ bản */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin: 8px 0;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        input[type="date"],
        select,
        input[type="number"],
        input[type="radio"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0 15px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="radio"] {
            width: auto;
        }

        .radio-label {
            display: inline-block;
            margin-right: 15px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }

        .footer a {
            text-decoration: none;
            color: #4CAF50;
        }
    </style>
</head>
<body></body>
<?php
include "connect.php"; // Đảm bảo kết nối cơ sở dữ liệu


if (isset($_POST['add'])) {
    // Lấy dữ liệu từ form
    $fullname = $_POST['fullname'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $hometown = $_POST['hometown'];
    $level = $_POST['level'];
    $group = $_POST['group'];

    // Chuẩn bị câu lệnh SQL để thêm sinh viên vào cơ sở dữ liệu
    $sql = "INSERT INTO table_students (fullname, dob, gender, hometown, level, `group`) 
            VALUES ('$fullname', '$dob', '$gender', '$hometown', '$level', '$group')";

    // Thực thi câu lệnh SQL và kiểm tra kết quả
    if (mysqli_query($conn, $sql)) {
        // Nếu thành công, chuyển hướng về danh sách sinh viên
        header('Location: students.php');
        exit(); // Đảm bảo dừng script sau khi chuyển hướng
    } else {
        // Nếu có lỗi, hiển thị thông báo lỗi
        echo "Lỗi: " . mysqli_error($conn);
    }
    
}
?>



<br><br>
<form action="add.php" method="post" enctype="multipart/form-data">
    <label for="fullname">Họ và tên:</label>
    <input type="text" id="fullname" name="fullname" required><br><br>

    <label for="dob">Ngày sinh:</label>
    <input type="date" id="dob" name="dob" required><br><br>

    <label for="gender">Giới tính:</label>
    <input type="radio" id="male" name="gender" value="Nam">
    <label for="male">Nam</label>
    <input type="radio" id="female" name="gender" value="Nữ">
    <label for="female">Nữ</label><br><br>

    <label for="hometown">Quê quán:</label>
    <input type="text" id="hometown" name="hometown" required><br><br>

    <label for="level">Trình độ học vấn:</label>
    <select name="level" id="level" required>
        <option value="0">Tiến Sĩ</option>
        <option value="1">Thạc Sĩ</option>
        <option value="2">Kỹ Sư</option>
        <option value="3">Khác</option>
    </select><br><br>

    <label for="group">Nhóm:</label>
    <input type="number" id="group" name="group" required><br><br>

    <button id="submit" name="add"> Gửi</button>
    
</form>

