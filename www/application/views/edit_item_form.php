<div class="right_s">
    <h1>Редактировать продукцию в категории: <?php echo $item_cat_data['cat_name'] ?></h1>
    <?php echo validation_errors(); ?>
    <br/>
    <p>Для изменения продукции введите новые данные в соответствующие поля</p>
    <form class="dashed_underline pad_bot_10" action="/admin/change_item/<? echo $this->uri->segment(3) ?>/<? echo $this->uri->segment(4) ?>" method="post">
        <div>
            Название раздела<span style="color:red">*</span>: <input class="required" type="text" size="71" name="prod_name" value="<? echo $item_data['prod_name'] ?>" />
        </div><br/>
        <div>Основное описание продукции<span style="color:red">*</span>: <br/><textarea  class="required" cols="73" rows="5" name="prod_desc"><?php echo $item_data['prod_desc'] ?></textarea></div>
        <div style="font-size:12px;color:#9b0000;">Примечание. В основном описании продукции можно использовать HTML-тег "&LT;p&gt" для отделения абзацев.</div>
        <br/>
        <div>Ключевые слова продукции (мета-теги):<br/><textarea cols="73" rows="5" name="prod_keywords"><?php echo $item_data['keywords'] ?></textarea></div>
        <br/>
        <div>Описание продукции (мета-теги):<br/><textarea cols="73" rows="5" name="prod_description"><?php echo $item_data['description'] ?></textarea></div>
        <p><span style="color:red">*</span> <span>- поля для обязательного заполнения</span></p>
        <div class="adm_prod_list">
            <input type="submit" value="Изменить данную продукцию"/>
            <a class="del" href="/admin/del_item/<? echo $this->uri->segment(3) ?>/<? echo $this->uri->segment(4) ?>">Удалить продукцию и все ее содержимое</a>
        </div>
    </form>
    <h3 class="marg_top_10">Изображения данной продукции:</h3>
    <p>Для изменения данных изображений заполните соответствующие поля</p>
    <?php if (isset($imgs) && $imgs != ''):
        foreach ($imgs as $val):
            ?>
            <div class="marg_top_10">
                <div class="prod_imgs"><img src="<?php echo $val['link'] ?>" alt="<? echo $val['alt'] ?>" title="<? echo $val['title'] ?>" /></div>
                <form class="dashed_underline pad_bot_10" method="post" action="/admin/edit_foto/<? echo $this->uri->segment(3) ?>/<? echo $val['id'] ?>">
                    <div>"Title" название изображения<span style="color:red">*</span>: <input class="required" type="text" size="71" name="title_img" value="<? echo $val['title'] ?>" /></div>
                    <div>"Alt" альтернативное описание изображения: <input type="text" size="71" name="alt_img" value="<? echo $val['alt'] ?>" /></div>
                    <div class="adm_prod_list">
                        <input type="submit" value="Изменить данные изображения"/>
                        <a class="del" href="/admin/del_img/<? echo $this->uri->segment(3) ?>/<? echo $val['id'] ?>">Удалить изображение</a>
                    </div>
                </form>
            </div>
        <? endforeach; ?>
<? endif; ?>

    <div class="adm_prod_list">
        <a href="/admin/new_img/<? echo $this->uri->segment(3) ?>/<? echo $this->uri->segment(4) ?>">Добавить изображение данной продукции</a>
        <a href="/admin/enter/">Вернуться в административную панель</a>
        <a href="/">Вернуться на главную</a>
    </div>
</div>
</div>