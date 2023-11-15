<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý bản tin</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Danh sách bản tin</h2>

    <!-- Form tìm kiếm -->
    <form action="timkiem.php" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Tìm kiếm theo từ khóa" name="keyword">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
            </div>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Tiêu đề</th>
                <th>Nội dung</th>
                <th>Từ khóa</th>
                <th>Chi tiết</th> <!-- Thêm cột mới -->
            </tr>
        </thead>
        <tbody>
            <?php
            // Kết nối đến database
            $conn = mysqli_connect("localhost", "root", "", "ql_sach2");

            // Kiểm tra kết nối
            if (!$conn) {
                die("Kết nối không thành công: " . mysqli_connect_error());
            }

            // Phân trang
            $limit = 4; // Số bản ghi trên mỗi trang
            $page = isset($_GET['page']) ? $_GET['page'] : 1; // Trang hiện tại
            $start = ($page - 1) * $limit; // Vị trí bắt đầu lấy dữ liệu

            // Query lấy dữ liệu từ database với phân trang
            $sql = "SELECT id_bantin, tieude, noidung, tukhoa FROM tbl_bantin LIMIT $start, $limit";
            $result = mysqli_query($conn, $sql);

            // Hiển thị dữ liệu
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['tieude']}</td>";
                echo "<td>{$row['noidung']}</td>";
                echo "<td>{$row['tukhoa']}</td>";
                // Thêm liên kết để xem chi tiết
                echo "<td><a href='detail.php?id={$row['id_bantin']}' class='btn btn-info'>Xem chi tiết</a></td>";
                echo "</tr>";
            }

            // Đóng kết nối
            mysqli_close($conn);
            ?>
        </tbody>
    </table>

    <!-- Phân trang -->
    <?php
    // Kết nối đến database
    $conn = mysqli_connect("localhost", "root", "", "ql_sach2");

    // Query lấy tổng số bản ghi
    $sql = "SELECT COUNT(*) AS total FROM tbl_bantin";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $total_records = $row['total'];

    // Tính số trang
    $total_pages = ceil($total_records / $limit);

    // Hiển thị phân trang
    echo "<ul class='pagination'>";
    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<li class='page-item'><a class='page-link' href='index.php?page=$i'>$i</a></li>";
    }
    echo "</ul>";

    // Đóng kết nối
    mysqli_close($conn);
    ?>
</div>

<!-- Include Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
