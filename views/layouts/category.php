<?php
/** @var string $content */
/** @var string $title */
use app\models\Category;

$id = isset($_GET['id']) ? $_GET['id'] : 0;

$breadcrumbs = array_reverse(Category::findAllParent($id));
?>
<!DOCTYPE html>
<html>
<head>
    <?php include_once ("_head.php");?>
</head>
<body>
<?php include_once ("_header.php");?>

<!-- Page Content -->
<div class="content">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="/">Главная</a></li>
            <?php
            if(count($breadcrumbs) > 1) {
                foreach ($breadcrumbs as $item) {
                    if($item->name == $title)
                        break;
                    echo "<li><a href='index.php?r=category&id=$item->id'>$item->name</a></li>";
                }
            }
            ?>
            <li class="active"><?php
                if(strlen($title) > 55) {
                    echo substr($title, 0, 55) . "...";
                } else {
                    echo $title;
                }

                ?>
            </li>
        </ol>

        <div class="row">
            <!-- Content Column -->
            <div class="col-md-12 category">
                <?=$content?>
            </div>
        </div>
        <!-- /.row -->
    </div>
</div>
<?php include_once ("_footer.php");?>
<body>
<html>