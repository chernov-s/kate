<?php require_once ("_utils.php"); ?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Лабораторная 9. Задача 1</title>
</head>
<body>

    <?php
    $points = getPoints(-5, 5);
    ?>

    <p>F(x)=x^3-20x^2+x+5</p>

    <?php require_once ("_render.php"); ?>
</body>
</html>