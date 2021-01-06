<?php

class Req extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_menu($table) {
        $this->db->select("cat_name, `id`, `link`, `description`, `keywords`");
        $this->db->order_by('cat_name',"ASC");
        $res = $this->db->get($table);
        if ($res->num_rows() > 0)
            return $res->result_array();
        else
            return false;
    }

    function get_cat_name($id) {
        $this->db->select('cat_name, description, keywords');
        $this->db->where('id', $id);
        $this->db->from('prod_cat');
        $res = $this->db->get();
        if ($res->num_rows() > 0)
            return $res->row_array();
        else
            return false;
    }

    function get_items($id) {
        $this->db->select('prod_name, id');
        $this->db->where('cat_id', $id);
        $this->db->from('prod_list');
        $this->db->order_by('prod_name','asc');
        $res = $this->db->get();
        if ($res->num_rows() > 0)
            return $res->result_array();
        else
            return false;
    }

    function get_all_prod() {
        $this->db->select('prod_name, prod_desc, id, cat_id');
        $this->db->from('prod_list');
        $this->db->order_by("prod_name", "asc");
        $this->db->group_by('cat_id');
        $res = $this->db->get();
        if ($res->num_rows() > 0)
            return $res->result_array();
        else
            return false;
    }

    function get_cats_with_prods($cats) {
        $this->db->select("cat_name, id");
        $this->db->from('prod_cat');
        $this->db->order_by("cat_name", "asc");
        $this->db->where_in('id', $cats);
        $res = $this->db->get();
        if ($res->num_rows() > 0)
            return $res->result_array();
        else
            return false;
    }

    function get_prods_by_cat($data) {
        $this->db->select('prod_name, id, cat_id');
        $this->db->from('prod_list');
        $this->db->order_by("prod_name", "asc");
        $this->db->where_in('cat_id', $data);
        $res = $this->db->get();
        if ($res->num_rows() > 0)
            return $res->result_array();
        else
            return false;
    }
    function get_prods_id_by_cat($data) {
        $this->db->select('id');
        $this->db->from('prod_list');
        $this->db->where('cat_id', $data);
        $res = $this->db->get();
        if ($res->num_rows() > 0)
            return $res->result_array();
        else
            return $res=0;
    }

    function get_one_item($id) {
        $this->db->select('prod_name, prod_desc, id, keywords, description');
        $this->db->where('id', $id);
        $this->db->from('prod_list');
        $res = $this->db->get();
        if ($res->num_rows() > 0)
            return $res->row_array();
        else
            return false;
    }

    function get_item_cat_name($prod_id) {
        $this->db->select('cat_name, prod_cat.id');
        $this->db->from('prod_list');
        $this->db->join('prod_cat', 'prod_cat.id=prod_list.cat_id');
        $this->db->where('prod_list.id', $prod_id);
        $res = $this->db->get();
        if ($res->num_rows() > 0)
            return $res->row_array();
        else
            return false;
    }

    function get_prod_id_by_foto_id($foto_id) {
        $this->db->select('prod_id');
        $this->db->where('id', $foto_id);
        $this->db->from('foto');
        $res = $this->db->get();
        if ($res->num_rows() > 0)
            return $res->row_array();
        else
            return false;
    }

    function get_fotos() {
        $this->db->select("link, foto.id, title, alt, prod_name");
        $this->db->join('prod_list', 'prod_list.id=foto.prod_id');
        $this->db->from('foto');
        $this->db->order_by("id", "asc");
        $res = $this->db->get();
        if ($res->num_rows() > 0)
            return $res->result_array();
        else
            return false;
    }

    function get_fotos_of_item($prod_id) {
        $this->db->select("link, title, alt, id");
        $this->db->where('prod_id', $prod_id);
        $this->db->from('foto');
        $this->db->order_by("id", "asc");
        $res = $this->db->get();
        if ($res->num_rows() > 0)
            return $res->result_array();
        else
            return false;
    }

    function get_fotos_link($prod_id) {
        $this->db->select('link');
        $this->db->from('foto');
        $this->db->where('prod_id', $prod_id);
        $res = $this->db->get();
        if ($res->num_rows() > 0)
            return $res->result_array();
        else
            return $res = '';
    }

    function adm_check($log) {
        $this->db->select('log, pass');
        $this->db->from('adm_data');
        $this->db->where('log',$log);
        $res = $this->db->get();
        if ($res->num_rows() > 0)
            return $res->row_array();
        else
            return false;
    }


    function search($post) {
        $query = $this->db->query("SELECT cat_name, prod_cat.id as cat_id, prod_list.id as prod_id, prod_name, SUBSTR(prod_desc, 1, 150) as prod_desc FROM prod_list
            JOIN prod_cat on prod_list.cat_id=prod_cat.id WHERE prod_desc LIKE '%" . $post['search'] . "%' OR prod_name LIKE '%" . $post['search'] . "%' ORDER BY prod_cat.id ASC");
        if ($query->num_rows() > 0)
            return $query->result_array();
        else
            return false;
    }

}