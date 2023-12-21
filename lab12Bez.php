<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>
    <?php
    $modul = $_POST['mod'];
    $arr = [];
    $d = 0; //выступает в виде степени

    for ($i = 2; $i <= $modul; $i++) { //проверка на простые числа
        if ($modul % $i == 0) {
            array_push($arr, $i); //записываем простые числа в массив
        }
    }

    for ($i = 1; $i < $modul; $i++) { //проверка взаимнопростых чисел
        $isNotDivisible = true;
        foreach ($arr as $number) { //перебираем числа в массиве
            if ($i % $number == 0) {
                $isNotDivisible = false;
                break;

            }
        }

        if ($isNotDivisible) { //если числа взаимнопростые, то идёт счётчик
            $d++;

        }
    }

    $g = 0; //первообразный модуль 
    while ($g < $modul) {
        if ($modul != 1 && $modul != 2) {
            if (($g ** $d) % $modul == 1 && $g > 1) {
                echo $g;
                break;
            }
        } else {
            echo 1;
            break;
        }
        $g++;
    }

    ?>
</body>
<form method="post">
    <input type="text" placeholder="Введите первое число" name="mod">
    <button type="submit">Отправить</button>
</form>

</html>