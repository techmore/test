<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Login
 *
 * A Controller Responsible for handling user authentication
 * - Access control (login and logout)
 */

class Login extends CI_Controller{

	public $data = array();

	public function __construct(){
		parent::__construct();
        $this->load->model('registry_model');
        $this->load->model('user_model');
        $this->load->model('school_model');
	}

	public function index(){

        if(!isset($this->db) || !$this->db->conn_id){
            redirect('/install');
        }

        $is_installed = $this->registry_model->getValue('install_status');

        if($is_installed){ // Check if app is installed

            if($this->session->userdata('is_logged_in')){

                //Check if Code and Database are same version
                if($this->same_versions()){

                    // If the user has already logged in take them to the home page
                    redirect('/home');
                }else{

                    //Redirect to database update process
                    redirect('/update');
                }

            }
            else{
                //Load the login form page
                //redirect('/login/validate'); || removed in version 5.0 was showing login failed error even if visiting page for the first time.
                $this->login_form();

            }
        }else{ // Redirect to app which will initiate the install process
            redirect('/app');
        }
        
	}

	public function validate(){
		$username 	= $this->input->post('username');
		$password 	= $this->input->post('password');

        if(!empty($username) && !empty($password)){
            $check	=	$this->user_model->validate($username, $password);

            if($check){ // Login credentials match

                $userStatus = $this->user_model->getStatus($username);

                if($userStatus == 'active'){ // User is active
                    $sessionData = array(
                        'is_logged_in'	=>	TRUE,
                        'username'		=>	$username,
                        'role'          => $this->user_model->getUserRoleByUsername($username)
                    );

                    //Get the host state and add to session
                    $this->session->set_userdata('host_state', $this->registry_model->getValue('host_state'));

                    //Get the host level and add to session
                    $this->session->set_userdata('host_level', $this->registry_model->getValue('host_level'));

                    // Load user's school into session object for school users and school administrators
                    if($sessionData['role']['level'] > DISTRICT_ADMIN_LEVEL){

                        $userRow = $this->user_model->getUser($username, 'username');
                        $this->school_model->attach_to_session($userRow[0]['school_id']);

                    }

                    // Load user's district into session object for District administrators only
                    if($sessionData['role']['level'] == DISTRICT_ADMIN_LEVEL){

                        $this->load->model('district_model');

                        $districtRow = $this->user_model->getUserDistrict($this->session->userdata('user_id'));
                        $this->district_model->attach_to_session($districtRow[0]['did']);
                    }


                    $this->session->set_userdata($sessionData);

                    //Redirect to the home page
                    redirect('/home');
                }elseif($userStatus == 'blocked'){ // User is blocked

                    //Create flash error message and send back to login page
                    $this->session->set_flashdata('error', 'Your account has been blocked!');
                    $this->login_form();
                }

            }
            else{ // Login failed

                //Create flash error message and send back to login page
                $this->session->set_flashdata('error', 'Login failed! Please provide a valid user ID and password');
                $this->login_form();
            }
        }else{
            $this->session->set_flashdata('error', 'Login failed! Please provide a valid user ID and password');
            $this->login_form();
        }


	}

    /**
     * Action for loading the login form view
     */
    public function login_form($message=''){
        $program_administrator = json_decode($this->registry_model->getValue('program_administrator'), true);

        $templateData = array(
            'page'                  =>  'login',
            'page_title'            => 'Log In',
            'program_administrator' =>  $program_administrator
        );

        $this->template->load('template', 'login_screen', $templateData);

    }

    /**
     * Action to signout/logout users
     * We will destroy the session object and redirect to login screen
     */
    public function signout(){

        // Destroy the entire session object
        $this->session->sess_destroy();

        if($this->input->post('ajax')){
            // Do something for ajax specific requests
        }
        else{
            // Do something for other non AJAX requests
        }


        // Redirect to home or login screen
        redirect('/login');

    }

    /**
     * Check if the Code version is similar to the Database version.
     *
     * @return boolean
     *
     */
    private function same_versions(){

        if($this->registry_model->hasKey('version')){

            $DBversion = $this->registry_model->getValue('version');

            return ($DBversion && ($DBversion == VERSION));

        }
        else{
            return false;
        }
    }
}