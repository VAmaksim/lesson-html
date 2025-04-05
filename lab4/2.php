<?php
$str = 'a1b2c3'; // Заменить числа на их значение минус 1
$result = preg_replace_callback('/\d+/', function($matches) {
    return $matches[0] - 1;
}, $str);
echo $result;
?>
