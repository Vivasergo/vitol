<div class="right_s">
    <div id="map">
        <h3 style="border-bottom: dashed 1px gray; padding-bottom: 16px; color:gray; margin-bottom: 10px">Карта сайта</h3>
        <ul>
            <li><a href="/">Главная</a></li>
            <li><a href="/main/gallery">Фотогалерея</a></li>
            <li><a href="/main/design/">Проектирование</a></li>
            <li><a href="/main/contacts/">Контакты</a></li>
            <li><a href="/products/">Продукция:</a>
                <?php
                if (isset($prods) && isset($cats)) {
                    echo '<ul>';
                    foreach ($cats as $val) {
                        echo "<li><a href=\"/products/categories/".$val['id']."\">" . $val['cat_name'] . "</a></li>";
                        echo "<ul class=\"prod_list\">";
                        foreach ($prods as $prod_val) {
                            if ($val['id'] == $prod_val['cat_id']) {
                                echo "<li><a href=\"/products/item/" . $val['id'] . '/' . $prod_val['id'] . "\"><em>" . $prod_val['prod_name'] . "</em></a></li>";
                            }
                        }
                        echo "</ul>";
                    }
                    echo "</ul>";
                }
                else
                    echo 'Произошла ошибка.';
                ?></li>
        </ul>
    </div>
</div>
</div>