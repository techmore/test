<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * School Controller Class
 *
 * Developed by Synergy Enterprises, Inc. for the U.S. Department of Education
 *
 * Controller Responsible for:
 * - Access control (login and logout)
 * - User registration and management
 * - Permissions management
 * - User role management
 * - User session data management
 *
 *
 * Date: 5/01/15 11:47 AM
 *
 * (c) 2015 United States Department of Education
 */

class School extends CI_Controller{

    public function __construct(){
        parent::__construct();

        if($this->session->userdata('is_logged_in')){
            // Load the user_model that will handle most database operations
            $this->load->model('registry_model');
            $this->load->model('user_model');
            $this->load->model('school_model');
            $this->load->model('access_model');
            $this->load->model('report_model');

            $host_state = $this->registry_model->getValue('host_state');
            $this->session->set_userdata('host_state', $host_state);
            
        }
        else{
            redirect('/login');
        }

    }

    public function index(){

        //Get the User roles available
        $roles = $this->user_model->getAllRoles();
        //Get the districts available in the state
        $districts = $this->user_model->getDistricts($this->session->userdata('host_state'));
        //Get the districts available in the state
        $schools = $this->school_model->getSchools($this->registry_model->getValue('host_state'));
        // Get all registered users
        $users = $this->user_model->getUsers();
         // Get the role access permissions for the logged in user
        $role = $this->user_model->getUserRole($this->session->userdata('user_id'));
        // Get the EOP access setting to the state
        $stateEOPAccess = $this->access_model->getStateAccess();

        //Get schools that have report data
        foreach($schools as &$school){

            if($this->report_model->hasData($school['id'])){
                $school['has_data'] = true;
                $school['last_modified'] = $this->report_model->getLastModifiedDate($school['id']);
            }else{
                $school['has_data'] = false;
            }
        }

        if($role['level']<4){ // If not a Super, State or District admin don't load
            $templateData = array(
                'page'          =>  'school',
                'page_title'    =>  'School Management',
                'step_title'    =>  'Schools',
                'users'          => $users,
                'roles'         =>  $roles,
                'districts'     =>  $districts,
                'schools'       =>  $schools,
                'role'          =>  $role,
                'stateEOPAccess'=>  $stateEOPAccess
            );
            $this->template->load('template', 'school_screen', $templateData);
        }
        else{ // Redirect to user management with error message
            $this->session->set_flashdata('error', " Sorry you've been redirected here because you don't have access to School Management resource!");
            redirect('/user');
        }


    }

    /**
     *  Function used to reload /school page on a ajax call
     */
     private function ajax_reload(){
        $templateData = array(
            'page'          =>  'school',
            'page_title'    =>  'School Management',
            'step_title'    =>  'Schools'
        );
        return $this->template->load('template', 'school_screen', $templateData, true);
    }

