<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_model extends CI_Model {

    public function __construct(){
        parent::__construct();

        $this->load->model('school_model');
    }

    public function getSchoolsWithData(){

        $schools = null;
        
        $this->db->select('sid')
            ->distinct('sid')
            ->from('eop_view_entities')
            ->where("sid IS NOT NULL AND (
                                            id IN (select distinct(entity_id) FROM eop_field where body !='')
                                          OR
                                            description like '{%}'
                                          )",
                NULL,
                FALSE);
        //FALSE stops codeigniter from escaping the select statement which might be detrimental.

        $query = $this->db->get();

        $school_ids =  $query->result_array();

        if(is_array($school_ids) && count($school_ids)>0){
            foreach($school_ids as $key=>$school_id){
                $school = $this->school_model->getSchool($school_id['sid']);
                $school[0]['last_modified'] = $this->getLastModifiedDate($school_id['sid']);
                $schools[$key]= $school;
            }
        }

        return $schools;
    }

    public function getLastModifiedDate($sid){


        $fieldDate = $this->getLastModifiedFieldDate($sid);
        $entityDate = $this->getLastModifiedEntityDate($sid);

        if(strtotime($fieldDate) > strtotime($entityDate)){
            return $fieldDate;
        }else{
            return $entityDate;
        }

    }

    public function getLastModifiedFieldDate($sid){
        $this->db->select_max('A.timestamp')
            ->from('eop_field A')
            ->join('eop_entity B', 'A.entity_id = B.id')
            ->where(array('B.sid'=>$sid));
        $query = $this->db->get();


        return $query->result_array()[0]['timestamp'];

    }

    public function getLastModifiedEntityDate($sid){
        $this->db->select_max('timestamp')
            ->from('eop_entity')
            ->where(array('sid'=>$sid));
        $query = $this->db->get();

        return $query->result_array()[0]['timestamp'];
    }

    public function hasData($sid){
        $this->db->select('sid')
                ->distinct('sid')
                ->from('eop_view_entities')
                ->where(array('sid'=>$sid));
        $query = $this->db->get();

        $ret = count($query->result_array());

        if($ret>0)
            return true;
        else
            return false;
    }



}