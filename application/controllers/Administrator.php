<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Administrator Controller Class
 *
 * Developed by Synergy Enterprises, Inc. for the U.S. Department of Education
 *
 * Team Responsible for:
 *
 * - Managing Events calendar operations
 *
 *
 * Date: 06/26/19 05:34 PM
 *
 *  EOP Assist 5.0 Feature addition
 *
 * (c) 2019 United States Department of Education
 */

class Administrator extends CI_Controller{

    public function __construct(){
        parent::__construct();

        if($this->session->userdata('is_logged_in')){

            $this->load->model('registry_model');
            $this->load->model('user_model');
        }
        else{
            redirect('/login');
        }
    }

    public function index(){

        $this->authenticate();
        $role = $this->user_model->getUserRole($this->session->userdata('user_id'));
        // Get the role access permissions for the logged in user
        $program_administrator = json_decode($this->registry_model->getValue('program_administrator'), true);

        $templateData = array(
            'page'                      =>  'administrator',
            'page_title'                =>  'Administrator Contact Management',
            'step_title'                =>  'Program Administrator',
            'role'                      =>  $role,
            'program_administrator'     =>  $program_administrator
        );
        $this->template->load('template', 'administrator_screen', $templateData);

    }

    public function update(){

        $name = $this->input->post('name');
        $title = $this->input->post('title');
        $agency = $this->input->post('agency');
        $phone = $this->input->post('phone');
        $email = $this->input->post('email');

        $data = array(
            'contact_name'=>$name,
            'contact_title'=>$title,
            'contact_agency'=>$agency,
            'contact_phone'=>$phone,
            'contact_email'=>$email
        );

        $savedRecs = $this->registry_model->update('program_administrator', json_encode($data));

        if($savedRecs && is_numeric($savedRecs) && $savedRecs>0){
            $this->session->set_flashdata('success', 'Administrator contact updated successfully!');
        }else{
            $this->session->set_flashdata('error', 'Update failed!');
        }


        redirect('/administrator');
    }

    /**
     * Function checks if user is logged in, redirects to login page if not.
     * @method authenticate
     * @return void
     */
    function authenticate(){
        if($this->session->userdata('is_logged_in')){
            //do nothing
        }
        else{
            redirect('/login');
        }
    }
}