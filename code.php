<?php
/**
 * Выполнение коррекции форматирования кода PHP
 */

include 'Corrector.php';
include 'ReadWriter.php';

if (empty($argv[2])) {
    echo "{$argv[0]} {cp|mv} {имя файла}" . PHP_EOL;
} else {
    // параметры команды
    $file_name = $argv[2];
    $mode = $argv[1];

    // массив строк исходного файла
    $ReadWriter = new ReadWriter;
    $data = $ReadWriter->read($file_name);

    // коррекция кода
    $Corrector = new Corrector;
    $cs_data = $Corrector->correct($data);
    $cs_str = implode("", $cs_data);

    // вывод результатов в зависимости от режима
    $ReadWriter->write($cs_str, $file_name, $mode);
}
