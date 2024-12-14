<?php
// Kết nối cơ sở dữ liệu
require_once 'pdo.php';

// Kiểm tra xem người dùng có nhập từ khóa tìm kiếm không
if (isset($_GET['query'])) {
    $query = $_GET['query'];
    
    // Tìm kiếm trong bảng products và comments
    $sql = "
        SELECT p.name AS product_name, c.content AS comment_content, c.created_at
        FROM comments c
        JOIN products p ON c.product_id = p.id
        WHERE c.content LIKE ? OR p.name LIKE ?
    ";
    
    // Thực thi truy vấn tìm kiếm
    $params = ['%' . $query . '%', '%' . $query . '%'];
    $results = pdo_query($sql, $params);
}
?>

<!-- Hiển thị kết quả tìm kiếm -->
<div class="content-wrapper">
    <h2>Kết quả tìm kiếm cho: "<?= htmlspecialchars($query) ?>"</h2>
    
    <?php if (empty($results)): ?>
        <p>Không có kết quả phù hợp.</p>
    <?php else: ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Bình luận</th>
                    <th>Ngày tạo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $result): ?>
                    <tr>
                        <td><?= htmlspecialchars($result['product_name']) ?></td>
                        <td><?= htmlspecialchars($result['comment_content']) ?></td>
                        <td><?= $result['created_at'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
