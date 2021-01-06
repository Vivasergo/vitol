<div class="right_s">
    <h1>Добавить раздел</h1>
    <?php echo validation_errors(); ?>	
    <br/>

    <form class="dashed_underline pad_bot_10" action="/admin/add_cat/" method="post">
        <div>
            Введите название нового раздела <span style="color:red">*</span>: <input class="required" type="text" size="65" name="cat_name" />
        </div><br/>
        <div>Ключевые слова раздела (мета-теги):<br/><textarea cols="73" rows="5" name="cat_keywords"></textarea></div>
        <br/>
        <div>Описание раздела (мета-теги):<br/><textarea cols="73" rows="5" name="cat_description"></textarea></div>
        <p><span style="color:red">*</span> <span>- поля для обязательного заполнения</span></p>
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