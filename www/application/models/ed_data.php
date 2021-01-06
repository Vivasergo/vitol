<?php

class Ed_data extends CI_Model {

    function change_cat($post) {
        $update_data = array('cat_name' => $post['cat_name'], 'description' => $post['cat_description'], 'keywords' => $post['cat_keywords']);
        $this->db->where('id', $this->uri->segment(3));
        if (!$this->db->update('prod_cat', $update_data))
            return FALSE;
        else {
            return TRUE;
        }
    }

    function add_cat($post) {
        $ins_data = array('cat_name' => $post['cat_name'], 'keywords' => $post['cat_keywords'], 'description' => $post['cat_description'], 'link' => '/products/categories/');
        if (!$this->db->insert('prod_cat', $ins_data))
            return FALSE;
        else {
            return TRUE;
        }
    }

    function add_new_item($post) {
        $cat_id = $this->uri->segment(3);
        $data_ins = array('prod_name' => $post['prod_name'], 'prod_desc' => $post['prod_desc'], 'keywords' => $post['prod_keywords'],
            'description' => $post['prod_description'], 'cat_id' => $cat_id);
        if (!$this->db->insert('prod_list', $data_ins))
            return FALSE;
        else {
            return TRUE;
        }
    }

    function change_item($post) {
        $update = array('prod_name' => $post['prod_name'], 'prod_desc' => $post['prod_desc'], 'keywords' => $post['prod_keywords'],
            'description' => $post['prod_description']);
        $prod_id = $this->uri->segment(4);
        $this->db->where('id', $prod_id);
        if (!$this->db->update('prod_list', $update))
            return FALSE;
        else {
            return TRUE;
        }
    }

    function add_new_img($post) {
        $insert = array('link' => $post['file_link'], 'title' => $post['title'], 'alt' => $post['alt'], 'prod_id' => $this->uri->segment(4));
        if (!$this->db->insert('foto', $insert))
            return FALSE;
        else {
            return TRUE;
        }
    }

    function change_img_data($post) {
        $update = array('title' => $post['title_img'], 'alt' => $post['alt_img']);
        $prod_id = $this->uri->segment(4);
        $this->db->where('id', $prod_id);
        if (!$this->db->update('foto', $update))
            return FALSE;
        else {
            return TRUE;
        }
    }

    function get_img($img_id) {
        $this->db->select('link');
        $this->db->where('id', $img_id);
        $this->db->from('foto');
        $res = $this->db->get();
        if ($res->num_rows() > 0)
            return $res->row_array();
        else
            return false;
    }

    function del_img($img_id) {
        if (!$this->db->delete('foto', array('id' => $img_id))) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function del_item($prod_id) {
        if (!$this->db->delete('foto', array('prod_id' => $prod_id))) {
            return FALSE;
        }
        if (!$this->db->delete('prod_list', array('id' => $prod_id))) {
            return FALSE;
        }
        return TRUE;
    }
    function del_cat($cat_id) {
        if (!$this->db->delete('prod_cat', array('id' => $cat_id))) {
            return FALSE;
        }
        return TRUE;
    }
}