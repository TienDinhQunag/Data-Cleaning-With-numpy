<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết bản tin</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Chi tiết bản tin</h2>

    <?php
    // Kết nối đến database
    $conn = mysqli_connect("localhost", "root", "", "ql_sach2");

    // Kiểm tra kết nối
    if (!$conn) {
        die("Kết nối không thành công: " . mysqli_connect_error());
    }

    // Lấy id bản tin từ tham số URL
    $id_bantin = isset($_GET['id']) ? $_GET['id'] : 0;

    // Query lấy thông tin chi tiết từ database
    $sql = "SELECT * FROM tbl_bantin WHERE id_bantin = $id_bantin";
    $result = mysqli_query($conn, $sql);

    // Kiểm tra có bản tin hay không
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Hiển thị thông tin chi tiết
        echo "<p><strong>Tiêu đề:</strong> {$row['tieude']}</p>";
        echo "<p><strong>Nội dung:</strong> {$row['noidung']}</p>";
        echo "<p><strong>Từ khóa:</strong> {$row['tukhoa']}</p>";
        echo "<p><strong>Người đăng:</strong> {$row['nguontin']}</p>";
        echo "<p><strong>Lượt like:</strong> {$row['luotlike']}</p>";
        echo "<p><strong>Rating:</strong> {$row['rating']}</p>";
    } else {
        echo "<p>Không tìm thấy bản tin.</p>";
    }

    // Đóng kết nối
    mysqli_close($conn);
    ?>

    <!-- Nút quay lại trang trước -->
    <a href="javascript:history.go(-1)" class="btn btn-primary mt-3">Quay lại</a>
</div>

<!-- Include Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
