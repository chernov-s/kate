<?php
use app\models\Category;
?>
<div class="sidebar">
    <div class="well">
        <h4>Поиск</h4>
        <form method="get" action="index.php">
            <div class="input-group">
                <input type="hidden" name="r" value="category/search">
                <input name="q" class="form-control" type="text" placeholder="Поиск по всем разделам" value="<?=isset($q) ? $q : ''?>">
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
    </div>
    <div class="well">
        <h4>Объявления по разделам</h4>
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