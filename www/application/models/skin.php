<?php
class Skin extends CI_Model {

    function render($name, $data=array())
    {
     /*   $desc=$this->req->get_main_meta();

        if($desc['desc']=='')
            {
                if(isset($data['desc']) && $data['desc']!='')
                     $data['desc']=$data['desc'];
                else
                {
                    $data['desc']='Описание по умолчанию, если ни для одной страницы не установлено описание, кроме главной.';
                }
            }
            else $data['desc']=$desc['desc'];

            if($desc['keywords']=='')
            {
                 if(isset($data['keywords']) && $data['keywords']!='')
                     $data['keywords']=$data['keywords'];
                 else
                 {
                     $data['keywords']='Ключевые слова по умолчанию, если ни для одной страницы не установлено описание, кроме главной.';
                 }
            }
            else $data['keywords']=$desc['keywords'];
        */
        
        $data['menu']=  $this->req->get_menu('prod_cat');
        $data['breadcrumbs']=  $this->breadcrumbs->get_breadcrumbs($data);
        $this->load->view('top_header', $data);
        $this->load->view('h_menu_header', $data);
        $this->load->view('nav_header', $data);
        $this->load->view('prod_menu_left', $data);
        $this->load->view($name, $data);
        $this->load->view('footer', $data);

    }
}