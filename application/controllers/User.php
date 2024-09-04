<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * User Controller Class
 *
 * Developed by Synergy Enterprises, Inc. for the U.S. Department of Education
 *
 * Controller Responsible for:
 *
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

class User extends CI_Controller{


    public function __construct(){
        parent::__construct();

        if($this->session->userdata('is_logged_in')){

            $this->load->model('registry_model');
            // Load the user_model that will handle most database operations
            $this->load->model('user_model');
            $this->load->model('school_model');
            $this->load->model('district_model');

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
        $schools = $this->school_model->getSchools($this->session->userdata('host_state'));
        // Get all registered users
        $users = $this->user_model->getUsers();
         // Get the role access permissions for the logged in user
        $role = $this->user_model->getUserRole($this->session->userdata('user_id'));

        // Get the district admin's district
        $distAdminDistrict = '';
        if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL){ // District admin logged in
            $districtRow = $this->user_model->getUserDistrict($this->session->userdata('user_id'));
            $distAdminDistrict = $districtRow[0]['did'];
        }

        if($this->session->userdata['role']['level']<=4){ // Stop school users from accessing this section of the web app
            $templateData = array(
                'page'          =>  'users',
                'page_title'    =>  'User Management',
                'step_title'    =>  'Users',
                'users'          => $users,
                'roles'         =>  $roles,
                'districts'     =>  $districts,
                'schools'       =>  $schools,
                'role'          =>  $role,
                'adminDistrict' =>  $distAdminDistrict

            );
            $this->template->load('template', 'users_screen', $templateData);
        }else{ // Redirect school users to the My Account section
            redirect('/user/profile');
        }

    }

    /**
     *  Function used to reload /user page on a ajax call
     */
     private function ajax_reload(){
        $templateData = array(
            'page'          =>  'users',
            'page_title'    =>  'User Management',
            'step_title'    =>  'Users'
        );
        return $this->template->load('template', 'users_screen', $templateData, true);
    }
    
    public function import($action='show'){

        //Get the User roles available
        $roles = $this->user_model->getAllRoles();
        //Get the districts available in the state
        $districts = $this->district_model->getDistricts($this->session->userdata('host_state'));
        //Get the districts available in the state
        $schools = $this->school_model->getSchools($this->session->userdata('host_state'));
        // Get all registered users
        $users = $this->user_model->getUsers();
        // Get the role access permissions for the logged in user
        $role = $this->user_model->getUserRole($this->session->userdata('user_id'));
        // Get the district admin's district
        $distAdminDistrict = '';
        if($this->session->userdata['role']['level'] == 3){ // District admin logged in
            $districtRow = $this->user_model->getUserDistrict($this->session->userdata('user_id'));
            $distAdminDistrict = $districtRow[0]['did'];
        }

        $templateData = array(
            'page'          =>  'users',
            'page_title'    =>  'User Management',
            'step_title'    =>  'Users',
            'roles'         =>  $roles,
            'districts'     =>  $districts,
            'schools'       =>  $schools,
            'users'         =>  $users,
            'role'          =>  $role,
            'adminDistrict' =>  $distAdminDistrict
        );

        if($action=='show'){
            $templateData['viewImport'] = true;
        }else if($action=='preview'){

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
        }else if($action=='save'){
            //var_dump($this->input->post('first_name'));
            //exit;
            $savedRecs = 0;

            $first_names = $this->input->post('first_name');
            $last_names  = $this->input->post('last_name');
            $emails      = $this->input->post('email');
            $phones      = $this->input->post('phone');
            $passwords   = $this->input->post('password');
            $roles       = $this->input->post('slctuserrole');
            $districts   = $this->input->post('sltdistrict');
            $schools     = $this->input->post('sltschool');

            if(isset($first_names) && is_array($first_names) && count($first_names)>0){
                for($i=0; $i<count($first_names); $i++){
                    $data = array(
                        'role_id'       =>  $roles[$i],
                        'first_name'    =>  $first_names[$i],
                        'last_name'     =>  $last_names[$i],
                        'email'         =>  $emails[$i],
                        'username'      =>  explode("@", $emails[$i])[0],
                        'password'      =>  md5($passwords[$i]),
                        'phone'         =>  $phones[$i],
                        'district'      =>  $districts[$i],
                        'school'        =>  $schools[$i],
                        'read_only'     =>  'n'
                    );

                    if($this->session->userdata['role']['level'] == 3){ //District admin is adding user, make the default user district be the same as the district admin
                        $districtRow = $this->user_model->getUserDistrict($this->session->userdata('user_id'));
                        $data['district'] = $districtRow[0]['did'];
                    }
                    if($this->session->userdata['role']['level'] == 4){ //School admin is adding user, make the default user school be the same as the school admin's
                        $schoolRow = $this->user_model->getUserSchool($this->session->userdata('user_id'));
                        $data['school'] = $schoolRow[0]['sid'];
                    }

                    if($data['role_id'] <= 3 ){ //If we are adding a district, or state admin or super user, remove school association
                        if($data['role_id']<=2){ // The state admin and super, remove school and district association
                            $data['school'] = '';
                            $data['district'] = '';
                        }
                        else{
                            $data['school'] = '';
                        }
                    }

                    $savedRecs = $this->user_model->addUser($data);

                }

                if(is_numeric($savedRecs) && $savedRecs>=1){
                    $this->session->set_flashdata('success', ' Users imported successfully!');
                }
                else{
                    $this->session->set_flashdata('error', ' Import failed!');
                }

                redirect('/user');
            }

        }

        $this->template->load('template', 'users_screen', $templateData);
    }

