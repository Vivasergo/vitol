<div class="right_s">
    <div id="bg_adm">
        <div>
            <h5>Вход для администратора</h5>
            <?php echo validation_errors(); ?>	
            <form action="/admin/enter" method="post">
                <p>
                    Логин:<br/> <input class="required" type="text" name="log" /><br/>
                    Пароль:<br/> <input class="required" type="password" name="pass" /><br/>
                    <input type="submit" value="Вход" />
                </p>
            </form>
        </div>
    </div>

</div>
</div>