<?php
/* @var $this app\core\Controller */
/* @var $ads app\models\Ads */

$this->title = $ads->name;
$this->breadcrumbs[] = 'Al';
?>
<div class="row">
    <div class="col-md-8">
        <h2><?=$ads->name?></h2>
        <?=$ads->description?>
    </div>
    <div class="col-lg-4">
        <div class="well">
            <div class="row">
                <div class="col-xs-6">
                    <b>Добавленно: </b>
                </div>
                <div class="col-xs-6">
                    <?=$ads->create_at?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <b>Обновленно: </b>
                </div>
                <div class="col-xs-6">
                    <?=$ads->update_at?>
                </div>
            </div>
        </div>
        <div class="well">
            <h4>Действия</h4>
            <ul class="navbar nav">
                <li><a href=""><i class="glyphicon glyphicon-edit"></i> Редактировать</a></li>
                <li><a href=""><i class="glyphicon glyphicon-trash"></i> Удалить</a></li>
            </ul>
        </div>
    </div>
</div>
