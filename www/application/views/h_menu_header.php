<div class="top_menu">
    <ul>
        <?php
        if (isset($top_menu) && $top_menu == 'main') {
            echo "<li class=\"active\"> <span>Главная</span></li>
                        <li><a href=\"/main/gallery/\">Фотогалерея</a></li>
                        <li><a href=\"/main/design/\">Проектирование</a></li>
                        <li class=\"last_p\"><a href=\"/main/contacts/\">Контакты</a></li>";
        } else {
            switch ($this->uri->segment(2)) {
                case 'gallery':echo "<li > <a href=\"/\">Главная</a></li>
                                <li class=\"active\"><span>Фотогалерея</span></li>
                                <li><a href=\"/main/design/\">Проектирование</a></li>
                                <li class=\"last_p\"><a href=\"/main/contacts/\">Контакты</a></li>";
                    break;
                case 'design':echo "<li > <a href=\"/\">Главная</a></li>
                                <li><a href=\"/main/gallery/\">Фотогалерея</a></li>
                                <li class=\"active\"><span>Проектирование</span></li>
                                <li class=\"last_p\"><a href=\"/main/contacts/\">Контакты</a></li>";
                    break;
                case 'contacts':echo "<li > <a href=\"/\">Главная</a></li>
                                <li><a href=\"/main/gallery/\">Фотогалерея</a></li>
                                <li><a href=\"/main/design/\">Проектирование</a></li>
                                <li class=\"active last_p\"><span>Контакты</span></li>";
                    break;
                default : echo "<li > <a href=\"/\">Главная</a></li>
                                <li><a href=\"/main/gallery/\">Фотогалерея</a></li>
                                <li><a href=\"/main/design/\">Проектирование</a></li>
                                <li class=\"last_p\"><a href=\"/main/contacts/\">Контакты</a></li>";
                    break;
            }
        }
        ?>
    </ul>
    <span class="right_line"></span>
    <form action="/main/search/" method="post" class="search">
        <p>
            <input id="search" type="text" name="search" value="поиск по сайту"/>
            <input type="image" src="/img/search_icon.jpg" />
        </p>
    </form>
</div>