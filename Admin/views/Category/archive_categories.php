<div class="content-wrapper">
    <h2>Kho lưu trữ</h2>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên danh mục</th>
                <th>Ngày xóa</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $deletedCategories = Category::getDeletedCategories();
            foreach ($deletedCategories as $category) {
                echo "<tr>";
                echo "<td>{$category['id']}</td>";
                echo "<td>{$category['name']}</td>";
                echo "<td>{$category['deleted_at']}</td>";
                echo "<td>
                        <a href='index.php?act=restore_category&id={$category['id']}' class='btn btn-success'>Khôi phục</a>
                        <a href='index.php?act=list_categories' class='btn btn-secondary'>Danh sách</a>
                      </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
