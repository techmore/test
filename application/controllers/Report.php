<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Report Controller Class
 *
 * Developed by Synergy Enterprises, Inc. for the U.S. Department of Education
 *
 * Report Responsible for:
 *
 * - Creating EOP Report for export
 * - Exporting Team members and Users to Excel Worksheet
 *
 *
 * Date: 6/26/15 02:34 PM
 *
 * (c) 2015 United States Department of Education
 */

class Report extends CI_Controller{

    var $school_id = null;
    var $EOP_type = 'internal';
    var $EOP_ctype = 'internal';
    var $numbered_lists = 0;

    public function __construct(){
        parent::__construct();

        if($this->session->userdata('is_logged_in')){
            //Load Libraries
            $this->load->library('simple_html_dom');
            $this->load->library('Html2Text');
            $this->load->library('word');
            $this->load->library('excel');
            $this->load->library('DocStyles');
            $this->load->library('upload');
            $this->load->helper('file');

            //Load helper functions
            $this->load->helper(array('h2d_htmlconverter', 'support_functions', 'word'));

            //Load Models
            $this->load->model('school_model');
            $this->load->model('plan_model');
            $this->load->model('report_model');
            $this->load->model('team_model');
            $this->load->model('registry_model');
            $this->load->model('state_model');

        }
        else{
            redirect('/login');
        }
    }

    public function remove($docType='main'){
        $sid =isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null;
        $type_id = $this->plan_model->getEntityTypeId('file', 'name');

        if(!empty($sid)){
            $fileEntityData = $this->plan_model->getEntities('file', array("sid"=>$sid) , false);
            $arrayStore = array();

            if(is_array($fileEntityData) && count($fileEntityData)>0){
                $arrayStore = objectToArray(json_decode($fileEntityData[0]['description']));

                $this->plan_model->deleteEntity(array('sid'=>$sid, 'type_id'=>$type_id));
            }
            unlink($arrayStore[$docType]['full_path']);
            //get the basic_plan_source value
            $temp = $arrayStore[$docType]['basic_plan_source'];
            $arrayStore[$docType]= array('basic_plan_source'=>$temp);

            $entityData = array(
                'name'      =>      'Basic Plan',
                'title'     =>      'Uploaded Basic Plan',
                'owner'     =>      $this->session->userdata('user_id'),
                'sid'       =>      $sid,
                'type_id'   =>      $type_id,
                'description'=>     json_encode($arrayStore)
            );
            $this->plan_model->addEntity($entityData);

        }else{
            if($this->registry_model->hasKey('sys_preferences')){
                $preferences = json_decode($this->registry_model->getValue('sys_preferences'));
                //update the preference value
                $arrayStore = array();
                $arrayStore['main'] = isset($preferences->main) ? objectToArray($preferences->main) : null;
                $arrayStore['cover'] = isset($preferences->cover) ? objectToArray($preferences->cover) : null;

                unlink($arrayStore[$docType]['full_path']);
                //get the basic_plan_source value
                $temp = $arrayStore[$docType]['basic_plan_source'];
                $arrayStore[$docType] = array('basic_plan_source' => $temp);

                $this->registry_model->update('sys_preferences', json_encode($arrayStore));
            }
        }

        redirect('plan/step5/4');
    }

    public function upload(){

        $sid =isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null;
        $type_id = $this->plan_model->getEntityTypeId('file', 'name');
        $docType = $this->input->post('docType');

        $config = array(
            'upload_path'   =>  dirname($_SERVER["SCRIPT_FILENAME"]).'/uploads/',
            'upload_url'    =>  base_url()."uploads/",
            'file_name'     =>  'uploaded_EOP_'.$docType.'_'.$sid,
            'overwrite'     =>  true,
            'allowed_types' =>  'doc|docx',
            'max_size'      =>  '10024KB'
        );
        $this->upload->initialize($config);
        if($this->upload->do_upload()){
            $fileData = $this->upload->data();

            $data = array(
                'saved' => true,
                'fileData' => array($docType => $fileData)
            );

            if(!empty($sid)){


                $fileEntityData = $this->plan_model->getEntities('file', array("sid"=>$sid) , false);
                $arrayStore = array();


                if(is_array($fileEntityData) && count($fileEntityData)>0){
                    $arrayStore = objectToArray(json_decode($fileEntityData[0]['description']));

                    $this->plan_model->deleteEntity(array('sid'=>$sid, 'type_id'=>$type_id));
                }

                $arrayStore[$docType]= $fileData;

                $entityData = array(
                    'name'      =>      'Basic Plan',
                    'title'     =>      'Uploaded Basic Plan',
                    'owner'     =>      $this->session->userdata('user_id'),
                    'sid'       =>      $sid,
                    'type_id'   =>      $type_id,
                    'description'=>     json_encode($arrayStore)
                );
                $this->plan_model->addEntity($entityData);

                $data['fileData'] = $arrayStore;

            }else{

                if($this->registry_model->hasKey('sys_preferences')){
                    $preferences = json_decode($this->registry_model->getValue('sys_preferences'));
                    //update the preference value
                    $arrayStore = array();
                    $arrayStore['main'] = isset($preferences->main) ? objectToArray($preferences->main) : null;
                    $arrayStore['cover'] = isset($preferences->cover) ? objectToArray($preferences->cover) : null;

                    $arrayStore[$docType] = $fileData;
                    $arrayStore[$docType]['basic_plan_source'] = 'external';

                    $this->registry_model->update('sys_preferences', json_encode($arrayStore));
                    $data['fileData'] = $arrayStore;
                }else{
                    $fileData['basic_plan_source'] = 'external';
                    $arrayStore = array();
                    $arrayStore[$docType] = $fileData;

                    $preferences = array('sys_preferences' => json_encode($arrayStore));
                    $this->registry_model->addVariables($preferences);
                    $data['fileData'] = $arrayStore;
                }
            }


            $this->load->view('ajax/upload', $data);

        }else{
            $data = $this->upload->display_errors();
            $this->load->view('ajax/upload', $data);
        }
    }

    public function getUploads(){
        if($this->input->post('ajax')){
            $sid = isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null;


            if(!empty($sid)){
                $entityData = $this->plan_model->getEntities('file', array("sid"=>$sid) , false);

                if(is_array($entityData) && count($entityData)>0){
                    $fileData = json_decode($entityData[0]['description']);

                    $data= array(
                        'fileData' => objectToArray($fileData)
                    );

                    $this->load->view('ajax/upload', $data);

                }
            }else{
                $preferences = json_decode($this->registry_model->getValue('sys_preferences'));
                if(!empty($preferences)){
                    $data = array(
                        'fileData' => objectToArray($preferences)
                    );

                    $this->load->view('ajax/upload', $data);

                }
            }

        }
    }


    public function importdoc(){
        if($this->input->post('ajax')){

            $config = array(
                'upload_path'   =>  dirname($_SERVER["SCRIPT_FILENAME"]).'/uploads/',
                'upload_url'    =>  base_url()."uploads/",
                'file_name'     =>  'importdoc',
                'overwrite'     =>  true,
                'allowed_types' =>  'doc|docx',
                'max_size'      =>  '10024KB'
            );
            $this->upload->initialize($config);

            if($this->upload->do_upload()){
                $fileData = $this->upload->data();
                $filePath = $fileData['full_path'];
                $fileExtension = substr($fileData['orig_name'], (strrpos($fileData['orig_name'], ".")+1));

                $text ='';

                if($fileExtension == 'doc')
                    $text = read_doc($fileData);
                elseif($fileExtension == 'docx')
                    $text = read_docx($fileData);

                unlink($filePath);

                $this->output->set_output($text);

            }else{
                $this->output->set_output($this->upload->display_errors());
            }


        }else{
            $this->output->set_output(json_encode($this->input->post()));
        }
    }

    private function get_schools_in_my_district(){

        return $this->school_model->getDistrictSchools($this->session->userdata['loaded_district']['id']);
    }

    public function search($param='', $param2=''){

        if($this->input->post('ajax')) {
            switch ($param) {
                case 'exercises':

                    $this->load->model('exercise_model');

                    $conditions = array(
                        'host' => $this->input->post('txtHost'),
                        'district_id' => $this->input->post('filter_by_district'),
                        'school_id' => $this->input->post('filter_by_school'),
                        'type' => $this->input->post('txttype'),
                        'from' => $this->input->post('txtDateExerciseFrom'),
                        'to' => $this->input->post('txtDateExerciseTo')
                    );

                    if (isset($this->session->userdata['role']['level']) && $this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL) {
                        $schoolCondition = '';

                        if (isset($this->session->userdata['loaded_school']['id'])) {
                            $schoolCondition = array('sid' => $this->session->userdata['loaded_school']['id']);
                        }
                        $resultData = ($param2 == '') ? $this->exercise_model->getExercises($conditions, true) : $this->exercise_model->getExercises($schoolCondition);
                    } else if ($this->session->userdata['role']['level'] >= SCHOOL_ADMIN_LEVEL) { //School Admin and User
                        $schoolCondition = array('sid' => $this->session->userdata['loaded_school']['id']);

                        $resultData = ($param2 == '') ? $this->exercise_model->getExercises($conditions, true) : $this->exercise_model->getExercises($schoolCondition);

                    } else { //State and Super Admins
                        $resultData = ($param2 == '') ? $this->exercise_model->getExercises($conditions, true) : $this->exercise_model->getExercises();
                    }

                    $templateData = array(
                        'exerciseData' => $resultData
                    );

                    $this->load->view('ajax/dashboard/exercises', $templateData);

                    break;
                case 'trainings':

                    $this->load->model('training_model');

                    $conditions = array(
                        'host' => $this->input->post('txtProvider'),
                        'district_id' => $this->input->post('filter_by_district'),
                        'school_id' => $this->input->post('filter_by_school'),
                        'topic' => $this->input->post('txtTopic'),
                        'from' => $this->input->post('txtDateTrainingFrom'),
                        'to' => $this->input->post('txtDateTrainingTo')
                    );

                    if (isset($this->session->userdata['role']['level']) && $this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL) {
                        $schoolCondition = '';

                        if (isset($this->session->userdata['loaded_school']['id'])) {
                            $schoolCondition = array('sid' => $this->session->userdata['loaded_school']['id']);
                        }
                        $resultData = ($param2 == '') ? $this->training_model->getTrainings($conditions, true) : $this->training_model->getTrainings($schoolCondition);
                    } else if ($this->session->userdata['role']['level'] >= SCHOOL_ADMIN_LEVEL ) { //School Admin and User
                        $schoolCondition = array('sid' => $this->session->userdata['loaded_school']['id']);

                        $resultData = ($param2 == '') ? $this->training_model->getTrainings($conditions, true) : $this->training_model->getTrainings($schoolCondition);

                    } else { //State and Super Admins
                        $resultData = ($param2 == '') ? $this->training_model->getTrainings($conditions, true) : $this->training_model->getTrainings();
                    }

                    $templateData = array(
                        'trainingData' => $resultData
                    );

                    $this->load->view('ajax/dashboard/trainings', $templateData);

                    break;
            }
        }else{
            redirect('report');
        }
    }

