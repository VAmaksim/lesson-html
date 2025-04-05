<?php
$str = 'ahb acb aeb aeeb adcb axeb gaadg gaaag gbbbg gccccg';
$pattern = '/g...g/'; // 'g ' + три любых символа + 'g'
preg_match_all($pattern, $str, $matches);
print_r($matches[0]);
?>
