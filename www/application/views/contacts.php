<div class="right_s">
    <div class="contacts">
        50029, г.Кривой Рог,<br/>
        ул. Шостаковича, 10,<br/>
        0564 95-87-88,<br/>
        056 406-06-44,<br/>
        e-mail: <a href="mailto:vitol1995@mail.ru">vitol1995@mail.ru</a>
    </div>
    <!-- Этот блок кода нужно вставить в ту часть страницы, где вы хотите разместить карту (начало) -->
    <div id="ymaps-map-id_1340087791998502017362" style="width: 590px; height: 331px;"></div>
    <div style="width: 590px; text-align: right;"><a href="http://api.yandex.ru/maps/tools/constructor/?lang=ru-RU" target="_blank" style="color: #1A3DC1; font: 13px Arial,Helvetica,sans-serif;">Создано с помощью инструментов Яндекс.Карт</a></div>
    <script type="text/javascript">
        function fid_1340087791998502017362(ymaps) {
            var map = new ymaps.Map("ymaps-map-id_1340087791998502017362", {
                center: [33.46457495160613, 48.01222923914408],
                zoom: 16,
                type: "yandex#map"
            });
            map.controls
            .add("zoomControl")
            .add("mapTools")
            .add(new ymaps.control.TypeSelector(["yandex#map", "yandex#satellite", "yandex#hybrid", "yandex#publicMap"]));
            map.geoObjects
            .add(new ymaps.Placemark([33.46471263844471, 48.01142439174859], {
                balloonContent: 'ООО фирма "ВИТОЛ". Кривой Рог, ул.Шостаковича, 10.'
            }, {
                preset: "twirl#blueDotIcon"
            }))
            .add(new ymaps.Polyline([
                [33.463446635789666, 48.01579762855522],
                [33.46398307759264, 48.015581674997016],
                [33.46554948765734, 48.0129217723837],
                [33.464262027330186, 48.012518635720284],
                [33.46475555378895, 48.011712352881624],
                [33.46432640034656, 48.01158277052821],
                [33.46456243473987, 48.011352401091074]
            ], {
                balloonContent: ""
            }, {
                strokeColor: "ff0000",
                strokeWidth: 5,
                strokeOpacity: 0.8
            }));
        };
    </script>
    <script type="text/javascript" src="http://api-maps.yandex.ru/2.0/?coordorder=longlat&load=package.full&wizard=constructor&lang=ru-RU&onload=fid_1340087791998502017362"></script>
    <!-- Этот блок кода нужно вставить в ту часть страницы, где вы хотите разместить карту (конец) -->
    <div class="qes_form">
        <div class="contacts">
            Вы можете задать вопрос, заполнив форму ниже. И наши сотрудники свяжутся с вами в ближайшее время.
        </div>
        <form id="mail_us" method="post" action="/main/mail_us/">
            <table>
                <tr>
                    <td>Название организации:</td>
                    <td><input type="text" name="organization" value="<? echo set_value('organization'); ?>" size="35" />
                    </td>
                </tr>
                <tr>
                    <td>Контактное лицо:</td>
                    <td><input type="text" name="person" value="<? echo set_value('person'); ?>" size="35" /></td>
                </tr>
                <tr>
                    <td>Ваш E-mail: <span style="color:red">*</span></td>
                    <td><input class="required" type="text" name="e-mail" value="<? echo set_value('e-mail'); ?>" size="35" />
                    </td>
                </tr>
                <?php echo '<tr><td style="color:red; padding-left:15px; font-size:10px;" colspan="2">' . form_error('e-mail', '<span class="error">', '</span>') . "</td></tr>"; ?>
                <tr>
                    <td>Номер контактного телефона:</td>
                    <td><input id="phone" type="text" name="phone" value="<? echo set_value('phone'); ?>" size="35" /></td>
                </tr>
                <tr>
                    <td>Ваше сообщение: <span style="color:red">*</span></td>
                </tr>
                <tr>
                    <td colspan="2"><textarea  class="required" name="message" value="<? echo set_value('message'); ?>" cols="73" rows="10"></textarea><br/>
                        <span style="color:red">*</span> <span>- поля для обязательного заполнения</span>
                </tr>
                <?php echo '<tr><td style="color:red; padding-left:15px; font-size:10px;" colspan="2">' . form_error('message', '<span class="error">', '</span>') . "</td></tr>"; ?>
                <tr>
                    <td><input id="sub_mail" type="submit" value="Отправить сообщение" /></td>
                </tr>
            </table>
        </form>
    </div>
</div>
</div>