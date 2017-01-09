<?php
class Point
{
    public $x;
    public $y;
    function __construct($x, $y) {
        $this->x = $x;
        $this->y = $y;
    }
}

/**
 * @param float $x
 * @return float
 */
function f($x) {
    return $x*$x*$x-20*$x*$x+$x+5;
}

function sign($x) {
    return ($x > 0) - ($x < 0);
}

/**
 * @param float $a begin interval
 * @param float $b end interval
 * @param float|int $n
 *
 * @return array Point
 */
function getPoints($a, $b, $n = 20) {
    if($a < $b && $n < 0)
        return [];
    $x=$a;
    $step = ($b-$a)/$n;
    $points = [];
    while (($x<=$b)) {
        $points[] = new Point($x, f($x));
        $x=$x+$step;
    }
    return $points;
}

/**
 * @param array Point $points
 *
 * @return bool
 */
function isMonotonically($points) {
    $count = count($points);
    if($count < 2)
        return false;
    for($i = 2; $i < $count; $i++) {
        if ($i > 2 && sign($points[$i]->x - $points[$i-1]->x) != sign($points[$i-1]->x - $points[$i-2]->x)){
            return false;
        }
    }
    return true;
}

/**
 * @param array Point $points
 *
 * @return Point
 */
function getMinPoint($points) {
    $min = 9999999999999;
    $i = 0;
    $indexMax = 0;
    foreach ($points as $point) {
        if ($point->x < $min) {
            $min =$point->x;
            $indexMax = $i;
        }
        $i++;
    }
    return $points[$indexMax];
}

/**
 * @param array Point $points
 *
 * @return Point
 */
function getMaxPoint($points) {
    $max = -9999999999999;
    $i = 0;
    $indexMax = 0;
    foreach ($points as $point) {
        if ($point->x > $max) {
            $max =$point->x;
            $indexMax = $i;
        }
        $i++;
    }
    return $points[$indexMax];
}

/*
 * Task: найти число корней уравнения F(x)=0 на заданном интервале (количество перемен знака);
 *
 * @param array Point $points
 *
 * @return int
 */

function getCountChangeSign($points) {
    $sign = sign($points[0]->x);
    $i = 0;
    foreach ($points as $point) {
        if ($sign!=sign($point->x)) {
            $sign = sign($point->x);
            $i++;
        }
    }
    return $i;
}

/**
 * @param array Point $points
 *
 * @return string
 */
function renderTable($points) {
    $tableStr = "";
    foreach ($points as $point) {
        $tableStr .= "<tr> <td>$point->x</td><td>$point->y</td></tr>";
    }
    return $tableStr;
}