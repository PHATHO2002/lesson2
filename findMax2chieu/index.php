<?php
// $arr = [
//     [1, 2, 3],
//     [4, 5, 6],
//     [9, 8, 7]
// ];
// $max = $arr[0][0];
// $irow = 0;
// $jcol = 0;

// for ($i = 0; $i < count($arr); $i++) {
//     for ($j = 0; $j < count($arr[$i]); $j++) {
//         if ($max < $arr[$i][$j]) {
//             $max = $arr[$i][$j];
//             $irow = $i;
//             $jcol = $j;
//         }
//     }
// }
function findMaxAndIndex($arr)
{
    $max = $arr[0][0];
    $irow = 0;
    $jcol = 0;

    for ($i = 0; $i < count($arr); $i++) {
        for ($j = 0; $j < count($arr[$i]); $j++) {
            if ($max < $arr[$i][$j]) {
                $max = $arr[$i][$j];
                $irow = $i;
                $jcol = $j;
            }
        }
    }
    return ['max' => $max, 'row' => $irow, 'col' => $jcol];
}
function isnguyenduong($number)
{
    return is_int((int)$number) && (int)$number > 0;
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
            <label for="name">nhap vao hang</label>
            <input type="number" name="row">
        </div>
        <div class="">
            <label for="name">nhap vao cot</label>
            <input type="number" name="col">
        </div>
        <input type="submit" value="gửi">
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['arr'])) {
            $maxAndRowsAndCol = findMaxAndIndex($_POST['arr']);
            $max = $maxAndRowsAndCol['max'];
            $irow = $maxAndRowsAndCol['row'];
            $jcol = $maxAndRowsAndCol['col'];

            echo "<p> max là : $max nằm ở vị trí arr[$irow][ $jcol]</p>";
        } else {
            if (isnguyenduong($_POST['row']) && isnguyenduong($_POST['col'])) {

                $row = (int) $_POST['row'];
                $col = (int) $_POST['col'];
                echo '<form action="" method="POST">';
                echo "<div style='display: none;' class=''>";
                echo "   <label for='name'>Nhập vào hàng:</label>";
                echo "   <input type='number' name='row' value='$row'>";
                echo "</div>";
                echo "<div style='display: none;' class=''>";
                echo "   <label for='col'>Nhập vào cột:</label>";
                echo "   <input type='number' name='col' value='$col'>";
                echo "</div>";

                for ($i = 0; $i < $row; $i++) {
                    for ($j = 0; $j < $col; $j++) {
                        echo "<p style='display: inline-block;'> Nhập vào arr[$i][$j]: </p>";
                        echo "<input style='display: inline-block;' type='number' name='arr[$i][$j]' required>";
                    }
                    echo "<br>";
                }

                echo "<input type='submit' value='Tìm max'>";
                echo "</form>";
            } else {
                echo '<p>hàng và cột phải là số nguyên dương >0 </p>';
            }
        }
    }
    ?>
</body>

</html>