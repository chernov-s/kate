<?php
use app\models\Category;

$counter = 0;
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$category = Category::findChild($id);
?>
<div class="filter">
    <div class="well">
        <div class="input-group">
            <input class="form-control" type="text">
            <span class="input-group-btn">
                <button class="btn btn-primary" type="button">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
    </div>
    <div class="well">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#children" aria-controls="children" role="tab" data-toggle="tab">Подразделы</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Дополнительно</a></li>
            <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Цена</a></li>
            <li role="presentation"><a href="#options" aria-controls="options" role="tab" data-toggle="tab">Операции</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="children">
                <div class="row">
                        <?php
                        foreach ($category as $item) {
                            echo "<div class='col-sm-6'><a href='index.php?r=category&id=$item->id'>$item->name</a></div>";
                        }
                        ?>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="profile">...</div>
            <div role="tabpanel" class="tab-pane" id="messages">...</div>
            <div role="tabpanel" class="tab-pane" id="options">
                <div class="row">
                    <div class='col-sm-12'>
                        <form action="index.php?r=category&id=<?=$item->id?>" method="post">
                            <div class="input-group">
                                <h4>Добавить подраздел</h4>
                            </div>
                            <div class="input-group">
                                <input type="hidden" name="parent_id" value="<?=$id?>">
                                <input class="form-control" type="text" placeholder="Имя подраздела" name="name">
                                    <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class='col-sm-12'>
                        <h4>Добавить объявление:</h4>
                        <form action="?r=category/create" class="form-inline">
                            <input type="hidden" name="category_id" value="<?=$id?>">
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Название" name="name">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Описание" name="description">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Цена" name="price">
                            </div>
                            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>