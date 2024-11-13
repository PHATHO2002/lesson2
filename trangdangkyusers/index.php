<?php
function saveDataJSON($filename, $name, $email, $phone)
{
    $contact = ["name" =>  $name, "email" => $email, "phone" => $phone];
    $json_users = file_get_contents($filename);
    $users = json_decode($json_users, true);
    $users[] = $contact;
    file_put_contents($filename, json_encode($users));
    echo "lưu vào file json thành công";
}
function displayUsers($users)
{
    if (empty($users)) {
        echo '<h1> danh sách trống </h1>';
    } else {

        foreach ($users as $user) {
            printf(
                "Tên người dùng: %s, email: %s, Số đt: %s <br>",
                $user['name'],
                $user['email'],
                $user['phone']
            );
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form action="" method="POST">
        <div class="">
            <label for="name">Tên người dùng:</label>
            <input type="text" name="name">
        </div>
        <div class="">
            <label for="email">Email:</label>
            <input type="text" name="email">
        </div>
        <div class="">
            <label for="phone">Số điện thoại:</label>
            <input type="text" name="phone">
        </div>
        <input type="submit" name="action" value="add">
        <input type="submit" name="action" value="display">

    </form>
    <?php

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if ($_POST['action'] == 'add') {
            if (empty(trim($_POST["name"])) || empty(trim($_POST["email"])) || empty(trim($_POST["phone"]))) {
                echo "<p>du lieu ko duoc de trong </p>";
            } else {
                $email = trim($_POST["email"]);
                $name = trim($_POST["name"]);
                $phone = trim($_POST["phone"]);
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    saveDataJSON('users.json', $name, $email, $phone);
                } else {
                    echo "email không hợp lệ";
                }
            }
        } else if ($_POST["action"] == "display") {
            $json_users = file_get_contents('users.json');
            $users = json_decode($json_users, true);

            displayUsers($users);
        }
    }
    ?>
</body>

</html>