    public function index(){

        $this->authenticate();
        $this->load->model('files_model');

        $eligibleSchools    = array();



        if(isset($this->session->userdata['role']['level']) && $this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL){
            $schools_with_data = $this->report_model->getSchoolsWithData();
            $data = $this->get_schools_in_my_district();

            if(is_array($schools_with_data) && count($schools_with_data)>0) {
                foreach ($schools_with_data as $schoolWithData) {
                    foreach ($data as $d) {

                        if ($schoolWithData[0]['id'] == $d['id']) {
                            array_push($eligibleSchools, $schoolWithData);
                            break;
                        }
                    }
                }
            }

        }else if($this->session->userdata['role']['level'] == SCHOOL_ADMIN_LEVEL || $this->session->userdata['role']['level'] == SCHOOL_USER_LEVEL){ //School Admin and User
            $schools_with_data = $this->report_model->getSchoolsWithData();
            foreach($schools_with_data as $schoolWithData){
                if($this->session->userdata['loaded_school']['id'] == $schoolWithData[0]['id']){
                    array_push($eligibleSchools, $schoolWithData);
                    break;
                }
            }

        }
        else if($this->session->userdata['role']['level'] == SUPER_ADMIN_LEVEL){ // Super Admins
            $schools_with_data = $this->report_model->getSchoolsWithData();
            $eligibleSchools = $schools_with_data;

        }
        elseif($this->session->userdata['role']['level']== STATE_ADMIN_LEVEL){ // State Admins

            $virtualStateSchool = array();

            if($this->report_model->hasData(null)) {
                //Get virtual state school data

                $preferences = $this->registry_model->getValue('sys_preferences');

                $state = $this->state_model->getStateName($this->registry_model->getValue('host_state'));
                $virtualStateSchool = array(
                    array(
                        array(
                            'id'                    => null,
                            'district-id'           => 0,
                            'state'                 => $state,
                            'name'                  => 'State of '.$state,
                            'screen_name'           => 'State of '.$state,
                            'has_data'              => true,
                            'last_modified'         => $this->report_model->getLastModifiedDate(null),
                            'preferences'           => $preferences
                        )
                    )
                );
            }

            $eligibleSchools = $virtualStateSchool;

        }


        $data = array(
            'schools_with_data' => $eligibleSchools,
            'EOP_type' => $this->registry_model->getValue('EOP_type')
        );



        $files = $this->files_model->getFiles();
        if(is_array($files) && count($files)>0){
            $this->load->model('school_model');
            foreach($files as &$file){
                $school = $this->school_model->getSchool($file['sid']);
                $file['school'] = ($school[0]['screen_name']) ? $school[0]['screen_name'] : $school[0]['name'];
            }
            unset($file);
        }

        $templateData = array(
            'page'          =>  'myeop',
            'step_title'    =>  'My EOP',
            'page_title'    =>  'My EOP',
            'page_vars'     =>  $data,
            'files'         =>  $files
        );
        $this->template->load('template', 'report_screen', $templateData);
    }

    public function make($school_id = ''){

        if($school_id==''){
            $this->school_id = isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : Null;
        }else{
            $this->school_id = $school_id;
        }

        if($this->school_id == Null){
            $preferences = json_decode($this->registry_model->getValue('sys_preferences'));

            if(!empty($preferences)){
                $this->EOP_type = isset($preferences->main->basic_plan_source) ? $preferences->main->basic_plan_source : 'internal';
                $this->EOP_ctype = isset($preferences->cover->basic_plan_source) ? $preferences->cover->basic_plan_source : 'internal';
            }else{
                $this->EOP_type = 'internal';
                $this->EOP_ctype = 'internal';
            }

            $loaded_state = $this->state_model->getStateName($this->registry_model->getValue('host_state'));
            $school = array(
                    array(
                        'id' => null,
                        'district-id' => 0,
                        'state' => $loaded_state,
                        'name' =>  "State of $loaded_state Sample",
                        'screen_name' => "State of $loaded_state Sample",
                        'has_data' => true,
                        'last_modified' => $this->report_model->getLastModifiedDate(null)
                    )
            );
        }
        else{
            $school = $this->school_model->getSchool($this->school_id);
            //Get the basic plan source preference for the school
            $this->EOP_type = 'internal';
            $this->EOP_ctype = 'internal';
            if (!empty($school[0]['preferences'])) {
                $preferencesObj = json_decode($school[0]['preferences']);

                $this->EOP_type = isset($preferencesObj->main) ? $preferencesObj->main->basic_plan_source : 'internal';
                $this->EOP_ctype = isset($preferencesObj->cover) ? $preferencesObj->cover->basic_plan_source : 'internal';
            }
        }
        //Make file name from the school's name
        $fileName=$school[0]['name'];
        $fileName = preg_replace("([^\w\s\d\-_~,;:\[\]\(\).])",'', $fileName);
        $fileName = preg_replace("([\.]{2,})",'',$fileName);

        //Get plan data from database
        if($this->school_id==Null && $this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL){
            $form1Data      = $this->plan_model->getEntities('bp', array('name'=>'form1',  'owner_role_level'=> DISTRICT_ADMIN_LEVEL, 'district_id'=>$this->session->userdata['loaded_district']['id']), true);
            $form2Data      = $this->plan_model->getEntities('bp', array('name'=>'form2',  'owner_role_level'=> DISTRICT_ADMIN_LEVEL, 'district_id'=>$this->session->userdata['loaded_district']['id']), true);
            $form3Data      = $this->plan_model->getEntities('bp', array('name'=>'form3',  'owner_role_level'=> DISTRICT_ADMIN_LEVEL, 'district_id'=>$this->session->userdata['loaded_district']['id']), true);
            $form4Data      = $this->plan_model->getEntities('bp', array('name'=>'form4',  'owner_role_level'=> DISTRICT_ADMIN_LEVEL, 'district_id'=>$this->session->userdata['loaded_district']['id']), true);
            $form5Data      = $this->plan_model->getEntities('bp', array('name'=>'form5',  'owner_role_level'=> DISTRICT_ADMIN_LEVEL, 'district_id'=>$this->session->userdata['loaded_district']['id']), true);
            $form6Data      = $this->plan_model->getEntities('bp', array('name'=>'form6',  'owner_role_level'=> DISTRICT_ADMIN_LEVEL, 'district_id'=>$this->session->userdata['loaded_district']['id']), true);
            $form7Data      = $this->plan_model->getEntities('bp', array('name'=>'form7',  'owner_role_level'=> DISTRICT_ADMIN_LEVEL, 'district_id'=>$this->session->userdata['loaded_district']['id']), true);
            $form8Data      = $this->plan_model->getEntities('bp', array('name'=>'form8',  'owner_role_level'=> DISTRICT_ADMIN_LEVEL, 'district_id'=>$this->session->userdata['loaded_district']['id']), true);
            $form9Data      = $this->plan_model->getEntities('bp', array('name'=>'form9',  'owner_role_level'=> DISTRICT_ADMIN_LEVEL, 'district_id'=>$this->session->userdata['loaded_district']['id']), true);
            $form10Data     = $this->plan_model->getEntities('bp', array('name'=>'form10', 'owner_role_level'=> DISTRICT_ADMIN_LEVEL, 'district_id'=>$this->session->userdata['loaded_district']['id']), true);
            $form11Data     = $this->plan_model->getEntities('bp', array('name'=>'form11', 'owner_role_level'=> DISTRICT_ADMIN_LEVEL, 'district_id'=>$this->session->userdata['loaded_district']['id']), true);
        }elseif($this->school_id==Null && $this->session->userdata['role']['level'] == STATE_ADMIN_LEVEL){
            $form1Data      = $this->plan_model->getEntities('bp', array('name'=>'form1',  'owner_role_level'=> STATE_ADMIN_LEVEL, 'district_id'=>null, 'mandate'=>'school', 'sid'=>null), true);
            $form2Data      = $this->plan_model->getEntities('bp', array('name'=>'form2',  'owner_role_level'=> STATE_ADMIN_LEVEL, 'district_id'=>null, 'mandate'=>'school', 'sid'=>null), true);
            $form3Data      = $this->plan_model->getEntities('bp', array('name'=>'form3',  'owner_role_level'=> STATE_ADMIN_LEVEL, 'district_id'=>null, 'mandate'=>'school', 'sid'=>null), true);
            $form4Data      = $this->plan_model->getEntities('bp', array('name'=>'form4',  'owner_role_level'=> STATE_ADMIN_LEVEL, 'district_id'=>null, 'mandate'=>'school', 'sid'=>null), true);
            $form5Data      = $this->plan_model->getEntities('bp', array('name'=>'form5',  'owner_role_level'=> STATE_ADMIN_LEVEL, 'district_id'=>null, 'mandate'=>'school', 'sid'=>null), true);
            $form6Data      = $this->plan_model->getEntities('bp', array('name'=>'form6',  'owner_role_level'=> STATE_ADMIN_LEVEL, 'district_id'=>null, 'mandate'=>'school', 'sid'=>null), true);
            $form7Data      = $this->plan_model->getEntities('bp', array('name'=>'form7',  'owner_role_level'=> STATE_ADMIN_LEVEL, 'district_id'=>null, 'mandate'=>'school', 'sid'=>null), true);
            $form8Data      = $this->plan_model->getEntities('bp', array('name'=>'form8',  'owner_role_level'=> STATE_ADMIN_LEVEL, 'district_id'=>null, 'mandate'=>'school', 'sid'=>null), true);
            $form9Data      = $this->plan_model->getEntities('bp', array('name'=>'form9',  'owner_role_level'=> STATE_ADMIN_LEVEL, 'district_id'=>null, 'mandate'=>'school', 'sid'=>null), true);
            $form10Data     = $this->plan_model->getEntities('bp', array('name'=>'form10', 'owner_role_level'=> STATE_ADMIN_LEVEL, 'district_id'=>null, 'mandate'=>'school', 'sid'=>null), true);
            $form11Data     = $this->plan_model->getEntities('bp', array('name'=>'form11', 'owner_role_level'=> STATE_ADMIN_LEVEL, 'district_id'=>null, 'mandate'=>'school', 'sid'=>null), true);
        }else{
            $form1Data      = $this->plan_model->getEntities('bp', array('name'=>'form1', 'sid'=>$this->school_id), true);
            $form2Data      = $this->plan_model->getEntities('bp', array('name'=>'form2', 'sid'=>$this->school_id), true);
            $form3Data      = $this->plan_model->getEntities('bp', array('name'=>'form3', 'sid'=>$this->school_id), true);
            $form4Data      = $this->plan_model->getEntities('bp', array('name'=>'form4', 'sid'=>$this->school_id), true);
            $form5Data      = $this->plan_model->getEntities('bp', array('name'=>'form5', 'sid'=>$this->school_id), true);
            $form6Data      = $this->plan_model->getEntities('bp', array('name'=>'form6', 'sid'=>$this->school_id), true);
            $form7Data      = $this->plan_model->getEntities('bp', array('name'=>'form7', 'sid'=>$this->school_id), true);
            $form8Data      = $this->plan_model->getEntities('bp', array('name'=>'form8', 'sid'=>$this->school_id), true);
            $form9Data      = $this->plan_model->getEntities('bp', array('name'=>'form9', 'sid'=>$this->school_id), true);
            $form10Data     = $this->plan_model->getEntities('bp', array('name'=>'form10', 'sid'=>$this->school_id), true);
            $form11Data     = $this->plan_model->getEntities('bp', array('name'=>'form11', 'sid'=>$this->school_id), true);
        }


        $fnData         = $this->getFunctions(true, $this->school_id);
        $topLevelFns    = $this->getTopLevelFunctions();
        $functionalDataHolder = array();

        /*foreach($topLevelFns as $key=>$value){

            foreach($fnData as $v){
                if($value['name'] == $v['name']){
                    array_push($functionalDataHolder, $v);
                    break;
                }
            }
        }*/

        foreach($fnData as $fnValue){

            foreach($topLevelFns as $topLevelFn){
                if($fnValue['name'] == $topLevelFn['name']){

                    //if(!$this->hasFunction($cleanedFns, $fnValue)){
                        array_push($functionalDataHolder, $fnValue);
                    //}
                    break;
                }
            }
        }

        $functionalData = $this->cleanFunctionalData($functionalDataHolder);

        $THData  = $this->cleanTHData($this->getThreatsAndHazards(true, $this->school_id));


        $this->word->setDefaultFontSize(12);

        //Set the styles
        $styles = $this->docstyles;
        //$this->word->addFontStyle('Goal', array('size'=>16, 'color'=>'333333', 'bold'=>true, 'allCaps' => true));

        foreach($styles->fontStyles as $key=>$value){
            $this->word->addFontStyle($key, $value);
        }
        foreach($styles->paragraphStyles as $key=>$value){
            $this->word->addParagraphStyle($key, $value);
        }
        foreach($styles->titleStyles as $key=>$value){
            $this->word->addTitleStyle($key, $value);
        }
        foreach($styles->tableStyles as $key=>$value){
            $this->word->addTableStyle($key, $value[0], $value[1]);
        }
        foreach($styles->linkStyles as $key=>$value){
            $this->word->addLinkStyle($key, $value);
        }


        //Generate Cover Page
        $this->makeCoverPage($form1Data);

        $section = $this->word->addSection();


        // Header
        $header = $section->createHeader();
        $header->addText(isset($form1Data[0]['children'][0]['fields'][0]['body']) ? htmlspecialchars(stripslashes($form1Data[0]['children'][0]['fields'][0]['body'])):"", 'Headers_1', array('align'=>'left'));
        $header->addWatermark(
            realpath('./assets/report_images/image2.png'),
            array(
                'width'             => 800,
                'marginTop'         => -0,
                'marginLeft'        => -0,
                'positioning'       => 'relative',
                'wrappingStyle'     => 'behind',
                'hPosRelTo'         => 'page',
                'vPosRelTo'         => 'page'
            )
        );
        $header->addTextBreak(2);




        //Footer
        $footer = $section->createFooter();
        $footer->addPreserveText('{PAGE}', null,array('align'=>'right'));


        //Add Table of Contents Title
        //$table = $section->addTable(array('floating' => true,'width'=>'auto'));
        //$table->addRow(6500, null);
        //$cell = $table->addCell(1800, array('textDirection'=>'btLr'));
        //$cell->addText('Contents', 'TOCTitle');

        //Add Table of Contents
        $section->addText('Contents','TOCTitle');


        $section->addTextBreak(2);
        $section->addTOC(array('name'=>'HELVETICA NEUE', 'spaceBefore'=>30, 'spaceAfter'=>30, 'size'=>10.5), array('tabLeader'=>\PhpOffice\PhpWord\Style\TOC::TAB_LEADER_DOT), 1, 3);
        $section->addPageBreak();



        //Insert Uploaded Basic Plan sections
        if($this->EOP_type=='external'){

            if($this->school_id == Null){
                $preferences = json_decode($this->registry_model->getValue('sys_preferences'));

                if(!empty($preferences)) {
                    $section->addTitle('Basic Plan', 1);
                    $this->insertUploadedBasicPlan($preferences->main, $section);
                }

            }else {
                $uploadedEntityData = $this->plan_model->getEntities('file', array('name' => 'Basic Plan', 'sid' => $this->school_id), false);
                if (is_array($uploadedEntityData) && count($uploadedEntityData) > 0) {
                    $fileData = json_decode($uploadedEntityData[0]['description']);

                    $section->addTitle('Basic Plan', 1);

                    $this->insertUploadedBasicPlan($fileData->main, $section);
                }
            }

        }

        //Add Section 1
        $this->makeSection1($form1Data, $section);


        //Add Section 2
        $this->makeSection2($form2Data, $section);


        //Add Section 3
        $this->makeSection3($form3Data, $section);

        //Add Section 4
        $this->makeSection4($form4Data, $section);


        //Add Section 5
        $this->makeSection5($form5Data, $section);


        //Add Section 6
        $this->makeSection6($form6Data, $section);


        //Add Section 7
        $this->makeSection7($form7Data, $section);


        //Add Section 8
        $this->makeSection8($form8Data, $section);


        //Add Section 9
        $this->makeSection9($form9Data, $section);


        //Add Section 10
        $this->makeSection10($form10Data, $section);

        //Add Section 11
        $this->makeSection11($form11Data, $section);


        $this->makeFunctionalAnnexes($functionalData, $section);


        $this->makeTHAnnexes($THData, $section);

        $this->flushToBrowser($fileName);

    }

