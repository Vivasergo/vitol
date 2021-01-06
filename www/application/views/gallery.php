<div class="right_s">
    <div id="bg_grey">
        <div id="all_scr_img"><img src="/img/ga-41.jpg" alt="" /></div>
    </div>
    <h1 id="prod_title">Грохот ГА-41</h1>
    <div class="gallery">
        <div id="big_img_cont">
            <div id="big_img"><img src='/img/ga-41.jpg' width="451" height="339" alt="" /></div>
        </div>
        <div id="left_bot"></div>
        <div id="gal">
            <ul id="gal_img">
                <?php
                if (isset($fotos)) {
                    foreach ($fotos as $val) {
                        echo "<li><img src=\"" . $val['link'] . "\" alt=\"" . $val['alt'] . "\"  title=\"" . $val['prod_name'] . "\" /></li>";
                    }
                }
                else
                    echo '<li>Произошла ошибка</li>';
                ?>        
            </ul>
        </div>
        <div id="right_bot"></div>
    </div>
</div>
</div>