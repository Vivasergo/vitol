<div class="right_s">
    <h1>Добавить продукцию в раздел: <?php echo $cat_data['cat_name'] ?></h1>
    <?php echo validation_errors(); ?>	
    <br/>

    <form class="dashed_underline pad_bot_10" action="/admin/add_img/<?php echo $this->uri->segment(3) ?>" enctype="multipart/form-data" method="post">

        <div id="add_img_but" class="adm_prod_list"><a href="javascript:void(0)">Для добавления изображения нажмите сюда</a> </div>
        <div id="file_upl_form">
            <div>Добавить изображение (необязательно): <input id="file_field" type="file" name="userfile" /></div><br/>
            <div><input style="display: none" id="hiden" type="hiden" name="hiden" /></div>
            <div>Описание изображения<span style="color:red">**</span>: <input id="file_title" type="text" name="img_title" size="80" /></div><br/>
            <div>Альтернативное описание изображения: <input type="text" name="img_alt" size="80" /></div><br/>
            <p class="no_marg"><span style="color:red">**</span> <span>- поля для обязательного заполнения, в случае если вы добавляете изображение</span></p>
        </div>
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