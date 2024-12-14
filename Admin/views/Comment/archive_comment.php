<div class="content-wrapper">
    <h2>Danh sách bình luận đã lưu trữ</h2>
    <a href="index.php?act=list_comments" class="btn btn-secondary mb-3">Quay lại danh sách bình luận</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Người dùng</th>
                <th>Sản phẩm</th>
                <th>Nội dung</th>
                <th>Ngày tạo</th>
                <th>Ngày xóa</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
        <?php $index = 1; ?> 
            <?php foreach ($comments as $comment): ?>
                <tr>
                    <td><?= $index++ ?></td>
                    <td><?= htmlspecialchars($comment['user_name']) ?></td>
                    <td><?= htmlspecialchars($comment['product_name']) ?></td>
                    <td><?= htmlspecialchars($comment['content']) ?></td>
                    <td><?= $comment['created_at'] ?></td>
                    <td>
                        <?php
                            // Kiểm tra xem deleted_at có tồn tại không và hiển thị nếu có
                            if (!empty($comment['deleted_at'])) {
                                echo $comment['deleted_at'];
                            } else {
                                echo 'Chưa bị xóa';
                            }
                        ?>
                    </td>
                    <td>
                        <a href="index.php?act=restore_comment&id=<?= $comment['id'] ?>" 
                           class="btn btn-success btn-sm"
                           onclick="return confirm('Bạn có chắc chắn muốn khôi phục bình luận này?')">Khôi phục</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
