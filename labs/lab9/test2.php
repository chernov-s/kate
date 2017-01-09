<?php
require_once ("_utils.php");
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Лабораторная 9. Задача 2</title>
</head>
<body>

<p>F(x)=x^3-20x^2+x+5</p>
<form action="test2.php" method="post">
    a= <input type="text" name="a" size="5" value="">
    b= <input type="text" name="b" size="5" value="">
    n= <input type="text" name="n" size="3" value=""><br>
    <input type="submit" value="Построить таблицу">
</form>

<?php
if( ($_POST['a']) && isset($_POST['b']) && isset($_POST['n']) ) {
    $points = getPoints($_POST['a'], $_POST['b'], $_POST['n']);

    require_once ("_render.php");
}
?>
</body>
</html>