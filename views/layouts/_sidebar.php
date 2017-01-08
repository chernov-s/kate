<?php
use app\models\Category;
?>
<div class="sidebar">
    <div class="well">
        <h4>Поиск</h4>
        <div class="input-group">
            <input class="form-control" type="text">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
    </div>
    <div class="well">
        <h4>Объявления</h4>
        <ul class="navbar nav">
        <?php
            $category = Category::findChild(0);
            foreach ($category as $item) {
                echo "<li><a href='index.php?r=category&id=$item->id'>$item->name</a></li>";
            }
        ?>
        </ul>
    </div>
</div>