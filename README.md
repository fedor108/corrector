# corrector
Утилита для исправления форматирования PHP кода. Написана на PHP.

Исправить код из файла {file}, резульатат поместить в {file}.cs 
    php corrector/code.php cp {file}

Исправить код из файла {file}, результать поместить в {file}
    php corrector/code.php mv {file}

Исправить найденые по имени файлы в директории {dir} с заменой исходников
    find {dir} -name '{name}' -exec php ../corrector/code.php mv {} \;
    
