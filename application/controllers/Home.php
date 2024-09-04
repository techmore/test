<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller{

	public $data = array();

	public function __construct(){
		parent::__construct();
        $this->load->model('page_model');
        $this->load->model('resource_model');
        $this->load->model('registry_model');

	}


	public function index(){

        if(!isset($this->db) || !$this->db->conn_id){
            redirect('/install');
        }

        if($this->session->userdata('is_logged_in')){

            //Check if Code and Database are same version
            if($this->same_versions()){

                // Load the home screen if the user is logged in
                $this->template->set('page_title', 'Home');
                $this->template->set('step_title', 'Getting Started');
                $resources = $this->resource_model->getCompiledResources();

                $data = array(
                    'step'      =>  1,
                    'page'      =>  'home',
                    'resources' =>  $resources
                );
                $this->template->load('template', 'home_screen', $data);
            }else{

                //Redirect to database update process
                redirect('/update');
            }
        }
        else{
            // Redirect to login for if not logged in
            redirect('/login');
        }
	}

    /**
     *  Action to load home steps pages
     * @method step
     * @param INT page number
     */
    public function step($step=1){
        if($this->session->userdata('is_logged_in')){

            $step = ($step<=3)? $step : 1;
            $resources = $this->resource_model->getCompiledResources();
            
            $this->template->set('page_title', 'Home');
            $this->template->set('step_title', 'Getting Started');
            $data = array(
                'step'      =>  $step,
                'page'      =>  'home',
                'resources' =>  $resources
            );
            $this->template->load('template', 'home_screen', $data);
        }
        else{
            // Redirect to login for if not logged in
            redirect('/login');
        }
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