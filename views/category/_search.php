<!-- SEARCH -->
<div class="well">
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