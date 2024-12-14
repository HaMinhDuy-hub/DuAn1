<div class="content-wrapper">
    <h2>Sửa thông tin người dùng</h2>
    <form action="index.php?act=edit_user&id=<?= $user['id'] ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="fullname">Họ và tên:</label>
            <input type="text" class="form-control" id="fullname" name="fullname" value="<?= $user['fullname'] ?>" required>
        </div>
        <div class="form-group">
            <label for="username">Tên đăng nhập:</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= $user['username'] ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" required>
        </div>
        <div class="form-group">
            <label for="role_id">Vai trò:</label>
            <select class="form-control" id="role_id" name="role_id">
                <option value="1" <?= $user['role_id'] == 1 ? 'selected' : '' ?>>Quản trị viên</option>
                <option value="2" <?= $user['role_id'] == 2 ? 'selected' : '' ?>>Người dùng</option>
            </select>
        </div>
        <div class="form-group">
            <label for="avatar">Hình đại diện:</label>
            <input type="file" class="form-control" id="avatar" name="avatar">
        </div>
        <div class="form-group">
            <label for="is_active">Trạng thái:</label>
            <select class="form-control" id="is_active" name="is_active">
                <option value="1" <?= $user['is_active'] ? 'selected' : '' ?>>Hoạt động</option>
                <option value="0" <?= !$user['is_active'] ? 'selected' : '' ?>>Ngưng hoạt động</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="index.php?act=list_users" class="btn btn-secondary">Hủy</a>
    </form>
</div>
