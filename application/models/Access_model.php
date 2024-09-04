<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: GMajwega
 * Date: 5/8/15
 * Time: 1:03 PM
 */

class Access_model extends CI_Model {

    public function __construct(){
        parent::__construct();
        $this->load->model('school_model');
        $this->load->model('district_model');
    }

    public function getStateWideStateAccess(){

        return $this->registry_model->getValue('state_permission');
    }

    public function getDistrictWideStateAccess($district){

 
        $districtRow = $this->district_model->getDistrict($district);

        return $districtRow[0]['state_permission'];
    }

    public function getSchoolWideStateAccess($school){
        $schoolRow = $this->school_model->getSchool($school);

        return $schoolRow[0]['state_permission'];
    }

    public function grantStatewideAccess(){
        return $this->registry_model->update('state_permission', 'write');
    }

    public function revokeStatewideAccess(){
       return $this->registry_model->update('state_permission', 'deny');
    }

    public function grantDistrictWideAccess($did){
        $data = array(
            'state_permission' => 'write'
            );
        return $this->district_model->updateDistrict($did, $data);
    }
    public function revokeDistrictWideAccess($did){
         $data = array(
            'state_permission' => 'deny'
            );
        return $this->district_model->updateDistrict($did, $data);
    }


    public function grantSchoolWideAccess($sid){

        $data = array(
            'state_permission' => 'write'
            );
        return $this->school_model->updateSchool($sid, $data);

    }

    public function revokeSchoolWideAccess($sid){

        $data = array(
            'state_permission' => 'deny'
            );
        return $this->school_model->updateSchool($sid, $data);

    }

    /**
     * @method getStateAccess
     *  State Access to EOP
     */
    public function getStateAccess(){

        $stateAccess = $this->getStateWideStateAccess();

        return $stateAccess;
    }


}