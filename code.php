<?php
/**
 * Выполнение коррекции форматирования кода PHP
 */

include 'Corrector.php';

if (empty($argv[2])) {
    echo "{$argv[0]} {cp|mv} {имя файла}" . PHP_EOL;
} else {
    // параметры команды
    $file_name = $argv[2];
    $mode = $argv[1];

    // массив строк исходного файла
    $data = file($file_name);

    // коррекция кода
    $Corrector = new Corrector;
    $cs_data = $Corrector->correct($data);
    $cs_str = implode("", $cs_data);

    // вывод результатов в зависимости от режима
    $out_file_name = '';
    if ('cp' == $mode) {
        $out_file_name = $file_name . '.cs';
    } elseif ('mv' == $mode) {
        $out_file_name = $file_name;
    }
    if (empty($out_file_name)) {
        echo $cs_str . PHP_EOL;
    } else {
        file_put_contents($out_file_name, $cs_str);
    }
}
