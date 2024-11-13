<?php
function findMin($arr)
{
    $min = $arr[0];
    $index = 0;
    for ($i = 1; $i < count($arr); $i++) {

        if ($min > $arr[$i]) {
            $min = $arr[$i];
            $index = $i;
        }
    }
    return $index;
}

$arr = [21, 23, 76, 98, 32, 123, 34, 12];
print_r($arr);
echo "<br>";
$index = findMin($arr);
echo "phần từ nhỏ nhất nằm ở vị trí " . $index;
