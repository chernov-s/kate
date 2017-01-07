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
        <div class="row">
            <!-- Sidebar Column -->
            <div class="col-md-4">
                <?php include_once ("_sidebar.php");?>
            </div>

            <!-- Content Column -->
            <div class="col-lg-8">
                <?=$content?>
            </div>
        </div>
        <!-- /.row -->
    </div>
</div>
<?php include_once ("_footer.php");?>
<body>
<html>