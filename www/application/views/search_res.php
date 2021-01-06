<div class="right_s">
    <div class="s_block">
        <h3 style="border-bottom: dashed 1px gray; padding-bottom: 16px; color:gray;">Результаты поиска</h3>
        <?php
        if ($search != false) {
            foreach ($search as $val) {
                echo "<h3>" . $val['cat_name'] . "</h3>";
                echo "<h4><a class=\"prod_title\" href=\"/products/item/" . $val['cat_id'] . "/" . $val['prod_id'] . "\">" . $val['prod_name'] . "</a></h4>";
                echo '<p>' . $val['prod_desc'] . "...<a href=\"/products/item/" . $val['cat_id'] . "/" . $val['prod_id'] . "\">Подробнее</a></p>";
            }
        }
        else
            echo 'Ничего не найдено';
        ?>
    </div>
</div>
</div>