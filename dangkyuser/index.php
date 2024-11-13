<?php
function saveDataJSON($filename, $username, $email, $password)
{
    $user = ["username" =>  $username, "email" => $email, "password" => $password];
    $json_users = file_get_contents($filename);
    $users = json_decode($json_users, true);
    $users[] = $user;
    file_put_contents($filename, json_encode($users));
    echo "lưu vào file json thành công";
} ?>

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
            <label for="name">username:</label>
            <input type="text" name="username">
        </div>
        <div class="">
            <label for="email">email:</label>
            <input type="text" name="email">
        </div>
        <div class="">
            <label for="phone">password:</label>
            <input type="password" name="password">
        </div>
        <input type="submit" name="action" value="gửi">
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        if (empty(trim($_POST["username"])) || empty(trim($_POST["email"])) || empty(trim($_POST["password"]))) {
            echo "<p>du lieu ko duoc de trong </p>";
        } else {
            $username = trim($_POST["username"]);
            $email = trim($_POST["email"]);
            $password = trim($_POST["password"]);
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if (strlen($password) < 8) {
                    echo "pass ít nhất 8 ký tự";
                } else {

                    saveDataJSON('users.json', $username, $email, $password);
                }
            } else {
                echo "email không hợp lệ";
            }
        }
    } ?>
</body>

</html>