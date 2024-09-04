<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: vkothale
 * Date: 10/24/2016
 * Time: 11:05 AM
 */
class Toolkit extends CI_Controller
{
    public function __construct(){
        parent::__construct();

        if ($this->session->userdata('is_logged_in')) {
            $this->load->model('resource_model');
            $this->load->model('page_model');
            $this->load->model('user_model');
            $this->load->model('registry_model');
            $host_state = $this->registry_model->getValue('host_state');
            $this->session->set_userdata('host_state', $host_state);
        } else {
            redirect('/login');
        }
    }

    public function index(){

        //Get the User roles available
        $roles = $this->user_model->getAllRoles();

        // Get the role access permissions for the logged in user
        $role = $this->user_model->getUserRole($this->session->userdata('user_id'));

        //Get all the resources
        $resources = $this->resource_model->get();

        //Get all pages
        $pages = $this->page_model->get();

        // Get the district admin's district
        $distAdminDistrict = '';
        if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL){ // District admin logged in
            $districtRow = $this->user_model->getUserDistrict($this->session->userdata('user_id'));
            $distAdminDistrict = $districtRow[0]['did'];
        }

        if ($this->session->userdata['role']['level'] <= SCHOOL_ADMIN_LEVEL) { // Stop school users from accessing this section of the web app

            $templateData = array(
                'page' => 'toolkit',
                'page_title' => 'Resource Toolkit Management',
                'step_title' => 'Resource Toolkit',
                'resources' => $resources,
                'pages'     =>  $pages,
                'roles' => $roles,
                'role' => $role,
                'adminDistrict' => $distAdminDistrict

            );

            $this->template->load('template', 'toolkit_screen', $templateData);

        } else { // Redirect school users to the My Account section
             redirect('/user/profile');
        }
    }
    /**
     * Action to add new Resource Toolkit Items
     *
     * @method add
     * @param string $param Optional Specifies nature of item to add default is entity
     * @param string $param2 Optional Specifies the type of the item or entity
     */
    public function add(){

        $shared = 'default';
        $district_id = null;
        $school_id = null;

        if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL){
            $shared         = 'district';
            $district_id    =  $this->session->userdata['loaded_district']['id'];
        }elseif($this->session->userdata['role']['level'] == SCHOOL_ADMIN_LEVEL){
            $shared         =   'school';
            $school_id      =   $this->session->userdata['loaded_school']['id'];
        }

        $resourceData = array(
            'name'          =>  $this->input->post('txtname'),
            'url'           =>  $this->input->post('txtURL'),
            'section'       =>  $this->input->post('slctsection'),
            'pages'         =>  $this->input->post('pages'),
            'shared'        =>  $shared,
            'district_id'   =>  $district_id,
            'school_id'     =>  $school_id
        );

        $savedRecs = $this->resource_model->add($resourceData);

        //start of file upload code
        $config = array(
            'upload_path'   =>  dirname($_SERVER["SCRIPT_FILENAME"]).'/uploads/',
            'upload_url'    =>  base_url()."uploads/",
            'overwrite'     =>  true,
            'allowed_types' =>  'doc|docx|pdf',
            'max_size'      =>  '10024KB'
        );
        $this->load->library('upload');
        $this->upload->initialize($config);
        $this->upload->do_upload('userfile');
        $data = $this->upload->data();
        //end of file upload code

        if(is_numeric($savedRecs) && $savedRecs>=1){
            $this->session->set_flashdata('success','Resource was saved successfully!');
        }
        else{
            $this->session->set_flashdata('error','Unknown error occurred while trying to save resource!');
        }

        redirect('/toolkit');

    }


    /**
     *  Update Action, allows the resource toolkit record to be updated.
     *
     * @method update
     *
     */

    public function update(){

        $shared = ($this->session->userdata['role']['level'] < STATE_ADMIN_LEVEL ) ? 'default' : $this->input->post('slctsharedupdate');
        $id=$this->input->post('updateid');

        $resourceData = array(
            'name'          =>  $this->input->post('txtnameupdate'),
            'url'           =>  $this->input->post('txtURLUpdate'),
            'section'       =>  $this->input->post('slctsectionupdate'),
            'pages'         =>  $this->input->post('pagesupdate'),
            'shared'       =>  $shared
        );


        $recs = $this->resource_model->update($id, $resourceData);

        //start of file upload code
        $config = array(
            'upload_path'   =>  dirname($_SERVER["SCRIPT_FILENAME"]).'/uploads/',
            'upload_url'    =>  base_url()."uploads/",
            'overwrite'     =>  true,
            'allowed_types' =>  'doc|docx|pdf',
            'max_size'      =>  '10024KB'
        );
        $this->load->library('upload');
        $this->upload->initialize($config);
        if($this->upload->do_upload('userfileupdate')){

        }else{
            var_dump($this->upload->display_errors());
        }
        $data = $this->upload->data();
        //end of file upload code

        if(is_numeric($recs) && $recs>0){
            $this->session->set_flashdata('success','Resource was updated successfully!');
            redirect('/toolkit');
        }
        else{
            $this->session->set_flashdata('error','Update failed!');
            redirect('/toolkit');
        }

    }


    /**
     *  Delete Action
     * @method Delete a resource item
     *
     */

    public function delete(){
        if($this->input->post('ajax')){
            $id = $this->input->post('id');
            $affectedRecs = $this->resource_model->delete(array('id'=>$id));

            if(is_numeric($affectedRecs) && $affectedRecs > 0){
                $this->session->set_flashdata('success','Resource was deleted successfully!');
                $this->output->set_output(json_encode(array(
                    'deleted' =>  TRUE
                )));
            }
            else{
                $this->session->set_flashdata('error','Operation failed!');
                $this->output->set_output(json_encode(array(
                    'deleted' =>  FALSE
                )));
            }
        }
        else{
            redirect('/toolkit');
        }
    }


    public function loadResourceCtls(){
        if($this->input->post('ajax')){

            $action = $this->input->post('action');
            $id     = $this->input->post('id');

            switch($action){
                case 'edit':
                    $resourceData = $this->resource_model->get(array('id'=>$id));

                    //Get all pages
                    $pages = $this->page_model->get();

                    // Get the role access permissions for the logged in user
                    $role = $this->user_model->getUserRole($this->session->userdata('user_id'));

                    $data = array(
                        'resource'  =>  $resourceData[0],
                        'pages'     =>  $pages,
                        'role'      =>  $role
                    );

                    $this->load->view('ajax/update_resource', $data);
                    break;
            }

        }else{
            redirect('/toolkit');
        }
    }

    public function upload(){

        $this->load->library('upload');
        $this->load->helper('file');

        $docType = $this->input->post('docType');

        $config = array(
            'upload_path'   =>  dirname($_SERVER["SCRIPT_FILENAME"]).'/uploads/',
            'upload_url'    =>  base_url()."uploads/",
            'file_name'     =>  'uploaded_EOP_resource'.$docType.time(),
            'overwrite'     =>  true,
            'allowed_types' =>  'doc|docx|pdf',
            'max_size'      =>  '10024KB'
        );
        $this->upload->initialize($config);
        if($this->upload->do_upload()){
            $fileData = $this->upload->data();

            $data = array(
                'saved' => true,
                'fileData' => array($docType => $fileData)
            );

            $this->load->view('ajax/upload', $data);

        }else{
            $data = $this->upload->display_errors();
            $this->load->view('ajax/upload', $data);
        }
    }

}