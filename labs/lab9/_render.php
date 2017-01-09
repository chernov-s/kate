<?php if(count($points) > 0) :?>
    <?php
    $min = getMinPoint($points);
    $max = getMaxPoint($points);
    ?>
    <!-- Render table -->
    <table border='1'>
        <tr><th> x </th><th> F(x) </th></tr>
        <?=renderTable($points)?>
    </table>

    <!-- Render result -->
    <p> max: f(<?=$max->x?>) = <?=$max->y?> </p>
    <p> min: f(<?=$min->x?>) = <?=$min->y?> </p>
    <p> F(x) - <?=isMonotonically($points) ? "monotonically" : "not monotonically"?></p>
    <p> num of zeros: <?=getCountChangeSign($points)?> </p>

<?php else :?>
    Некорректные данные
<?php endif; ?>