    public function import($action='show'){

        //Get the User roles available
        $roles = $this->user_model->getAllRoles();
        //Get the districts available in the state
        $districts = $this->user_model->getDistricts($this->session->userdata('host_state'));
        //Get the districts available in the state
        $schools = $this->school_model->getSchools($this->registry_model->getValue('host_state'));
        // Get all registered users
        $users = $this->user_model->getUsers();
        // Get the role access permissions for the logged in user
        $role = $this->user_model->getUserRole($this->session->userdata('user_id'));
        // Get the EOP access setting to the state
        $stateEOPAccess = $this->access_model->getStateAccess();

        //Get schools that have report data
        foreach($schools as &$school){

            if($this->report_model->hasData($school['id'])){
                $school['has_data'] = true;
                $school['last_modified'] = $this->report_model->getLastModifiedDate($school['id']);
            }else{
                $school['has_data'] = false;
            }
        }

        if($role['level']<4){ // If not a Super, State or District admin don't load
            $templateData = array(
                'page'          =>  'school',
                'page_title'    =>  'School Management',
                'step_title'    =>  'Schools',
                'users'          => $users,
                'roles'         =>  $roles,
                'districts'     =>  $districts,
                'schools'       =>  $schools,
                'role'          =>  $role,
                'stateEOPAccess'=>  $stateEOPAccess
            );

            if($action=='show') {
                $templateData['viewImport'] = true;
            }elseif($action=='preview'){

                $data = array();

                $fileName = $_FILES["csvInp"]["tmp_name"];


                if ($_FILES["csvInp"]["size"] > 0) {

                    $file = fopen($fileName, "r");

                    while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
                        $data[] = $column;
                    }
                }
                $templateData['csvData'] = $data;
                $templateData['viewPreview'] = true;

            }elseif($action=='save'){

                $savedRecs = 0;

                $school_names       = $this->input->post('school_name');
                $screen_names       = $this->input->post('screen_name');
                $districts          = $this->input->post('sltdistrict');


                if(isset($school_names) && is_array($school_names) && count($school_names)>0) {
                    for ($i = 0; $i < count($school_names); $i++) {

                        $data = array(
                            'name'            =>  $school_names[$i],
                            'screen_name'     =>  $screen_names[$i],
                            'district_id'     =>  $districts[$i]
                        );

                        if($this->session->userdata['role']['level'] == 3){ //District admin is adding school, make the default  district be the same as the district admin
                            $districtRow = $this->user_model->getUserDistrict($this->session->userdata('user_id'));
                            $data['district_id'] = $districtRow[0]['did'];
                        }

                        $savedRecs = $this->school_model->addSchool($data);

                    }

                    if(is_numeric($savedRecs) && $savedRecs>=1){
                        $this->session->set_flashdata('success', ' Schools imported successfully!');
                    }
                    else{
                        $this->session->set_flashdata('error', ' Schools import failed!');
                    }

                    redirect('/school');
                }
            }

            $this->template->load('template', 'school_screen', $templateData);
        }
        else{ // Redirect to user management with error message
            $this->session->set_flashdata('error', " Sorry you've been redirected here because you don't have access to School Management resource!");
            redirect('/user');
        }


    }

    public function add(){

        // Check if there is data submitted
        $submitted = is_null($this->input->post('school_form_submit'))? FALSE : $this->input->post('school_form_submit');

        if($submitted){ // Form has been submitted
            // Process the data and add to the database
            $data = array(

                'name'            =>  $this->input->post('school_name'),
                'screen_name'     =>  $this->input->post('screen_name'),
                'district_id'     =>  $this->input->post('sltdistrict'),
            );

            if($this->session->userdata['role']['level'] == 3){ //District admin is adding school, make the default  district be the same as the district admin
                $districtRow = $this->user_model->getUserDistrict($this->session->userdata('user_id'));
                $data['district_id'] = $districtRow[0]['did'];
            }

            $savedRecs = $this->school_model->addSchool($data);

            if(is_numeric($savedRecs) && $savedRecs>=1){
                $this->session->set_flashdata('success', ' New school created successfully!');
            }
            else{
                $this->session->set_flashdata('error', ' School creation failed!');
            }

            redirect('/school');
        }
        else{ // No form submitted, prompt with the user addition form

            //Get the User roles available
            $roles = $this->user_model->getAllRoles();
            //Get the districts available in the state
            $districts = $this->user_model->getDistricts($this->session->userdata('host_state'));
            //Get the districts available in the state
            $schools = $this->school_model->getSchools($this->session->userdata('host_state'));
            // Get all registered users
            $users = $this->user_model->getUsers();
             // Get the role access permissions for the logged in user
            $role = $this->user_model->getUserRole($this->session->userdata('user_id'));
            // Get the EOP access setting to the state
            $stateEOPAccess = $this->access_model->getStateAccess();

            //Get schools that have report data
            foreach($schools as &$school){

                if($this->report_model->hasData($school['id'])){
                    $school['has_data'] = true;
                    $school['last_modified'] = $this->report_model->getLastModifiedDate($school['id']);
                }else{
                    $school['has_data'] = false;
                }
            }

            $templateData = array(
                'page'          =>  'users',
                'page_title'    =>  'User Management',
                'step_title'    =>  'Schools',
                'viewform'      =>  true,
                'roles'         =>  $roles,
                'districts'     =>  $districts,
                'schools'       =>  $schools,
                'users'         =>  $users,
                'role'          =>  $role,
                'stateEOPAccess'=>  $stateEOPAccess
            );
            $this->template->load('template', 'school_screen', $templateData);
        }
    }

    /**
     *  Edit Action
     * @method update This method enables updates/edits of the user information
     *
     */
  
    public function update(){
        if($this->input->post('ajax')) { // If form was submitted using ajax

            $data = array(
                'id'               =>   $this->input->post('school_id'),
                'name'             =>   $this->input->post('school_name'),
                'screen_name'      =>   $this->input->post('screen_name')
            );
            $savedRecs = $this->school_model->update($data);

            if(is_numeric($savedRecs) && $savedRecs>=1){
                $this->session->set_flashdata('success', 'School updated successfully!');
            }
            else{
                $this->session->set_flashdata('error', ' School update failed!');
            }

            $this->output->set_output($this->ajax_reload());
        }
        else{ // Do nothing

        }
    }

    /**
     * Function handles school deletion
     *
     * @method delete
     */
    public function delete($param1 = 0){

        $school_id = $param1;

        if($this->input->post('ajax')){
            $id = $this->input->post('id');
            $affectedRecs = $this->school_model->deleteSchool($id);

            if(is_numeric($affectedRecs) && $affectedRecs > 0){
                $this->session->set_flashdata('success','School was deleted successfully!');
                $this->output->set_output(json_encode(array(
                    'deleted' =>  TRUE
                )));
            }
            else{
                $this->session->set_flashdata('error','School deletion failed!');
                $this->output->set_output(json_encode(array(
                    'deleted' =>  FALSE
                )));
            }
        }
        else{
        }
    }

    /**
     * AJAX Action returns schools in a requested district
     * @method get_schools_in_district
     */
    public function get_schools_in_district(){
        if($this->input->post('ajax')){ // If form was submitted using ajax

            $district_id = $this->input->post('district_id');

            $schools = $this->school_model->getDistrictSchools($district_id);

            $this->output->set_output(json_encode($schools));
        }
        else{ // Do nothing

        }
    }

    /**
     * AJAX Action returns schools in a requested user's district
     * @method get_schools_in_my_district
     */
    public function get_schools_in_my_district($user = ''){
        if($this->input->post('ajax')){ // If form was submitted using ajax

            $user_id = $this->input->post('user_id');
            $district_id = $this->user_model->getUserDistrict($user_id)[0]['did'];

            $schools = $this->school_model->getDistrictSchools($district_id);

            $this->output->set_output(json_encode($schools));
        }
        else{
            if($user==''){
                $user_id = $this->session->userdata('user_id');
            }else{
                $user_id = $user;
            }

            $district_id = $this->user_model->getUserDistrict($user_id)[0]['did'];

            $schools = $this->school_model->getDistrictSchools($district_id);

            return $schools;
        }
    }

    /**
     * AJAX Action returns all schools
     * @method get_schools
     */
    public function get_schools(){
        if($this->input->post('ajax')){ // If form was submitted using ajax

            $schools = $this->school_model->getSchools();

            $this->output->set_output(json_encode($schools));
        }
        else{

            $schools = $this->school_model->getSchools();

            return $schools;
        }
    }

    /**
     *  AJAX Action attaches a school to the session object
     * @method attach_to_session
     */
    public function attach_to_session(){
        if($this->input->post('ajax')) { // If form was submitted using ajax

            //Clear loaded_school session data
            $this->session->unset_userdata('loaded_school');

            $school_id = $this->input->post('school_id');

            $schoolData = $this->school_model->getSchool($school_id);
            $data = array(
                'loaded_school' => array(
                    'id'                =>  $schoolData[0]['id'],
                    'district_id'       =>  $schoolData[0]['district_id'],
                    'state_val'         =>  $schoolData[0]['state_val'],
                    'name'              =>  $schoolData[0]['name'],
                    'screen_name'       =>  $schoolData[0]['screen_name'],
                    'description'       =>  $schoolData[0]['description'],
                    'created_date'      =>  $schoolData[0]['created_date'],
                    'modified_date'     =>  $schoolData[0]['modified_date'],
                    'owner'             =>  $schoolData[0]['owner'],
                    'state_permission'  =>  $schoolData[0]['state_permission'],
                    'district'          =>  $schoolData[0]['district'],
                    'state'             =>  $schoolData[0]['state']
                )

            );

            $this->session->set_userdata($data);

            $this->output->set_output(json_encode(array(
                'loaded'    =>  TRUE,
                'school_id' =>  $school_id
                )));

        }else{ // Do nothing at the moment

        }
    }

    /**
     * AJAX function detaches a school from the session object
     * @method detach from session
     */
    public function detach_from_session(){

        if($this->input->post('ajax')){
            //Clear loaded school session data
            if($this->session->userdata['loaded_school']){
                $this->session->unset_userdata('loaded_school');
            }

            $this->output->set_output(json_encode(array('unloaded'=> TRUE)));
        }else{
            //Do nothing at the moment
        }

    }
}