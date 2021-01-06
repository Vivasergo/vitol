<div class="right_s">
    <?php
    echo "<h1>" . $cat_name['cat_name'] . "</h1>";
    if (isset($items)) {
        echo '<ul class="prod_list">';
        foreach ($items as $val) {
            echo "<li><a href=\"/products/item/" . $this->uri->segment(3) . '/' . $val['id'] . "\"><em>" . $val['prod_name'] . "</em></a></li>";
        }
        echo '</ul>';
    }
    ?>

</div>
</div>