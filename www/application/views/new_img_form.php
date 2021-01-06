<div class="right_s">
    <h1>Добавить изображение в продукцию: <?echo $prod_data['prod_name']?></h1>
    <?php echo validation_errors(); ?>
     <?php if(isset($error)) echo '<p style="color:red">'.$error.'</p>';?>
    <br/>

    <form class="dashed_underline pad_bot_10" action="/admin/add_img/<? echo $this->uri->segment(3)?>/<?echo $prod_id?>" enctype="multipart/form-data" method="post">
        <div>
            Добавить изображение<span style="color:red">*</span>: <input class="required" type="file" size="65" name="userfile" />
            <p style='margin-bottom:0; text-indent:0; color:#992c2c;'>Максимальный размер файла 6 мб.<br/>Требуемый размер изображения: по горизонтали = 800px, по вертикали = 600px</p>
        </div><br/>
        <div>Описание изображения<span style="color:red">*</span>: <br/><textarea class="required" cols="73" rows="5" name="title"></textarea></div>
        <br/>
        <div>Альтернативное описание изображения: <br/><textarea cols="73" rows="5" name="alt"></textarea></div>
        <p><span style="color:red">*</span> <span>- поля для обязательного заполнения</span></p>
        <div class="adm_prod_list">
            <input type="submit" value="Добавить изображение"/>
        </div>
    </form>
    <div class="adm_prod_list">
        <a href="/admin/enter/">Вернуться в административную панель</a>
        <a href="/">Вернуться на главную</a>
    </div>
</div>
</div>