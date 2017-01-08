<?php
/* @var $this app\core\Controller */
/* @var array $ads app\models\Ads */

$this->title = 'Поиск';
?>
<h1>Поиск по запросу: <?=$q?></h1>
<?=$this->render('_search', [
        'q'=> $q
]) ?>
<h3>Результатов найденно: <?=count($ads)?></h3>
<hr>
<?=$this->render('_view', [
    'ads'=> $ads
]) ?>