<?php

function load_sanpham_home()
{
    $sql = "SELECT * FROM products WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 0, 9";
    return pdo_query($sql);
}

function loadall_sanpham_top10(){
    $sql="select * from products where 1 order by price desc limit 0,8";
    $listsanpham=pdo_query($sql);
    return $listsanpham;
}
function insert_sanpham($name, $price, $product_image, $description, $category_id)
{
    $sql = "INSERT INTO `products`(`name`, `price`, `product_image`, `description`, `category_id`) VALUES ('$name','$price','$product_image','$description','$category_id')";
    pdo_execute($sql);
}
function delete_sanpham($id)
{
    $sql = "DELETE FROM `products` WHERE id=" . $id;
    pdo_execute($sql);
}

function loadAll_sanphampage($keyw, $category_id) {
    $sql = "SELECT * FROM products WHERE deleted_at IS NULL";

    if ($category_id != "") {
        $sql .= " AND category_id = " . intval($category_id); // Tránh lỗi SQL Injection
    }

    if ($keyw != "") {
        $sql .= " AND name LIKE '%" . htmlspecialchars($keyw, ENT_QUOTES) . "%'"; // Xử lý chuỗi đầu vào an toàn
    }

    $sql .= " ORDER BY category_id ASC";
    $list_sp = pdo_query($sql);
    return $list_sp;
}


function update_sanpham($category_id, $id, $name, $price, $description, $product_image)
{
    if ($product_image != "") 
        $sql = "UPDATE `products` SET `category_id`='" . $category_id . "', `name`='" . $name . "',`price`='" . $price . "',`description`='" . $description . "',`product_image`='" . $product_image . "' WHERE id=" . $id;
    else 
        $sql = "UPDATE `products` SET `category_id`='" . $category_id . "', `name`='" . $name . "',`price`='" . $price . "',`description`='" . $description . "' WHERE id=" . $id; 
    pdo_execute($sql);
}
function loadone_sanpham($id)
{
    $sql = "SELECT * FROM products WHERE id=" . $id;
    $sp = pdo_query_one($sql);
    return $sp;
}
function load_sanpham_cungloai($id, $category_id) {
    $sql = "SELECT * FROM products WHERE category_id = $category_id AND id <> $id AND deleted_at IS NULL";
    $listsp = pdo_query($sql);
    return $listsp;
}

function loadAll_size(){
    $sql= "select * from sizes order by id asc";
    $size = pdo_query($sql);
    return $size;
}
function loadone_sanphamCart($idList) {
    $sql = 'SELECT * FROM products WHERE id IN ('. $idList . ')';
    $sanpham = pdo_query($sql);
    return $sanpham;
}