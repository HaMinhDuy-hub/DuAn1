<div class="content-wrapper">
    <h2>Sản phẩm đã xóa</h2>

    <?php if ($products): ?> <!-- Kiểm tra nếu có sản phẩm đã xóa -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Danh mục</th>
                    <th>Giá</th>
                    <th>Ngày xóa</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><?= $product['id'] ?></td>
                        <td><?= htmlspecialchars($product['name']) ?></td>
                        <td><?= htmlspecialchars($product['category_name']) ?></td> <!-- Hiển thị tên danh mục -->
                        <td><?= number_format($product['price'], 0, ',', '.') ?> VND</td>
                        <td><?= $product['deleted_at'] ?></td>
                        <td>
                            <a href="index.php?act=restore_product&id=<?= $product['id'] ?>" 
                               class="btn btn-success"
                               onclick="return confirm('Bạn có chắc muốn khôi phục sản phẩm này?')">Khôi phục</a>
                               <a href="index.php?act=delete_forever&id=<?= $product['id'] ?>" 
                                class="btn btn-danger"
                                onclick="return confirm('Bạn có chắc muốn xóa vĩnh viễn sản phẩm này?')">Xóa vĩnh viễn</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?> <!-- Nếu không có sản phẩm nào đã xóa -->
        <p>Không có sản phẩm nào đã xóa.</p>
    <?php endif; ?>

</div>
