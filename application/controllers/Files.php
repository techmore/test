<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Files Controller Class
 *
 * Developed by Synergy Enterprises, Inc. for the U.S. Department of Education
 *
 * Controller Responsible for:
 *
 * - Uploaded Files Management
 *
 *
 * Date: 7/1/19 2:49 PM
 *
 * (c) 2019 United States Department of Education
 */

class Files extends CI_Controller{

    public function __construct(){
        parent::__construct();

        if($this->session->userdata('is_logged_in')){
            $this->load->model('files_model');
        }
        else{
            redirect('/login');
        }
    }

    public function index(){

        $this->authenticate();

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
            'page'          =>  'files',
            'step'          =>  'files',
            'page_title'    =>  'File Manager',
            'step_title'    =>  'File Manager',
            'files'         =>  $files
        );
        $this->template->load('template', 'files_screen', $templateData);
    }
    
    public function loadForm12Ctls(){

        if($this->input->post('ajax')) {
            
            $action = $this->input->post('action');
            $files = $this->files_model->getFiles();

            if (is_array($files) && count($files) > 0) {
                $this->load->model('school_model');
                foreach ($files as &$file) {
                    $school = $this->school_model->getSchool($file['sid']);
                    $file['school'] = ($school[0]['screen_name']) ? $school[0]['screen_name'] : $school[0]['name'];
                }
                unset($file);
            }

            $this->loadAjaxTemplate($action);

        }else{
            redirect('plan/step5/4');
        }
        
    }


    public function upload(){

        $error = false;

        if (isset($_FILES['userfile']) && count($_FILES['userfile']) > 0) {

            $files = $_FILES['userfile'];

            $config = array(
                'upload_path' => dirname($_SERVER["SCRIPT_FILENAME"]) . '/uploads/files/',
                'upload_url' => base_url() . "uploads/files/",
                'overwrite' => true,
                'allowed_types' => 'jpg|jpeg|png|gif|docx|doc|xlsx|xls|pptx|ppt|pdf|txt',
                'max_size' => '100024KB'
            );

            $this->load->library('upload', $config);

            $userfiles = array();

            $titles = $this->input->post('title');

            foreach ($files['name'] as $key => $userfile) {
                $_FILES['userfile[]']['name']       = $files['name'][$key];
                $_FILES['userfile[]']['type']       = $files['type'][$key];
                $_FILES['userfile[]']['tmp_name']   = $files['tmp_name'][$key];
                $_FILES['userfile[]']['error']      = $files['error'][$key];
                $_FILES['userfile[]']['size']       = $files['size'][$key];

                $userfiles[] = $files['name'][$key];
                $config['file_name'] = $this->sanitizeFileName($files['name'][$key]);

                $this->upload->initialize($config);


                if ($this->upload->do_upload('userfile[]')) {
                    $fileData = $this->upload->data();

                    $sid = isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : NULL;
                    $did = isset($this->session->userdata['loaded_school']['district_id']) ? $this->session->userdata['loaded_school']['district_id'] : NULL;

                    $data = array(
                        'name'  =>  $titles[$key],
                        'data'  =>  json_encode($fileData),
                        'owner' =>  $this->session->userdata('user_id'),
                        'sid'   =>  $sid,
                        'did'   =>  $did
                    );
                    
                    $this->files_model->addFile($data);

                } else {
                    $error = array('error' => $this->upload->display_errors());
                }
            }
            if (!$error) {
                $this->session->set_flashdata('success', 'Data saved successfully!');
            } else {
                $this->session->set_flashdata('error', "An error occurred during the upload! <br/> {$error}");
            }

            redirect('/files');
        }
    }

    public function uploadFromStep5(){

        $error = false;

        if (isset($_FILES['userfile']) && count($_FILES['userfile']) > 0) {

            $files = $_FILES['userfile'];

            $config = array(
                'upload_path' => dirname($_SERVER["SCRIPT_FILENAME"]) . '/uploads/files/',
                'upload_url' => base_url() . "uploads/files/",
                'overwrite' => true,
                'allowed_types' => 'jpg|jpeg|png|gif|docx|doc|xlsx|xls|pptx|ppt|pdf|txt',
                'max_size' => '100024KB'
            );

            $this->load->library('upload', $config);

            $userfiles = array();

            $titles = $this->input->post('title');

            foreach ($files['name'] as $key => $userfile) {
                $_FILES['userfile[]']['name']       = $files['name'][$key];
                $_FILES['userfile[]']['type']       = $files['type'][$key];
                $_FILES['userfile[]']['tmp_name']   = $files['tmp_name'][$key];
                $_FILES['userfile[]']['error']      = $files['error'][$key];
                $_FILES['userfile[]']['size']       = $files['size'][$key];

                $userfiles[] = $files['name'][$key];
                $config['file_name'] = $this->sanitizeFileName($files['name'][$key]);

                $this->upload->initialize($config);


                if ($this->upload->do_upload('userfile[]')) {
                    $fileData = $this->upload->data();

                    $sid = isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : NULL;
                    $did = isset($this->session->userdata['loaded_school']['district_id']) ? $this->session->userdata['loaded_school']['district_id'] : NULL;

                    $data = array(
                        'name'  =>  $titles[$key],
                        'data'  =>  json_encode($fileData),
                        'owner' =>  $this->session->userdata('user_id'),
                        'sid'   =>  $sid,
                        'did'   =>  $did
                    );

                    $this->files_model->addFile($data);

                } else {
                    $error = array('error' => $this->upload->display_errors());
                }
            }
            if (!$error) {
                $this->session->set_flashdata('success', 'Data saved successfully!');
            } else {
                $this->session->set_flashdata('error', "An error occurred during the upload! <br/> {$error}");
            }
        }

        redirect('plan/step5/4');
    }

    public function loadAjaxTemplate($action='view'){
        $files = $this->files_model->getFiles();
        $templateData = array(
            'action' => ($action == 'edit') ? 'edit' : 'view',
            'files' => $files
        );

        $this->load->view('ajax/form12', $templateData);
    }

    public function delete($id=0){
        if(is_numeric($id) && $id>0){

            $file = $this->files_model->getFile($id);
            $file_data = json_decode($file[0]['data'], true);
            
            unlink($file_data['full_path']);
            $this->files_model->deleteFile($id);

            $this->session->set_flashdata('success', 'File Deleted successfully!');
        }

        redirect('/files');
    }

    public function deleteFromPlanScreen($id=0){
        if($this->input->post('ajax')) {

            if(is_numeric($id) && $id>0){

                $file = $this->files_model->getFile($id);
                $file_data = json_decode($file[0]['data'], true);

                unlink($file_data['full_path']);
                $this->files_model->deleteFile($id);
            }
            $action = $this->input->post('action');
            $this->loadAjaxTemplate($action);

        }else{
            redirect('plan/step5/4');
        }
    }

    public static function sanitizeFileName ($str = '')
    {
        $str = strip_tags($str);
        $str = preg_replace('/[\r\n\t ]+/', ' ', $str);
        $str = preg_replace('/[\"\*\/\:\<\>\?\'\|]+/', ' ', $str);
        $str = strtolower($str);
        $str = html_entity_decode( $str, ENT_QUOTES, "utf-8" );
        $str = htmlentities($str, ENT_QUOTES, "utf-8");
        $str = preg_replace("/(&)([a-z])([a-z]+;)/i", '$2', $str);
        $str = str_replace(' ', '-', $str);
        $str = rawurlencode($str);
        $str = str_replace('%', '-', $str);
        return $str;
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