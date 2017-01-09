<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Лабораторная 10. Задание 2</title>
</head>
<body>
<h2>Лабораторная 10. Задание 2</h2>
<p>
    Дано натуральное n. Напечатать все различные цифры, встречающиеся в его записи.
    Вывести цифру, которая встречается в числе чаще всего.
</p>
<form action="" method="get">
    n:  <input type="text" name="n" /><br />
    <input type="submit" value="ок" />
</form>

<?php

if (isset($_GET['n'])) {
    $n = $_GET['n'];
    $items = [];

    while ($n > 0){
        $m = $n % 10;
        $items[$m]++;
        $n = floor($n / 10);
    }
    echo "<table border='1'>";
    echo "<tr><th>Цифра</th><th>Встречается раз</th></tr>";
    foreach ($items as $key => $value) {
        echo "<tr><td>$key</td><td>$value</td></tr>";
    }
    echo "</table>";
    $max = -1;
    $freqMax = 0;
    foreach ($items as $key => $value) {
        if ($value > $max) {
            $max = $value;
            $freqMax = $key;
        }
    }
    echo "Самая частая цифра: $freqMax";
}
?>
</body>
</html>