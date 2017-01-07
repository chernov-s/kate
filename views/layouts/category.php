<?php
/** @var string $content */
/** @var string $title */

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
        <h1><?=$title?></h1>
        <div class="row">
            <!-- Filter Column -->
            <div class="col-md-12">
                <?php include_once ("_filter.php");?>
            </div>
        </div>
        <div class="row">
            <!-- Content Column -->
            <div class="col-md-12">
                <?=$content?>
            </div>
        </div>
        <!-- /.row -->
    </div>
</div>
<?php include_once ("_footer.php");?>
<body>
<html>