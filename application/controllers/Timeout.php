<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Timeout Controller Class
 *
 * Developed by Synergy Enterprises, Inc. for the U.S. Department of Education
 *
 * Team Responsible for:
 *
 * - Managing Events calendar operations
 *
 *
 * Date: 11/08/16 02:34 PM
 *
 *  EOP Assist 4.0 Feature addition
 *
 * (c) 2016 United States Department of Education
 */

class Timeout extends CI_Controller{

    public function __construct(){
        parent::__construct();

        if($this->session->userdata('is_logged_in')){

            $this->load->model('user_model');
        }
        else{
            redirect('/login');
        }
    }

    public function index(){

        $this->authenticate();

        // Get the role access permissions for the logged in user
        $role = $this->user_model->getUserRole($this->session->userdata('user_id'));
        $currentTimeout = $this->config->item('sess_expiration');

        $templateData = array(
            'page'              =>  'timeout',
            'page_title'        =>  'Time-Out Management',
            'step_title'        =>  'Time-Out',
            'role'              =>  $role,
            'currentTimeout'    =>  round(($currentTimeout / 60), 2, PHP_ROUND_HALF_UP) // Convert to Minutes
        );
        $this->template->load('template', 'timeout_screen', $templateData);

    }

    public function update(){

        $this->load->helper('file');
        $timeValue = round( ($this->input->post('updatetxttime') * 60), 2, PHP_ROUND_HALF_UP); // Convert to Minutes
        $setting = '[\'sess_expiration\']';

        if(is_numeric($timeValue)){
            updateConfig('settings.php', $setting, $timeValue);
            $this->config->set_item('sess_expiration', $timeValue);

            $this->session->set_flashdata('success', 'Time-Out duration updated successfully!');
        }

        redirect('/timeout');
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