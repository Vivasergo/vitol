<div class="right_s">
    <?php
    if (isset($prods) && isset($cats)) {
        foreach ($cats as $val) {
            echo "<h3>" . $val['cat_name'] . "</h3>";
            echo "<ul class=\"prod_list\">";
            foreach ($prods as $prod_val) {
                if ($val['id'] == $prod_val['cat_id']) {
                    echo "<li><a href=\"/products/item/" . $val['id'] . '/' . $prod_val['id'] . "\"><em>" . $prod_val['prod_name'] . "</em></a></li>";
                }
            }
            echo "</ul>";
        }
    }
    else
        echo 'Произошла ошибка.';
    ?>

</div>
</div>