    /**
     * Function that retrieves and returns an array of Functions depending on the
     * logged in user role.
     *
     * @param bool $recursive
     * @param integer $school_id defaults to null
     *
     * @return array of Functions
     */
    private function getFunctions($recursive = false, $school_id = null){

        $type = $this->plan_model->getEntityTypeId('fn');

        switch($this->session->userdata['role']['level']){

            case STATE_ADMIN_LEVEL:

                if(is_null($school_id)){
                    $query = "SELECT * FROM eop_view_entities WHERE (type_id= $type AND copy=0 AND mandate = 'state') OR (type_id=$type AND mandate='school' AND sid is null AND district_id is null AND owner_role_level = ".STATE_ADMIN_LEVEL.")";
                    $fnData = $this->plan_model->getEntities('fn', $query, $recursive, array('orderby'=>'name', 'type'=>'ASC'));
                }else{

                    $school_district = $this->school_model->getSchoolDistrict($school_id);
                    $query = "SELECT * FROM eop_view_entities WHERE (type_id= $type AND copy=0 AND mandate = 'state' AND ref_key not in(select ref_key from eop_view_entities where ref_key IS NOT NULL AND type_id=$type AND sid={$school_id})) OR (type_id=$type AND copy=0 AND mandate='district' AND district_id = {$school_district} AND owner_role_level = ".DISTRICT_ADMIN_LEVEL." AND ref_key not in(select ref_key from eop_view_entities where ref_key IS NOT NULL AND type_id=$type AND sid=$school_id)) OR (type_id=$type AND sid={$school_id}) OR (type_id=$type AND sid={$school_id} AND description='live')";
                    $fnData = $this->plan_model->getEntities('fn', $query, $recursive, array('orderby'=>'name', 'type'=>'ASC'));
                }

                break;

            case DISTRICT_ADMIN_LEVEL:

                if(is_null($school_id)){
                    $query = "SELECT * FROM eop_view_entities WHERE (type_id= $type AND copy=0 AND mandate = 'state') OR (type_id=$type AND copy=0 AND mandate='district' AND district_id = {$this->session->userdata['loaded_district']['id']} AND owner_role_level = ".DISTRICT_ADMIN_LEVEL.")";
                    $fnData = $this->plan_model->getEntities('fn', $query, $recursive, array('orderby'=>'name', 'type'=>'ASC'));
                }else{

                    $school_district = $this->school_model->getSchoolDistrict($school_id);
                    $query = "SELECT * FROM eop_view_entities WHERE (type_id= $type AND copy=0 AND mandate = 'state' AND ref_key not in(select ref_key from eop_view_entities where ref_key IS NOT NULL AND type_id=$type AND sid=$school_id)) OR (type_id=$type AND copy=0 AND mandate='district' AND district_id = {$school_district} AND owner_role_level = ".DISTRICT_ADMIN_LEVEL." AND (ref_key IS NULL OR ref_key not in(select ref_key from eop_view_entities where ref_key IS NOT NULL AND type_id=$type AND sid=$school_id))) OR (type_id=$type AND sid={$school_id})";
                    $fnData = $this->plan_model->getEntities('fn', $query, $recursive, array('orderby'=>'name', 'type'=>'ASC'));
                }
                break;

            case SCHOOL_ADMIN_LEVEL:
            case SCHOOL_USER_LEVEL:

                $school_district = $this->school_model->getSchoolDistrict($school_id);
                $query = "SELECT * FROM eop_view_entities WHERE (type_id= $type AND copy=0 AND mandate = 'state' AND ref_key not in(select ref_key from eop_view_entities where ref_key IS NOT NULL AND type_id=$type AND sid=$school_id)) OR (type_id=$type AND copy=0 AND mandate='district' AND district_id = {$school_district} AND owner_role_level = ".DISTRICT_ADMIN_LEVEL." AND ref_key not in(select ref_key from eop_view_entities where ref_key IS NOT NULL AND type_id=$type AND sid=$school_id)) OR (type_id=$type AND sid={$school_id}) OR (type_id=$type AND sid={$school_id} AND description='live')";
                $fnData = $this->plan_model->getEntities('fn', $query, $recursive, array('orderby'=>'name', 'type'=>'ASC'));
                break;

            default:
                if(is_null($school_id)){

                }else{
                    $fnData = $this->plan_model->getEntities('fn', array('sid'=>$school_id ), $recursive, array('orderby'=>'name', 'type'=>'ASC'));
                }
                break;
        }

        return $fnData;
    }

