<?php
$archivedUsers = User::getArchived();
?>

<div class="content-wrapper">
    <h2>Kho lưu trữ người dùng</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Họ và tên</th>
                <th>Tên đăng nhập</th>
                <th>Email</th>
                <th>Vai trò</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($archivedUsers as $user): ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['fullname'] ?></td>
                    <td><?= $user['username'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['role_name'] ?></td>
                    <td>
                        <a href="index.php?act=restore_user&id=<?= $user['id'] ?>" 
                           class="btn btn-success btn-sm"
                           onclick="return confirm('Bạn có chắc chắn muốn khôi phục tài khoản này?')">Khôi phục</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
