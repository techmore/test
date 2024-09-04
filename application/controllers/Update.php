<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update extends CI_Controller{

    public $percentage = 0;

    public function  __construct(){

        parent::__construct();

        // Load  modules
        //$this->load->model('update_model');
        $this->load->model('registry_model');
        $this->load->model('app_model');
        $this->load->model('update_model');

    }

    public function index(){

        //Make sure user is logged in
        $this->authenticate();

        $this->template->set('page_title', 'Database Updates');
        $data = array(
            'page'          =>  'home',
            'step_title'    =>  'Installing Required Updates'
        );

        $this->template->load('update/template', 'update/home', $data);
    }


    public function run($count){

        //header('Content-Type: text/octet-stream');
        //header('Cache-Control: no-cache');

        switch($count){
            case 1:
                //Add the new database tables
                $this->addTables();
                break;
            case 2:
                //Add version number to registry table
                $this->updateRegistry();
                break;
        }

    }

    
    private function addTables(){

        //$tables = array('eop_page', 'eop_resource', 'eop_resource2page', 'eop_sessions');

        $host_field = array(
            'host'          => array(
                'type'          =>  'varchar',
                'constraint'    =>  16,
                'null'          =>  true
            )
        );

        $this->app_model->createTable('eop_files', $this->config->item('db')['dbdriver']);

        $this->app_model->createTable('eop_exercise', $this->config->item('db')['dbdriver']);

        $this->app_model->createTable('eop_training', $this->config->item('db')['dbdriver']);

        $this->app_model->addFields('eop_exercise', $host_field, $this->config->item('db')['dbdriver']);
        

        if($this->registry_model->hasKey('version')){
            if($this->registry_model->getValue('version')=='2.0'){
                $this->update_model->updateEntityTable();
            }
        }else{
            $this->update_model->updateEntityTable();
        }

        //$this->session->set_userdata['update_progress'] = 'populate';
        $this->send_message("Adding new tables to the database.", 50);

    }

    

    private function updateRegistry(){

        $value = VERSION;

        if($this->registry_model->hasKey('version')){

            $this->registry_model->update('version', "$value");
        }else{
            $this->registry_model->addVariable('version', "$value");
        }
        

        $this->session->unset_userdata('update_progress');
        $this->send_message("Writing to registry", 100, false);

    }


    /**
     * @param $message
     * @param $progress
     * @param bool $more
     */
    function send_message($message, $progress, $more=true)
    {

        $d = array('message' => $message , 'progress' => $progress, 'more'=>$more);

        echo json_encode($d);

        //PUSH THE data out by all FORCE POSSIBLE
        //ob_flush();
        //flush();
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