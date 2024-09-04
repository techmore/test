<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migrate extends CI_Controller {

    public $data = array();

    private $overall_progress;

    public function __construct(){
        parent::__construct();

        // Load  modules
        $this->load->model('migrate_model');
        $this->load->model('registry_model');
        $this->load->model('district_model');
        $this->load->model('school_model');
        $this->load->model('user_model');
        $this->load->model('plan_model');
        $this->load->model('team_model');
        $this->load->model('calendar_model');

        $this->overall_progress =0;
        
    }


	/**
	 * Index Page for this controller.
	 *
	 */

	public function index(){
        //Make sure user is logged in
        $this->authenticate();

        $this->template->set('page_title', 'Data Migration');
        $data = array(
            'page'  =>  'home'
        );
        $this->template->load('migrate/template', 'migrate/home', $data);
	}

    /**
    *   run function action
    *   This action will execute the data migration
     * 1- Initialize a database instance with the passed data
     * 2- Copy table values from the old database into the new database
    */
    public function run(){

        $form_name = $this->input->post('form_name');
        $db_obj = null;

        $database_type  =   (!empty($this->input->post('database_type'))) ? $this->input->post('database_type') : 'mysql';
        $database_host  =   $this->input->post('database_host');
        $database_name  =   $this->input->post('database_name');
        $database_user_name =   $this->input->post('database_user_name');
        $database_password  =   $this->input->post('database_password');



        if($form_name =="database_form"){ // If it's the right submitted form

            // Set the database configuration
            try{
                $config['hostname'] = $database_host;
                $config['username'] = $database_user_name;
                $config['password'] = $database_password;
                $config['database'] = $database_name;
                $config['dbdriver'] = strtolower($database_type);
                $config['dbprefix'] = "";
                $config['pconnect'] = FALSE;
                $config['db_debug'] = FALSE;
                $config['cache_on'] = FALSE;
                $config['cachedir'] = "";
                $config['char_set'] = "utf8";
                $config['dbcollat'] = "utf8_general_ci";

                $db_obj = $this->load->database($config, TRUE); // Load the database

                $connected = $db_obj->initialize(); // Initialize the database connections

                if (!$connected) {                  //Test database connection before continuing

                    $message = <<<EOF
                    <div><div class='notify notify-red'><span class='symbol icon-error' style='margin:10px;'></span>Database connection failure! make sure the database <strong><em>$database_name</em></strong> exists and that the
                    user <strong><em>$database_user_name</em></strong> with the entered password has access privileges on the database.</div></div>

EOF;
                    $serverTime = time();
                    $this->send_message($serverTime, $message, 0);
                    sleep(1);

                    $this->session->set_flashdata('error', $message);
                    exit;
                    redirect('migrate');

                }else{

                    header('Content-Type: text/octet-stream');
                    header('Cache-Control: no-cache');

                    //Migrate district data
                    $this->migrate_district_data($db_obj);

                    //Migrate school data
                    $this->migrate_school_data($db_obj);

                    //Migrate user data
                    $this->migrate_user_data($db_obj);

                    //Migrate team data
                    $this->migrate_team_data($db_obj);

                    //Migrate threats & hazard data
                    $this->migrate_th_data($db_obj);

                    //Migrate functions data
                    $this->migrate_fn_data($db_obj);

                    //Migrate basic plan data
                    $this->migrate_form1_data($db_obj);
                    $this->migrate_form2_data($db_obj);
                    $this->migrate_form3_data($db_obj);
                    $this->migrate_form4_data($db_obj);
                    $this->migrate_form5_data($db_obj);
                    $this->migrate_form6_data($db_obj);
                    $this->migrate_form7_data($db_obj);
                    $this->migrate_form8_data($db_obj);
                    $this->migrate_form9_data($db_obj);
                    $this->migrate_form10_data($db_obj);

                    //Migrate calendar data
                    $this->migrate_calendar_data($db_obj);
                }

            }catch(Exception $e){

                echo $e->getMessage();
            }

        }else{
            redirect('migrate');
        }
    }

    /**
     * @param $db_obj
     */
    private function migrate_district_data($db_obj){

        $serverTime = time();

        $obsolete_district_data = $this->migrate_model->getObsoleteDistricts($db_obj);

        if(is_array($obsolete_district_data) && count($obsolete_district_data) > 0){ //If records are returned

            $num_recs = count($obsolete_district_data);
            $processedRecs = 0;

            $message = "Migrating Districts...";
            $this->send_message($serverTime, $message, 0);
            sleep(1);

            foreach($obsolete_district_data as $key=>$record) {
                $processedRecs++;

                $percentage = ceil(($processedRecs / $num_recs) * 100);

                //Copy record data into new database
                $data = array(

                    'name'            =>  $record['code'],
                    'screen_name'     =>  $record['display_name'],
                    'state_val'       =>  $this->registry_model->getValue('host_state')
                );

                $savedRecs = $this->district_model->addDistrict($data);

                $status = (is_numeric($savedRecs) && $savedRecs >=1) ? 'Success' : 'Failure';
                $this->send_message($serverTime, $percentage . '% district data migration complete. server time: ' . date("h:i:s", time()) . " [$status]", $percentage);

                sleep(1);
            }
        }else{

            //No data
            $message = "Migrating Districts...";
            $message .= "<br> Empty Data Set";
            $this->send_message($serverTime, $message, 0);
            sleep(1);

            $percentage = 100;
            $this->send_message($serverTime, $percentage . '% completed', $percentage);
            sleep(1);
        }
    }

    /**
     * @param $db_obj
     */
    private function migrate_school_data($db_obj){

        $serverTime = time();

        $obsolete_school_data = $this->migrate_model->getObsoleteSchools($db_obj);


        if(is_array($obsolete_school_data) && count($obsolete_school_data) > 0){ //If records are returned

            $num_recs = count($obsolete_school_data);
            $processedRecs = 0;

            $message = "Migrating Schools...";
            $this->send_message($serverTime, $message, 0);
            sleep(1);

            foreach($obsolete_school_data as $key=>$record) {
                $processedRecs++;

                $percentage = ceil(($processedRecs / $num_recs) * 100);
                $district = $this->district_model->getDistrictByName($record['district']);

                //Copy record data into new database
                $data = array(

                    'name'            =>  $record['code'],
                    'screen_name'     =>  $record['display_name'],
                    'district_id'     =>  (!empty($district) && is_array($district)) ? $district[0]['id']: null
                );

                $savedRecs = $this->school_model->addSchool($data);

                $status = (is_numeric($savedRecs) && $savedRecs >=1) ? 'Success' : 'Failure';
                $this->send_message($serverTime, $percentage . '% school data migration complete. server time: ' . date("h:i:s", time()) . " [$status]", $percentage);

                sleep(1);
            }
        }else{

            //No data
            $message = "Migrating Schools...";
            $message .= "<br> Empty Data Set";
            $this->send_message($serverTime, $message, 0);
            sleep(1);

            $percentage = 100;
            $this->send_message($serverTime, $percentage . '% completed', $percentage);
            sleep(1);

        }
    }


    /**
     * @param $db_obj
     * @return void
     */
    private function migrate_team_data($db_obj){

        $serverTime = time();
        $message = "Migrating Team Data...";

        $obsolete_team_data = $this->migrate_model->getObsoleteTeamMembers($db_obj);

        if(is_array($obsolete_team_data) && count($obsolete_team_data)>0) { //If records  are returned

            $num_recs = count($obsolete_team_data);
            $processedRecs = 0;

            $this->send_message($serverTime, $message, 0);
            sleep(1);

            foreach ($obsolete_team_data as $key => $record) {
                $processedRecs++;

                $percentage = ceil(($processedRecs / $num_recs) * 100);

                $school = $this->school_model->getSchoolByName($record['school']);


                $data = array(
                    'name'          =>  $record['team_name'],
                    'title'         =>  $record['title'],
                    'organization'  =>  $record['organization'],
                    'email'         =>  $record['email'],
                    'phone'         =>  $record['phone'],
                    'interest'      =>  $record['interest'],
                    'sid'           =>  (!empty($school) && is_array($school)) ? $school[0]['id']: null,
                    'owner'         =>  $this->session->userdata('user_id')
                );

                $savedRecs = $this->team_model->addMember($data);

                $status = (is_numeric($savedRecs)) ? 'Success' : 'Failure';

                $this->send_message($serverTime, $percentage . '% team data migration complete. server time: ' . date("h:i:s", time()) . " [$status]", $percentage);

                sleep(1);

            }
        }else{

            //No data
            $message .= "<br> Empty Data Set";
            $this->send_message($serverTime, $message, 0);
            sleep(1);

            $percentage = 100;
            $this->send_message($serverTime, $percentage . '% completed', $percentage);
            sleep(1);
        }

    }

    private function migrate_calendar_data($db_obj){

        $serverTime = time();
        $message = "Migrating Calendar Events Data...";

        $obsolete_calendar_data = $this->migrate_model->getObsoleteCalendarEvents($db_obj);

        if(is_array($obsolete_calendar_data) && count($obsolete_calendar_data)>0) { //If records  are returned

            $num_recs = count($obsolete_calendar_data);
            $processedRecs = 0;

            $this->send_message($serverTime, $message, 0);
            sleep(1);

            foreach ($obsolete_calendar_data as $key => $record) {
                $processedRecs++;

                $percentage = ceil(($processedRecs / $num_recs) * 100);

                $school = $this->school_model->getSchoolByName($record['school']);


                $data = array(
                    'title'         =>  $record['title'],
                    'start_time'    =>  $record['start_time'],
                    'end_time'      =>  $record['end_time'],
                    'location'      =>  $record['location'],
                    'body'          =>  $record['body'],
                    'modified_by'   =>  $this->session->userdata('user_id'),
                    'sid'       =>      (!empty($school) && is_array($school)) ? $school[0]['id']: null
                );

                $savedRecs = $this->calendar_model->addEvent($data);

                $status = (is_numeric($savedRecs)) ? 'Success' : 'Failure';

                $this->send_message($serverTime, $percentage . '% calendar data migration complete. server time: ' . date("h:i:s", time()) . " [$status]", $percentage);

                sleep(1);

            }
        }else{

            //No data
            $message .= "<br> Empty Data Set";
            $this->send_message($serverTime, $message, 0);
            sleep(1);

            $percentage = 100;
            $this->send_message($serverTime, $percentage . '% completed', $percentage);
            sleep(1);
        }

    }

    private function migrate_user_data($db_obj){


        $serverTime = time();

        $obsolete_users_data = $this->migrate_model->getObsoleteUsers($db_obj);

        if(is_array($obsolete_users_data) && count($obsolete_users_data)>0){ //If records  are returned

            $num_recs = count($obsolete_users_data);
            $processedRecs = 0;

            $message = "Migrating Users...";
            $this->send_message($serverTime, $message, 0);
            sleep(1);

            foreach($obsolete_users_data as $key=>$record){
                $processedRecs ++;

                $percentage = ceil(($processedRecs / $num_recs) * 100);

                $district = $this->district_model->getDistrictByName($record['district']);
                $school = $this->school_model->getSchoolByName($record['school']);

                //Copy record data into new database
                $data = array(
                    'role_id'       =>  ($record['user_role'] == '01A') ? 3 : (($record['user_role'] == '02A') ? 4 : 5),
                    'first_name'    =>  $record['first_name'],
                    'last_name'     =>  $record['last_name'],
                    'email'         =>  $record['email'],
                    'username'      =>  $record['user_id'],
                    'password'      =>  $record['password'],
                    'phone'         =>  $record['phone_number'],
                    'district'      =>  (!empty($district) && is_array($district)) ? $district[0]['id']: '',
                    'school'        =>  (!empty($school) && is_array($school)) ? $school[0]['id']: '',
                    'read_only'     =>  'n'
                );

                $savedRecs = $this->user_model->addUser($data);

                $status = (is_numeric($savedRecs) && $savedRecs >=1) ? 'Success' : 'Failure';


                $this->send_message($serverTime, $percentage . '% user data migration complete. server time: ' . date("h:i:s", time()) . " [$status]", $percentage);

                sleep(1);

            }


        }else{

            //No data
            $message = "Migrating Users...";
            $message .= "<br> Empty Data Set";
            $this->send_message($serverTime, $message, 0);
            sleep(1);

            $percentage = 100;
            $this->send_message($serverTime, $percentage . '% completed', $percentage);
            sleep(1);
        }

    }

    private function migrate_th_data($db_obj){

        $serverTime = time();

        $obsolete_th_data = $this->migrate_model->getObsoleteThs($db_obj);

        if(is_array($obsolete_th_data) && count($obsolete_th_data)>0){ //If records  are returned

            $num_recs = count($obsolete_th_data);
            $processedRecs = 0;

            $message = "Migrating Goals and Objectives for Threats and Hazards...";
            $this->send_message($serverTime, $message, 0);
            sleep(1);

            foreach($obsolete_th_data as $key=>$record){
                $processedRecs ++;

                $percentage = ceil(($processedRecs / $num_recs) * 100);

                $school = $this->school_model->getSchoolByName($record['school']);

                //Copy record data into new database
                $data = array(
                    'name'      =>      $record['th_name'],
                    'title'     =>      $record['th_name'],
                    'owner'     =>      $this->session->userdata('user_id'),
                    'sid'       =>      (!empty($school) && is_array($school)) ? $school[0]['id']: null,
                    'type_id'   =>      $this->plan_model->getEntityTypeId('th', 'name')
                );

                $fieldIds = array();
                $entityIds = array();
                $savedRecs = $this->plan_model->addThreatAndHazard($data, $entityIds, $fieldIds, $school[0]['id']);

                $status = (is_numeric($savedRecs) && $savedRecs >=1) ? 'Success' : 'Failure';

                if(is_numeric($savedRecs) && $savedRecs >= 1){

                    $condition = array('name'=>$record['th_name']);
                    $migrated_th = $this->plan_model->getEntities('th', $condition, true, array('orderby'=>'timestamp', 'type'=>'DESC'));

                    if(!empty($migrated_th) && is_array($migrated_th)) {

                        $goalData = $this->migrate_model->getTHData($db_obj, $record['id']);

                        if(is_array($goalData) && count($goalData)>0){

                            $th_initiated = false;

                            if(isset($goalData['g1']['parent'][0]['g1']) && !empty($goalData['g1']['parent'][0]['g1']))
                                $th_initiated = true;
                            if(isset($goalData['g2']['parent'][0]['g2']) && !empty($goalData['g2']['parent'][0]['g2']))
                                $th_initiated = true;
                            if(isset($goalData['g3']['parent'][0]['g3']) && !empty($goalData['g3']['parent'][0]['g3']))
                                $th_initiated = true;

                            if($th_initiated) {
                                //Add field to newly migrated TH to indicate that it has been initiated
                                $fieldData = array(
                                    'entity_id' => $migrated_th[0]['id'],
                                    'name' => 'TH Field',
                                    'title' => 'Threats and Hazards Default Field',
                                    'weight' => 1,
                                    'type' => 'text',
                                    'body' => ''
                                );

                                $recs = $this->plan_model->addField($fieldData);
                            }


                            $goalRecords = $goalData;

                            //Deal with goal 1
                            $g1 = $goalRecords['g1'];
                            if(is_array($g1) && count($g1)>0){
                                $parent = $g1['parent'];
                                if(count($parent)>0){
                                    $this->plan_model->updateField($fieldIds['g1']['goal'], array('body'=>$parent[0]['g1']));

                                    //add goal's function
                                    $fndata = array(
                                        'name'      =>      $parent[0]['fn_name'],
                                        'title'     =>      $parent[0]['fn_name'],
                                        'parent'    =>      $entityIds['g1'],
                                        'owner'     =>      $this->session->userdata('user_id'),
                                        'sid'       =>      $school[0]['id'],
                                        'type_id'   =>      $this->plan_model->getEntityTypeId('fn', 'name')
                                    );
                                    $this->plan_model->addTHFn($fndata);
                                }

                                //Courses of action only existed for  goal 1
                                $course_of_action = $goalRecords['ca'];
                                if(count($course_of_action)>0){
                                    $this->plan_model->updateField($fieldIds['g1']['course_of_action'], array('body'=>$course_of_action[0]['action_text']));
                                }

                                //Loop through objectives and insert respective fields and function data
                                $objectives = $g1['objectives'];
                                if(is_array($objectives) && count($objectives)>0){
                                    foreach($objectives as $key => $objective){

                                        $entityId = null;

                                        if($key == 0){ //first goal objective should already exist
                                            $entityId = $entityIds['g1Obj'];
                                            $this->plan_model->updateField($fieldIds['g1']['objective'], array('body'=>$objective['obj']));
                                        }else{

                                            //Create new entity and field
                                            $entityData = array(
                                                'name'      =>      'Goal 1 Objective',
                                                'title'     =>      'Objective',
                                                'owner'     =>      $this->session->userdata('user_id'),
                                                'sid'       =>      $school[0]['id'],
                                                'type_id'   =>      $this->plan_model->getEntityTypeId('obj', 'name'),
                                                'parent'    =>      $entityIds['g1'],
                                                'weight'    =>      $key
                                            );
                                            $entityId = $this->plan_model->addEntity($entityData);

                                            $fieldData = array(
                                                'entity_id' =>      $entityId,
                                                'name'      =>      'Objective Field',
                                                'title'     =>      'Objective',
                                                'weight'    =>      1,
                                                'type'      =>      'text',
                                                'body'      =>      $objective['obj']
                                            );
                                            $this->plan_model->addField($fieldData);
                                        }

                                        //add objective's function
                                        $fnData = array(
                                            'name'      =>  $objective['fn_name'],
                                            'title'     =>  $objective['fn_name'],
                                            'parent'    =>  $entityId,
                                            'owner'     =>  $this->session->userdata('user_id'),
                                            'sid'       =>  $school[0]['id'],
                                            'type_id'   =>  $this->plan_model->getEntityTypeId('fn', 'name')
                                        );
                                        $this->plan_model->addTHFn($fnData);
                                    }
                                }
                            }

                            //Deal with goal 2
                            $g2 = $goalRecords['g2'];
                            if(is_array($g2) && count($g2)>0){
                                $parent = $g2['parent'];
                                if(count($parent)>0){
                                    $this->plan_model->updateField($fieldIds['g2']['goal'], array('body'=>$parent[0]['g2']));

                                    //add goal's function
                                    $fndata = array(
                                        'name'      =>      $parent[0]['fn_name'],
                                        'title'     =>      $parent[0]['fn_name'],
                                        'parent'    =>      $entityIds['g2'],
                                        'owner'     =>      $this->session->userdata('user_id'),
                                        'sid'       =>      $school[0]['id'],
                                        'type_id'   =>      $this->plan_model->getEntityTypeId('fn', 'name')
                                    );
                                    $this->plan_model->addTHFn($fndata);
                                }

                                $objectives = $g2['objectives'];
                                //Loop through objectives and insert respective fields and function data
                                if(is_array($objectives) && count($objectives)>0){
                                    foreach($objectives as $key => $objective){

                                        $entityId = null;

                                        if($key == 0){ //first goal objective should already exist
                                            $entityId = $entityIds['g2Obj'];
                                            $this->plan_model->updateField($fieldIds['g2']['objective'], array('body'=>$objective['obj']));
                                        }else{

                                            //Create new entity and field
                                            $entityData = array(
                                                'name'      =>      'Goal 2 Objective',
                                                'title'     =>      'Objective',
                                                'owner'     =>      $this->session->userdata('user_id'),
                                                'sid'       =>      $school[0]['id'],
                                                'type_id'   =>      $this->plan_model->getEntityTypeId('obj', 'name'),
                                                'parent'    =>      $entityIds['g2'],
                                                'weight'    =>      $key
                                            );
                                            $entityId = $this->plan_model->addEntity($entityData);

                                            $fieldData = array(
                                                'entity_id' =>      $entityId,
                                                'name'      =>      'Objective Field',
                                                'title'     =>      'Objective',
                                                'weight'    =>      1,
                                                'type'      =>      'text',
                                                'body'      =>      $objective['obj']
                                            );
                                            $this->plan_model->addField($fieldData);
                                        }

                                        //add objective's function
                                        $fnData = array(
                                            'name'      =>  $objective['fn_name'],
                                            'title'     =>  $objective['fn_name'],
                                            'parent'    =>  $entityId,
                                            'owner'     =>  $this->session->userdata('user_id'),
                                            'sid'       =>  $school[0]['id'],
                                            'type_id'   =>  $this->plan_model->getEntityTypeId('fn', 'name')
                                        );
                                        $this->plan_model->addTHFn($fnData);
                                    }
                                }

                            }

                            //Deal with goal 3
                            $g3 = $goalRecords['g3'];
                            if(is_array($g3) && count($g3)>0){
                                $parent = $g3['parent'];
                                if(count($parent)>0){
                                    $this->plan_model->updateField($fieldIds['g3']['goal'], array('body'=>$parent[0]['g3']));

                                    //add goal's function
                                    $fndata = array(
                                        'name'      =>      $parent[0]['fn_name'],
                                        'title'     =>      $parent[0]['fn_name'],
                                        'parent'    =>      $entityIds['g3'],
                                        'owner'     =>      $this->session->userdata('user_id'),
                                        'sid'       =>      $school[0]['id'],
                                        'type_id'   =>      $this->plan_model->getEntityTypeId('fn', 'name')
                                    );
                                    $this->plan_model->addTHFn($fndata);
                                }



                                $objectives = $g3['objectives'];
                                //Loop through objectives and insert respective fields and function data
                                if(is_array($objectives) && count($objectives)>0){
                                    foreach($objectives as $key => $objective){

                                        $entityId = null;

                                        if($key == 0){ //first goal objective should already exist
                                            $entityId = $entityIds['g3Obj'];
                                            $this->plan_model->updateField($fieldIds['g3']['objective'], array('body'=>$objective['obj']));
                                        }else{

                                            //Create new entity and field
                                            $entityData = array(
                                                'name'      =>      'Goal 3 Objective',
                                                'title'     =>      'Objective',
                                                'owner'     =>      $this->session->userdata('user_id'),
                                                'sid'       =>      $school[0]['id'],
                                                'type_id'   =>      $this->plan_model->getEntityTypeId('obj', 'name'),
                                                'parent'    =>      $entityIds['g3'],
                                                'weight'    =>      $key
                                            );
                                            $entityId = $this->plan_model->addEntity($entityData);

                                            $fieldData = array(
                                                'entity_id' =>      $entityId,
                                                'name'      =>      'Objective Field',
                                                'title'     =>      'Objective',
                                                'weight'    =>      1,
                                                'type'      =>      'text',
                                                'body'      =>      $objective['obj']
                                            );
                                            $this->plan_model->addField($fieldData);
                                        }

                                        //add objective's function
                                        $fnData = array(
                                            'name'      =>  $objective['fn_name'],
                                            'title'     =>  $objective['fn_name'],
                                            'parent'    =>  $entityId,
                                            'owner'     =>  $this->session->userdata('user_id'),
                                            'sid'       =>  $school[0]['id'],
                                            'type_id'   =>  $this->plan_model->getEntityTypeId('fn', 'name')
                                        );
                                        $this->plan_model->addTHFn($fnData);
                                    }
                                }

                            }

                        }
                    }
                }


                $this->send_message($serverTime, $percentage . '% Threats/Hazard goals data  processed. server time: ' . date("h:i:s", time()) . " [$status]", $percentage);

                sleep(1);

            }


        }else{

            //No data
            $message = "Migrating Threats and Hazards...";
            $message .= "<br> Empty Data Set";
            $this->send_message($serverTime, $message, 0);
            sleep(1);

            $percentage = 100;
            $this->send_message($serverTime, $percentage . '% completed', $percentage);
            sleep(1);

        }
    }

    private function migrate_fn_data($db_obj){

        $serverTime = time();

        $obsolete_fn_data = $this->migrate_model->getObsoleteFns($db_obj);


        if(is_array($obsolete_fn_data) && count($obsolete_fn_data)>0){ //If records  are returned

            $num_recs = count($obsolete_fn_data);
            $processedRecs = 0;

            $message = "Migrating Goals and Objectives for Functions... ";
            $this->send_message($serverTime, $message, 0);
            sleep(1);

            foreach($obsolete_fn_data as $key=>$record){
                $processedRecs ++;

                $percentage = ceil(($processedRecs / $num_recs) * 100);

                $school = $this->school_model->getSchoolByName($record['school']);
                $migrated_fn = $this->plan_model->getEntities('fn', array('parent is not null'=> Null, 'name'=>$record['fn_name'],'sid'=>$school[0]['id']), false);


                if(is_array($migrated_fn) && count($migrated_fn)>0){

                    $migrated_fn_record = $migrated_fn[0]; //Get only the first record we need one unique function
                    $goalData = $this->migrate_model->getFNData($db_obj, $record['id']);

                    if(is_array($goalData) && count($goalData)>0) {

                        $goalRecords = $goalData;


                        $there_is_a_goal = false;

                        if (isset($goalRecords['g1']['parent'][0]['g1']) && !empty($goalRecords['g1']['parent'][0]['g1']))
                            $there_is_a_goal = true;

                        if (isset($goalRecords['g2']['parent'][0]['g2']) && !empty($goalRecords['g2']['parent'][0]['g2']))
                            $there_is_a_goal = true;

                        if (isset($goalRecords['g3']['parent'][0]['g3']) && !empty($goalRecords['g3']['parent'][0]['g3']))
                            $there_is_a_goal = true;

                        //Deal with goal 1
                        $g1 = $goalRecords['g1'];
                        $parent = $g1['parent'];
                        $course_of_action = $goalRecords['ca'];

                        if ($there_is_a_goal) {

                            $goal1Data = array(
                                'name' => 'Goal 1',
                                'title' => 'Goal 1 (Before)',
                                'owner' => $this->session->userdata('user_id'),
                                'sid' => (!empty($school) && is_array($school)) ? $school[0]['id'] : null,
                                'type_id' => $this->plan_model->getEntityTypeId('g1', 'name'),
                                'parent' => $migrated_fn_record['id'],
                                'weight' => 1
                            );
                            $insertedGoalId = $this->plan_model->addEntity($goal1Data);

                            //Add Course of action entity enter body for g1 only
                            if (isset($course_of_action[0]['action_text']) && !empty($course_of_action[0]['action_text'])) {

                                $courseOfActionData = array(
                                    'name' => 'Goal 1 FN Course of Action',
                                    'title' => 'Course of Action',
                                    'owner' => $this->session->userdata('user_id'),
                                    'sid' => (!empty($school) && is_array($school)) ? $school[0]['id'] : null,
                                    'type_id' => $this->plan_model->getEntityTypeId('ca', 'name'),
                                    'parent' => $insertedGoalId,
                                    'weight' => 1
                                );

                                $newCourseofActionId = $this->plan_model->addEntity($courseOfActionData);

                                $fieldData = array(
                                    'entity_id' => $newCourseofActionId,
                                    'name' => 'Goal 1 FN Course of Action Field',
                                    'title' => 'Goal 1 FN Course of Action Field',
                                    'weight' => 1,
                                    'type' => 'text',
                                    'body' => $course_of_action[0]['action_text']
                                );
                                $this->plan_model->addField($fieldData);
                            }


                            if (count($parent) > 0) {

                                // add goal 1 field data
                                $goal1FieldData = array(
                                    'entity_id' => $insertedGoalId,
                                    'name' => 'Goal 1 Function Field',
                                    'title' => 'Goal 1 Function Field',
                                    'weight' => 1,
                                    'type' => 'text',
                                    'body' => $parent[0]['g1']
                                );
                                $this->plan_model->addField($goal1FieldData);

                            }

                            //Objectives
                            //Loop through objectives and insert respective fields data
                            $objectives = $g1['objectives'];
                            if (is_array($objectives) && count($objectives) > 0) {
                                foreach ($objectives as $key => $objective) {

                                    //Create new entity and field
                                    $entityData = array(
                                        'name' => 'Goal 1 Objective',
                                        'title' => 'Objective',
                                        'owner' => $this->session->userdata('user_id'),
                                        'sid' => $school[0]['id'],
                                        'type_id' => $this->plan_model->getEntityTypeId('obj', 'name'),
                                        'parent' => $insertedGoalId,
                                        'weight' => $key
                                    );
                                    $entityId = $this->plan_model->addEntity($entityData);

                                    $fieldData = array(
                                        'entity_id' => $entityId,
                                        'name' => 'Objective Field',
                                        'title' => 'Objective',
                                        'weight' => 1,
                                        'type' => 'text',
                                        'body' => $objective['obj']
                                    );
                                    $this->plan_model->addField($fieldData);

                                }
                            }
                        }


                        //Deal with goal 2
                        $g2 = $goalRecords['g2'];
                        $parent = $g2['parent'];

                        if ($there_is_a_goal) {
                            $goal2Data = array(
                                'name' => 'Goal 2',
                                'title' => 'Goal 2 (Before)',
                                'owner' => $this->session->userdata('user_id'),
                                'sid' => (!empty($school) && is_array($school)) ? $school[0]['id'] : null,
                                'type_id' => $this->plan_model->getEntityTypeId('g2', 'name'),
                                'parent' => $migrated_fn_record['id'],
                                'weight' => 1
                            );
                            $insertedGoalId = $this->plan_model->addEntity($goal2Data);

                            if (isset($course_of_action[0]['action_text']) && !empty($course_of_action[0]['action_text'])) {

                                $courseOfActionData = array(
                                    'name' => 'Goal 2 FN Course of Action',
                                    'title' => 'Course of Action',
                                    'owner' => $this->session->userdata('user_id'),
                                    'sid' => (!empty($school) && is_array($school)) ? $school[0]['id'] : null,
                                    'type_id' => $this->plan_model->getEntityTypeId('ca', 'name'),
                                    'parent' => $insertedGoalId,
                                    'weight' => 1
                                );

                                $newCourseofActionId = $this->plan_model->addEntity($courseOfActionData);

                                $fieldData = array(
                                    'entity_id' => $newCourseofActionId,
                                    'name' => 'Goal 2 FN Course of Action Field',
                                    'title' => 'Goal 2 FN Course of Action Field',
                                    'weight' => 1,
                                    'type' => 'text',
                                    'body' => ''
                                );
                                $this->plan_model->addField($fieldData);
                            }

                            if (count($parent) > 0) {
                                if (isset($parent[0]['g2']) && !empty($parent[0]['g2'])) {
                                    // add goal 1 field data
                                    $goal2FieldData = array(
                                        'entity_id' => $insertedGoalId,
                                        'name' => 'Goal 2 Function Field',
                                        'title' => 'Goal 2 Function Field',
                                        'weight' => 1,
                                        'type' => 'text',
                                        'body' => $parent[0]['g2']
                                    );
                                    $this->plan_model->addField($goal2FieldData);
                                }
                            }

                            //Objectives
                            //Loop through objectives and insert respective fields data
                            $objectives = $g2['objectives'];
                            if (is_array($objectives) && count($objectives) > 0) {
                                foreach ($objectives as $key => $objective) {

                                    //Create new entity and field
                                    $entityData = array(
                                        'name' => 'Goal 2 Objective',
                                        'title' => 'Objective',
                                        'owner' => $this->session->userdata('user_id'),
                                        'sid' => $school[0]['id'],
                                        'type_id' => $this->plan_model->getEntityTypeId('obj', 'name'),
                                        'parent' => $insertedGoalId,
                                        'weight' => $key
                                    );
                                    $entityId = $this->plan_model->addEntity($entityData);

                                    $fieldData = array(
                                        'entity_id' => $entityId,
                                        'name' => 'Objective Field',
                                        'title' => 'Objective',
                                        'weight' => 1,
                                        'type' => 'text',
                                        'body' => $objective['obj']
                                    );
                                    $this->plan_model->addField($fieldData);

                                }
                            }
                        }


                        //Deal with goal 3
                        $g3 = $goalRecords['g3'];
                        $parent = $g3['parent'];


                        if ($there_is_a_goal) {
                            $goal3Data = array(
                                'name' => 'Goal 3',
                                'title' => 'Goal 3 (Before)',
                                'owner' => $this->session->userdata('user_id'),
                                'sid' => (!empty($school) && is_array($school)) ? $school[0]['id'] : null,
                                'type_id' => $this->plan_model->getEntityTypeId('g3', 'name'),
                                'parent' => $migrated_fn_record['id'],
                                'weight' => 1
                            );
                            $insertedGoalId = $this->plan_model->addEntity($goal3Data);

                            if (isset($course_of_action[0]['action_text']) && !empty($course_of_action[0]['action_text'])) {

                                $courseOfActionData = array(
                                    'name' => 'Goal 3 FN Course of Action',
                                    'title' => 'Course of Action',
                                    'owner' => $this->session->userdata('user_id'),
                                    'sid' => (!empty($school) && is_array($school)) ? $school[0]['id'] : null,
                                    'type_id' => $this->plan_model->getEntityTypeId('ca', 'name'),
                                    'parent' => $insertedGoalId,
                                    'weight' => 1
                                );

                                $newCourseofActionId = $this->plan_model->addEntity($courseOfActionData);

                                $fieldData = array(
                                    'entity_id' => $newCourseofActionId,
                                    'name' => 'Goal 3 FN Course of Action Field',
                                    'title' => 'Goal 3 FN Course of Action Field',
                                    'weight' => 1,
                                    'type' => 'text',
                                    'body' => ''
                                );
                                $this->plan_model->addField($fieldData);
                            }

                            if (count($parent) > 0) {
                                if (isset($parent[0]['g3']) && !empty($parent[0]['g3'])) {
                                    // add goal 3 field data
                                    $goal3FieldData = array(
                                        'entity_id' => $insertedGoalId,
                                        'name' => 'Goal 3 Function Field',
                                        'title' => 'Goal 3 Function Field',
                                        'weight' => 1,
                                        'type' => 'text',
                                        'body' => $parent[0]['g3']
                                    );
                                    $this->plan_model->addField($goal3FieldData);
                                }
                            }

                            //Objectives
                            //Loop through objectives and insert respective fields data
                            $objectives = $g3['objectives'];
                            if (is_array($objectives) && count($objectives) > 0) {
                                foreach ($objectives as $key => $objective) {

                                    //Create new entity and field
                                    $entityData = array(
                                        'name' => 'Goal 3 Objective',
                                        'title' => 'Objective',
                                        'owner' => $this->session->userdata('user_id'),
                                        'sid' => $school[0]['id'],
                                        'type_id' => $this->plan_model->getEntityTypeId('obj', 'name'),
                                        'parent' => $insertedGoalId,
                                        'weight' => $key
                                    );
                                    $entityId = $this->plan_model->addEntity($entityData);

                                    $fieldData = array(
                                        'entity_id' => $entityId,
                                        'name' => 'Objective Field',
                                        'title' => 'Objective',
                                        'weight' => 1,
                                        'type' => 'text',
                                        'body' => $objective['obj']
                                    );
                                    $this->plan_model->addField($fieldData);
                                }
                            }
                        }
                    }
                }
                //else try and get orphaned functions that don't have an associated Threat and Hazard goal or objective but
                // have data in them from the old eop1.0
                else{

                    $goalData = $this->migrate_model->getFNData($db_obj, $record['id']);

                    if(is_array($goalData) && count($goalData)>0) {


                        //Add the orphan function to the database
                        $fndata = array(
                            'name'      =>      $record['fn_name'],
                            'title'     =>      $record['fn_name'],
                            'parent'    =>      1,
                            'owner'     =>      $this->session->userdata('user_id'),
                            'sid'       =>      (!empty($school) && is_array($school)) ? $school[0]['id'] : null,
                            'type_id'   =>      $this->plan_model->getEntityTypeId('fn', 'name')
                        );
                        $fn_record_id = null;
                        $this->plan_model->addTHFn($fndata, $fn_record_id);

                        $goalRecords = $goalData;


                        $there_is_a_goal = false;

                        if (isset($goalRecords['g1']['parent'][0]['g1']) && !empty($goalRecords['g1']['parent'][0]['g1']))
                            $there_is_a_goal = true;

                        if (isset($goalRecords['g2']['parent'][0]['g2']) && !empty($goalRecords['g2']['parent'][0]['g2']))
                            $there_is_a_goal = true;

                        if (isset($goalRecords['g3']['parent'][0]['g3']) && !empty($goalRecords['g3']['parent'][0]['g3']))
                            $there_is_a_goal = true;

                        //Deal with goal 1
                        $g1 = $goalRecords['g1'];
                        $parent = $g1['parent'];
                        $course_of_action = $goalRecords['ca'];

                        if ($there_is_a_goal) {

                            $goal1Data = array(
                                'name' => 'Goal 1',
                                'title' => 'Goal 1 (Before)',
                                'owner' => $this->session->userdata('user_id'),
                                'sid' => (!empty($school) && is_array($school)) ? $school[0]['id'] : null,
                                'type_id' => $this->plan_model->getEntityTypeId('g1', 'name'),
                                'parent' => $fn_record_id,
                                'weight' => 1
                            );
                            $insertedGoalId = $this->plan_model->addEntity($goal1Data);

                            //Add Course of action entity enter body for g1 only
                            if (isset($course_of_action[0]['action_text']) && !empty($course_of_action[0]['action_text'])) {

                                $courseOfActionData = array(
                                    'name' => 'Goal 1 FN Course of Action',
                                    'title' => 'Course of Action',
                                    'owner' => $this->session->userdata('user_id'),
                                    'sid' => (!empty($school) && is_array($school)) ? $school[0]['id'] : null,
                                    'type_id' => $this->plan_model->getEntityTypeId('ca', 'name'),
                                    'parent' => $insertedGoalId,
                                    'weight' => 1
                                );

                                $newCourseofActionId = $this->plan_model->addEntity($courseOfActionData);

                                $fieldData = array(
                                    'entity_id' => $newCourseofActionId,
                                    'name' => 'Goal 1 FN Course of Action Field',
                                    'title' => 'Goal 1 FN Course of Action Field',
                                    'weight' => 1,
                                    'type' => 'text',
                                    'body' => $course_of_action[0]['action_text']
                                );
                                $this->plan_model->addField($fieldData);
                            }


                            if (count($parent) > 0) {

                                // add goal 1 field data
                                $goal1FieldData = array(
                                    'entity_id' => $insertedGoalId,
                                    'name' => 'Goal 1 Function Field',
                                    'title' => 'Goal 1 Function Field',
                                    'weight' => 1,
                                    'type' => 'text',
                                    'body' => $parent[0]['g1']
                                );
                                $this->plan_model->addField($goal1FieldData);

                            }

                            //Objectives
                            //Loop through objectives and insert respective fields data
                            $objectives = $g1['objectives'];
                            if (is_array($objectives) && count($objectives) > 0) {
                                foreach ($objectives as $key => $objective) {

                                    //Create new entity and field
                                    $entityData = array(
                                        'name' => 'Goal 1 Objective',
                                        'title' => 'Objective',
                                        'owner' => $this->session->userdata('user_id'),
                                        'sid' => $school[0]['id'],
                                        'type_id' => $this->plan_model->getEntityTypeId('obj', 'name'),
                                        'parent' => $insertedGoalId,
                                        'weight' => $key
                                    );
                                    $entityId = $this->plan_model->addEntity($entityData);

                                    $fieldData = array(
                                        'entity_id' => $entityId,
                                        'name' => 'Objective Field',
                                        'title' => 'Objective',
                                        'weight' => 1,
                                        'type' => 'text',
                                        'body' => $objective['obj']
                                    );
                                    $this->plan_model->addField($fieldData);

                                }
                            }
                        } //end if there_is_a_goal for g1


                        //Deal with goal 2
                        $g2 = $goalRecords['g2'];
                        $parent = $g2['parent'];

                        if ($there_is_a_goal) {
                            $goal2Data = array(
                                'name' => 'Goal 2',
                                'title' => 'Goal 2 (Before)',
                                'owner' => $this->session->userdata('user_id'),
                                'sid' => (!empty($school) && is_array($school)) ? $school[0]['id'] : null,
                                'type_id' => $this->plan_model->getEntityTypeId('g2', 'name'),
                                'parent' => $fn_record_id,
                                'weight' => 1
                            );
                            $insertedGoalId = $this->plan_model->addEntity($goal2Data);

                            if (isset($course_of_action[0]['action_text']) && !empty($course_of_action[0]['action_text'])) {

                                $courseOfActionData = array(
                                    'name' => 'Goal 2 FN Course of Action',
                                    'title' => 'Course of Action',
                                    'owner' => $this->session->userdata('user_id'),
                                    'sid' => (!empty($school) && is_array($school)) ? $school[0]['id'] : null,
                                    'type_id' => $this->plan_model->getEntityTypeId('ca', 'name'),
                                    'parent' => $insertedGoalId,
                                    'weight' => 1
                                );

                                $newCourseofActionId = $this->plan_model->addEntity($courseOfActionData);

                                $fieldData = array(
                                    'entity_id' => $newCourseofActionId,
                                    'name' => 'Goal 2 FN Course of Action Field',
                                    'title' => 'Goal 2 FN Course of Action Field',
                                    'weight' => 1,
                                    'type' => 'text',
                                    'body' => ''
                                );
                                $this->plan_model->addField($fieldData);
                            }

                            if (count($parent) > 0) {
                                if (isset($parent[0]['g2']) && !empty($parent[0]['g2'])) {
                                    // add goal 1 field data
                                    $goal2FieldData = array(
                                        'entity_id' => $insertedGoalId,
                                        'name' => 'Goal 2 Function Field',
                                        'title' => 'Goal 2 Function Field',
                                        'weight' => 1,
                                        'type' => 'text',
                                        'body' => $parent[0]['g2']
                                    );
                                    $this->plan_model->addField($goal2FieldData);
                                }
                            }

                            //Objectives
                            //Loop through objectives and insert respective fields data
                            $objectives = $g2['objectives'];
                            if (is_array($objectives) && count($objectives) > 0) {
                                foreach ($objectives as $key => $objective) {

                                    //Create new entity and field
                                    $entityData = array(
                                        'name' => 'Goal 2 Objective',
                                        'title' => 'Objective',
                                        'owner' => $this->session->userdata('user_id'),
                                        'sid' => $school[0]['id'],
                                        'type_id' => $this->plan_model->getEntityTypeId('obj', 'name'),
                                        'parent' => $insertedGoalId,
                                        'weight' => $key
                                    );
                                    $entityId = $this->plan_model->addEntity($entityData);

                                    $fieldData = array(
                                        'entity_id' => $entityId,
                                        'name' => 'Objective Field',
                                        'title' => 'Objective',
                                        'weight' => 1,
                                        'type' => 'text',
                                        'body' => $objective['obj']
                                    );
                                    $this->plan_model->addField($fieldData);

                                }
                            }
                        } //end if there_is_a_goal for g2


                        //Deal with goal 3
                        $g3 = $goalRecords['g3'];
                        $parent = $g3['parent'];


                        if ($there_is_a_goal) {
                            $goal3Data = array(
                                'name' => 'Goal 3',
                                'title' => 'Goal 3 (Before)',
                                'owner' => $this->session->userdata('user_id'),
                                'sid' => (!empty($school) && is_array($school)) ? $school[0]['id'] : null,
                                'type_id' => $this->plan_model->getEntityTypeId('g3', 'name'),
                                'parent' => $fn_record_id,
                                'weight' => 1
                            );
                            $insertedGoalId = $this->plan_model->addEntity($goal3Data);

                            if (isset($course_of_action[0]['action_text']) && !empty($course_of_action[0]['action_text'])) {

                                $courseOfActionData = array(
                                    'name' => 'Goal 3 FN Course of Action',
                                    'title' => 'Course of Action',
                                    'owner' => $this->session->userdata('user_id'),
                                    'sid' => (!empty($school) && is_array($school)) ? $school[0]['id'] : null,
                                    'type_id' => $this->plan_model->getEntityTypeId('ca', 'name'),
                                    'parent' => $insertedGoalId,
                                    'weight' => 1
                                );

                                $newCourseofActionId = $this->plan_model->addEntity($courseOfActionData);

                                $fieldData = array(
                                    'entity_id' => $newCourseofActionId,
                                    'name' => 'Goal 3 FN Course of Action Field',
                                    'title' => 'Goal 3 FN Course of Action Field',
                                    'weight' => 1,
                                    'type' => 'text',
                                    'body' => ''
                                );
                                $this->plan_model->addField($fieldData);
                            }

                            if (count($parent) > 0) {
                                if (isset($parent[0]['g3']) && !empty($parent[0]['g3'])) {
                                    // add goal 3 field data
                                    $goal3FieldData = array(
                                        'entity_id' => $insertedGoalId,
                                        'name' => 'Goal 3 Function Field',
                                        'title' => 'Goal 3 Function Field',
                                        'weight' => 1,
                                        'type' => 'text',
                                        'body' => $parent[0]['g3']
                                    );
                                    $this->plan_model->addField($goal3FieldData);
                                }
                            }

                            //Objectives
                            //Loop through objectives and insert respective fields data
                            $objectives = $g3['objectives'];
                            if (is_array($objectives) && count($objectives) > 0) {
                                foreach ($objectives as $key => $objective) {

                                    //Create new entity and field
                                    $entityData = array(
                                        'name' => 'Goal 3 Objective',
                                        'title' => 'Objective',
                                        'owner' => $this->session->userdata('user_id'),
                                        'sid' => $school[0]['id'],
                                        'type_id' => $this->plan_model->getEntityTypeId('obj', 'name'),
                                        'parent' => $insertedGoalId,
                                        'weight' => $key
                                    );
                                    $entityId = $this->plan_model->addEntity($entityData);

                                    $fieldData = array(
                                        'entity_id' => $entityId,
                                        'name' => 'Objective Field',
                                        'title' => 'Objective',
                                        'weight' => 1,
                                        'type' => 'text',
                                        'body' => $objective['obj']
                                    );
                                    $this->plan_model->addField($fieldData);
                                }
                            }
                        } //end if there_is_a_goal for g3
                    }//End if goalData has records
                } //End else

                $this->send_message($serverTime, $percentage . '% functional goals data processed. server time: ' . date("h:i:s", time()), $percentage);

                sleep(1);

            }


        }else{

            //No data
            $message = "Migrating Goals and Objectives for Functions...";
            $message .= "<br> Empty Data Set";
            $this->send_message($serverTime, $message, 0);
            sleep(1);

            $percentage = 100;
            $this->send_message($serverTime, $percentage . '% completed', $percentage);
            sleep(1);

        }
    }

    private function migrate_form1_data($db_obj){


        $serverTime = time();

        $obsolete_form1_data = $this->migrate_model->getObsoleteForm1Data($db_obj);

        if(is_array($obsolete_form1_data) && count($obsolete_form1_data)>0){ //If records  are returned

            $num_recs = count($obsolete_form1_data);
            $processedRecs = 0;

            $message = "Migrating Basic Plan Section 1 Data...";
            $this->send_message($serverTime, $message, 0);
            sleep(1);

            foreach($obsolete_form1_data as $key=>$record){
                $processedRecs ++;

                $percentage = ceil(($processedRecs / $num_recs) * 100);

                $school = $this->school_model->getSchoolByName($record['school']);


                //Add form1 entity
                $entityData = array(
                    'name'      =>      'form1',
                    'title'     =>      'Introductory Material',
                    'owner'     =>      $this->session->userdata('user_id'),
                    'sid'       =>      (!empty($school) && is_array($school)) ? $school[0]['id']: null,
                    'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                    'weight'    =>      1
                );

                $insertedEntityId = $this->plan_model->addEntity($entityData);

                /**
                 * Add Children and their corresponding fields
                 */
                //1.0
                $entityData = array(
                    'name'      =>      '1.0',
                    'title'     =>      'Cover Page',
                    'owner'     =>      $this->session->userdata('user_id'),
                    'sid'       =>      (!empty($school) && is_array($school)) ? $school[0]['id']: null,
                    'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                    'parent'    =>      $insertedEntityId,
                    'weight'    =>      1
                );
                $insertedChildEntityId = $this->plan_model->addEntity($entityData);
                //1.0 fields
                $fieldData = array(
                    'entity_id' =>      $insertedChildEntityId,
                    'name'      =>      'Title Field',
                    'title'     =>      'Title of the plan',
                    'weight'    =>      1,
                    'type'      =>      'text',
                    'body'      =>      $record['title']
                );
                $this->plan_model->addField($fieldData);

                $fieldData = array(
                    'entity_id' =>      $insertedChildEntityId,
                    'name'      =>      'Date Field',
                    'title'     =>      'Date',
                    'weight'    =>      2,
                    'type'      =>      'text',
                    'body'      =>      $record['form_date']
                );
                $this->plan_model->addField($fieldData);

                $fieldData = array(
                    'entity_id' =>      $insertedChildEntityId,
                    'name'      =>      'School Field',
                    'title'     =>      'The school(s) covered by the plan',
                    'weight'    =>      3,
                    'type'      =>      'text',
                    'body'      =>      $record['plan']
                );
                $this->plan_model->addField($fieldData);

                //1.1
                $entityData = array(
                    'name'      =>      '1.1',
                    'title'     =>      'Promulgation Document and Signatures',
                    'owner'     =>      $this->session->userdata('user_id'),
                    'sid'       =>      (!empty($school) && is_array($school)) ? $school[0]['id']: null,
                    'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                    'parent'    =>      $insertedEntityId,
                    'weight'    =>      2
                );
                $insertedChildEntityId = $this->plan_model->addEntity($entityData);
                //1.1 fields
                $fieldData = array(
                    'entity_id' =>      $insertedChildEntityId,
                    'name'      =>      'Promulgation Field',
                    'title'     =>      'Promulgation Field',
                    'weight'    =>      1,
                    'type'      =>      'text',
                    'body'      =>      $record['q1']
                );
                $this->plan_model->addField($fieldData);
                //1.2
                $entityData = array(
                    'name'      =>      '1.2',
                    'title'     =>      'Approval and Implementation',
                    'owner'     =>      $this->session->userdata('user_id'),
                    'sid'       =>      (!empty($school) && is_array($school)) ? $school[0]['id']: null,
                    'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                    'parent'    =>      $insertedEntityId,
                    'weight'    =>      3
                );
                $insertedChildEntityId = $this->plan_model->addEntity($entityData);
                //1.2 fields
                $fieldData = array(
                    'entity_id' =>      $insertedChildEntityId,
                    'name'      =>      'Approval Field',
                    'title'     =>      'Approval Field',
                    'weight'    =>      1,
                    'type'      =>      'text',
                    'body'      =>      $record['q2']
                );
                $this->plan_model->addField($fieldData);

                $record_of_changes = $this->migrate_model->getRecordOfChanges($db_obj, $record['id']);
                if(count($record_of_changes)>0){

                    //1.3
                    $entityData = array(
                        'name'      =>      '1.3',
                        'title'     =>      'Record of Changes',
                        'owner'     =>      $this->session->userdata('user_id'),
                        'sid'       =>      (!empty($school) && is_array($school)) ? $school[0]['id']: null,
                        'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                        'parent'    =>      $insertedEntityId,
                        'weight'    =>      3
                    );
                    $insertedChildEntityId = $this->plan_model->addEntity($entityData);

                    //1.3 fields
                    $columns = array('Change Number', 'Date of Change', 'Name', 'Summary of Change');
                    $weight = 1;
                    foreach($record_of_changes as $position=>$record_of_change){

                        switch($record_of_change['col']){

                            case 1:
                                $fieldData = array(
                                    'entity_id' =>      $insertedChildEntityId,
                                    'name'      =>      $columns[0],
                                    'title'     =>      $columns[0],
                                    'weight'    =>      $weight,
                                    'type'      =>      'text',
                                    'body'      =>      $record_of_change['column_value']
                                );
                                $this->plan_model->addField($fieldData);
                                break;

                            case 2:
                                $fieldData = array(
                                    'entity_id' =>      $insertedChildEntityId,
                                    'name'      =>      $columns[1],
                                    'title'     =>      $columns[1],
                                    'weight'    =>      $weight,
                                    'type'      =>      'text',
                                    'body'      =>      $record_of_change['column_value']
                                );
                                $this->plan_model->addField($fieldData);
                                break;
                            case 3:
                                $fieldData = array(
                                    'entity_id' =>      $insertedChildEntityId,
                                    'name'      =>      $columns[2],
                                    'title'     =>      $columns[2],
                                    'weight'    =>      $weight,
                                    'type'      =>      'text',
                                    'body'      =>      $record_of_change['column_value']
                                );
                                $this->plan_model->addField($fieldData);
                                break;
                            case 4:
                                $fieldData = array(
                                    'entity_id' =>      $insertedChildEntityId,
                                    'name'      =>      $columns[3],
                                    'title'     =>      $columns[3],
                                    'weight'    =>      $weight,
                                    'type'      =>      'text',
                                    'body'      =>      $record_of_change['column_value']
                                );
                                $weight++;
                                $this->plan_model->addField($fieldData);
                                break;
                        }
                    }
                }


                $records_of_distribution = $this->migrate_model->getRecordOfDistribution($db_obj, $record['id']);
                if(count($records_of_distribution)>0){

                    //1.4
                    $entityData = array(
                        'name'      =>      '1.4',
                        'title'     =>      'Record of Distribution',
                        'owner'     =>      $this->session->userdata('user_id'),
                        'sid'       =>      (!empty($school) && is_array($school)) ? $school[0]['id']: null,
                        'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                        'parent'    =>      $insertedEntityId,
                        'weight'    =>      4
                    );
                    $insertedChildEntityId = $this->plan_model->addEntity($entityData);

                    //1.4 fields
                    $columns = array(
                        'Title and name of person receiving the plan',
                        'Agency (school office, government agency, or private-sector entity',
                        'Date of delivery',
                        'Number of copies delivered'
                    );
                    $weight =1;
                    foreach($records_of_distribution as $position=>$record_of_distribution){

                        switch($record_of_distribution['col']){

                            case 1:
                                $fieldData = array(
                                    'entity_id' =>      $insertedChildEntityId,
                                    'name'      =>      $columns[0],
                                    'title'     =>      $columns[0],
                                    'weight'    =>      $weight,
                                    'type'      =>      'text',
                                    'body'      =>      $record_of_distribution['column_value']
                                );
                                $this->plan_model->addField($fieldData);
                                break;

                            case 2:
                                $fieldData = array(
                                    'entity_id' =>      $insertedChildEntityId,
                                    'name'      =>      $columns[1],
                                    'title'     =>      $columns[1],
                                    'weight'    =>      $weight,
                                    'type'      =>      'text',
                                    'body'      =>      $record_of_distribution['column_value']
                                );
                                $this->plan_model->addField($fieldData);
                                break;

                            case 3:
                                $fieldData = array(
                                    'entity_id' =>      $insertedChildEntityId,
                                    'name'      =>      $columns[2],
                                    'title'     =>      $columns[2],
                                    'weight'    =>      $weight,
                                    'type'      =>      'text',
                                    'body'      =>      $record_of_distribution['column_value']
                                );
                                $this->plan_model->addField($fieldData);
                                break;

                            case 4:
                                $fieldData = array(
                                    'entity_id' =>      $insertedChildEntityId,
                                    'name'      =>      $columns[3],
                                    'title'     =>      $columns[3],
                                    'weight'    =>      $weight,
                                    'type'      =>      'text',
                                    'body'      =>      $record_of_distribution['column_value']
                                );
                                $this->plan_model->addField($fieldData);
                                $weight++;
                                break;
                        }
                    }
                }



                $status = (is_numeric($insertedEntityId)) ? 'Success' : 'Failure';


                $this->send_message($serverTime, $percentage . '% basic plan section 1 data processed. server time: ' . date("h:i:s", time()) . " [$status]", $percentage);

                sleep(1);

            }


        }else{

            //No data
            $message = "Migrating Basic Plan Section 1 Data...";
            $message .= "<br> Empty Data Set";
            $this->send_message($serverTime, $message, 0);
            sleep(1);

            $percentage = 100;
            $this->send_message($serverTime, $percentage . '% completed', $percentage);
            sleep(1);
        }

    }

    private function migrate_form2_data($db_obj){

        $serverTime = time();

        $obsolete_form2_data = $this->migrate_model->getObsoleteForm2Data($db_obj);

        if(is_array($obsolete_form2_data) && count($obsolete_form2_data)>0) { //If records  are returned

            $num_recs = count($obsolete_form2_data);
            $processedRecs = 0;

            $message = "Migrating Basic Plan Section 2 Data...";
            $this->send_message($serverTime, $message, 0);
            sleep(1);

            foreach ($obsolete_form2_data as $key => $record) {
                $processedRecs++;

                $percentage = ceil(($processedRecs / $num_recs) * 100);

                $school = $this->school_model->getSchoolByName($record['school']);

                //Add form2 entity
                $entityData = array(
                    'name'      =>      'form2',
                    'title'     =>      'Purpose, Scope, Situation Overview, and Assumptions',
                    'owner'     =>      $this->session->userdata('user_id'),
                    'sid'       =>      (!empty($school) && is_array($school)) ? $school[0]['id']: null,
                    'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                    'weight'    =>      1
                );

                $insertedEntityId = $this->plan_model->addEntity($entityData);

                /**
                 * Add Children and their corresponding fields
                 */
                //2.1
                $entityData = array(
                    'name'      =>      '2.1',
                    'title'     =>      'Purpose',
                    'owner'     =>      $this->session->userdata('user_id'),
                    'sid'       =>      (!empty($school) && is_array($school)) ? $school[0]['id']: null,
                    'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                    'parent'    =>      $insertedEntityId,
                    'weight'    =>      1
                );
                $insertedChildEntityId = $this->plan_model->addEntity($entityData);
                //2.1 fields
                $fieldData = array(
                    'entity_id' =>      $insertedChildEntityId,
                    'name'      =>      'Purpose Field',
                    'title'     =>      'Purpose',
                    'weight'    =>      1,
                    'type'      =>      'text',
                    'body'      =>      $record['q2_1']
                );
                $this->plan_model->addField($fieldData);


                //2.2
                $entityData = array(
                    'name'      =>      '2.2',
                    'title'     =>      'Scope',
                    'owner'     =>      $this->session->userdata('user_id'),
                    'sid'       =>      (!empty($school) && is_array($school)) ? $school[0]['id']: null,
                    'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                    'parent'    =>      $insertedEntityId,
                    'weight'    =>      2
                );
                $insertedChildEntityId = $this->plan_model->addEntity($entityData);
                //2.2 fields
                $fieldData = array(
                    'entity_id' =>      $insertedChildEntityId,
                    'name'      =>      'Scope',
                    'title'     =>      'Scope',
                    'weight'    =>      1,
                    'type'      =>      'text',
                    'body'      =>      $record['q2_2']
                );
                $this->plan_model->addField($fieldData);

                //2.3
                $entityData = array(
                    'name'      =>      '2.3',
                    'title'     =>      'Situation Overview',
                    'owner'     =>      $this->session->userdata('user_id'),
                    'sid'       =>      (!empty($school) && is_array($school)) ? $school[0]['id']: null,
                    'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                    'parent'    =>      $insertedEntityId,
                    'weight'    =>      3
                );
                $insertedChildEntityId = $this->plan_model->addEntity($entityData);
                //2.3 fields
                $fieldData = array(
                    'entity_id' =>      $insertedChildEntityId,
                    'name'      =>      'Situation Overview',
                    'title'     =>      'Situation Overview',
                    'weight'    =>      1,
                    'type'      =>      'text',
                    'body'      =>      $record['q2_3']
                );
                $this->plan_model->addField($fieldData);

                //2.4
                $entityData = array(
                    'name'      =>      '2.4',
                    'title'     =>      'Planning Assumptions',
                    'owner'     =>      $this->session->userdata('user_id'),
                    'sid'       =>      (!empty($school) && is_array($school)) ? $school[0]['id']: null,
                    'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                    'parent'    =>      $insertedEntityId,
                    'weight'    =>      3
                );
                $insertedChildEntityId = $this->plan_model->addEntity($entityData);
                //2.4 fields
                $fieldData = array(
                    'entity_id' =>      $insertedChildEntityId,
                    'name'      =>      'Planning Assumptions',
                    'title'     =>      'Planning Assumptions',
                    'weight'    =>      1,
                    'type'      =>      'text',
                    'body'      =>      $record['q2_4']
                );
                $this->plan_model->addField($fieldData);

                $status = (is_numeric($insertedEntityId)) ? 'Success' : 'Failure';


                $this->send_message($serverTime, $percentage . '% basic plan section 2 data processed. server time: ' . date("h:i:s", time()) . " [$status]", $percentage);

                sleep(1);
            }
        }else{

            //No data
            $message = "Migrating Basic Plan Section 2 Data...";
            $message .= "<br> Empty Data Set";
            $this->send_message($serverTime, $message, 0);
            sleep(1);

            $percentage = 100;
            $this->send_message($serverTime, $percentage . '% completed', $percentage);
            sleep(1);
        }

    }

    private function migrate_form3_data($db_obj){

        $serverTime = time();
        $message = "Migrating Basic Plan Section 3 Data...";

        $obsolete_form3_data = $this->migrate_model->getObsoleteForm3Data($db_obj);

        if(is_array($obsolete_form3_data) && count($obsolete_form3_data)>0) { //If records  are returned

            $num_recs = count($obsolete_form3_data);
            $processedRecs = 0;

            $this->send_message($serverTime, $message, 0);
            sleep(1);

            foreach ($obsolete_form3_data as $key => $record) {
                $processedRecs++;

                $percentage = ceil(($processedRecs / $num_recs) * 100);

                $school = $this->school_model->getSchoolByName($record['school']);


                //Add form3 entity
                $entityData = array(
                    'name'      =>      'form3',
                    'title'     =>      'Concept of Operations (CONOPS)',
                    'owner'     =>      $this->session->userdata('user_id'),
                    'sid'       =>      (!empty($school) && is_array($school)) ? $school[0]['id']: null,
                    'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                    'weight'    =>      1
                );

                $insertedEntityId = $this->plan_model->addEntity($entityData);

                /**
                 * Add Children and their corresponding fields
                 */
                //3.1
                $entityData = array(
                    'name'      =>      '3.1',
                    'title'     =>      'CONOPS',
                    'owner'     =>      $this->session->userdata('user_id'),
                    'sid'       =>      (!empty($school) && is_array($school)) ? $school[0]['id']: null,
                    'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                    'parent'    =>      $insertedEntityId,
                    'weight'    =>      1
                );
                $insertedChildEntityId = $this->plan_model->addEntity($entityData);
                //3.1 fields
                $fieldData = array(
                    'entity_id' =>      $insertedChildEntityId,
                    'name'      =>      'CONOPS Field',
                    'title'     =>      'CONOPS',
                    'weight'    =>      1,
                    'type'      =>      'text',
                    'body'      =>      $record['q3_1']
                );
                $this->plan_model->addField($fieldData);

                $status = (is_numeric($insertedEntityId)) ? 'Success' : 'Failure';

                $this->send_message($serverTime, $percentage . '% basic plan section 3 data processed. server time: ' . date("h:i:s", time()) . " [$status]", $percentage);

                sleep(1);

            }
        }else{

            //No data
            $message .= "<br> Empty Data Set";
            $this->send_message($serverTime, $message, 0);
            sleep(1);

            $percentage = 100;
            $this->send_message($serverTime, $percentage . '% completed', $percentage);
            sleep(1);
        }

    }

    private function migrate_form4_data($db_obj){

        $serverTime = time();
        $message = "Migrating Basic Plan Section 4 Data...";

        $obsolete_form4_data = $this->migrate_model->getObsoleteForm4Data($db_obj);

        if(is_array($obsolete_form4_data) && count($obsolete_form4_data)>0) { //If records  are returned

            $num_recs = count($obsolete_form4_data);
            $processedRecs = 0;

            $this->send_message($serverTime, $message, 0);
            sleep(1);

            foreach ($obsolete_form4_data as $key => $record) {
                $processedRecs++;

                $percentage = ceil(($processedRecs / $num_recs) * 100);

                $school = $this->school_model->getSchoolByName($record['school']);


                //Add form4 entity
                $entityData = array(
                    'name'      =>      'form4',
                    'title'     =>      'Organization and Assignment of Responsibilities',
                    'owner'     =>      $this->session->userdata('user_id'),
                    'sid'       =>      (!empty($school) && is_array($school)) ? $school[0]['id']: null,
                    'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                    'weight'    =>      1
                );

                $insertedEntityId = $this->plan_model->addEntity($entityData);

                /**
                 * Add Children and their corresponding fields
                 */
                //4.1
                $entityData = array(
                    'name'      =>      '4.1',
                    'title'     =>      'Organization and Assignment of Responsibilities',
                    'owner'     =>      $this->session->userdata('user_id'),
                    'sid'       =>      (!empty($school) && is_array($school)) ? $school[0]['id']: null,
                    'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                    'parent'    =>      $insertedEntityId,
                    'weight'    =>      1
                );
                $insertedChildEntityId = $this->plan_model->addEntity($entityData);
                //4.1 fields
                $fieldData = array(
                    'entity_id' =>      $insertedChildEntityId,
                    'name'      =>      'Organization Field',
                    'title'     =>      'Organization and Assignment of Responsibilities',
                    'weight'    =>      1,
                    'type'      =>      'text',
                    'body'      =>      $record['q4_1']
                );
                $this->plan_model->addField($fieldData);

                $status = (is_numeric($insertedEntityId)) ? 'Success' : 'Failure';

                $this->send_message($serverTime, $percentage . '% basic plan section 4 data processed. server time: ' . date("h:i:s", time()) . " [$status]", $percentage);

                sleep(1);

            }
        }else{

            //No data
            $message .= "<br> Empty Data Set";
            $this->send_message($serverTime, $message, 0);
            sleep(1);

            $percentage = 100;
            $this->send_message($serverTime, $percentage . '% completed', $percentage);
            sleep(1);
        }

    }

    private function migrate_form5_data($db_obj){

        $serverTime = time();
        $message = "Migrating Basic Plan Section 5 Data...";

        $obsolete_form5_data = $this->migrate_model->getObsoleteForm5Data($db_obj);

        if(is_array($obsolete_form5_data) && count($obsolete_form5_data)>0) { //If records  are returned

            $num_recs = count($obsolete_form5_data);
            $processedRecs = 0;

            $this->send_message($serverTime, $message, 0);
            sleep(1);

            foreach ($obsolete_form5_data as $key => $record) {
                $processedRecs++;

                $percentage = ceil(($processedRecs / $num_recs) * 100);

                $school = $this->school_model->getSchoolByName($record['school']);


                //Add form5 entity
                $entityData = array(
                    'name'      =>      'form5',
                    'title'     =>      'Direction, Control and Coordination',
                    'owner'     =>      $this->session->userdata('user_id'),
                    'sid'       =>      (!empty($school) && is_array($school)) ? $school[0]['id']: null,
                    'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                    'weight'    =>      1
                );

                $insertedEntityId = $this->plan_model->addEntity($entityData);

                /**
                 * Add Children and their corresponding fields
                 */
                //5.1
                $entityData = array(
                    'name'      =>      '5.1',
                    'title'     =>      'Direction, Control and Coordination',
                    'owner'     =>      $this->session->userdata('user_id'),
                    'sid'       =>      (!empty($school) && is_array($school)) ? $school[0]['id']: null,
                    'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                    'parent'    =>      $insertedEntityId,
                    'weight'    =>      1
                );
                $insertedChildEntityId = $this->plan_model->addEntity($entityData);
                //5.1 fields
                $fieldData = array(
                    'entity_id' =>      $insertedChildEntityId,
                    'name'      =>      'Direction Field',
                    'title'     =>      'Direction, Control and Coordination',
                    'weight'    =>      1,
                    'type'      =>      'text',
                    'body'      =>      $record['q5_1']
                );
                $this->plan_model->addField($fieldData);

                $status = (is_numeric($insertedEntityId)) ? 'Success' : 'Failure';

                $this->send_message($serverTime, $percentage . '% basic plan section 5 data processed. server time: ' . date("h:i:s", time()) . " [$status]", $percentage);

                sleep(1);

            }
        }else{

            //No data
            $message .= "<br> Empty Data Set";
            $this->send_message($serverTime, $message, 0);
            sleep(1);

            $percentage = 100;
            $this->send_message($serverTime, $percentage . '% completed', $percentage);
            sleep(1);
        }

    }

    private function migrate_form6_data($db_obj){

        $serverTime = time();
        $message = "Migrating Basic Plan Section 6 Data...";

        $obsolete_form6_data = $this->migrate_model->getObsoleteForm6Data($db_obj);

        if(is_array($obsolete_form6_data) && count($obsolete_form6_data)>0) { //If records  are returned

            $num_recs = count($obsolete_form6_data);
            $processedRecs = 0;

            $this->send_message($serverTime, $message, 0);
            sleep(1);

            foreach ($obsolete_form6_data as $key => $record) {
                $processedRecs++;

                $percentage = ceil(($processedRecs / $num_recs) * 100);

                $school = $this->school_model->getSchoolByName($record['school']);


                //Add form6 entity
                $entityData = array(
                    'name'      =>      'form6',
                    'title'     =>      'Information Collection, Analysis and Dissemination',
                    'owner'     =>      $this->session->userdata('user_id'),
                    'sid'       =>      (!empty($school) && is_array($school)) ? $school[0]['id']: null,
                    'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                    'weight'    =>      1
                );

                $insertedEntityId = $this->plan_model->addEntity($entityData);

                /**
                 * Add Children and their corresponding fields
                 */
                //6.1
                $entityData = array(
                    'name'      =>      '6.1',
                    'title'     =>      'Information Collection, Analysis and Dissemination',
                    'owner'     =>      $this->session->userdata('user_id'),
                    'sid'       =>      (!empty($school) && is_array($school)) ? $school[0]['id']: null,
                    'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                    'parent'    =>      $insertedEntityId,
                    'weight'    =>      1
                );
                $insertedChildEntityId = $this->plan_model->addEntity($entityData);
                //6.1 fields
                $fieldData = array(
                    'entity_id' =>      $insertedChildEntityId,
                    'name'      =>      'Information Field',
                    'title'     =>      'Information Collection, Analysis and Dissemination',
                    'weight'    =>      1,
                    'type'      =>      'text',
                    'body'      =>      $record['q6_1']
                );
                $this->plan_model->addField($fieldData);

                $status = (is_numeric($insertedEntityId)) ? 'Success' : 'Failure';

                $this->send_message($serverTime, $percentage . '% basic plan section 6 data processed. server time: ' . date("h:i:s", time()) . " [$status]", $percentage);

                sleep(1);

            }
        }else{

            //No data
            $message .= "<br> Empty Data Set";
            $this->send_message($serverTime, $message, 0);
            sleep(1);

            $percentage = 100;
            $this->send_message($serverTime, $percentage . '% completed', $percentage);
            sleep(1);
        }

    }

    private function migrate_form7_data($db_obj){

        $serverTime = time();
        $message = "Migrating Basic Plan Section 7 Data...";

        $obsolete_form7_data = $this->migrate_model->getObsoleteForm7Data($db_obj);

        if(is_array($obsolete_form7_data) && count($obsolete_form7_data)>0) { //If records  are returned

            $num_recs = count($obsolete_form7_data);
            $processedRecs = 0;

            $this->send_message($serverTime, $message, 0);
            sleep(1);

            foreach ($obsolete_form7_data as $key => $record) {
                $processedRecs++;

                $percentage = ceil(($processedRecs / $num_recs) * 100);

                $school = $this->school_model->getSchoolByName($record['school']);


                //Add form7 entity
                $entityData = array(
                    'name'      =>      'form7',
                    'title'     =>      'Training Exercise',
                    'owner'     =>      $this->session->userdata('user_id'),
                    'sid'       =>      (!empty($school) && is_array($school)) ? $school[0]['id']: null,
                    'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                    'weight'    =>      1
                );

                $insertedEntityId = $this->plan_model->addEntity($entityData);

                /**
                 * Add Children and their corresponding fields
                 */
                //7.1
                $entityData = array(
                    'name'      =>      '7.1',
                    'title'     =>      'Training Exercise',
                    'owner'     =>      $this->session->userdata('user_id'),
                    'sid'       =>      (!empty($school) && is_array($school)) ? $school[0]['id']: null,
                    'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                    'parent'    =>      $insertedEntityId,
                    'weight'    =>      1
                );
                $insertedChildEntityId = $this->plan_model->addEntity($entityData);
                //7.1 fields
                $fieldData = array(
                    'entity_id' =>      $insertedChildEntityId,
                    'name'      =>      'Training Exercise Field',
                    'title'     =>      'Training Exercise',
                    'weight'    =>      1,
                    'type'      =>      'text',
                    'body'      =>      $record['q7_1']
                );
                $this->plan_model->addField($fieldData);

                $status = (is_numeric($insertedEntityId)) ? 'Success' : 'Failure';

                $this->send_message($serverTime, $percentage . '% basic plan section 7 data processed. server time: ' . date("h:i:s", time()) . " [$status]", $percentage);

                sleep(1);

            }
        }else{

            //No data
            $message .= "<br> Empty Data Set";
            $this->send_message($serverTime, $message, 0);
            sleep(1);

            $percentage = 100;
            $this->send_message($serverTime, $percentage . '% completed', $percentage);
            sleep(1);
        }

    }

    private function migrate_form8_data($db_obj){

        $serverTime = time();
        $message = "Migrating Basic Plan Section 8 Data...";

        $obsolete_form8_data = $this->migrate_model->getObsoleteForm8Data($db_obj);

        if(is_array($obsolete_form8_data) && count($obsolete_form8_data)>0) { //If records  are returned

            $num_recs = count($obsolete_form8_data);
            $processedRecs = 0;

            $this->send_message($serverTime, $message, 0);
            sleep(1);

            foreach ($obsolete_form8_data as $key => $record) {
                $processedRecs++;

                $percentage = ceil(($processedRecs / $num_recs) * 100);

                $school = $this->school_model->getSchoolByName($record['school']);


                //Add form8 entity
                $entityData = array(
                    'name'      =>      'form8',
                    'title'     =>      'Administration, Finance, and Logistics',
                    'owner'     =>      $this->session->userdata('user_id'),
                    'sid'       =>      (!empty($school) && is_array($school)) ? $school[0]['id']: null,
                    'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                    'weight'    =>      1
                );

                $insertedEntityId = $this->plan_model->addEntity($entityData);

                /**
                 * Add Children and their corresponding fields
                 */
                //8.1
                $entityData = array(
                    'name'      =>      '8.1',
                    'title'     =>      'Administration, Finance, and Logistics',
                    'owner'     =>      $this->session->userdata('user_id'),
                    'sid'       =>      (!empty($school) && is_array($school)) ? $school[0]['id']: null,
                    'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                    'parent'    =>      $insertedEntityId,
                    'weight'    =>      1
                );
                $insertedChildEntityId = $this->plan_model->addEntity($entityData);
                //8.1 fields
                $fieldData = array(
                    'entity_id' =>      $insertedChildEntityId,
                    'name'      =>      'Administration, Finance, and Logistics Field',
                    'title'     =>      'Administration, Finance, and Logistics',
                    'weight'    =>      1,
                    'type'      =>      'text',
                    'body'      =>      $record['q8_1']
                );
                $this->plan_model->addField($fieldData);


                $status = (is_numeric($insertedEntityId)) ? 'Success' : 'Failure';

                $this->send_message($serverTime, $percentage . '% basic plan section 8 data processed. server time: ' . date("h:i:s", time()) . " [$status]", $percentage);

                sleep(1);

            }
        }else{

            //No data
            $message .= "<br> Empty Data Set";
            $this->send_message($serverTime, $message, 0);
            sleep(1);

            $percentage = 100;
            $this->send_message($serverTime, $percentage . '% completed', $percentage);
            sleep(1);
        }

    }

    private function migrate_form9_data($db_obj){

        $serverTime = time();
        $message = "Migrating Basic Plan Section 9 Data...";

        $obsolete_form9_data = $this->migrate_model->getObsoleteForm9Data($db_obj);

        if(is_array($obsolete_form9_data) && count($obsolete_form9_data)>0) { //If records  are returned

            $num_recs = count($obsolete_form9_data);
            $processedRecs = 0;

            $this->send_message($serverTime, $message, 0);
            sleep(1);

            foreach ($obsolete_form9_data as $key => $record) {
                $processedRecs++;

                $percentage = ceil(($processedRecs / $num_recs) * 100);

                $school = $this->school_model->getSchoolByName($record['school']);


                //Add form9 entity
                $entityData = array(
                    'name'      =>      'form9',
                    'title'     =>      'Plan Development and Maintenance',
                    'owner'     =>      $this->session->userdata('user_id'),
                    'sid'       =>      (!empty($school) && is_array($school)) ? $school[0]['id']: null,
                    'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                    'weight'    =>      1
                );

                $insertedEntityId = $this->plan_model->addEntity($entityData);

                /**
                 * Add Children and their corresponding fields
                 */
                //9.1
                $entityData = array(
                    'name'      =>      '9.1',
                    'title'     =>      'Plan Development and Maintenance',
                    'owner'     =>      $this->session->userdata('user_id'),
                    'sid'       =>      (!empty($school) && is_array($school)) ? $school[0]['id']: null,
                    'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                    'parent'    =>      $insertedEntityId,
                    'weight'    =>      1
                );
                $insertedChildEntityId = $this->plan_model->addEntity($entityData);
                //9.1 fields
                $fieldData = array(
                    'entity_id' =>      $insertedChildEntityId,
                    'name'      =>      'Plan Development and Maintenance Field',
                    'title'     =>      'Plan Development and Maintenance',
                    'weight'    =>      1,
                    'type'      =>      'text',
                    'body'      =>      $record['q9_1']
                );
                $this->plan_model->addField($fieldData);


                $status = (is_numeric($insertedEntityId)) ? 'Success' : 'Failure';

                $this->send_message($serverTime, $percentage . '% basic plan section 9 data processed. server time: ' . date("h:i:s", time()) . " [$status]", $percentage);

                sleep(1);

            }
        }else{

            //No data
            $message .= "<br> Empty Data Set";
            $this->send_message($serverTime, $message, 0);
            sleep(1);

            $percentage = 100;
            $this->send_message($serverTime, $percentage . '% completed', $percentage);
            sleep(1);
        }

    }

    private function migrate_form10_data($db_obj){

        $serverTime = time();
        $message = "Migrating Basic Plan Section 10 Data...";

        $obsolete_form10_data = $this->migrate_model->getObsoleteForm10Data($db_obj);

        if(is_array($obsolete_form10_data) && count($obsolete_form10_data)>0) { //If records  are returned

            $num_recs = count($obsolete_form10_data);
            $processedRecs = 0;

            $this->send_message($serverTime, $message, 0);
            sleep(1);

            foreach ($obsolete_form10_data as $key => $record) {
                $processedRecs++;

                $percentage = ceil(($processedRecs / $num_recs) * 100);

                $school = $this->school_model->getSchoolByName($record['school']);


                //Add form10 entity
                $entityData = array(
                    'name'      =>      'form10',
                    'title'     =>      'Authorities and References',
                    'owner'     =>      $this->session->userdata('user_id'),
                    'sid'       =>      (!empty($school) && is_array($school)) ? $school[0]['id']: null,
                    'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                    'weight'    =>      1
                );

                $insertedEntityId = $this->plan_model->addEntity($entityData);

                /**
                 * Add Children and their corresponding fields
                 */
                //10.1
                $entityData = array(
                    'name'      =>      '10.1',
                    'title'     =>      'Authorities and References',
                    'owner'     =>      $this->session->userdata('user_id'),
                    'sid'       =>      (!empty($school) && is_array($school)) ? $school[0]['id']: null,
                    'type_id'   =>      $this->plan_model->getEntityTypeId('bp', 'name'),
                    'parent'    =>      $insertedEntityId,
                    'weight'    =>      1
                );
                $insertedChildEntityId = $this->plan_model->addEntity($entityData);
                //10.1 fields
                $fieldData = array(
                    'entity_id' =>      $insertedChildEntityId,
                    'name'      =>      'Authorities and References Field',
                    'title'     =>      'Authorities and References',
                    'weight'    =>      1,
                    'type'      =>      'text',
                    'body'      =>      $record['q10_1']
                );
                $this->plan_model->addField($fieldData);

                $status = (is_numeric($insertedEntityId)) ? 'Success' : 'Failure';

                $this->send_message($serverTime, $percentage . '% basic plan section 10 data processed. server time: ' . date("h:i:s", time()) . " [$status]", $percentage);

                sleep(1);

            }
        }else{

            //No data
            $message .= "<br> Empty Data Set";
            $this->send_message($serverTime, $message, 0);
            sleep(1);

            $percentage = 100;
            $this->send_message($serverTime, $percentage . '% completed', $percentage);
            sleep(1);
        }

    }

        function test(){

        $config['hostname'] = 'localhost';
        $config['username'] = 'root';
        $config['password'] = 'glyde1';
        $config['database'] = 'eop1.0';
        $config['dbdriver'] = strtolower('mysql');
        $config['dbprefix'] = "";
        $config['pconnect'] = FALSE;
        $config['db_debug'] = FALSE;
        $config['cache_on'] = FALSE;
        $config['cachedir'] = "";
        $config['char_set'] = "utf8";
        $config['dbcollat'] = "utf8_general_ci";

        $db_obj = $this->load->database($config, TRUE);
            print_r($this->migrate_model->test($db_obj));
        /*$obsolete_th_data = $this->migrate_model->getObsoleteFns($db_obj);
        $newarr = array();

        foreach($obsolete_th_data as $key=>$record){

            $school = $this->school_model->getSchoolByName('First School');
            $newarr[] = $this->plan_model->getEntities('fn', array('parent is not null'=> Null, 'name'=>$school[0]['id'],'sid'=>$school[0]['id']), false);
            print_r($school);
        }*/

        //print_r($newarr);

    }

    /**
    Send a partial message
     */
    function send_message($id, $message, $progress)
    {
        if($progress >= 100){
            $this->overall_progress += ceil(100/17);
        }

        $d = array('message' => $message , 'progress' => $progress, 'overall_progress'=>$this->overall_progress);

        echo json_encode($d) . PHP_EOL;

        //PUSH THE data out by all FORCE POSSIBLE
        ob_flush();
        flush();
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

/* End of file App.php */
/* Location: ./application/controllers/App.php */