<?php
/* @var array $ads app\models\Ads */
?>

<div class="row ads">
    <?php foreach ($ads as $item) :?>
        <div class="col-md-12">
            <div class="media ads__item">
                <div class="media-left">
                    <div class="ads__item-img">
                        <img src="assets/img/snowman.png" width="70">
                    </div>
                </div>
                <div class="media-body ads__item-body">
                    <h4 class="media-heading">
                        <a href="index.php?r=category/view&id=<?=$item->category_id?>&ads=<?=$item->id?>"><?=$item->name?></a>
                    </h4>
                    <p>
                        <?=$item->update_at;?>
                    </p>
                    <p>
                        Раздел: <a href="index.php?r=category&id=<?=$item->category_id;?>"><?=$item->category_name;?></a>
                    </p>
                </div>
                <div class="media-right">
                    <div class="ads__item-price">
                        <?=$item->price;?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

</div>