<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: GMajwega
 * Date: 5/19/15
 * Time: 1:00 PM
 */

class Access extends CI_Controller{


    public function __construct(){
        parent::__construct();

        if($this->session->userdata('is_logged_in')){
            // Load the user_model that will handle most database operations
            $this->load->model('registry_model');
            $this->load->model('user_model');
            $this->load->model('district_model');
            $this->load->model('access_model');

            $host_state = $this->registry_model->getValue('host_state');
            $this->session->set_userdata('host_state', $host_state);

        }
        else{
            redirect('/login');
        }

    }

    public function index(){

        // Get the role access permissions for the logged in user
        $role = $this->user_model->getUserRole($this->session->userdata('user_id'));
        $stateWideStateAccess = $this->access_model->getStateWideStateAccess();

        $district_val = $this->user_model->getUserDistrict($this->session->userdata('user_id'));
        $school_val = $this->user_model->getUserSchool($this->session->userdata('user_id'));

        if(is_array($district_val) && count($district_val)>=1)
        $districtWideStateAccess = $this->access_model->getDistrictWideStateAccess($district_val[0]['did']);

        if(is_array($school_val) && count($school_val)>=1)
        $schoolWideStateAccess = $this->access_model->getSchoolWideStateAccess($school_val[0]['sid']);


        $templateData = array(
            'page'                  =>  'access',
            'page_title'            =>  'State Access',
            'step_title'            =>  'EOP State Access',
            'role'                  =>  $role,
            'stateWideStateAccess'  =>  $stateWideStateAccess,
            'districtWideStateAccess'=> isset($districtWideStateAccess) ? $districtWideStateAccess : '',
            'schoolWideStateAccess' =>  isset($schoolWideStateAccess) ? $schoolWideStateAccess : ''
        );
        $this->template->load('template', 'state_access_screen', $templateData);
    }

    public function grant_statewide_access(){

        if($this->input->post('ajax')){
            $recs = $this->access_model->grantStatewideAccess();

            if(is_numeric($recs) && $recs>=1){ // We were successful
                $this->output->set_output('1');
            }else{
                $this->output->set_output('0');
            }

        }
        else{ // Do nothing

        }
    }

    public function revoke_statewide_access(){

        if($this->input->post('ajax')){
            $recs = $this->access_model->revokeStatewideAccess();

            if(is_numeric($recs) && $recs>=1){ // We were successful
                $this->output->set_output('1');
            }else{
                $this->output->set_output('0');
            }

        }
        else{ // Do nothing

        }
    }

    public function grant_districtwide_access(){

        if($this->input->post('ajax')){
            $district_val = $this->user_model->getUserDistrict($this->session->userdata('user_id'));

            if(is_array($district_val) && count($district_val)>=1){
                $recs = $this->access_model->grantDistrictWideAccess($district_val[0]['did']);
            }

            if(isset($recs) && is_numeric($recs) && $recs>=1){ // We were successful
                $this->output->set_output('1');
            }else{
                $this->output->set_output('0');
            }

        }
        else{ // Do nothing

        }
    }

    public function revoke_districtwide_access(){
        if($this->input->post('ajax')){
            $district_val = $this->user_model->getUserDistrict($this->session->userdata('user_id'));

            if(is_array($district_val) && count($district_val)>=1){
                $recs = $this->access_model->revokeDistrictWideAccess($district_val[0]['did']);
            }

            if(isset($recs) && is_numeric($recs) && $recs>=1){ // We were successful
                $this->output->set_output('1');
            }else{
                $this->output->set_output('0');
            }

        }
        else{ // Do nothing

        }
    }

    public function grant_schoolwide_access(){
        if($this->input->post('ajax')){
            $school_val = $this->user_model->getUserSchool($this->session->userdata('user_id'));

            if(is_array($school_val) && count($school_val)>=1){
                $recs = $this->access_model->grantSchoolWideAccess($school_val[0]['sid']);
            }

            if(isset($recs) && is_numeric($recs) && $recs>=1){ // We were successful
                $this->output->set_output('1');
            }else{
                $this->output->set_output('0');
            }

        }else{
            // Do nothing
        }
    }

    public function revoke_schoolwide_access(){

        if($this->input->post('ajax')){
            $school_val = $this->user_model->getUserSchool($this->session->userdata('user_id'));

            if(is_array($school_val) && count($school_val)>=1){
                $recs = $this->access_model->revokeSchoolWideAccess($school_val[0]['sid']);
            }

            if(isset($recs) && is_numeric($recs) && $recs>=1){ // We were successful
                $this->output->set_output('1');
            }else{
                $this->output->set_output('0');
            }

        }else{
            // Do nothing
        }

    }

}