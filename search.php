<?php
include "connect.php"; // Kết nối cơ sở dữ liệu
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm Kiếm Học Viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8c7cc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #ffe4e1;
            border-radius: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 600px;
            padding: 30px;
            text-align: center;
            color: #333;
        }
        .container h2 {
            color: #d63384;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        .buttons {
            margin-top: 20px;
        }
        .buttons button {
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            background-color: #d63384;
            color: white;
            font-size: 16px;
        }
        .results {
            margin-top: 20px;
            text-align: left;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tìm Kiếm Sinh Viên</h2>
        <form action="" method="get">
            <div class="form-group">
                <label for="keyword">Từ Khóa (Tên hoặc Quê Quán)</label>
                <input type="text" id="keyword" name="keyword" placeholder="Nhập từ khóa..." required>
            </div>
            <div class="buttons">
                <button type="submit">Tìm Kiếm</button>
            </div>
        </form>

        <div class="results">
            <?php
            // Xử lý tìm kiếm khi có từ khóa
            if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
                $noidung = mysqli_real_escape_string($conn, $_GET['keyword']);

                // Truy vấn dữ liệu
                $sql = "SELECT * FROM table_students 
                        WHERE fullname LIKE '%$noidung%' 
                        OR hometown LIKE '%$noidung%'";
                $result = mysqli_query($conn, $sql);

                // Kiểm tra và hiển thị kết quả
                if (mysqli_num_rows($result) > 0) {
                    echo "<h3>Kết Quả Tìm Kiếm:</h3>";
                    echo "<table border='1' cellpadding='10' cellspacing='0' style='width: 100%; text-align: left;'>";
                    echo "<tr>
                            <th>Họ và Tên</th>
                            <th>Ngày Sinh</th>
                    
                            <th>Quê Quán</th>
                            
                          </tr>";
                          
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>" . $row['fullname'] . "</td>
                                <td>" . $row['dob'] . "</td>
                                
                                <td>" . $row['hometown'] . "</td>
                                
                              </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>Không tìm thấy kết quả nào.</p>";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
