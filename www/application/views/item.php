<div class="right_s">
    <div id="bg_grey">
        <div id="all_scr_img"></div>
    </div>
    <?php
    echo "<h1>" . $item['prod_name'] . "</h1>";
    echo '<div class="item_p">' . $item['prod_desc'] . '</div>';
    ?>
    <div class="prod_imgs">
        <div class="img">
        <?php
        if (isset($fotos) && ($fotos != '')) {
            foreach ($fotos as $val) {
                echo "<div class=\"small_foto_cont\"><h4>" . $val['title'] . "</h4>
                    <img src=\"" . $val['link'] . "\" alt=\"" . $val['alt'] . "\" title=\"" . $val['title'] . "\" /></div>";
            }
        }
        ?>
        </div>
    </div>
</div>
</div>