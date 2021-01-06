<div class="right_s">
    <div>
        <h3><?php if (isset($mess)) echo $mess; else echo 'Операция выполнена успешно'; ?></h3>
        <?php if (isset($info)) echo '<div class="adm_prod_list">'.$info.'</div>'; ?>
        <div class="adm_prod_list">
            <a href="/admin/enter/">Вернуться в административную панель</a>
            <a href="/">Вернуться на главную</a>
        </div>
    </div>
</div>
</div>