<div class="content-wrapper">
    <h2>Thêm người dùng mới</h2>
    <form action="index.php?act=add_user" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="fullname">Họ và tên:</label>
            <input type="text" class="form-control" id="fullname" name="fullname" required>
        </div>
        <div class="form-group">
            <label for="username">Tên đăng nhập:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="role_id">Vai trò:</label>
            <select class="form-control" id="role_id" name="role_id">
                <option value="1">Quản trị viên</option>
                <option value="0">Người dùng</option>
            </select>
        </div>
        <div class="form-group">
            <label for="avatar">Hình đại diện:</label>
            <input type="file" class="form-control" id="avatar" name="avatar">
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
        <a href="index.php?act=list_users" class="btn btn-secondary">Hủy</a>
        <a href="index.php?act=list_user" class="btn btn-warning">Danh sách</a>
    </form>
</div>
