<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('skin');
        $this->load->model('req');
        $this->load->model('ed_data');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="error_msg">', '</p>');
        $this->load->helper(array('form', 'url'));
        $this->load->library('breadcrumbs');
        $this->load->library('session');
        $data['title'] = 'Администратор';
    }

    function index() {
        if ($this->session->userdata(md5('adm_check_ok')) == md5('accepted_111')) {
            $this->skin->render('admin_main');
        } else {
            $this->skin->render('admin_enter');
        }
    }

    private function acs_check() {
        if ($this->session->userdata(md5('adm_check_ok')) == md5('accepted_111')) {
            return TRUE;
        } else {
            $this->skin->render('admin_enter');
        }
    }

    function enter() {
        $this->form_validation->set_message('required', 'Поле не заполнено!');
        $this->form_validation->set_message('min_length', 'Пароль должен быть не менее 5 символов!');
        $this->form_validation->set_rules('pass', 'Пароль', 'trim|required|xss_clean|strip_tags|md5');
        $this->form_validation->set_rules('log', 'Логин', 'trim|required|xss_clean|strip_tags|min_length[5]');
        if ($this->form_validation->run() == FALSE) {
            $this->skin->render('admin_enter');
        } else {
            $post = $this->input->post();
            $log = $post['log'];
            $pass = $post['pass'];
            if ($adm_data = $this->req->adm_check($log)) {
                if (($adm_data['log'] == $log) && ($adm_data['pass']) == $pass) {
                    $ses_mass = array(md5('adm_check_ok') => md5('accepted_111'));
                    $this->session->set_userdata($ses_mass);
                    $data['title'] = 'Административная панель';
                    $this->skin->render('admin_main', $data);
                } else {
                    $data['error'] = "Произошла ошибка. Логин или пароль введены не верно";
                    $this->skin->render('error', $data);
                }
            } else {
                $data['error'] = "Произошла ошибка. Логин или пароль введены не верно";
                $this->skin->render('error', $data);
            }
        }
    }

    function edit_foto() {
        if ($this->acs_check()) {
            $this->form_validation->set_message('required', 'Поле %s не заполнено!');
            $this->form_validation->set_rules('title_img', 'Основное описание изображения', 'required|trim|xss_clean|strip_tags');
            $this->form_validation->set_rules('alt_img', 'Дополнительное описание изображения', 'trim|xss_clean|strip_tags');
            if ($this->form_validation->run() == FALSE) {
                $prod_id = $this->uri->segment(4);
                $data['item_cat_data'] = $this->req->get_item_cat_name($prod_id);
                $data['item_data'] = $this->req->get_one_item($prod_id);
                $data['imgs'] = $this->req->get_fotos_of_item($prod_id);
                $this->skin->render('edit_item_form', $data);
            } else {
                $post = $this->input->post();
                if (!$this->ed_data->change_img_data($post)) {
                    $data['title'] = "Ошибка";
                    $data['error'] = "Произошла ошибка изменения данных изображения";
                    $this->skin->render('error', $data);
                } else {
                    $prod_data = $this->req->get_prod_id_by_foto_id($this->uri->segment(4));
                    $data['post'] = $this->input->post();
                    $data['info'] = "<a href=\"/admin/edit_item/" . $this->uri->segment(3) . "/" . $prod_data['prod_id'] . "\">Вернуться к редактированию измененной продукции</a><br/>
                <a href=\"/admin/new_img/" . $this->uri->segment(3) . "/" . $prod_data['prod_id'] . "\">Добавить изображение к изменной прдукции</a>";
                    $data['mess'] = 'Данные успешно изменены';
                    $data['title'] = 'Успех';
                    $this->skin->render('success', $data);
                }
            }
        }
    }

    function edit_item() {
        if ($this->acs_check()) {
            $prod_id = $this->uri->segment(4);
            $data['item_cat_data'] = $this->req->get_item_cat_name($prod_id);
            $data['item_data'] = $this->req->get_one_item($prod_id);
            $data['imgs'] = $this->req->get_fotos_of_item($prod_id);
            $this->skin->render('edit_item_form', $data);
        }
    }

    function change_item() {
        if ($this->acs_check()) {
            $this->form_validation->set_message('required', 'Поле %s не заполнено!');
            $this->form_validation->set_rules('prod_name', 'Название продукции', 'trim|required|xss_clean|strip_tags');
            $this->form_validation->set_rules('prod_desc', 'Основное описание продукции', 'required|trim|xss_clean|callback_my_strip_tags');
            $this->form_validation->set_rules('prod_keywords', 'Ключевые слова продукции', 'trim|xss_clean|strip_tags');
            $this->form_validation->set_rules('prod_description', 'Описание продукции', 'trim|xss_clean|strip_tags');
            if ($this->form_validation->run() == FALSE) {
                $prod_id = $this->uri->segment(4);
                $data['item_cat_data'] = $this->req->get_item_cat_name($prod_id);
                $data['item_data'] = $this->req->get_one_item($prod_id);
                $data['imgs'] = $this->req->get_fotos_of_item($prod_id);
                $this->skin->render('edit_item_form', $data);
            } else {
                $post = $this->input->post();
                if (!$this->ed_data->change_item($post)) {
                    $data['title'] = "Ошибка";
                    $data['error'] = "Произошла ошибка изменения продукции";
                    $this->skin->render('error', $data);
                } else {
                    $data['post'] = $this->input->post();
                    $prod_id = $this->uri->segment(4);
                    $data['info'] = "<a href=\"/admin/edit_item/" . $this->uri->segment(3) . "/$prod_id\">Вернуться к редактированию измененной продукции</a><br/>
                <a href=\"/admin/new_img/" . $this->uri->segment(3) . "/$prod_id\">Добавить изображение к изменной прдукции</a>";
                    $data['mess'] = 'Данные успешно изменены';
                    $data['title'] = 'Успех';
                    $this->skin->render('success', $data);
                }
            }
        }
    }

    function edit_cat() {
        if ($this->acs_check()) {
            $cat_id = $this->uri->segment(3);
            $data['cat_data'] = $this->req->get_cat_name($cat_id);
            $data['item_data'] = $this->req->get_items($cat_id);
            $this->skin->render('edit_cat_form', $data);
        }
    }

    function change_cat() {
        if ($this->acs_check()) {
            $this->form_validation->set_message('required', 'Поле %s не заполнено!');
            $this->form_validation->set_rules('cat_name', 'Название раздела', 'trim|required|xss_clean|strip_tags');
            $this->form_validation->set_rules('cat_keywords', 'Ключевые слова раздела', 'trim|xss_clean|strip_tags');
            $this->form_validation->set_rules('cat_description', 'Описание раздела', 'trim|xss_clean|strip_tags');
            if ($this->form_validation->run() == FALSE) {
                $cat_id = $this->uri->segment(3);
                $data['cat_data'] = $this->req->get_cat_name($cat_id);
                $data['item_data'] = $this->req->get_items($cat_id);
                $this->skin->render('edit_cat_form', $data);
            } else {
                $post = $this->input->post();
                if (!$this->ed_data->change_cat($post)) {
                    $data['title'] = "Ошибка";
                    $data['error'] = "Произошла ошибка изменения раздела";
                    $this->skin->render('error', $data);
                } else {
                    $data['mess'] = 'Данные успешно изменены';
                    $data['title'] = 'Успех';
                    $this->skin->render('success', $data);
                }
            }
        }
    }

    function new_cat() {
        if ($this->acs_check()) {
            $this->skin->render('new_cat_form');
        }
    }

    function add_cat() {
        if ($this->acs_check()) {
            $this->form_validation->set_message('required', 'Поле %s не заполнено!');
            $this->form_validation->set_rules('cat_name', 'Название раздела', 'trim|required|xss_clean|strip_tags');
            $this->form_validation->set_rules('cat_keywords', 'Ключевые слова раздела', 'trim|xss_clean|strip_tags');
            $this->form_validation->set_rules('cat_description', 'Описание раздела', 'trim|xss_clean|strip_tags');
            if ($this->form_validation->run() == FALSE) {
                $this->skin->render('new_cat_form');
            } else {
                $post = $this->input->post();
                if (!$this->ed_data->add_cat($post)) {
                    $data['title'] = "Ошибка";
                    $data['error'] = "Произошла ошибка изменения раздела";
                    $this->skin->render('error', $data);
                } else {
                    $data['mess'] = 'Раздел успешно добавлен';
                    $data['title'] = 'Успех';
                    $this->skin->render('success', $data);
                }
            }
        }
    }

    function new_item() {
        if ($this->acs_check()) {
            $cat_id = $this->uri->segment(3);
            $data['cat_data'] = $this->req->get_cat_name($cat_id);
            $this->skin->render('new_item_form', $data);
        }
    }

    function add_item() {
        if ($this->acs_check()) {
            $this->form_validation->set_message('required', 'Поле %s не заполнено!');
            $this->form_validation->set_rules('prod_name', 'Название продукции', 'trim|required|xss_clean|strip_tags');
            $this->form_validation->set_rules('prod_keywords', 'Ключевые слова продукции(мета)', 'trim|xss_clean|strip_tags');
            $this->form_validation->set_rules('prod_description', 'Описание продукции(мета)', 'trim|xss_clean|strip_tags');
            $this->form_validation->set_rules('prod_desc', 'Основное описание продукции', 'trim|required|xss_clean|callback_my_strip_tags');

            if ($this->form_validation->run() == FALSE) {
                $cat_id = $this->uri->segment(3);
                $data['cat_data'] = $this->req->get_cat_name($cat_id);
                $this->skin->render('new_item_form', $data);
            } else {
                $post = $this->input->post();
                if (!$this->ed_data->add_new_item($post)) {
                    $data['title'] = "Ошибка";
                    $data['error'] = "Произошла ошибка добавления продукции";
                    $this->skin->render('error', $data);
                } else {
                    $data['mess'] = 'Продукция успешно добавлена';
                    $data['title'] = 'Успех';
                    $data['info'] = 'Для добавления изображения перейдите в меню редактирования соответствующей продукции';
                    $this->skin->render('success', $data);
                }
            }
        }
    }

    function new_img() {
        if ($this->acs_check()) {
            $data['prod_id'] = $this->uri->segment(4);
            $data['prod_data'] = $this->req->get_one_item($data['prod_id']);
            $this->skin->render('new_img_form', $data);
        }
    }

    function add_img() {
        if ($this->acs_check()) {
            $this->load->library('image_lib');
            $this->form_validation->set_rules('title', 'Описание изображения', 'required|trim|xss_clean|strip_tags');
            $this->form_validation->set_rules('alt', 'Альтернативное описание изображения', 'trim|xss_clean|strip_tags');
            if ($this->form_validation->run() == FALSE) {
                $data['prod_id'] = $this->uri->segment(4);
                $data['prod_data'] = $this->req->get_one_item($data['prod_id']);
                $this->skin->render('new_img_form', $data);
            } else {
                if ($_FILES['userfile']['name'] != '') {
                    $config['upload_path'] = './fotos/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['max_size'] = '6000';
                    $config['encrypt_name'] = TRUE;
                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload()) {
                        $data['error'] = $this->upload->display_errors();
                        $data['prod_id'] = $this->uri->segment(4);
                        $data['prod_data'] = $this->req->get_one_item($data['prod_id']);
                        $this->skin->render('new_img_form', $data);
                        return FALSE;
                    } else {
                        $post = $this->input->post();
                        $file = $this->upload->data();
                        $post['file_link'] = '/fotos/' . $file['file_name'];
                        $img_width = $file['image_width'];
                        $img_height = $file['image_height'];
                        if (!$this->ed_data->add_new_img($post)) {
                            $data['title'] = "Ошибка";
                            $data['error'] = "Произошла ошибка добавления изображения";
                            $this->skin->render('error', $data);
                        } else {
                            if (($img_width != '800') || ($img_height != '600')) {
                                $config['image_library'] = 'GD2';
                                $config['source_image'] = '.' . $post['file_link'];
                                $config['width'] = '800';
                                $config['height'] = '600';

                                $this->image_lib->initialize($config);

                                if (!$this->image_lib->resize()) {
                                    echo $this->image_lib->display_errors();
                                    $data['title'] = "Ошибка";
                                    $data['error'] = "Произошла ошибка добавления изображения";
                                    $this->skin->render('error', $data);
                                }
                            }

                            $data['mess'] = 'Изображение успешно добавлено';
                            $data['title'] = 'Успех';
                            $this->skin->render('success', $data);
                        }
                    }
                } else {
                    $data['title'] = "Ошибка";
                    $data['error'] = "Не выбран файл изображения";
                    $this->skin->render('error', $data);
                }
            }
        }
    }

    function del_img() {
        if ($this->acs_check()) {
            $img_id = $this->uri->segment(4);
            $res = $this->ed_data->get_img($img_id);
            if (!unlink('.' . $res['link'])) {
                $data['title'] = "Ошибка";
                $data['error'] = "Возникла ошибка при удалении изображения";
                $this->skin->render('error', $data);
            } else {
                if (!$this->ed_data->del_img($img_id)) {
                    $data['title'] = "Ошибка";
                    $data['error'] = "Возникла ошибка при удалении изображения";
                    $this->skin->render('error', $data);
                } else {
                    $data['mess'] = 'Изображение успешно удалено';
                    $data['title'] = 'Успех';
                    $this->skin->render('success', $data);
                }
            }
        }
    }

    function del_item() {
        if ($this->acs_check()) {
            $prod_id = $this->uri->segment(4);
            $img_link = $this->req->get_fotos_link($prod_id);
            if ($img_link != '') {
                foreach ($img_link as $val) {
                    if (!unlink('.' . $val['link'])) {
                        $data['title'] = "Ошибка";
                        $data['error'] = "Возникла ошибка при удалении изображения";
                        $this->skin->render('error', $data);
                        return FALSE;
                    }
                }
            }
            if (!$this->ed_data->del_item($prod_id)) {
                $data['title'] = "Ошибка";
                $data['error'] = "Возникла ошибка при удалении продукции";
                $this->skin->render('error', $data);
                return FALSE;
            } else {
                $data['mess'] = 'Продукция успешно удалена';
                $data['title'] = 'Успех';
                $this->skin->render('success', $data);
            }
        }
    }

    function del_cat() {
        if ($this->acs_check()) {
            $cat_id = $this->uri->segment('3');
            $prod_ids = $this->req->get_prods_id_by_cat($cat_id);
            if ($prod_ids != 0) {
                foreach ($prod_ids as $prod_id) {
                    $img_link = $this->req->get_fotos_link($prod_id['id']);
                    if ($img_link != '') {
                        foreach ($img_link as $val) {
                            if (!unlink('.' . $val['link'])) {
                                $data['title'] = "Ошибка";
                                $data['error'] = "Возникла ошибка при удалении изображения";
                                $this->skin->render('error', $data);
                                return FALSE;
                            }
                        }
                    }
                    if (!$this->ed_data->del_item($prod_id['id'])) {
                        $data['title'] = "Ошибка";
                        $data['error'] = "Возникла ошибка при удалении продукции";
                        $this->skin->render('error', $data);
                        return FALSE;
                    }
                }
            }
            if (!$this->ed_data->del_cat($cat_id)) {
                $data['title'] = "Ошибка";
                $data['error'] = "Возникла ошибка при удалении раздела";
                $this->skin->render('error', $data);
                return FALSE;
            } else {
                $data['mess'] = 'Раздел успешно удален';
                $data['title'] = 'Успех';
                $this->skin->render('success', $data);
            }
        }
    }

    function go_exit() {
        $this->session->sess_destroy();
        redirect('/main/');
    }

    public function my_strip_tags($str) {
        return strip_tags($str, '<p>');
    }

}