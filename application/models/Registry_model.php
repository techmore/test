<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: GMajwega
 * Date: 5/8/15
 * Time: 1:03 PM
 */

class Registry_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }
 
    function addVariable($key, $value){
        $data = array("rkey"=>$key, "value"=>$value);
        $this->db->insert('eop_registry', $data);
        return $this->db->affected_rows();
    }

    function addVariables($data){
        $recordsArray=array();
        foreach($data as $key=>$value){
            array_push($recordsArray, array(
                'rkey'       =>  $key,
                'value'     =>  $value));
        }

        foreach ($recordsArray as $key => $record) {
            $this->db->insert('eop_registry', $record);
        }

        return $this->db->affected_rows();

    }

    function getValue($key){

        $this->db->select("*")
            ->from("eop_registry")
            ->where(array("rkey"=>$key))
            ->limit(1);

        $query = $this->db->get();

        if($query){

            if ($query->num_rows() > 0){
                return $query->row()->value;
            }
            else{
                return False;
            }
        }else{
            return false;
        }


    }


    function hasKey($key){
        $query = $this->db->get_where("eop_registry", array("rkey"=>$key));

        if($query) {
            if ($query->num_rows() > 0) {
                return true;
            } else {
                return false;
            }
        }else{
            return false;
        }
    }

    function hasValue($value){

        $query = $this->db->get_where("eop_registry", array("value"=>$value));

        if($query->num_rows()>0){
            return true;
        }
        else{
            return false;
        }

    }

    function update($key, $value){

        $updateData = array(
            'value'    =>  $value
        );

        $this->db->where('rkey', $key);
        $this->db->update('eop_registry', $updateData);

        return $this->db->affected_rows();
    }

    function updateValue($value){

        $updateData = array(
            'value'    =>  $value
        );

        $this->db->where('value', $value);
        $this->db->update('eop_registry', $updateData);

        return $this->db->affected_rows();

    }
    function updateKey($key){

        $updateData = array(
            'rkey'    =>  $key
        );

        $this->db->where('rkey', $key);
        $this->db->update('eop_registry', $updateData);

        return $this->db->affected_rows();

    }

    function delete($key){

        $this->db->delete('eop_registry', array('rkey' => $key));

        return $this->db->affected_rows();

    }


}