<div class="content-wrapper">
    <h2>Danh sách bình luận</h2>
    <a href="index.php?act=archive_comment" class="btn btn-secondary mb-3">Kho lưu trữ</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Người dùng</th>
                <th>Sản phẩm</th>
                <th>Nội dung</th>
                <th>Ngày tạo</th>
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
                        <a href="index.php?act=delete_comment&id=<?= $comment['id'] ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Bạn có chắc chắn muốn xóa bình luận này?')">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
