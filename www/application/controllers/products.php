<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Products extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('skin');
        $this->load->model('req');
        $this->load->helper('url');
        $this->load->library('breadcrumbs');
    }

    public function index() {
        $data['title'] = 'Продукция ООО фирма "Витол"';
        $data['all_prod'] = $this->req->get_all_prod();
        $cats = array();
        foreach ($data['all_prod'] as $val) {
            array_push($cats, $val['cat_id']);
        }
        $data['prods'] = $this->req->get_prods_by_cat($cats);
        $data['cats'] = $this->req->get_cats_with_prods($cats);
        $this->skin->render('all_prod', $data);
    }

    function categories() {
        $id = $this->uri->segment(3);
        if ($id == '')
            redirect('/products/');
        $data['cat_name'] = $this->req->get_cat_name($id);
        $data['category_id'] = $id;
        $data['items'] = $this->req->get_items($id);
        $data['title'] = $data['cat_name']['cat_name'];
        $data['description'] = $data['cat_name']['description'];
        $data['keywords'] = $data['cat_name']['keywords'];
        $this->skin->render('prod_list', $data);
    }

    function item() {
        $cat_id = $this->uri->segment(3);
        $prod_id = $this->uri->segment(4);
        if ($cat_id == '' || $prod_id == '')
            redirect('/products/');
        $data['cat_name'] = $this->req->get_cat_name($cat_id);
        $data['item'] = $this->req->get_one_item($prod_id);
        $data['fotos'] = $this->req->get_fotos_of_item($prod_id);
        $data['description'] = $data['item']['description'];
        $data['keywords'] = $data['item']['keywords'];
        $data['title'] = $data['item']['prod_name'];
        $this->skin->render('item', $data);
    }

}

