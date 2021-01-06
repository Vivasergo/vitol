<div class="cont">
    <div class="nav">
        <h3><a href="/products/">Продукция</a></h3>
        <img src="/img/small_h_line.png" width="250" height="3" alt="" />
        <?php
        if (isset($menu) && $menu != '') {
            if ($this->uri->segment(1) == 'admin') {
                echo '<ul>';
                foreach ($menu as $val) {
                    if ($val['id'] == $this->uri->segment(3)) {
                        echo "<li class=\"active\"><span style=\"display:none\" class=\"first_list_arr\"></span><a class=\"red_font\" href=\"/admin/edit_cat/" . $val['id'] . "\">" . $val['cat_name'] . "</a><span class=\"last_list_arr\"></span></li>";
                    }
                    else
                        echo "<li><span class=\"first_list_arr\"></span><a href=\"/admin/edit_cat/" . $val['id'] . "\" title=\"" . $val['cat_name'] . "\">" . $val['cat_name'] . "</a></li>";
                }
                echo '</ul>';
            }
            else {
                echo '<ul>';
                foreach ($menu as $val) {
                    if ($val['id'] == $this->uri->segment(3)) {
                        echo "<li class=\"active\"><span style=\"display:none\" class=\"first_list_arr\"></span><a class=\"red_font\" href=\"" . $val['link'] . $val['id'] . "\">" . $val['cat_name'] . "</a><span class=\"last_list_arr\"></span></li>";
                    }
                    else
                        echo "<li><span class=\"first_list_arr\"></span><a href=\"" . $val['link'] . $val['id'] . "\" title=\"" . $val['cat_name'] . "\">" . $val['cat_name'] . "</a></li>";
                }
                echo '</ul>';
            }
        }
        else
            echo '';
        ?>
        <img src="/img/small_h_line.png" width="250" height="3" alt="" />
        <div>
       <!--     <a href="/main/docs/">Разрешительные документы</a>
       -->
        </div>
    </div>