    public function add(){

        // Check if there is data submitted
        $submitted = is_null($this->input->post('user_form_submit'))? FALSE : $this->input->post('user_form_submit');

        if($submitted){ // Form has been submitted
            // Process the data and add to the database

            $data = array(
                'role_id'       =>  $this->input->post('slctuserrole'),
                'first_name'    =>  $this->input->post('first_name'),
                'last_name'     =>  $this->input->post('last_name'),
                'email'         =>  $this->input->post('email'),
                'username'      =>  $this->input->post('username'),
                'password'      =>  md5($this->input->post('user_password')),
                'phone'         =>  $this->input->post('phone'),
                'district'      =>  ($this->input->post('sltdistrict') == FALSE) ? '' : $this->input->post('sltdistrict'),
                'school'        =>  ($this->input->post('sltschool') == FALSE) ? '' : $this->input->post('sltschool'),
                'read_only'     =>  ($this->input->post('user_access_permission')) ? $this->input->post('user_access_permission') : 'n'
            );


            if($this->input->post('sltschool')){ // If there is a school selected, get the school's district if it's under one and associate it to the user
                $school_id = $this->input->post('sltschool');
                $district_id = $this->school_model->getSchoolDistrict($school_id);

                if(null != $district_id){
                    $data['district'] = $district_id;
                }
            }

            if($this->session->userdata['role']['level'] == 3){ //District admin is adding user, make the default user district be the same as the district admin
                $districtRow = $this->user_model->getUserDistrict($this->session->userdata('user_id'));
                $data['district'] = $districtRow[0]['did'];
            }
            if($this->session->userdata['role']['level'] == 4){ //School admin is adding user, make the default user school be the same as the school admin's
                $schoolRow = $this->user_model->getUserSchool($this->session->userdata('user_id'));
                $data['school'] = $schoolRow[0]['sid'];
            }

            if($data['role_id'] <= 3 ){ //If we are adding a district, or state admin or super user, remove school association
                if($data['role_id']<=2){ // The state admin and super, remove school and district association
                    $data['school'] = '';
                    $data['district'] = '';
                }
                else{
                    $data['school'] = '';
                }
            }

            /* If we are creating a district admin, make sure a district is selected else redirect with an error
            */
            if($data['role_id'] == 3){

                if(empty($data['district']) || $data['district']== 'Null' || $data['district']== '-1' || $data['district']== Null){

                    $this->session->set_flashdata('error', ' You need to select a district for a district administrator');

                    redirect('/user');

                }
            }

            $savedRecs = $this->user_model->addUser($data);

            if(is_numeric($savedRecs) && $savedRecs>=1){
                $this->session->set_flashdata('success', ' New user created successfully!');
            }
            else{
                $this->session->set_flashdata('error', ' New user creation failed!');
            }

            redirect('/user');
        }
        else{ // No form submitted, prompt with the user addition form

            //Get the User roles available
            $roles = $this->user_model->getAllRoles();
            //Get the districts available in the state
            $districts = $this->district_model->getDistricts($this->session->userdata('host_state'));
            //Get the districts available in the state
            $schools = $this->school_model->getSchools($this->session->userdata('host_state'));
            // Get all registered users
            $users = $this->user_model->getUsers();
             // Get the role access permissions for the logged in user
            $role = $this->user_model->getUserRole($this->session->userdata('user_id'));
            // Get the district admin's district
            $distAdminDistrict = '';
            if($this->session->userdata['role']['level'] == 3){ // District admin logged in
                $districtRow = $this->user_model->getUserDistrict($this->session->userdata('user_id'));
                $distAdminDistrict = $districtRow[0]['did'];
            }

            $templateData = array(
                'page'          =>  'users',
                'page_title'    =>  'User Management',
                'step_title'    =>  'Users',
                'viewform'      =>  true,
                'roles'         =>  $roles,
                'districts'     =>  $districts,
                'schools'       =>  $schools,
                'users'         =>  $users,
                'role'          =>  $role,
                'adminDistrict' =>  $distAdminDistrict
            );
            $this->template->load('template', 'users_screen', $templateData);
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
                'user_id'          =>   $this->input->post('user_id'),
                'first_name'       =>   $this->input->post('first_name'),
                'last_name'        =>   $this->input->post('last_name'),
                'email'            =>   $this->input->post('email'),
                'username'         =>   $this->input->post('username'),
                'phone'            =>   $this->input->post('phone'),
                'role_id'          =>   $this->input->post('role_id'),
                'school_id'        =>   $this->input->post('school_id'),
                'district_id'      =>   $this->input->post('district_id'),
                'access'           =>   $this->input->post('access')
            );

            // Force access (View only attribute) to 'No' for other users except school user.
            if($this->input->post('role_id')<=4)
                $data['access'] = 'n';

            $savedRecs = $this->user_model->update($data);

            //If the user's role has been changed to a district, state or super admin, unlink the user from their school
            if($this->input->post('role_id')<=3){
                $this->user_model->unlinkUserFromSchool($data['user_id']);
            }

            //If the user's role has been changed to a school user or school admin, unlink the user from a district
            if($this->input->post('role_id')>=4){
                $this->user_model->unlinkUserFromDistrict($data['user_id']);
            }

            if(is_numeric($savedRecs) && $savedRecs>=1){ //User information saved successfully
                $this->session->set_flashdata('success', 'User updated successfully!');
            }
            elseif(is_numeric($savedRecs) && $savedRecs==0){
                //Do nothing
            }
            else{
                $this->session->set_flashdata('error', ' User update failed!');
            }

            $this->output->set_output($this->ajax_reload());
        }
        else{ // Update account profile of currently logged in user from the My Account page

            $form_name = $this->input->post('form_name');
            if($form_name){

                if($form_name == "account_form"){
                    $data = array(
                        'first_name'        =>  $this->input->post('fname'),
                        'last_name'         =>  $this->input->post('last_name'),
                        'phone'             =>  $this->input->post('phone'),
                        'email'             =>  $this->input->post('email'),
                        'username'          =>  $this->input->post('username')
                        );

                    $savedRecs = $this->user_model->updatePersonalAccount($this->session->userdata('user_id'), $data);

                    if(is_numeric($savedRecs)){

                        if( $savedRecs>=1){ //User profile updated successfully
                            $this->session->set_flashdata('success', 'User updated successfully!');
                        }
                        elseif($savedRecs ==0){
                            //$this->session->set_flashdata('success', 'User profile has been updated successfully!');
                        }
                        else{
                            $this->session->set_flashdata('error', ' User update failed!');
                        }
                    }


                    redirect('/user/profile');
                }
                elseif($form_name == "pwd_form"){
                    $oldPwd = $this->input->post('user_password_current');

                    $check  =   $this->user_model->validate($this->session->userdata('username'), $oldPwd);

                    if($check){
                        $newPwd  = $this->input->post('user_password_reset');
                        $savedRecs = $this->user_model->resetPwd($this->session->userdata('user_id'), md5($newPwd));

                        if(is_numeric($savedRecs) && $savedRecs>=1){ //Password reset successfully
                            $this->session->set_flashdata('success', 'Password reset successfully!');
                        }
                        elseif(is_numeric($savedRecs) && $savedRecs == 0){
                            $this->session->set_flashdata('success', 'Password reset successfully!');
                        }
                        elseif(is_numeric($savedRecs) && $savedRecs < 0){
                            $this->session->set_flashdata('error', ' Password reset failed!');
                        }
                        else{
                            $this->session->set_flashdata('error', ' Password reset failed!');
                        }
                    }
                    else{
                         $this->session->set_flashdata('error', 'The value you entered for the current password was not correct!');
                    }

                    redirect('/user/profile');
                }
            }else{

                $this->session->set_flashdata('error', ' Form not submitted properly');
                redirect('/user/profile');
            }
        }
    }

    /**
     *  Delete Action
     * @method Delete the user information
     *
     */

    public function delete(){
        if($this->input->post('ajax')){
            $id = $this->input->post('id');
            $affectedRecs = $this->user_model->deleteUser($id);

             if(is_numeric($affectedRecs) && $affectedRecs > 0){
                $this->session->set_flashdata('success','User was deleted successfully!');
                $this->output->set_output(json_encode(array(
                    'deleted' =>  TRUE
                )));
            }
            else{
                $this->session->set_flashdata('error','User deletion failed!');
                $this->output->set_output(json_encode(array(
                    'deleted' =>  FALSE
                )));
            }

        }
        else{
        }
    }



    /**
     * Reset Password Action
     * @method resetpwd Action that deals with resetting the user's password
     */
    public function resetpwd(){
        if($this->input->post('ajax')){ // If form was submitted using ajax

            $user_id        =   $this->input->post('user_id');
            $new_password   =   md5($this->input->post('new_password'));

            $savedRecs = $this->user_model->resetPwd($user_id, $new_password);

            if(is_numeric($savedRecs) && $savedRecs>=1){ //Password reset successfully
                $this->session->set_flashdata('success', 'Password reset successfully!');
            }
            elseif(is_numeric($savedRecs) && $savedRecs == 0){
                $this->session->set_flashdata('success', 'Password reset successfully!');
            }
            elseif(is_numeric($savedRecs) && $savedRecs < 0){
                $this->session->set_flashdata('error', ' Password reset failed!');
            }
            else{
                $this->session->set_flashdata('error', ' Password reset failed!');
            }

            $this->output->set_output($this->ajax_reload());

        }else{
            // Do nothing or return error prompt
        }
    }

    /**
    * Block user Action
    * @method block Action that blocks/deletes users
    */
    public function block(){
        if($this->input->post('ajax')){ // If the form was submitted using ajax

            $user_id    =   $this->input->post('user_id');

            $savedRecs = $this->user_model->block($user_id);

            if(is_numeric($savedRecs) && $savedRecs>=1){ //Password reset successfully
                $this->session->set_flashdata('success', 'User blocked successfully!');
            }
            else{
                $this->session->set_flashdata('error', ' User blocking failed!');
            }

            $this->output->set_output($this->ajax_reload());
        }
        else{ // Do nothing

        }
    }

    /**
    * Unblock user Action
    * @method unblock Action that unblocks/restores users
    */
    public function unblock(){
        if($this->input->post('ajax')){ // If the form was submitted using ajax

            $user_id    =   $this->input->post('user_id');

            $savedRecs = $this->user_model->unblock($user_id);

            if(is_numeric($savedRecs) && $savedRecs>=1){ //Password reset successfully
                $this->session->set_flashdata('success', 'User activated successfully!');
            }
            else{
                $this->session->set_flashdata('error', ' User activation failed!');
            }

            $this->output->set_output($this->ajax_reload());
        }
        else{ // Do nothing

        }
    }

    /**
     * Show Profile Action
     * This action loads the user account view for the user's profile
     *
     */
    public function profile(){

        // Get user's information
        $user = $this->user_model->getUser($this->session->userdata('user_id'));
        //Get the role access permissions for the logged in user
        $role = $this->user_model->getUserRole($this->session->userdata('user_id'));

        $templateData = array(
            'page'          =>  'account',
            'page_title'    =>  $user[0]['first_name']. ' '.$user[0]['last_name']. '\'s Profile',
            'step_title'    =>  'My Account',
            'user'          => $user,
            'role'          =>  $role

        );
        $this->template->load('template', 'account_screen', $templateData);
    }

    /**
     * Check existing username Action
     * @method checkusername Action that will check for existing user names and return true or false
     *
     */

    public function checkusername(){
        if($this->input->post('ajax')){ //If it's a ajax request
            $username = $this->input->post('username');

            if($this->user_model->checkUsername($username)){
                $this->output->set_output(json_encode(FALSE)); // Reject entry if username exists
            }else{
                $this->output->set_output(json_encode(TRUE)); // Accept entry of new username
            }
        }
        else{
            // Do nothing if its not an ajax request
        }
    }

    /**
     * Check for existing user email because no account should share an email
     * @method checkuseremail Action that will check for existing user emails and return true or false
     */
    public function checkuseremail(){
        if($this->input->post('ajax')){ //If it's a ajax request
            $email = $this->input->post('email');

            if($this->user_model->checkUseremail($email)){
                $this->output->set_output(json_encode(FALSE)); // Reject entry if email exists
            }else{
                $this->output->set_output(json_encode(TRUE)); // Accept entry
            }
        }
        else{
            // Do nothing if its not an ajax request
        }
    }


    public function checkusernameUpdate(){
        if($this->input->post('ajax')){ //If it's a ajax request
            $username = $this->input->post('username');
            $uid      = $this->input->post('id');

            if($this->user_model->checkUsernameUpdate($username, $uid)){
                $this->output->set_output(json_encode(FALSE)); // Reject entry if username exists
            }else{
                $this->output->set_output(json_encode(TRUE)); // Accept entry of new username
            }
        }
        else{
            // Do nothing if its not an ajax request
        }
    }


    public function checkuseremailUpdate(){
        if($this->input->post('ajax')){ //If it's a ajax request
            $email = $this->input->post('email');
            $uid      = $this->input->post('id');

            if($this->user_model->checkUseremailUpdate($email, $uid)){
                $this->output->set_output(json_encode(FALSE)); // Reject entry if email exists
            }else{
                $this->output->set_output(json_encode(TRUE)); // Accept entry
            }
        }
        else{
            // Do nothing if its not an ajax request
        }
    }

    public function login(){
        redirect('/login');
    }
}