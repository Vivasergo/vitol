<div class="right_s">
    <div>
        <h3>Административная панель</h3>
        <h3>Разделы:</h3>
        <?php
        if (isset($menu)) {
            echo '<ul class="adm_prod_list">';
            foreach ($menu as $val) {
                echo "<li>" . $val['cat_name'] . "<br/>
                                <a class=\"del\" href=\"/admin/del_cat/" . $val['id'] . "\">Удалить раздел и все его содержимое</a><a href=\"/admin/edit_cat/" . $val['id'] . "\">Редактировать раздел</a></li>";
            }
            echo "<li><a href=\"/admin/new_cat/\">Добавить новый раздел</a></li>";
            echo '</ul>';
        }
        ?>
    </div>

</div>
</div>