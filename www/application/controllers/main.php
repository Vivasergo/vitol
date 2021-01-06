<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Main extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->uri->segment(1) != 'admin') {
            $this->session->sess_destroy();
        }
        $this->load->helper(array('form', 'url'));
        $this->load->model('skin');
        $this->load->model('req');
        $this->load->library('form_validation');
        $this->load->library('breadcrumbs');
    }

    public function index() {
        /*  $desc=$this->req->get_main_meta();
          if($desc['desc']=='')
          {
          $ind=  $this->req->get_ind_meta();
          if($ind['desc']=='')
          {
          $data['desc']='Описание по умолчанию для главной страницы, если ни для всего сайта ни для главной страницы не установлено описание.';
          }
          else {$data['desc']=$ind['desc'];}
          }
          if($desc['keywords']=='')
          {
          $ind=  $this->req->get_ind_meta();
          if($ind['keywords']=='')
          {
          $data['keywords']='Ключевые слова по умолчанию для главной страницы, если ни для всего сайта ни для главной страницы не установлены ключевые слова. ';
          }
          else {$data['keywords']=$ind['keywords'];}
          }
         */
        $data['title'] = 'Главная. ООО фирма "Витол"';
        $data['top_menu'] = 'main';
        $this->skin->render('main_cont', $data);
    }

    function design() {
        $data['title'] = 'Проектирование';
        $this->skin->render('design', $data);
    }

    function contacts() {
        $data['title'] = 'Контакты';
        $this->skin->render('contacts', $data);
    }

    function gallery() {
        $data['title'] = 'Фотогалерея';
        $data['fotos'] = $this->req->get_fotos();
        $this->skin->render('gallery', $data);
    }

    function mail_us() {
        $this->load->library('email');
        $this->form_validation->set_message('required', 'Поле %s не заполнено!');
        $this->form_validation->set_message('valid_email', 'Поле %s должно содержать правильный электронный адрес!');
        $this->form_validation->set_rules('organization', 'Организация', 'trim|xss_clean|strip_tags');
        $this->form_validation->set_rules('person', 'Контактное лицо', 'trim|xss_clean|strip_tags');
        $this->form_validation->set_rules('e-mail', 'E-mail', 'trim|required|xss_clean|strip_tags|valid_email');
        $this->form_validation->set_rules('phone', 'Телефон', 'trim|xss_clean|strip_tags');
        $this->form_validation->set_rules('message', 'Сообщение', 'trim|required|xss_clean|strip_tags');
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Контакты';
            $this->skin->render('contacts', $data);
        } else {
            $config['protocol'] = 'smtp';
         //   $config['mailpath'] = '/usr/sbin/sendmail';
           $config['smtp_host']='mail.ukraine.com.ua';
            $config['smtp_port']='2525';
            $config['smtp_user']='info@vitol.in.ua';
            $config['smtp_pass']='viktor1952';
            $config['wordwrap'] = TRUE;

            $this->email->initialize($config);
            $post = $this->input->post();

            $mess = "Организация:" . $post['organization'] . "\nКонтактное лицо:" . $post['person'] . "\nТелефон:" . $post['phone'] . "\nE-mail:" . $post['e-mail']."\nСообщение:" . $post['message'];
            $this->email->from('info@vitol.in.ua', $post['organization']);

            $this->email->reply_to($post['e-mail'], $post['organization']);
            $this->email->to('vitol1995@mail.ru');
            $this->email->subject('Письмо с сайта фирмы "Витол"');
            $this->email->message($mess);

            if (!$this->email->send()) {
                $data['title'] = 'Ошибка';
                $data['error'] = "Произошла ошибка при отправке сообщения";
                $this->skin->render('error', $data);
            } else {
                $data['title'] = 'Сообщение отправлено';
                $data['mess'] = "Ваше сообщение успешно отправлено";
                $data['info'] = 'Наши сотрудники ответят на ваше сообщение в ближайшее время.';
                $this->skin->render('mail_success', $data);
            }
        }
    }

    function search() {
        if ($this->input->post('search') == '') {
            redirect('/');
        }
        $this->form_validation->set_rules('search', 'search', 'trim|xss_clean|strip_tags');
        if ($this->form_validation->run() == FALSE) {
            redirect('/');
        } else {
            $post = $this->input->post();
            $data['title'] = 'Результат поиска';
            $data['search'] = $this->req->search($post);
            $this->skin->render('search_res', $data);
        }
    }

    function map() {
        $data['title'] = 'Карта сайта';
        $data['all_prod'] = $this->req->get_all_prod();
        $cats = array();
        foreach ($data['all_prod'] as $val) {
            array_push($cats, $val['cat_id']);
        }
        $data['prods'] = $this->req->get_prods_by_cat($cats);
        $data['cats'] = $this->req->get_cats_with_prods($cats);
        $this->skin->render('map', $data);
    }

    /*    function registration_form()
      {
      $data['title']= 'Регистрация';
      $this->skin->render('reg_form', $data);
      }
      function registration()
      {
      $this->form_validation->set_message('required', 'Поле не заполнено!');
      $this->form_validation->set_message('numeric', 'В поле %s допускаются только цифры');
      $this->form_validation->set_message('matches', 'Пароль не совпадает с повторным паролем!');
      $this->form_validation->set_message('valid_email', 'E-mail введен не верно!');
      $this->form_validation->set_message('min_length', 'Минимальное количество символов в поле %s : 3!');
      $this->form_validation->set_rules('user_name', 'Имя', 'trim|required|min_length[3]|max_length[12]|xss_clean|strip_tags');
      $this->form_validation->set_rules('login', 'Логин', 'trim|required|xss_clean|strip_tags');
      $this->form_validation->set_rules('pass', 'Пароль', 'trim|required|min_length[3]|xss_clean|matches[pass_check]|strip_tags|md5');
      $this->form_validation->set_rules('pass_check', 'Повторный пароль', 'trim|required|md5|strip_tags|xss_clean');
      $this->form_validation->set_rules('e_mail', 'E-mail', 'trim|required|valid_email|xss_clean|strip_tags');
      $this->form_validation->set_rules('captcha', 'Капча', 'trim|required|xss_clean|strip_tags|numeric|md5');
      $this->form_validation->set_rules('cap', 'Капча', 'trim|required|xss_clean|strip_tags');
      $this->form_validation->set_rules('status', 'status', 'trim|xss_clean|strip_tags|alpha');

      if ($this->form_validation->run() == FALSE)
      {
      $data['title']= 'Регистрация';
      $this->skin->render('reg_form', $data);
      }
      else
      {
      $data['title']= 'Регистрация';
      $post = $this->input->post();
      if ($post['captcha']!=$post['cap'])
      {
      $data['title']='Ошибка';
      $data['error']='Цыфры введены не верно ';
      $this->skin->render('user_name_error', $data);
      return FALSE;
      }
      $this->req->new_user($post);
      }
      }

      function search()
      {
      if($this->input->post('search') == '')
      {
      redirect('/');
      }
      $this->form_validation->set_rules('search', 'search', 'trim|xss_clean|strip_tags');
      if ($this->form_validation->run() == FALSE)
      {
      redirect('/');
      }
      else
      {
      $post=  $this->input->post();
      $data['title']= 'Блог';
      $data['blog']=$this->req->search($post);
      $this->skin->render('blog', $data);
      }
      }
      function confirm()
      {
      $check=  $this->uri->segment(3);
      $this->req->confirm($check);
      }
      function enter()
      {
      $this->form_validation->set_message('required', 'Поле не заполнено!');
      $this->form_validation->set_rules('pass', 'Пароль', 'trim|required|xss_clean|strip_tags|md5');
      $this->form_validation->set_rules('login', 'Логин', 'trim|required|xss_clean|strip_tags');
      if ($this->form_validation->run() == FALSE)
      {
      $data['title']= 'Регистрация';
      $this->skin->render('right_side', $data);
      }
      else
      {
      $post=$this->input->post();
      $this->req->autorization($post);
      }
      }
      function go_exit()
      {
      $this->session->sess_destroy();
      redirect('/');
      }
     */
}

