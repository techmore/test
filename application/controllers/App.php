<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App extends CI_Controller {

    public $data = array();

    public function __construct(){
        parent::__construct();

        // Load the registry module
        $this->load->model('registry_model');

        if(! function_exists('posix_getpwuid')){

            function posix_geteuid(){

                $arr = array(
                    'name'  =>  getenv('USERNAME') ?: getenv('USER'),
                    'account'=> get_current_user()
                );

                return $arr;
            }

            function posix_getpwuid($uid='Unknown'){

                return $uid;

            }
        }

    }


	/**
	 * Index Page for this controller.
	 *
	 */

	public function index()
	{
        $is_logged_in = FALSE;
        $is_installed = FALSE;
 //      $this->session->sess_destroy();


        /**
         *  Check if the application installation completed successfully
         */
        if(!isset($this->db) || !$this->db->conn_id){

            //echo $this->db->_error_message();
           //var_dump( $this->db->conn_id);
            //echo 'Database not setup';
            //echo $this->db->username;
            $is_installed = false;

        }
        else{

            try{

                $is_installed = $this->registry_model->getValue('install_status');
                $host_state = $this->registry_model->getValue('host_state');
                $this->session->set_userdata(array('install_status' => $is_installed));
                $this->session->set_userdata(array('host_state' => $host_state));

            }catch(Exception $err){
                $is_installed = false;
               // $this->session->unset_userdata('install_statu')
            }

        }


        if($is_installed){ // App is installed

            /** Check if user is logged in */
            if ($this->session->userdata('is_logged_in'))
                $is_logged_in = $this->session->userdata('is_logged_in');


            if($is_logged_in){

                //Check if Code and Database are same version
                if($this->same_versions()){

                    // Redirect to app home page
                    redirect('/home');

                }else{

                    //Redirect to database update process
                    redirect('/update');
                }

            }
            else{
                // Redirect to login page
                redirect('/login');
            }
        }
        else{ //App has never been installed

            //Call the install action to start the installation process
           $this->install();
        }
	}

    /**
    *   Install function action
    *   This action will walk the user through the app installation and config process
    */
    public function install(){

        // installation progress variables
        $install_started = $this->session->userdata('install_started');

        if($install_started == FALSE){ //Installation has never been started

            if(!$this->session->userdata('install_status')){ //Installation not started
                //Load the initial install screen view and set the session data status to install_started
                $this->template->set('title', 'EOP ASSIST '.VERSION.' Installation');
                $data['screen']    =   'hosting_level';
                $data['step']      =   'hosting_level';
                $this->session->set_userdata(array(
                    'install_status'        => 'started',
                    'install_step'          => 'hosting_level',
                    'install_step_status'   => 'initiated'
                ));

                $this->template->load('install/template', 'install/install_screen', $data);
            }
            else{
                $install_step = $this->session->userdata('install_step');
                switch($install_step){
                    case "hosting_level":
                        $install_step_status = $this->session->userdata('install_step_status');
                        if($install_step_status == 'initiated'){

                            if($this->input->post('ajax')){ // If form was submitted using ajax request


                                $data['screen'] =   'verify_requirements';
                                $data['step']   =   'verify_requirements';

                                $this->session->set_userdata(array(
                                    'pref_hosting_level'    => $this->input->post('pref_hosting_level'),
                                    'install_step'          => 'verify_requirements',
                                    'install_step_status'   => 'initiated'
                                ));


                                /**
                                 * Call method to inspect host system
                                 * The method will return an array of status messages
                                 */
                                $statusMsgs = $this->checkRequirements();
                                $data['status']=$statusMsgs;

                                //$this->output->set_output(json_encode($data));

                                $this->output->set_output($this->load->view('install/embeds/verify_requirements', $data, TRUE));
                            }
                            else{
                                $this->session->sess_destroy();
                                redirect("app/install");
                            }
                        }
                        break;
                    case "verify_requirements":
                        $install_step_status = $this->session->userdata('install_step_status');

                        /**
                         * Call method to inspect host system
                         * The method will return an array of status messages
                         */
                        $statusMsgs = $this->checkRequirements();
                        $data['status']=$statusMsgs;

                        if($install_step_status == 'initiated'){

                            if($this->input->post('ajax')){ // If form is submitted using ajax
                                if(count($data['status']['fatal_errs']) <=0 ){

                                    $data['screen'] = 'database_settings';
                                    $data['step'] = 'database_settings';
                                    $this->session->set_userdata(array(
                                        'requirements_verified' => 'yes',
                                        'install_step' => 'database_settings',
                                        'install_step_status' => 'initiated'
                                    ));

                                    //$this->output->set_output(json_encode($data));
                                    $this->output->set_output($this->load->view('install/embeds/database_settings', $data, TRUE));

                                }else{

                                    // print_r ($data['status']);
                                    $data['screen']    =   'verify_requirements';
                                    $data['step']      =   'verify_requirements';
                                    $this->output->set_output($this->load->view('install/embeds/verify_requirements', $data, TRUE));

                                }
                            }
                            else{
                                $this->session->sess_destroy();
                                redirect('app/install');
                            }
                        }
                        break;
                    case "database_settings":
                        $install_step_status = $this->session->userdata('install_step_status');

                        if($install_step_status == 'initiated'){

                            //Get form input and add to session
                            $configs = array(
                                'database' => array(
                                    'hostname'  =>  $this->input->post('host_name'),
                                    'username'  =>  $this->input->post('database_username'),
                                    'password'  =>  $this->input->post('database_password'),
                                    'database'  =>  $this->input->post('database_name'),
                                    'dbdriver'  =>  ($this->input->post('database_type')) ? $this->input->post('database_type') : 'mysqli'
                                )
                            );

                            $this->session->set_userdata($configs);

                            /**
                             * Write database settings into config file
                             */
                            $dbsetup = $this->mkconfig($configs);

                            if(!$dbsetup['error']) { // If successfully written to config file

                                // Load the database
                                $config['hostname'] = $configs['database']['hostname'];
                                $config['username'] = $configs['database']['username'];
                                $config['password'] = $configs['database']['password'];
                                $config['database'] = $configs['database']['database'];
                                $config['dbdriver'] = $configs['database']['dbdriver'];
                                $config['pconnect'] = ($configs['database']['dbdriver'] == 'sqlsrv') ? FALSE : TRUE;



                                $this->db = $this->load->database($config, TRUE); // Load the database

                                $connected = $this->db->initialize(); // Initialize the database connections
                            }

                            if($this->input->post('ajax')){ // If form is submitted using ajax

                                if($dbsetup['error']){ // If saving to config file failed

                                    //Set  error message and reload step
                                    //$this->session->set_flashdata('error', $dbsetup['msg']);
                                    $data['screen']    =   'database_settings';
                                    $data['step']      =   'database_settings';
                                    $data['error']     =    $dbsetup['msg'];

                                    $this->output->set_output($this->load->view('install/embeds/database_settings', $data, TRUE));
                                }else{

                                    if (!$connected) {

                                        $data['screen']       = 'database_settings';
                                        $data['step']         = 'database_settings';
                                        $data['error']        = 'Database connection failed!';

                                        //$this->output->set_output(json_encode($data));
                                        $this->output->set_output($this->load->view('install/embeds/database_settings', $data, TRUE));

                                    }else{

                                        $data['screen'] =   'admin_account';
                                        $data['step']   =   'admin_account';
                                        $this->session->set_userdata(array(
                                            'database_settings_set'    => 'yes',
                                            'install_step'          => 'admin_account',
                                            'install_step_status'   => 'initiated'
                                        ));

                                        //$this->output->set_output(json_encode($data));
                                        $this->output->set_output($this->load->view('install/embeds/admin_account', $data, TRUE));

                                    }
                                }
                            }
                            else{

                                if($dbsetup['error']){

                                    $data['screen']    =   'database_settings';
                                    $data['step']      =   'database_settings';
                                    $data['error']     =    $dbsetup['msg'];

                                    $this->template->set('title', 'EOP ASSIST Installation');
                                    $this->template->load('install/template', 'install/install_screen', $data);

                                }else{

                                    if(!$connected){

                                        $data['screen']    =   'database_settings';
                                        $data['step']      =   'database_settings';
                                        $data['error']     =    'Database connection failed!';

                                        $this->template->set('title', 'EOP ASSIST Installation');
                                        $this->template->load('install/template', 'install/install_screen', $data);

                                    }else{

                                        $data['screen']    =   'admin_account';
                                        $data['step']      =   'admin_account';
                                        $this->session->set_userdata(array(
                                            'database_settings_set'    => 'yes',
                                            'install_step'          => 'admin_account',
                                            'install_step_status'   => 'initiated'
                                        ));

                                        $this->template->set('title', 'EOP ASSIST Installation');
                                        $this->template->load('install/template', 'install/install_screen', $data);
                                    }
                                }
                            }
                        }
                        break;
                    case "admin_account":
                        $install_step_status = $this->session->userdata('install_step_status');

                        if($install_step_status == 'initiated'){
                            if($this->input->post('ajax')){ // If form is submitted using ajax

                                // Get the submitted form input
                                $adminData = array(
                                        'username'      =>  $this->input->post('user_name'),
                                        'email'         =>  $this->input->post('user_email'),
                                        'password'      =>  md5($this->input->post('user_password')),
                                        'first_name'    =>  'Super',
                                        'last_name'     =>  'Administrator',
                                        'role_id'       =>  1
                                );

                                //Populate database with tables and views
                                $this->addTables($this->session->userdata['database']['dbdriver']);

                                /**
                                 * Connect to database and save the super admin settings
                                 *
                                 */

                                $this->load->model('user_model');
                                $savedUsers = $this->user_model->addUser($adminData);

                                if($this->session->userdata('pref_hosting_level') == 'district'){
                                    $district_name = $this->input->post('district_name');

                                    if(!empty($district_name)){
                                        $this->load->model('district_model');
                                        $districtData = array(
                                            'name'          =>  $district_name,
                                            'screen_name'   =>  $district_name,
                                            'state_val'     =>  ($this->input->post('host_state')) ? $this->input->post('host_state') :  NULL
                                        );

                                        $this->district_model->addDistrict($districtData);
                                    }

                                }

                                /**
                                 * Save the selected settings into the App registry
                                 *
                                 */
                                // Get the numerous submitted  inputs
                                $host_level = $this->session->userdata('pref_hosting_level');
                                $registryData = array(
                                    'install_status'    =>  'incomplete',
                                    'dbtype'            =>  $this->session->userdata['database']['dbdriver'],
                                    'host_level'        =>  $this->session->userdata('pref_hosting_level'),
                                    'host_state'        =>  $this->input->post('host_state'),
                                    'state_permission'  =>  'write',
                                    'sys_preferences'   =>  '',
                                    'EOP_type'          =>  'internal',
                                    'version'           =>  $this->config->item('version')
                                );

                                $savedRecs = $this->registry_model->addVariables($registryData);

                                if(is_numeric($savedRecs) && $savedRecs>=1 &&
                                    is_numeric($savedUsers) && $savedUsers>=1){ // Record saved successfully

                                    $data['screen'] =   'contact_information';
                                    $data['step']   =   'step_contacts';
                                    $this->session->set_userdata(array(
                                        'admin_account_set'    => 'yes',
                                        'install_step'          => 'step_contacts',
                                        'install_step_status'   => 'initiated',
                                        'user_name'             => $this->input->post('user_name'),
                                        'user_email'            => $this->input->post('user_email'),
                                        'user_password'         => $this->input->post('user_password')
                                    ));

                                    $this->output->set_output($this->load->view('install/embeds/contact_information', $data, TRUE));

                                }
                                else{ // Record did not get saved

                                    //Set  error message and reload admin account step

                                    $data['screen'] =   'admin_account';
                                    $data['step']   =   'admin_account';
                                    $data['error']  =   'Database error: '.$savedRecs.' '.$savedUsers;

                                    $this->output->set_output($this->load->view('install/embeds/admin_account', $data, TRUE));

                                }

                            }
                            else{

                                $data['screen']    =   'admin_account';
                                $data['step']      =   'admin_account';

                                $this->template->set('title', 'EOP ASSIST Installation');
                                $this->template->load('install/template', 'install/install_screen', $data);
                            }
                        }
                        
                        break;
                    case "step_contacts":
                        $install_step_status = $this->session->userdata('install_step_status');

                        if($install_step_status == 'initiated'){
                            if($this->input->post('ajax')) { // If form is submitted using ajax

                                // Get the submitted form input
                                $contactsData = array(
                                    'contact_name'          => $this->input->post('contact_name'),
                                    'contact_title'         => $this->input->post('contact_title'),
                                    'contact_agency'        => $this->input->post('contact_agency'),
                                    'contact_email'         => $this->input->post('contact_email'),
                                    'contact_phone'         => $this->input->post('contact_phone')
                                );

                                $savedRecs = $this->registry_model->addVariable('program_administrator', json_encode($contactsData));

                                if(is_numeric($savedRecs) && $savedRecs>=1){ // Record saved successfully

                                    $this->registry_model->update('install_status', 'completed');

                                    $data['screen'] =   'finished';
                                    $data['step']   =   'finished';
                                    $this->session->set_userdata(array(
                                        'contacts_set'          => 'yes',
                                        'install_step'          => 'finished',
                                        'install_step_status'   => 'initiated',

                                    ));

                                    $this->output->set_output($this->load->view('install/embeds/finished', $data, TRUE));

                                }
                                else{ // Record did not get saved

                                    //Set  error message and reload admin account step

                                    $data['screen'] =   'contact_information';
                                    $data['step']   =   'step_contacts';
                                    $data['error']  =   'Database error: '.$savedRecs;

                                    $this->output->set_output($this->load->view('install/embeds/contact_information', $data, TRUE));

                                }
                            }
                        }
                        break;
                    case "finished":
                        $install_step_status = $this->session->userdata('install_step_status');

                        if($install_step_status == 'initiated'){
                            $this->session->sess_destroy();

                            //Redirect to login page
                           redirect('/login');
                                
                            
                        }
                        else{

                        }
                        break;
                }
            }


        }
        else{

            $install_status ="";

            switch ($install_status) {
                case '':
                    # code...
                    break;
                
                default:
                    # code...
                    break;
            }


            $this->template->set('title', 'EOP ASSIST Installation Resumed');
        }
    }


    /**
     * Function returns JSON formatted install progress information to AJAX calls
     */
    public function getInstallProgress()
    {
        if ($this->input->post('ajax')) {
            $data = array(
                'current'   =>      $this->session->userdata('install_step'),
                'step1'     =>      ($this->session->userdata('pref_hosting_level'))? 'done':'',
                'step2'     =>      ($this->session->userdata('requirements_verified'))? 'done':'',
                'step3'     =>      ($this->session->userdata('database_settings_set'))? 'done':'',
                'step4'     =>      ($this->session->userdata('admin_account_set'))? 'done':'',
                'step5'     =>      ($this->session->userdata('contacts_set'))? 'done' : '',
                'step6'     =>      ($this->session->userdata('step_finished'))? 'done':''
            );

            $this->output->set_output(json_encode($data));
        }
    }


    /**
     * Function that uses the file helper to make a config file from the preferred settings
     */

    public function mkconfig($configs){
        $this->load->helper('file');

          
        return make_config_file($configs);

    }

    /**
     * Check system requirements and returns mixed array status message.
     * @return array
     */
    public function checkRequirements(){

        $data = array();
        $data['fatal_errs']=array();
        $data['warnings']= array();
        $data['file_errs'] = array();

        $required_libraries = array(
            'mysqli', 'date', 'gd', 'libxml', 'mbstring', 'mysqlnd', 'session', 'SimpleXML', 'xml', 'xmlreader', 'zip', 'zlib'
        );
        $optional_libraries = array('sqlsrv', 'pdo_sqlsrv', 'PDO_ODBC');
        $writable_files = array ('application/config/settings.php', 'uploads', 'application/logs');


        $data['php'] = array(
            'version'=>phpversion(),
            'sufficient'=> version_compare(phpversion(), '5.5.0'),
        );

        foreach($required_libraries as $library){
            if(!extension_loaded($library)){
                $data['fatal_errs'][]=array(
                    'library'=>$library,
                    'message'=> 'Not loaded'
                );
            }
        }

        foreach($optional_libraries as $library){
            if(!extension_loaded($library)){
                $data['warnings'][]=array(
                    'library'=>$library,
                    'message'=> 'Not loaded, Required for MS SQL SERVER'
                );
            }
        }

        foreach($writable_files as $file){
            if(!file_exists($file) || !is_writable($file)){
                $data['file_errs'][] = array(
                    'file'      =>  $file,
                    'message'   =>  'This file is not writable, please make sure that the user: <strong><em>'.posix_getpwuid(posix_geteuid())['name'].'</em></strong>, www-data for IIS or apache for Apache has write permissions to this file or directory to continue.'
                );
            }
        }

        return $data;
    }



    /**
     * @param $dbdriver String
     */
    public function addTables($dbdriver){

        $this->load->model('app_model');
        $savedRecs = array();

        $tables = array(
            'eop_access_log',
            'eop_activity_log',
            'eop_calendar',
            'eop_district',
            'eop_entity',
            'eop_entity_types',
            'eop_field',
            'eop_registry',
            'eop_role_permission',
            'eop_school',
            'eop_state',
            'eop_team',
            'eop_user',
            'eop_user2district',
            'eop_user2school',
            'eop_user_access',
            'eop_user_roles',
            'eop_page',
            'eop_resource',
            'eop_resource2page',
            'eop_files',
            'eop_exercise',
            'eop_training'
        );

        foreach($tables as $table){
            $savedRecs[] = $this->app_model->createTable($table, $dbdriver);
        }

        //Initialise entity_types, states, pages and user roles tables
        $this->app_model->initializeTables($dbdriver);

        //Create views
        $this->app_model->createViews($dbdriver);

    }

    public function test($dbdriver='mysqli'){

        $tables = array(
            'eop_access_log',
            'eop_activity_log',
            'eop_calendar',
            'eop_district',
            'eop_entity',
            'eop_entity_types',
            'eop_field',
            'eop_registry',
            'eop_role_permission',
            'eop_school',
            'eop_state',
            'eop_team',
            'eop_user',
            'eop_user2district',
            'eop_user2school',
            'eop_user_access',
            'eop_user_roles',
            'eop_page',
            'eop_resource',
            'eop_resource2page',
            'eop_sessions'
        );
        $this->load->model('app_model');
        foreach($tables as $table){
            $savedRecs[] = $this->app_model->createTable($table, $dbdriver);
        }

        //Initialise entity_types, states and user roles tables
        $this->app_model->initializeTables($dbdriver);

        //Create views
        $this->app_model->createViews($dbdriver);
    }

    /**
     * Echo PHP installation information on the server running the Web Application
     *
     * get to this by typing http://example.com/app/phpinfo in the browser.
     */
    public function phpinfo(){
        phpinfo();
    }

    /**
     * Respond to ping requests to keep the session fresh when needed.
     *
     * get to this by typing http://example.com/app/ping in the browser.
     */
    public function ping(){
        
        if($this->session->userdata('is_logged_in')){

            $pingTime = $this->session->now;
            $this->session->set_userdata('last_activity', $pingTime);
            $data = array(
                'last_activity'=> $this->session->userdata('last_activity'),
                'ping'  => $pingTime,
                'session_expriation' => $this->config->item('sess_expiration')
            );

            if($this->input->post('ajax')){
                $this->output->set_output(json_encode($data));
            }else{
                print_r($data);
            }

        }else{
            $data = array(
                'ping' => false,
                'last_activity'=>false,
                'session_expriation'=>$this->config->item('sess_expiration')
            );

            if($this->input->post('ajax')){
                $this->output->set_output(json_encode($data));
            }else{
                print_r($data);
            }
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

/* End of file App.php */
/* Location: ./application/controllers/App.php */