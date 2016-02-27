<?php
/**
 * Класс для получения данных из исходного файла и сохранения результата.
 */
class ReadWriter
{
    /**
     * Получить массив строк файла
     */
    public function read($file_name)
    {
        $str = file_get_contents($file_name);
        echo $file_name . PHP_EOL;
        echo $str . PHP_EOL . PHP_EOL;

        // win -> linux
        $str = str_replace("\r\n", "\n", $str);

        // mac -> linux
        $str = str_replace("\r", "\n", $str);

        return explode("\n", $str);
    }

    /**
     * Вывод str
     * mode == mv - в исходиный файл,
     * mode == cp - в копию файла,
     * или в консоль
     */
    public function write($str, $file_name, $mode)
    {
        $out_file_name = '';

        if ('cp' == $mode) {
            $out_file_name = $file_name . '.corrector';
        } elseif ('mv' == $mode) {
            $out_file_name = $file_name;
        }

        if (empty($file_name)) {
            echo $str . PHP_EOL;
        } else {
            file_put_contents($out_file_name, $str);
        }

        return true;
    }

}
