<?php
$json_products =   file_get_contents('products.json');
$products = json_decode($json_products, true);
function addProduct($name, $price, $quantity)
{
    $GLOBALS['products'][] = ["name" => $name, "price" => $price, "quantity" => $quantity];
    file_put_contents('products.json', json_encode($GLOBALS['products']));
}
function displayProducts($products)
{
    if (empty($products)) {
        echo '<h1> danh sách trống </h1>';
    } else {

        foreach ($products as $product) {
            printf(
                "Tên sản phẩm: %s, Giá: %.2f, Số lượng: %d <br>",
                $product['name'],
                $product['price'],
                $product['quantity']
            );
        }
    }
}
function searchProduct($products, $keyword)
{
    $keywordTrimed = trim(strtolower($keyword));
    $listProductFound = [];
    foreach ($products as $product) {
        if ($product['name'] == $keywordTrimed || strpos($product['name'], $keywordTrimed)) {
            $listProductFound[] = $product;
        }
    }
    return $listProductFound;
}
function sortProductsByName(&$products)
{
    usort($products, function ($a, $b) {
        return strcmp($a['name'], $b['name']);
    });
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>


<form action="" method="POST">
    <label for="name">Tên sản phẩm:</label>
    <input type="text" id="name" name="name"><br><br>

    <label for="price">Giá:</label>
    <input type="number" id="price" name="price"><br><br>

    <label for="quantity">Số lượng:</label>
    <input type="number" id="quantity" name="quantity"><br><br>

    <button type="submit" name="action" value="search">Tìm kiếm</button>
    <input type="text" id="quantity" name="keyword" placeholder="keyword ban muon tim kiem"><br><br>

    <button type="submit" name="action" value="add">Thêm sản phẩm</button>
    <button type="submit" name="action" value="display">Hiển thị danh sách</button>
    <button type="submit" name="action" value="sort">Sắp xếp</button>
</form>
<?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_POST['action']) {
        case 'add':
            if (!empty(trim($_POST['name'])) && is_numeric(trim($_POST['price'])) && is_numeric(trim($_POST['quantity']))) {
                $name = trim($_POST['name']);
                $price = (float)trim($_POST['price']);
                $quantity = (int)trim($_POST['quantity']);
                addProduct($name, $price, $quantity);
                echo 'thêm product thành công';
            } else {
                echo '<p> dữ liệu nhập vào chưa đúng </p>';
            }

            break;
        case 'search':
            if (!empty($_POST['keyword'])) {
                $productsFound = searchProduct($products, $_POST['keyword']);
                if (empty($productsFound)) {
                    echo '<p> key word ban tim kiem ko co </p>';
                    break;
                }
                echo ' tìm kiếm cho từ khóa ' . trim($_POST['keyword']) . '<br>';
                displayProducts($productsFound);
            } else {
                echo '<p> chưa nhập vào keyword bạn muốn tìm kiêm </p>';
            }
            break;
        case 'display':
            displayProducts($products);
            break;
        case 'sort':
            sortProductsByName($products);
            file_put_contents('products.json', json_encode($products));
            echo '<p> xap xep thanh cong an hien thi de xem ds sau khi xap xep</p>';
            break;
    }
}; ?>
</body>

</html>