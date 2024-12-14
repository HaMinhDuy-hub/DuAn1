<div class="content-wrapper">
    <h2>Danh sách người dùng</h2>
    <a href="index.php?act=add_user" class="btn btn-primary mb-3">Thêm người dùng</a>
    <a href="index.php?act=archive_users" class="btn btn-secondary mb-3">Kho lưu trữ</a>
    <?php if (isset($message)) echo "<p class='alert alert-success'>$message</p>"; ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên đầy đủ</th>
                <th>Tên đăng nhập</th>
                <th>Email</th>
                <th>Vai trò</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
        <?php $index = 1; ?> 
            <?php foreach ($users as $user): ?>
                <tr>
                <td><?= $index++ ?></td>
                    <td><?= $user['fullname'] ?></td>
                    <td><?= $user['username'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= htmlspecialchars($user['role_name']) ?></td>
                                    <td>
                    <?php if ($user['is_active']): ?>
                        <span class="badge bg-success">Kích hoạt</span>
                        <a href="index.php?act=toggle_active_user&id=<?= $user['id'] ?>&status=0" 
                        class="btn btn-warning btn-sm ms-2"
                        onclick="return confirm('Bạn có chắc chắn muốn ngừng kích hoạt tài khoản này?')">Ngừng kích hoạt</a>
                    <?php else: ?>
                        <span class="badge bg-danger">Ngừng kích hoạt</span>
                        <a href="index.php?act=toggle_active_user&id=<?= $user['id'] ?>&status=1" 
                        class="btn btn-success btn-sm ms-2"
                        onclick="return confirm('Bạn có chắc chắn muốn kích hoạt tài khoản này?')">Kích hoạt</a>
                    <?php endif; ?>
                </td>
                    <td>
                        <a href="index.php?act=edit_user&id=<?= $user['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                        <a href="index.php?act=delete_user&id=<?= $user['id'] ?>" 
                            class="btn btn-danger btn-sm" 
                            onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này?')">Xóa</a>
                    </td>
                </tr>
                
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