    private function getTopLevelFunctions(){

        $type = $this->plan_model->getEntityTypeId('fn');
        $name = escapeFieldName('name', $this->config->item('db')['dbdriver']);


        if(!is_null($this->school_id)){

            $school_district = $this->school_model->getSchoolDistrict($this->school_id);
            $super_admin_district = isset($this->session->userdata['loaded_district']['id']) ? $this->session->userdata['loaded_district']['id'] : $school_district;
            $query = "select * from eop_view_entities where (type_id=$type and parent is null and $name<>'None' and copy=0 and owner_role_level is null) or (type_id=$type and parent is null and $name<>'None' and copy=0 and owner_role_level=". STATE_ADMIN_LEVEL ." and mandate='state') or (type_id=$type and parent is null and $name<>'None' and copy=0 and owner_role_level =". DISTRICT_ADMIN_LEVEL ." and mandate='district' and district_id={$school_district}) or (type_id=$type and parent is null and $name<>'None' and copy=0 and owner_role_level in (".SCHOOL_ADMIN_LEVEL.",".SCHOOL_USER_LEVEL.") and sid={$this->school_id}) or (type_id=$type and parent is null and $name<>'None' and copy=0 and owner_role_level =". DISTRICT_ADMIN_LEVEL ." and district_id={$super_admin_district}) or (type_id=$type and parent is null and $name<>'None' and copy=0 and owner_role_level =". SUPER_ADMIN_LEVEL ." and sid={$this->school_id})";

        }else{
            $query = "select * from eop_view_entities where type_id=$type and parent is null and $name<>'None' and copy=0 and (owner_role_level is null or owner_role_level=". STATE_ADMIN_LEVEL .")";
        }

        return  $this->plan_model->getEntities('fn', $query, false, array('orderby'=>'name', 'type'=>'ASC'));

    }

    /**
     * Private function that retrieves and returns an array of Threats and Hazards
     *
     * @param bool $recursive
     * @param integer $school_id defaults to null
     *
     * @return array of Threats and Hazards
     */
    private function getThreatsAndHazards($recursive = false, $school_id = null){

        $type = $this->plan_model->getEntityTypeId('th');


        switch($this->session->userdata['role']['level']){

            case STATE_ADMIN_LEVEL:

                if(is_null($school_id)){
                    $query = "SELECT * FROM eop_view_entities WHERE (type_id= $type AND copy=0 AND mandate = 'state') OR (type_id=$type AND mandate='school' AND sid is null AND district_id is null AND owner_role_level = ".STATE_ADMIN_LEVEL.")";
                }else{

                    $school_district = $this->school_model->getSchoolDistrict($school_id);
                    $query = "SELECT * FROM eop_view_entities WHERE (type_id= $type AND copy=0 AND mandate = 'state' AND ref_key not in(select ref_key from eop_view_entities where type_id=$type AND sid=$school_id)) OR (type_id=$type AND copy=0 AND mandate='district' AND district_id = {$school_district} AND owner_role_level = ".DISTRICT_ADMIN_LEVEL." AND ref_key not in(select ref_key from eop_view_entities where type_id=$type AND sid=$school_id)) OR (type_id=$type AND sid=$school_id)";
                    $thData = $this->plan_model->getEntities('th', $query, $recursive, array('orderby'=>'name', 'type'=>'ASC'));
                }

                $thData = $this->plan_model->getEntities('th', $query, $recursive, array('orderby'=>'name', 'type'=>'ASC'));
                break;

            case DISTRICT_ADMIN_LEVEL:

                if(is_null($this->school_id)){
                    $query = "SELECT * FROM eop_view_entities WHERE (type_id= $type AND copy=0 AND mandate = 'state') OR (type_id=$type AND copy=0 AND mandate='district' AND district_id = {$this->session->userdata['loaded_district']['id']} AND owner_role_level = ".DISTRICT_ADMIN_LEVEL.") OR (type_id=$type AND copy=0 AND mandate='school' AND district_id= {$this->session->userdata['loaded_district']['id']} AND owner_role_level=". DISTRICT_ADMIN_LEVEL.")";

                    $thData = $this->plan_model->getEntities('th', $query, $recursive, array('orderby'=>'name', 'type'=>'ASC'));
                }else{
                    $query = "SELECT * FROM eop_view_entities WHERE (type_id= $type AND copy=0 AND mandate = 'state') OR (type_id=$type AND copy=0 AND mandate='district' AND district_id = {$this->session->userdata['loaded_district']['id']} AND owner_role_level = ".DISTRICT_ADMIN_LEVEL.") OR (type_id=$type AND sid=$this->school_id) OR (type_id=$type AND copy=0 AND mandate='school' AND district_id= {$this->session->userdata['loaded_district']['id']} AND owner_role_level=". DISTRICT_ADMIN_LEVEL.")";
                    $thData = $this->plan_model->getEntities('th', $query, $recursive, array('orderby'=>'name', 'type'=>'ASC'));
                }
                break;

            case SCHOOL_ADMIN_LEVEL:
            case SCHOOL_USER_LEVEL:

                $school_district = $this->school_model->getSchoolDistrict($school_id);
                $query = "SELECT * FROM eop_view_entities WHERE (type_id= $type AND copy=0 AND mandate = 'state' AND ref_key not in(select ref_key from eop_view_entities where type_id=$type AND sid=$school_id)) OR (type_id=$type AND copy=0 AND mandate='district' AND district_id = {$school_district} AND owner_role_level = ".DISTRICT_ADMIN_LEVEL." AND ref_key not in(select ref_key from eop_view_entities where type_id=$type AND sid=$school_id)) OR (type_id=$type AND sid=$school_id)";
                $thData = $this->plan_model->getEntities('th', $query, $recursive, array('orderby'=>'name', 'type'=>'ASC'));
                break;

            default:
                if(!is_null($school_id)){
                    $thData = $this->plan_model->getEntities('th', array('sid'=>$school_id ), $recursive, array('orderby'=>'name', 'type'=>'ASC'));
                }
                break;
        }

        return $thData;

    }

    function makeCoverPage($form1Data){


        if($this->EOP_type == 'external'){
            if($this->EOP_ctype=='external'){

                if($this->school_id == Null){
                    $preferences = json_decode($this->registry_model->getValue('sys_preferences'));

                    if(!empty($preferences)) {

                        $this->insertUploadedCoverPage($preferences->cover);
                    }

                }else {
                    $uploadedEntityData = $this->plan_model->getEntities('file', array('name' => 'Basic Plan', 'sid' => $this->school_id), false);
                    if(is_array($uploadedEntityData) && count($uploadedEntityData)>0){
                        $fileData = json_decode($uploadedEntityData[0]['description']);

                        $this->insertUploadedCoverPage($fileData->cover);
                    }
                }


            }else{
                if (is_array($form1Data) && count($form1Data) > 0) {
                    $html_dom = $this->simple_html_dom;
                    $sectionCover = $this->word->addSection();

                    //Create Header for the section
                    $headerCover = $sectionCover->addHeader();
                    $headerCover->addWatermark(
                        realpath('./assets/report_images/watermark.png'),
                        array(
                            'width'             => 800,
                            'marginTop'         => -50,
                            'marginLeft'        => -100,
                            'posHorizontal'     => 'absolute',
                            'posVertical'       => 'absolute'
                        )
                    );

                    //Add Date (form 1.0 Date)
                    $date = date_format(date_create($form1Data[0]['children'][0]['fields'][1]['body']), 'F j, Y');
                    $sectionCover->addTextBreak(5);
                    $sectionCover->addText(htmlspecialchars($date), 'coverDateText', 'coverDateParagraph');

                    //Add Document title (form 1.0 Title of the plan)
                    $sectionCover->addTextBreak(1);
                    $sectionCover->addText(htmlspecialchars(stripslashes($form1Data[0]['children'][0]['fields'][0]['body'])), 'docTitle', 'docTitleParagraph');
                    //$sectionCover->addTextBreak(5);



                    //Add the schools covered by the plan (form 1.0 Schools covered by the plan)
                    //$html_dom->load('<html><body>' . $form1Data[0]['children'][0]['fields'][2]['body'] . '</body></html>');

                    // Create the dom array of elements which we are going to work on:
                    //$html_dom_array = $html_dom->find('html', 0)->children();

                    // Convert the HTML and put it into the PHPWord object
                    //$coverSettings = $this->getStandardSettings('cover');
                    //htmltodocx_insert_html($sectionCover, $html_dom_array[0]->nodes, $coverSettings);

                    // Clear the HTML dom object:
                    //$html_dom->clear();

                    $sectionCover->addTextBreak(10);
                    $copyright1 = "This school emergency operations plan (EOP) was prepared using the U.S. Department of Education, Office of Safe and Supportive Schools and its Readiness and Emergency Management for Schools (REMS) Technical Assistance (TA) Center’s EOP ASSIST software application. For more information, visit https://rems.ed.gov";

                    $sectionCover->addText($copyright1, 'coverText', 'cover');

                    /*
                     * Removed with EOP7.0 after cover page redesign (08/16/2021)
                     * $copyright2 = "For more information, visit ";
                     * $textrun = $sectionCover->addTextRun('cover');
                     * $textrun->addText($copyright2, 'coverText');
                     * $textrun->addLink('https://rems.ed.gov/EOPASSIST.aspx', 'https://rems.ed.gov/EOPASSIST.aspx', 'default');
                     * $textrun->addText('.');
                    */


                    $sectionCover->addPageBreak();
                }
            }
        }else {
            if (is_array($form1Data) && count($form1Data) > 0) {
                $html_dom = $this->simple_html_dom;
                $sectionCover = $this->word->addSection();

                //Create Header for the section
                $headerCover = $sectionCover->addHeader();
                $headerCover->addWatermark(
                                            realpath('./assets/report_images/watermark.png'),
                                            array(
                                                'width'             => 800,
                                                'marginTop'         => -50,
                                                'marginLeft'        => -100,
                                                'posHorizontal'     => 'absolute',
                                                'posVertical'       => 'absolute'
                                                )
                );

                //Add Date (form 1.0 Date)
                $date = date_format(date_create($form1Data[0]['children'][0]['fields'][1]['body']), 'F j, Y');
                $sectionCover->addTextBreak(5);
                $sectionCover->addText(htmlspecialchars($date), 'coverDateText', 'coverDateParagraph');

                //Add Document title (form 1.0 Title of the plan)
                $sectionCover->addTextBreak(1);
                $sectionCover->addText(htmlspecialchars(stripslashes($form1Data[0]['children'][0]['fields'][0]['body'])), 'docTitle', 'docTitleParagraph');
                //$sectionCover->addTextBreak(5);
                //$textBoxTitle = $sectionCover->addTextBox(array('marginLeft'=>-100, 'borderColor'=>'none', 'bgColor'=>'transparent','left'=>0, 'top'=>0,'positioning'=>'relative', 'width'=>600, 'height'=>250, 'vPosRelTo'=>'page', 'hPosRelTo'=>'page'));
                //$textBoxTitle->addText('sdfkjasdaf', 'docTitle', 'docTitleParagraph');


                //Add the schools covered by the plan (form 1.0 Schools covered by the plan)
                //$html_dom->load('<html><body>' . $form1Data[0]['children'][0]['fields'][2]['body'] . '</body></html>');

                // Create the dom array of elements which we are going to work on:
                //$html_dom_array = $html_dom->find('html', 0)->children();

                // Convert the HTML and put it into the PHPWord object
                //$coverSettings = $this->getStandardSettings('cover');
                //htmltodocx_insert_html($sectionCover, $html_dom_array[0]->nodes, $coverSettings);

                // Clear the HTML dom object:
                //$html_dom->clear();

                //$sectionCover->addTextBreak(10);
                //$copyright1 = "This school emergency operations plan (EOP) was prepared using the U.S. Department of Education, Office of Safe and Supportive Schools and its Readiness and Emergency Management for Schools (REMS) Technical Assistance (TA) Center’s EOP ASSIST software application. For more information, visit https://rems.ed.gov";

                //$sectionCover->addText($copyright1, 'coverText', 'cover');

                /*
                 * Removed with EOP7.0 after cover page redesign (08/16/2021)
                 * $copyright2 = "For more information, visit ";
                 * $textrun = $sectionCover->addTextRun('cover');
                 * $textrun->addText($copyright2, 'coverText');
                 * $textrun->addLink('https://rems.ed.gov/EOPASSIST.aspx', 'https://rems.ed.gov/EOPASSIST.aspx', 'default');
                 * $textrun->addText('.');
                */


                $sectionCover->addPageBreak();
            }
        }

    }

