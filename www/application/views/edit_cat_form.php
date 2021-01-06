<div class="right_s">
    <h1>Редактировать раздел</h1>
    <?php echo validation_errors(); ?>
    <br/>
    <p>Для изменения раздела введите новые данные в соответствующие поля</p>
    <form class="dashed_underline pad_bot_10" action="/admin/change_cat/<? echo $this->uri->segment(3) ?>" method="post">
        <div>
            Название раздела <span style="color:red">*</span>: <input class="required" type="text" size="71" name="cat_name" value="<? echo $cat_data['cat_name'] ?>" />
        </div><br/>
        <div>Ключевые слова раздела (мета-теги):<br/><textarea cols="73" rows="5" name="cat_keywords"><?php echo $cat_data['keywords'] ?></textarea></div>
        <br/>
        <div>Описание раздела (мета-теги):<br/><textarea cols="73" rows="5" name="cat_description"><?php echo $cat_data['description'] ?></textarea></div>
        <p><span style="color:red">*</span> <span>- поля для обязательного заполнения</span></p>
        <div class="adm_prod_list">
            <input type="submit" value="Изменить раздел"/>
            <a class="del" href="/admin/del_cat/<? echo $this->uri->segment(3) ?>">Удалить раздел и все его содержимое</a>
        </div>
    </form>
    <h3 class="marg_top_10">Продукция данного раздела:</h3>
    <?php if (isset($item_data) && $item_data != ''): ?>
        <ul class="adm_prod_list">
            <? foreach ($item_data as $val): ?>
                <li><? echo $val['prod_name'] ?><br/><a class="del" href="/admin/del_item/<? echo $this->uri->segment(3) ?>/<? echo $val['id'] ?>/">Удалить продукцию</a>
                    <a href="/admin/edit_item/<? echo $this->uri->segment(3) ?>/<? echo $val['id'] ?>">Редактировать продукцию</a></li>
            <? endforeach; ?>
        </ul>
    <? endif; ?>
    <div class="adm_prod_list">
        <a href="/admin/new_item/<? echo $this->uri->segment(3) ?>">Добавить продукцию данного раздела</a>
        <a href="/admin/enter/">Вернуться в административную панель</a>
        <a href="/">Вернуться на главную</a>
    </div>
</div>
</div>