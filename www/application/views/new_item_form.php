<div class="right_s">
    <h1>Добавить продукцию в раздел: <?php echo $cat_data['cat_name'] ?></h1>
    <?php echo validation_errors(); ?>
    <br/>

    <form class="dashed_underline pad_bot_10" action="/admin/add_item/<?php echo $this->uri->segment(3) ?>" enctype="multipart/form-data" method="post">
        <div>
            Введите название новой продукции<span style="color:red">*</span>: <input class="required" type="text" size="65" name="prod_name" />
        </div><br/>
        <div>Основное описание продукции<span style="color:red">*</span>: <br/><textarea  class="required" cols="73" rows="5" name="prod_desc"></textarea></div>
        <div style="font-size:12px;color:#9b0000;">Примечание. В основном описании продукции можно использовать HTML-тег "&LT;p&gt" для отделения абзацев.</div>
        <br/>
        <div>Ключевые слова продукции (мета-теги):<br/><textarea cols="73" rows="5" name="prod_keywords"></textarea></div>
        <br/>
        <div>Описание продукции (мета-теги):<br/><textarea cols="73" rows="5" name="prod_description"></textarea></div>
        <br/>
        <p class="no_marg"><span style="color:red">*</span> <span>- поля для обязательного заполнения</span></p>
        <p>Чтобы добавить изображения необходимо сначала создать продукцию, затем перейти в меню редактирования этой продукции</p>
        <div class="adm_prod_list">
            <input type="submit" value="Добавить раздел"/>
        </div>
    </form>
    <div class="adm_prod_list">
        <a href="/admin/enter/">Вернуться в административную панель</a>
        <a href="/">Вернуться на главную</a>
    </div>
</div>
</div>