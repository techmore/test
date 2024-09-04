<?php

/**
 * Created by PhpStorm.
 * User: godfreymajwega
 * Date: 11/17/16
 * Time: 9:58 AM
 */
class Page_model extends CI_Model{

    public function __construct(){
        parent::__construct();

    }

    function get($data=''){

        $criteria = array();

        if(is_array($data) && count($data)>0){

            if(array_key_exists('id', $data))
                $criteria['id'] = $data['id'];

            $query = $this->db->get_where('eop_page', $criteria);
        }else{
            $query = $this->db->get('eop_page');
        }
        $results_array = $query->result_array();

        return $results_array;

    }
    function add($pageData){

    }
}