    function makeSection1($data, $section){

        if($this->EOP_type=='external'){
            return;
        }

        $section->addTitle('Basic Plan', 1); //This should be set regardless of data existing in the section

        if(is_array($data) && count($data)>0){

            $html_dom = $this->simple_html_dom;
            $standardSettings = $this->getStandardSettings('default');

            $section->addTitle('1. Introductory Material', 2);

            //Add sub-section 1.1
            $section->addTitle('1.1 Promulgation Document and Signatures', 3);
            $html_dom->load('<html><body>' . $data[0]['children'][1]['fields'][0]['body'] . '</body></html>');
            $html_dom_array = $html_dom->find('html',0)->children();
            htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $standardSettings);
            $html_dom->clear();


            //Add sub-section 1.2
            $section->addPageBreak();
            $section->addTitle('1.2 Approval and Implementation', 3);
            $html_dom->load('<html><body>' . $data[0]['children'][2]['fields'][0]['body'] . '</body></html>');
            $html_dom_array = $html_dom->find('html',0)->children();
            htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $standardSettings);
            $html_dom->clear();

            //Add sub-section 1.3
            $section->addPageBreak();
            $section->addTitle('1.3 Record of Changes', 3);
            $table = $section->addTable('defaultTableStyle');
            $cellStyle = array('valign'=>'center');
            $fontStyle = array('name'=>'Calibri','bold'=>true, 'align'=>'center');
            $table->addRow(900); // Add a row
            // Add cells
            $table->addCell(2000, $cellStyle)->addText('Change Number', $fontStyle);
            $table->addCell(2000, $cellStyle)->addText('Date of Change', $fontStyle);
            $table->addCell(2000, $cellStyle)->addText('Name', $fontStyle);
            $table->addCell(2000, $cellStyle)->addText('Summary of Change', $fontStyle);

            $child4['fields'] = $data[0]['children'][3]['fields'];
            $numFields = count($child4['fields']);
            for($i=1; $i<=($numFields/4); $i++){
                $table->addRow();
                foreach($child4['fields'] as $field_key=>$field){
                    if($field['weight'] == $i){
                        $this->html2text->setHtml($field['body']);
                        $txt = $this->html2text->getText();
                        $table->addCell(2000)->addText(htmlspecialchars(stripslashes($txt)));

                    }
                }

            }

            //Add sub-section 1.4
            $section->addPageBreak();
            $section->addTitle('1.4 Record of Distribution', 3);
            $table = $section->addTable('defaultTableStyle');
            $cellStyle = array('valign'=>'center');
            $fontStyle = array('name'=>'Calibri','bold'=>true, 'align'=>'center');
            $table->addRow(900); // Add a row
            // Add cells
            $table->addCell(2000, $cellStyle)->addText('Title and name of person receiving the plan', $fontStyle);
            $table->addCell(2000, $cellStyle)->addText('Agency (school office, government agency, or private-sector entity', $fontStyle);
            $table->addCell(2000, $cellStyle)->addText('Date of delivery', $fontStyle);
            $table->addCell(2000, $cellStyle)->addText('Number of copies delivered', $fontStyle);

            $child4['fields'] = $data[0]['children'][4]['fields'];
            $numFields = count($child4['fields']);
            for($i=1; $i<=($numFields/4); $i++){
                $table->addRow();
                foreach($child4['fields'] as $field_key=>$field){
                    if($field['weight'] == $i){
                        $this->html2text->setHtml($field['body']);
                        $txt = $this->html2text->getText();
                        $table->addCell(2000)->addText(htmlspecialchars(stripslashes($txt)));

                    }
                }

            }

