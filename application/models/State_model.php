<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: GMajwega
 * Date: 5/8/15
 * Time: 1:03 PM
 */

class State_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }



    function getState($state_val){
        $conditions = array('val'=>$state_val);

        $query = $this->db->get_where('eop_state', $conditions);

        return $query->result_array();

    }

    function getStateName($state_val){

        $state = $this->getState($state_val);
        if(is_array($state) && count($state)>0){
            return $state[0]['name'];
        }else{
            return null;
        }

    }


}