<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Breadcrumbs {

    public function get_breadcrumbs($data) {
        $CI = & get_instance();

        if (isset($data['top_menu']) && $data['top_menu'] == 'main') {
            $data['breadcrumbs']['s1'] = "<ul><li>Главная</li></ul>";
        } elseif ($CI->uri->segment(1) == 'admin') {
            $data['breadcrumbs']['s1'] = "<ul><li>Административная панель</li></ul>";
        } else {
            $data['breadcrumbs']['s1'] = "<ul><li><a href=\"/\">Главная</a></li>";
            if ($CI->uri->segment(1) == 'products') {
                if ($CI->uri->segment(2) == '') {
                    $data['breadcrumbs']['s2'] = "<li><span></span>Продукция</li></ul>";
                }
                if ($CI->uri->segment(2) == 'categories') {
                    $data['breadcrumbs']['s2'] = "<li><span></span><a href=\"/products/\">Продукция</a></li><li><span></span>" . $data['cat_name']['cat_name'] . "</li></ul>";
                }
                if ($CI->uri->segment(2) == 'item') {
                    $data['breadcrumbs']['s2'] = "<li><span></span><a href=\"/products/\">Продукция</a></li>
                        <li><span></span><a href=\"/products/categories/" . $CI->uri->segment(3) . "\">" . $data['cat_name']['cat_name'] . "</a></li>
                            <li><span></span>" . $data['item']['prod_name'] . "</li></ul>";
                }
            }
            switch ($CI->uri->segment(2)) {
                case 'gallery':$data['breadcrumbs']['s2'] = "<li><span></span>Фотогалерея</li></ul>";
                    break;
                case 'design':$data['breadcrumbs']['s2'] = "<li><span></span>Проектирование</li></ul>";
                    break;
                case 'contacts':$data['breadcrumbs']['s2'] = "<li><span></span>Контакты</li></ul>";
                    break;
                case 'search':$data['breadcrumbs']['s2'] = "<li><span></span>Результаты поиска</li></ul>";
                    break;
                case 'map':$data['breadcrumbs']['s2'] = "<li><span></span>Карта сайта</li></ul>";
                    break;
                case 'mail_us':$data['breadcrumbs']['s2'] = "<li><span></span>Отправить сообщение</li></ul>";
                    break;
            }
        }
        return $data['breadcrumbs'];
    }

}