            $section->addPageBreak(); //New Page

        }else{
            $section->addPageBreak(); //New Page
        }


    }

    function makeSection2($data, $section){

        $standardSettings = $this->getStandardSettings('default');

        if($this->EOP_type=='external'){
            return;
        }

        if(is_array($data) && count($data)>0) {
            $html_dom = $this->simple_html_dom;
            $children = $data[0]['children'];

            $section->addTitle('2. Purpose, Scope, Situation Overview and Assumptions', 2);

            //Add sub-section 2.1
            $section->addTitle('2.1 Purpose', 3);
            $html_dom->load('<html><body>' . $children[0]['fields'][0]['body'] . '</body></html>');
            $html_dom_array = $html_dom->find('html', 0)->children();
            htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $standardSettings);
            $html_dom->clear();

            //Add sub-section 2.2
            $section->addTitle('2.2 Scope', 3);
            $html_dom->load('<html><body>' . $children[1]['fields'][0]['body'] . '</body></html>');
            $html_dom_array = $html_dom->find('html', 0)->children();
            htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $standardSettings);
            $html_dom->clear();

            //Add sub-section 2.3
            $section->addTitle('2.3 Situation Overview', 3);
            $html_dom->load('<html><body>' . $children[2]['fields'][0]['body'] . '</body></html>');
            $html_dom_array = $html_dom->find('html', 0)->children();
            htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $standardSettings);
            $html_dom->clear();

            //Add sub-section 2.4
            $section->addTitle('2.4 Planning Assumptions', 3);
            $html_dom->load('<html><body>' . $children[3]['fields'][0]['body'] . '</body></html>');
            $html_dom_array = $html_dom->find('html', 0)->children();
            htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $standardSettings);
            $html_dom->clear();

            $section->addPageBreak(); //New Page
        }
    }

    function makeSection3($data, $section){

        $standardSettings = $this->getStandardSettings('default');

        if($this->EOP_type=='external'){
            return;
        }

        if(is_array($data) && count($data)>0) {
            $html_dom = $this->simple_html_dom;
            $children = $data[0]['children'];

            $section->addTitle('3. Concept of Operations (CONOPS)', 2);

            //Add sub-section 3.1
            $html_dom->load('<html><body>' . $children[0]['fields'][0]['body'] . '</body></html>');
            $html_dom_array = $html_dom->find('html', 0)->children();
            htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $standardSettings);
            $html_dom->clear();

            $section->addPageBreak(); //New Page
        }

    }

    function makeSection4($data, $section){

        $standardSettings = $this->getStandardSettings('default');

        if($this->EOP_type=='external'){
            return;
        }

        if(is_array($data) && count($data)>0) {
            $html_dom = $this->simple_html_dom;
            $children = $data[0]['children'];

            $section->addTitle('4. Organization and Assignment of Responsibilities', 2);

            //Add sub-section 4.1
            $html_dom->load('<html><body>' . $children[0]['fields'][0]['body'] . '</body></html>');
            $html_dom_array = $html_dom->find('html', 0)->children();
            htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $standardSettings);
            $html_dom->clear();

            $section->addPageBreak(); //New Page
        }
    }

    function makeSection5($data, $section){

        $standardSettings = $this->getStandardSettings('default');

        if($this->EOP_type=='external'){
            return;
        }

        if(is_array($data) && count($data)>0) {
            $html_dom = $this->simple_html_dom;
            $children = $data[0]['children'];

            $section->addTitle('5. Direction, Control, and Coordination', 2);

            //Add sub-section 5.1
            $html_dom->load('<html><body>' . $children[0]['fields'][0]['body'] . '</body></html>');
            $html_dom_array = $html_dom->find('html', 0)->children();
            htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $standardSettings);
            $html_dom->clear();

            $section->addPageBreak(); // New Page
        }
    }

    function makeSection6($data, $section){

        $standardSettings = $this->getStandardSettings('default');


        if($this->EOP_type=='external'){
            return;
        }

        if(is_array($data) && count($data)>0) {
            $html_dom = $this->simple_html_dom;
            $children = $data[0]['children'];

            $section->addTitle('6. Information Collection, Analysis, and Dissemination', 2);

            //Add sub-section 6.1
            $html_dom->load('<html><body>' . $children[0]['fields'][0]['body'] . '</body></html>');
            $html_dom_array = $html_dom->find('html', 0)->children();
            htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $standardSettings);
            $html_dom->clear();

            $section->addPageBreak(); //New Page
        }
    }

    function makeSection7($data, $section){

        $standardSettings = $this->getStandardSettings('default');

        if($this->EOP_type=='external'){
            return;
        }

        if(is_array($data) && count($data)>0) {
            $html_dom = $this->simple_html_dom;
            $children = $data[0]['children'];

            $section->addTitle('7. Training and Exercises', 2);

            //Add sub-section 7.1
            $html_dom->load('<html><body>' . $children[0]['fields'][0]['body'] . '</body></html>');
            $html_dom_array = $html_dom->find('html', 0)->children();
            htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $standardSettings);
            $html_dom->clear();

            $section->addPageBreak(); //New Page
        }
    }

    function makeSection8($data, $section){

        $standardSettings = $this->getStandardSettings('default');

        if($this->EOP_type=='external'){
            return;
        }

        if(is_array($data) && count($data)>0) {

            $html_dom = $this->simple_html_dom;
            $children = $data[0]['children'];

            $section->addTitle('8. Administration, Finance, and Logistics', 2);

            //Add sub-section 8.1
            $html_dom->load('<html><body>' . $children[0]['fields'][0]['body'] . '</body></html>');
            $html_dom_array = $html_dom->find('html', 0)->children();
            htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $standardSettings);
            $html_dom->clear();

            $section->addPageBreak(); //New Page
        }
    }

    function makeSection9($data, $section){

        $standardSettings = $this->getStandardSettings('default');

        if($this->EOP_type=='external'){
            return;
        }

        if(is_array($data) && count($data)>0) {

            $html_dom = $this->simple_html_dom;
            $children = $data[0]['children'];

            $section->addTitle('9. Plan Development and Maintenance', 2);

            //Add sub-section 9.1
            $html_dom->load('<html><body>' . $children[0]['fields'][0]['body'] . '</body></html>');
            $html_dom_array = $html_dom->find('html', 0)->children();
            htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $standardSettings);
            $html_dom->clear();

            $section->addPageBreak(); //New Page
        }
    }

    function makeSection10($data, $section){

        $standardSettings = $this->getStandardSettings('default');

        if($this->EOP_type=='external'){
            return;
        }

        if(is_array($data) && count($data)>0) {

            $html_dom = $this->simple_html_dom;
            $children = $data[0]['children'];

            $section->addTitle('10. Authorities and References', 2);

            //Add sub-section 10.1
            $html_dom->load('<html><body>' . $children[0]['fields'][0]['body'] . '</body></html>');
            $html_dom_array = $html_dom->find('html', 0)->children();
            htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $standardSettings);
            $html_dom->clear();

            $section->addPageBreak(); //New Page
        }
    }

    function makeSection11($data, $section){

        $children = array();

        if($this->EOP_type=='external'){
            return;
        }

        if($data && is_array($data) && count($data)>0){

            foreach($data as $entity){
                foreach($entity['children'] as $child){
                    switch($child['title']){
                        case 'Step 5 Photo':
                            $children[] = $child;
                            break;
                    }
                }
            }

            //Sort the image entities by weight
            for($i=0; $i<count($children); $i++){
                for($j=$i; $j<count($children); $j++){
                    if($children[$i]['weight']>$children[$j]['weight']){
                        $tmp_child = $children[$j];
                        $children[$j] = $children[$i];
                        $children[$i] = $tmp_child;
                    }
                }
            }

            $section->addTitle('11. Images', 2);

            $style = array(
                'marginTop'     => 1,
                'marginLeft'    => 1,
                'wrappingStyle' => 'square'
            );
            //Add the Images subsections
            foreach($children as $key => $child){
                $file_info = json_decode($child['fields'][2]['body'], true);
                $file_path = $file_info['full_path'];

                $section->addImage($file_path, $style);
                $textRun = $section->addTextRun();
                $textRun->addText($child['fields'][0]['body'], array('italic'=>false));
                $section->addTextBreak();
                $textRun = $section->addTextRun();
                $textRun->addText($child['fields'][1]['body'], array('italic'=>true));
            }

            $section->addPageBreak(); //New Page

        }else{
            return;
        }

    }

    function insertUploadedBasicPlan($fileData, PhpOffice\PhpWord\Element\Section $section){

        if(isset($fileData->file_name) && is_file(dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/".$fileData->file_name)){

            //Read word file into new phpword object
            $phpword = \PhpOffice\PhpWord\IOFactory::load(dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/".$fileData->file_name);

            //Get sections from the loaded document
            foreach($phpword->getSections() as $loadedSection){
                //$this->word->insertSection($loadedSection);
                foreach($loadedSection->getElements() as $element){
                    $section->insertElement($element);
                    /*switch(get_class($element)){
                        case "PhpOffice\PhpWord\Element\TextRun":
                            $section->insertElement($element);
                            break;
                        case "PhpOffice\PhpWord\Element\ListItemRun":
                            $section->insertElement($element);
                            break;
                        case "PhpOffice\PhpWord\Element\PageBreak":
                            $section->addPageBreak();
                            break;

                    }*/

                }
            }

            if(count($this->word->getSections())>0)
                $this->word->getLastSection()->addPageBreak(); //Add New Page at the end
        }

    }

    function insertUploadedCoverPage($fileData){

        if(isset($fileData->file_name) && is_file(dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/".$fileData->file_name)) {

            //Read word file into new phpword object
            $phpword = \PhpOffice\PhpWord\IOFactory::load(dirname($_SERVER["SCRIPT_FILENAME"]) . "/uploads/" . $fileData->file_name);

            //Get sections from the loaded document


            foreach ($phpword->getSections() as $loadedSection) {

                $this->word->insertSection($loadedSection);

            }

            if(count($this->word->getSections()) > 0)
                $this->word->getLastSection()->addPageBreak();

        }
    }

    function makeFunctionalAnnexes($data, $section){

        $section->addTitle('Functional Annexes', 1); //Title should exist regardless of availability of data
        $standardSettings = $this->getStandardSettings('default');

        if(is_array($data) && count($data)>0) {

            $html_dom = $this->simple_html_dom;
            $numItems= count($data);
            $i = 0;

            foreach ($data as $function) {

                $section->addTitle(htmlspecialchars($function['name']), 2);

                if(isset($function['children']) && is_array($function['children'])) {
                    foreach ($function['children'] as $fnChild) {

                        if ($fnChild['type'] == 'g1' || $fnChild['type'] == 'g2' || $fnChild['type'] == 'g3') {
                            $textrun = $section->addTextRun('standardParagraph');
                            $textrun->addText(htmlspecialchars($fnChild['type_title'] . ':'), 'Goal');

                            foreach ($fnChild['fields'] as $field) {
                                $html_dom->load('<html><body>' . $field['body'] . '</body></html>');
                                $html_dom_array = $html_dom->find('html', 0)->children();
                                htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $standardSettings);
                                $html_dom->clear();
                            }

                            foreach ($fnChild['children'] as $key => $grandChild) {
                                if ($grandChild['type'] == "obj") {
                                    $objTextRun = $section->addTextRun('objectiveParagraph');
                                    $objTextRun->addText('Objective: ', 'Objective');

                                    foreach ($grandChild['fields'] as $field) {
                                        $html_dom->load('<html><body>' . $field['body'] . '</body></html>');
                                        $html_dom_array = $html_dom->find('html', 0)->children();
                                        htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $standardSettings);
                                        $html_dom->clear();
                                    }
                                }
                            }
                            foreach ($fnChild['children'] as $key => $grandChild) {
                                if ($grandChild['type'] == "ca") {
                                    $coaTextRun = $section->addTextRun('actionParagraph');
                                    $coaTextRun->addText('Courses of Action: ', 'COA');

                                    foreach ($grandChild['fields'] as $field) {
                                        $html_dom->load('<html><body>' . $field['body'] . '</body></html>');
                                        $html_dom_array = $html_dom->find('html', 0)->children();
                                        htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $standardSettings);
                                        $html_dom->clear();
                                    }
                                }
                            }
                            $section->addTextRun('pOStyle')->addText(" ", array('size' => 8));
                        }
                    }
                }

                if(++$i === $numItems){ //Last item

                    $section->addPageBreak(); //New Page
                }else{
                    $section->addPageBreak(); //New Page
                }

            }

        }else{
            $section->addPageBreak(); //New Page
        }

    }

    function makeTHAnnexes($data, $section){

        $section->addTitle('Threat- and Hazard-Specific Annexes', 1); //Title should be set regardless of availability of data
        $standardSettings = $this->getStandardSettings('default');

        if(is_array($data) && count($data)>0) {
            $html_dom = $this->simple_html_dom;
            $numItems= count($data);
            $i = 0;

            foreach ($data as $threat) {
                $section->addTitle(htmlspecialchars($threat['name']), 2);

                if(isset($threat['children']) && is_array($threat['children'])) {
                    foreach ($threat['children'] as $thChild) {
                        if ($thChild['type'] == 'g1' || $thChild['type'] == 'g2' || $thChild['type'] == 'g3') {

                            $textrun = $section->addTextRun('standardParagraph');
                            $textrun->addText(htmlspecialchars($thChild['type_title'] . ':'), 'Goal');

                            foreach ($thChild['fields'] as $field) {
                                $html_dom->load('<html><body>' . $field['body'] . '</body></html>');
                                $html_dom_array = $html_dom->find('html', 0)->children();
                                htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $standardSettings);
                                $html_dom->clear();
                            }

                            foreach ($thChild['children'] as $key => $grandChild) {
                                if ($grandChild['type'] == "obj") {
                                    $objTextRun = $section->addTextRun('objectiveParagraph');
                                    $objTextRun->addText('Objective: ', 'Objective');

                                    foreach ($grandChild['fields'] as $field) {
                                        $html_dom->load('<html><body>' . $field['body'] . '</body></html>');
                                        $html_dom_array = $html_dom->find('html', 0)->children();
                                        htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $standardSettings);
                                        $html_dom->clear();
                                    }
                                }
                            }
                            foreach ($thChild['children'] as $key => $grandChild) {
                                if ($grandChild['type'] == "ca") {
                                    $coaTextRun = $section->addTextRun('actionParagraph');
                                    $coaTextRun->addText('Courses of Action: ', 'COA');

                                    foreach ($grandChild['fields'] as $field) {
                                        $html_dom->load('<html><body>' . $field['body'] . '</body></html>');
                                        $html_dom_array = $html_dom->find('html', 0)->children();
                                        htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $standardSettings);
                                        $html_dom->clear();
                                    }
                                }
                            }
                            $section->addTextRun('pOStyle')->addText(" ", array('size' => 8));
                        }
                    }
                }

                if(++$i === $numItems){ //Last item
                    //Do nothing
                }else{
                    $section->addPageBreak(); //New Page
                }
            }
        }else{
            //Do nothing
        }
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

    function getStandardSettings($state){

        $settings = null;
        $paths = htmltodocx_paths();

        switch($state){
            case 'default':

                $settings = array(
                    // Required parameters:
                    'phpword_object' => &$this->word, // Must be passed by reference.
                    // 'base_root' => 'http://test.local', // Required for link elements - change it to your domain.
                    // 'base_path' => '/htmltodocx/documentation/', // Path from base_root to whatever url your links are relative to.
                    'base_root' => $paths['base_root'],
                    'base_path' => $paths['base_path'],
                    // Optional parameters - showing the defaults if you don't set anything:
                    'current_style' => array('size' => '12'), // The PHPWord style on the top element - may be inherited by descendent elements.
                    'parents' => array(0 => 'body'), // Our parent is body.
                    'list_depth' => 0, // This is the current depth of any current list.
                    'context' => 'section', // Possible values - section, footer or header.
                    'pseudo_list' => FALSE, // NOTE: Word lists not yet supported (TRUE is the only option at present).
                    'pseudo_list_indicator_font_name' => 'Wingdings', // Bullet indicator font.
                    'pseudo_list_indicator_font_size' => '7', // Bullet indicator size.
                    'pseudo_list_indicator_character' => 'l ', // l Gives a circle or m for round bullet point with wingdings.
                    'table_allowed' => TRUE, // Note, if you are adding this html into a PHPWord table you should set this to FALSE: tables cannot be nested in PHPWord.
                    'treat_div_as_paragraph' => TRUE, // If set to TRUE, each new div will trigger a new line in the Word document.
                    'numbered_lists' => &$this->numbered_lists,

                    // Optional - no default:
                    'style_sheet' => htmltodocx_styles_example(), // This is an array (the "style sheet") - returned by htmltodocx_styles_example() here (in styles.inc) - see this function for an example of how to construct this array.
                );

                break;

            case 'cover':
                $settings = array(
                    // Required parameters:
                    'phpword_object' => &$this->word, // Must be passed by reference.
                    // 'base_root' => 'http://test.local', // Required for link elements - change it to your domain.
                    // 'base_path' => '/htmltodocx/documentation/', // Path from base_root to whatever url your links are relative to.
                    'base_root' => $paths['base_root'],
                    'base_path' => $paths['base_path'],
                    // Optional parameters - showing the defaults if you don't set anything:
                    'current_style' => array( 'size'=>'12','align' => 'center', 'spaceAfter' => '100'), // The PHPWord style on the top element - may be inherited by descendent elements.
                    'parents' => array(0 => 'body'), // Our parent is body.
                    'list_depth' => 0, // This is the current depth of any current list.
                    'context' => 'section', // Possible values - section, footer or header.
                    'pseudo_list' => TRUE, // NOTE: Word lists not yet supported (TRUE is the only option at present).
                    'pseudo_list_indicator_font_name' => 'Wingdings', // Bullet indicator font.
                    'pseudo_list_indicator_font_size' => '7', // Bullet indicator size.
                    'pseudo_list_indicator_character' => 'l ', // Gives a circle bullet point with wingdings.
                    'table_allowed' => TRUE, // Note, if you are adding this html into a PHPWord table you should set this to FALSE: tables cannot be nested in PHPWord.
                    'treat_div_as_paragraph' => TRUE, // If set to TRUE, each new div will trigger a new line in the Word document.
                    'numbered_lists' => &$this->numbered_lists,

                    // Optional - no default:
                    'style_sheet' => htmltodocx_styles_example(), // This is an array (the "style sheet") - returned by htmltodocx_styles_example() here (in styles.inc) - see this function for an example of how to construct this array.
                );
                break;
        }

        return $settings;


    }

    public function export($param='',$param2=''){
        if($param !='' && $param =='members') {
            $this->exportMembers();
        }elseif($param !='' && $param == 'users'){
            $this->exportUsers();
        }elseif($param!='' && $param == 'exercises'){

            $conditions = ($param2=='search') ? array(
                'host'          => $this->input->post('txtHost'),
                'district_id'   => $this->input->post('filter_by_district'),
                'school_id'     => $this->input->post('filter_by_school'),
                'type'          => $this->input->post('txttype'),
                'from'          => $this->input->post('txtDateExerciseFrom'),
                'to'            => $this->input->post('txtDateExerciseTo')
            ) : array();

            $this->exportExercises($conditions);

        }elseif($param !='' && $param == 'trainings'){

            $conditions = ($param2=='search') ? array(
                'host'          => $this->input->post('txtProvider'),
                'district_id'   => $this->input->post('filter_by_district'),
                'school_id'     => $this->input->post('filter_by_school'),
                'topic'         => $this->input->post('txtTopic'),
                'from'          => $this->input->post('txtDateTrainingFrom'),
                'to'            => $this->input->post('txtDateTrainingTo')
            ) : array();

            $this->exportTrainings($conditions);
        }
    }

    private function exportUsers(){

        $userData = $this->user_model->getUsers();

        PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
        //Set document properties
        $this->excel->getProperties()->setCreator($this->session->userdata('username'))
            ->setLastModifiedBy($this->session->userdata('username'))
            ->setTitle("EOP Assist User List")
            ->setSubject("User List");

        //DEFINE CELL STYLES
        $headingStyleArray = array(
            'font'  => array(
                'bold'  =>  true,
                'size'  =>  14
            ),
            'alignment' =>  array(
                'horizontal'    =>  PHPExcel_Style_Alignment::HORIZONTAL_CENTER
            ),
            'borders'   =>  array(
                'top'   =>  array(
                    'style' =>  PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        //Headings Data
        $this->excel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'FULL NAME')
            ->setCellValue('B1', 'EMAIL')
            ->setCellValue('C1', 'USER ID')
            ->setCellValue('D1', 'STATUS')
            ->setCellValue('E1', 'USER ROLE')
            ->setCellValue('F1', 'SCHOOL')
            ->setCellValue('G1', 'DISTRICT')
            ->setCellValue('H1', 'VIEW ONLY');


        //SET Style
        $this->excel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($headingStyleArray);

        //Column size
        $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);



        $index = 1;
        if(is_array($userData) && count($userData)>0){
            foreach($userData as $key => $row){
                $exportData[] = array( $row['first_name'], $row['last_name'], $row['email'], $row['username'], $row['status'],  $row['role'], $row['school'], $row['district'], $row['read_only']);
                ++$index;

                $this->excel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$index, $row['first_name']." ". $row['last_name'])
                    ->setCellValue('B'.$index, $row['email'])
                    ->setCellValue('C'.$index, $row['username'])
                    ->setCellValue('D'.$index, $row['status'])
                    ->setCellValue('E'.$index, $row['role'])
                    ->setCellValue('F'.$index, $row['school'])
                    ->setCellValue('G'.$index, $row['district'])
                    ->setCellValue('H'.$index, ($row['read_only']=="n") ? "No":"Yes");
            }
        }


        // Rename worksheet
        $this->excel->getActiveSheet()->setTitle('EOP ASSIST User List');


        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $this->excel->setActiveSheetIndex(0);


        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="UserList.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
        $objWriter->save('php://output');
        exit;

    }

    private function exportMembers(){
        $schoolCondition = '';

        if(isset($this->session->userdata['loaded_school']['id'])){
            $schoolCondition = array('sid'=>$this->session->userdata['loaded_school']['id']);
        }
        $memberData = $this->team_model->getMembers($schoolCondition);

        PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);

        //Set document properties
        $this->excel->getProperties()->setCreator($this->session->userdata('username'))
            ->setLastModifiedBy($this->session->userdata('username'))
            ->setTitle("My Core Planning Team")
            ->setSubject("Planning Team");

        //DEFINE CELL STYLES
        $headingStyleArray = array(
            'font'  => array(
                'bold'  =>  true,
                'size'  =>  14
            ),
            'alignment' =>  array(
                'horizontal'    =>  PHPExcel_Style_Alignment::HORIZONTAL_CENTER
            ),
            'borders'   =>  array(
                'top'   =>  array(
                    'style' =>  PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        //Headings Data
        $this->excel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'NAME')
            ->setCellValue('B1', 'TITLE')
            ->setCellValue('C1', 'ORGANIZATION')
            ->setCellValue('D1', 'EMAIL')
            ->setCellValue('E1', 'PHONE')
            ->setCellValue('F1', 'STAKEHOLDER CATEGORY');

        //SET Style
        $this->excel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($headingStyleArray);

        //Column size
        $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);

        $index = 1;
        if(is_array($memberData) && count($memberData)>0){
            foreach($memberData as $key => $row){
                $exportData[] = array($row['name'], $row['title'], $row['organization'], $row['email'], $row['phone'], $row['interest']);
                ++$index;

                $this->excel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$index, $row['name'])
                    ->setCellValue('B'.$index, $row['title'])
                    ->setCellValue('C'.$index, $row['organization'])
                    ->setCellValue('D'.$index, $row['email'])
                    ->setCellValue('E'.$index, $row['phone'])
                    ->setCellValue('F'.$index, str_replace(",", "\n", $row['interest']));
            }
        }


        // Rename worksheet
        $this->excel->getActiveSheet()->setTitle('Core Planning Team Members');


        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $this->excel->setActiveSheetIndex(0);


        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="myTeam.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
        $objWriter->save('php://output');
        exit;

    }

    private function exportExercises($conditions=array()){

        $this->load->model('exercise_model');
        $filter = (count($conditions)>0) ? true : false;

        if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL){
            $schoolCondition = '';
            if(isset($this->session->userdata['loaded_school']['id'])){
                $schoolCondition = array('sid'=>$this->session->userdata['loaded_school']['id']);
            }

            $memberData = ($filter) ? $this->exercise_model->getExercises($conditions, true) : $this->exercise_model->getExercises($schoolCondition);

        }elseif($this->session->userdata['role']['level'] >= SCHOOL_ADMIN_LEVEL){
            $schoolCondition = array('sid'=>$this->session->userdata['loaded_school']['id']);
            $memberData = ($filter) ? $this->exercise_model->getExercises($conditions, true) : $this->exercise_model->getExercises($schoolCondition);
        }else{
            $memberData = ($filter) ? $this->exercise_model->getExercises($conditions, true) : $this->exercise_model->getExercises();
        }


        PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);

        //Set document properties
        $this->excel->getProperties()->setCreator($this->session->userdata('username'))
            ->setLastModifiedBy($this->session->userdata('username'))
            ->setTitle("Exercises / Drills Documentation")
            ->setSubject("Exercise Documentation");

        //DEFINE CELL STYLES
        $headingStyleArray = array(
            'font'  => array(
                'bold'  =>  true,
                'size'  =>  14
            ),
            'alignment' =>  array(
                'horizontal'    =>  PHPExcel_Style_Alignment::HORIZONTAL_CENTER
            ),
            'borders'   =>  array(
                'top'   =>  array(
                    'style' =>  PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        //Headings Data
        $this->excel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'NAME')
            ->setCellValue('B1', 'TYPE')
            ->setCellValue('C1', 'LOCATION')
            ->setCellValue('D1', 'CONTACT')
            ->setCellValue('E1', 'DATE')
            ->setCellValue('F1', 'DESCRIPTION')
            ->setCellValue('G1', 'HOST');

        //SET Style
        $this->excel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($headingStyleArray);

        //Column size
        $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);

        $index = 1;
        if(is_array($memberData) && count($memberData)>0){
            foreach($memberData as $key => $row){
                $exportData[] = array($row['name'], $row['type'], $row['location'], $row['contact'], $row['date'], $row['description']);
                ++$index;

                $this->excel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$index, $row['name'])
                    ->setCellValue('B'.$index, $row['type'])
                    ->setCellValue('C'.$index, $row['location'])
                    ->setCellValue('D'.$index, $row['contact'])
                    ->setCellValue('E'.$index, $row['date'])
                    ->setCellValue('F'.$index, $row['description'])
                    ->setCellValue('G'.$index, $row['host']);
            }
        }


        // Rename worksheet
        $this->excel->getActiveSheet()->setTitle('Exercise Documentation Data');


        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $this->excel->setActiveSheetIndex(0);


        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="myExerciseDocumentationData.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
        $objWriter->save('php://output');
        exit;

    }

    private function exportTrainings($conditions=array()){
        $this->load->model('training_model');
        $filter = (count($conditions)>0) ? true : false;

        $school_loaded = (isset($this->session->userdata['loaded_school']['id']) && null != $this->session->userdata['loaded_school']['id']) ? true : false;
        $logged_in_role_level = $this->session->userdata['role']['level'];


        if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL){
            $schoolCondtion='';

            if(isset($this->session->userdata['loaded_school']['id'])){
                $schoolCondition = array('sid'=>$this->session->userdata['loaded_school']['id']);
            }

            $memberData = ($filter) ? $this->training_model->getTrainings($conditions, true) : $this->training_model->getTrainings($schoolCondition);

        }elseif($this->session->userdata['role']['level']>= SCHOOL_ADMIN_LEVEL){
            $schoolCondition = array('sid'=>$this->session->userdata['loaded_school']['id']);
            $memberData = ($filter) ? $this->training_model->getTrainings($conditions, true) : $this->training_model->getTrainings($schoolCondition);
        }else{
            $memberData = ($filter) ? $this->training_model->getTrainings($conditions, true) : $this->training_model->getTrainings();
        }
        

        PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);

        //Set document properties
        $this->excel->getProperties()->setCreator($this->session->userdata('username'))
            ->setLastModifiedBy($this->session->userdata('username'))
            ->setTitle("Train and Inform Stakeholders")
            ->setSubject("Trainings Documentation");

        //DEFINE CELL STYLES
        $headingStyleArray = array(
            'font'  => array(
                'bold'  =>  true,
                'size'  =>  14
            ),
            'alignment' =>  array(
                'horizontal'    =>  PHPExcel_Style_Alignment::HORIZONTAL_CENTER
            ),
            'borders'   =>  array(
                'top'   =>  array(
                    'style' =>  PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        //Headings Data

        if($logged_in_role_level == STATE_ADMIN_LEVEL) {
            $this->excel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'NAME')
                ->setCellValue('B1', 'TOPIC')
                ->setCellValue('C1', 'LOCATION')
                ->setCellValue('D1', 'FORMAT')
                ->setCellValue('E1', 'DATE')
                ->setCellValue('F1', 'PARTICIPANTS')
                ->setCellValue('G1', 'KEY PERSONNEL')
                ->setCellValue('H1', 'EVALUATION SCORE')
                ->setCellValue('I1', 'NUMBER OF LEAS')
                ->setCellValue('J1', 'NUMBER OF RURAL LEAS')
                ->setCellValue('K1', 'DESCRIPTION');

            //SET Style
            $this->excel->getActiveSheet()->getStyle('A1:K1')->applyFromArray($headingStyleArray);

            //Column size
            $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);

            $index = 1;
            if(is_array($memberData) && count($memberData)>0){
                foreach($memberData as $key => $row){
                    ++$index;

                    $this->excel->setActiveSheetIndex(0)
                        ->setCellValue('A'.$index, $row['name'])
                        ->setCellValue('B'.$index, $row['topic'])
                        ->setCellValue('C'.$index, $row['location'])
                        ->setCellValue('D'.$index, $row['format'])
                        ->setCellValue('E'.$index, $row['date'])
                        ->setCellValue('F'.$index, $row['participants'])
                        ->setCellValue('G'.$index, $row['personnel'])
                        ->setCellValue('H'.$index, $row['score'])
                        ->setCellValue('I'.$index, $row['leas'])
                        ->setCellValue('J'.$index, $row['rleas'])
                        ->setCellValue('K'.$index, $row['description']);
                }
            }

        }elseif(!$school_loaded && $logged_in_role_level==DISTRICT_ADMIN_LEVEL){
            $this->excel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'NAME')
                ->setCellValue('B1', 'TOPIC')
                ->setCellValue('C1', 'LOCATION')
                ->setCellValue('D1', 'FORMAT')
                ->setCellValue('E1', 'DATE')
                ->setCellValue('F1', 'PARTICIPANTS')
                ->setCellValue('G1', 'KEY PERSONNEL')
                ->setCellValue('H1', 'EVALUATION SCORE')
                ->setCellValue('I1', 'PROVIDER')
                ->setCellValue('J1', 'NUMBER OF SCHOOLS')
                ->setCellValue('K1', 'DESCRIPTION');

            //SET Style
            $this->excel->getActiveSheet()->getStyle('A1:K1')->applyFromArray($headingStyleArray);

            //Column size
            $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);

            $index = 1;
            if(is_array($memberData) && count($memberData)>0){
                foreach($memberData as $key => $row){
                    ++$index;

                    $this->excel->setActiveSheetIndex(0)
                        ->setCellValue('A'.$index, $row['name'])
                        ->setCellValue('B'.$index, $row['topic'])
                        ->setCellValue('C'.$index, $row['location'])
                        ->setCellValue('D'.$index, $row['format'])
                        ->setCellValue('E'.$index, $row['date'])
                        ->setCellValue('F'.$index, $row['participants'])
                        ->setCellValue('G'.$index, $row['personnel'])
                        ->setCellValue('H'.$index, $row['score'])
                        ->setCellValue('I'.$index, $row['provider'])
                        ->setCellValue('J'.$index, $row['schools'])
                        ->setCellValue('K'.$index, $row['description']);
                }
            }

        }else{
            $this->excel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'NAME')
                ->setCellValue('B1', 'TOPIC')
                ->setCellValue('C1', 'LOCATION')
                ->setCellValue('D1', 'FORMAT')
                ->setCellValue('E1', 'DATE')
                ->setCellValue('F1', 'PARTICIPANTS')
                ->setCellValue('G1', 'KEY PERSONNEL')
                ->setCellValue('H1', 'EVALUATION SCORE')
                ->setCellValue('I1', 'PROVIDER')
                ->setCellValue('J1', 'DESCRIPTION');

            //SET Style
            $this->excel->getActiveSheet()->getStyle('A1:J1')->applyFromArray($headingStyleArray);

            //Column size
            $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);

            $index = 1;
            if(is_array($memberData) && count($memberData)>0){
                foreach($memberData as $key => $row){
                    ++$index;

                    $this->excel->setActiveSheetIndex(0)
                        ->setCellValue('A'.$index, $row['name'])
                        ->setCellValue('B'.$index, $row['topic'])
                        ->setCellValue('C'.$index, $row['location'])
                        ->setCellValue('D'.$index, $row['format'])
                        ->setCellValue('E'.$index, $row['date'])
                        ->setCellValue('F'.$index, $row['participants'])
                        ->setCellValue('G'.$index, $row['personnel'])
                        ->setCellValue('H'.$index, $row['score'])
                        ->setCellValue('I'.$index, $row['provider'])
                        ->setCellValue('J'.$index, $row['description']);
                }
            }
        }


        // Rename worksheet
        $this->excel->getActiveSheet()->setTitle('Train and Inform Stakeholders');


        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $this->excel->setActiveSheetIndex(0);


        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="myTrainingsDocumentationData.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
        $objWriter->save('php://output');
        exit;

    }

    function flushToBrowser($fileName){

        $file = $fileName."_EOP.docx";
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($this->word, 'Word2007');


        // Redirect output to a client’s web browser (Word2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Disposition: attachment;filename="'.$file.'"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0

        $objWriter->save('php://output');
        exit;
    }

    function cleanTHData($entities){

        $eligibleEntities = array();

        foreach($entities as $key=>$value){
            foreach($value['children'] as $child){
                if($child['type']=='g1' || $child['type']=='g2' || $child['type']=='g3'){
                    foreach($child['children'] as $grandChild){
                        if($grandChild['type']=='ca') {
                            foreach ($grandChild['fields'] as $field) {
                                if (isset($field['body']) && !empty($field['body'])) {
                                    array_push($eligibleEntities, $value);
                                    break 3;
                                }
                            }
                        }
                    }
                }

            }

        }
        return $eligibleEntities;
    }

    function cleanFunctionalData($entities){
        $eligibleEntities = array();

        foreach($entities as $key=>$value){
            foreach($value['children'] as $child){
                if($child['type']=='g1' || $child['type']=='g2' || $child['type']=='g3'){
                    foreach($child['children'] as $grandChild){
                        if($grandChild['type']=='ca') {
                            foreach ($grandChild['fields'] as $field) {
                                if (isset($field['body']) && !empty($field['body'])) {
                                    array_push($eligibleEntities, $value);
                                    break 3;
                                }
                            }
                        }
                    }
                }

            }

        }

        return $eligibleEntities;
    }
}