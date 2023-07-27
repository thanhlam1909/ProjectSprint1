<?php 
include_once 'index_process.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ</title>

    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <header><?php include_once 'header.php'; ?></header>
    <div class='chuyentrang'><?php include_once 'slide-image.php' ?></div>

    <div class="gallery">
        <?php
        // Định nghĩa số lượng sản phẩm trên mỗi trang
        $productsPerPage = 20;
        // Xác định trang hiện tại
        $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
        // Tính số sản phẩm bắt đầu và kết thúc của trang hiện tại
        $startProduct = ($currentPage - 1) * $productsPerPage;
        $endProduct = $startProduct + $productsPerPage;
        // Lấy toàn bộ dữ liệu từ cơ sở dữ liệu và lưu vào một mảng
        $productsArray = array();
        while ($row = $result->fetch_assoc()) {
            $productsArray[] = $row;
        }
        $totalProducts = count($productsArray);

        if ($totalProducts > 0) {
            // Xử lý việc chỉ hiển thị các sản phẩm tương ứng với trang hiện tại
            for ($i = $startProduct; $i < min($endProduct, $totalProducts); $i++) {
                $row = $productsArray[$i];
                echo "<div class='laptop'>";
                echo "<a href='/layout/product_details.php?id=" . $row['id'] . "'>"; // Link to product details page

                // Hiển thị thông tin ảnh sản phẩm
                if (!empty($row['image_url'])) {
                    echo "<img src='action/" . $row['image_url'] . "' alt='Laptop Image'>";
                } else {
                    echo "<img src='img/laptop.png' alt='Default Image'>";
                }

                echo "<p><strong>" . $row['laptop_name'] . "</strong></p>";
                echo "<p>" . $row['price_range'] . "</p>";
                echo "</a>";
                echo "</div>";

            }
            $totalPages = ceil($totalProducts / $productsPerPage);
            for ($page = 1; $page <= $totalPages; $page++) {
                echo "<div class='centered-element'>"   ;
    
                 echo "<a class= 'page-link''href='?page=" . $page . "'>" . $page . "</a> ";
                 echo "</div>";
            }
            echo "</div>";
            
        } else {
            echo "<p>No laptops found in the database.</p>";
        }

        $conn->close();
        ?>

     
        
    </div>

    <footer><?php include_once 'footer.php'; ?></footer>
</body>

</html>