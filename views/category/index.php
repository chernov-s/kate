<?php
/* @var $this app\core\Controller */
/* @var string $name */
/* @var array $category app\models\Category */
/* @var array $ads app\models\Ads */
/* @var boolean $isEndBranch */

$this->title = $name;
$id = isset($_GET['id']) ? $_GET['id'] : 0;
?>
<h1><?=$name?></h1>
<div class="row">
    <!-- Filter Column -->
    <div class="col-md-12">
        <?php
            echo $this->render("_filter", [
                'isEndBranch' => $isEndBranch,
                'category' => $category,
                'id' => $id,
            ]);
        ?>
    </div>
</div>

<?=$this->render('_view', [
    'ads'=> $ads
]) ?>
