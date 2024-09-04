<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Team Controller Class
 *
 * Developed by Synergy Enterprises, Inc. for the U.S. Department of Education
 *
 * Exercise Responsible for:
 *
 * - Managing Exercises or Drills
 *
 *
 * Date: 5/29/19 12:00 PM
 *
 * (c) 2015 United States Department of Education
 */

/**
 * Created by PhpStorm.
 * User: godfreymajwega
 * Date: 5/29/19
 * Time: 11:59 AM
 */
class Exercise extends CI_Controller{

    public function __construct(){
        parent::__construct();

        if($this->session->userdata('is_logged_in')){
            $this->load->model('exercise_model');
            $this->load->library('upload');

        }
        else{
            redirect('/login');
        }
    }

    public function index(){

        $this->authenticate();
    }

    public function add(){
        $this->load->helper('string');
        $file_id = random_string('alnum', 16);
        $fileData = array();

        $config = array(
            'upload_path'   =>  dirname($_SERVER["SCRIPT_FILENAME"]).'/uploads/attachments/',
            'upload_url'    =>  base_url()."uploads/attachments/",
            'file_name'     =>  'attachment_'.$file_id,
            'overwrite'     =>  true,
            'allowed_types' =>  'doc|docx|jpg|jpeg|png|xls|xlsx|pdf',
            'max_size'      =>  '10024KB'
        );

        $this->upload->initialize($config);

        if($this->upload->do_upload('fileupload')) {
            $fileData = $this->upload->data();
        }

        $data = array(
            'name'          =>  $this->input->post('txtname'),
            'type'         =>   $this->input->post('txttype'),
            'date'          =>  $this->input->post('txtDate'),
            'location'      =>  $this->input->post('txtlocation'),
            'contact'       =>  $this->input->post('txtcontact'),
            'description'   =>  $this->input->post('txtdescription'),
            'owner'         =>  $this->session->userdata('user_id'),
            'file'          =>  json_encode($fileData),
            'host'          =>  $this->input->post('txtHost')
        );

        if(isset($this->session->userdata['loaded_school']['id']) && null != $this->session->userdata['loaded_school']['id']){
            $data['sid']    = $this->session->userdata['loaded_school']['id'];
        }

        if(isset($this->session->userdata['loaded_school']['district_id']) && null != $this->session->userdata['loaded_school']['district_id']){
            $data['did']    = $this->session->userdata['loaded_school']['district_id'];
        }else if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL){
            $data['did'] = $this->session->userdata['loaded_district']['id'];
        }
        
        $savedRecs = $this->exercise_model->addExercise($data);

        if(is_numeric($savedRecs) && $savedRecs>=1){
            $this->session->set_flashdata('success','Data was saved successfully!');
            $this->output->set_output(json_encode(array(
                'saved' =>  TRUE
            )));
        }
        else{
            $this->session->set_flashdata('error','Unknown error occurred while trying to save data!');
            $this->output->set_output(json_encode(array(
                'saved' =>  FALSE
            )));
        }

        redirect('/plan/step6/3');
    }

    /**
     * Show Action
     * Returns all exercises that satisfy certain criteria
     * @method show
     * @param string param all|id of exercise being requested
     *
     */
    public function show(){
        if($this->input->post('ajax')){

            $exerciseData =null;
            $param = $this->input->post('param');
            $schoolCondition = '';


            if(isset($this->session->userdata['loaded_school']['id'])){
                $schoolCondition = array('sid'=>$this->session->userdata['loaded_school']['id']);
            }

            $exerciseData = $this->exercise_model->getExercises($schoolCondition);


            $data= array(
                'exerciseData' => $exerciseData
            );

            $this->load->view('ajax/exercise', $data);


        }else{
            redirect('plan/step6/3');
        }
    }


    /**
     *  Edit Action
     * @method update This method enables updates/edits of the exercises or drills
     *
     */

    public function update(){

        $data = array(
            'name'          =>  $this->input->post('updatetxtname'),
            'type'          =>  $this->input->post('updatetxttype'),
            'location'      =>  $this->input->post('updatetxtlocation'),
            'contact'       =>  $this->input->post('updatetxtcontact'),
            'date'          =>  $this->input->post('updatetxtdate'),
            'description'   =>  $this->input->post('updatetxtdescription'),
            'host'          =>  $this->input->post('updateTxtHost')
        );

        if($this->input->post('checkbox_replace')=='yes'){
            $this->load->helper('string');
            $file_id = random_string('alnum', 16);
            $fileData = array();

            $config = array(
                'upload_path'   =>  dirname($_SERVER["SCRIPT_FILENAME"]).'/uploads/attachments/',
                'upload_url'    =>  base_url()."uploads/attachments/",
                'file_name'     =>  'attachment_'.$file_id,
                'overwrite'     =>  true,
                'allowed_types' =>  'doc|docx|jpg|jpeg|png|xls|xlsx|pdf',
                'max_size'      =>  '10024KB'
            );

            $this->upload->initialize($config);

            if($this->upload->do_upload('updatefileupload')) {
                $fileData = $this->upload->data();
            }else{
                $exercise = $this->exercise_model->getExercise($this->input->post('updateid'));

                if($exercise){
                    $fData = json_decode($exercise[0]['file'], true);
                    if($fData && is_array($fData) && count($fData)>0)
                        unlink($fData['full_path']);
                }
            }

            $data['file'] = json_encode($fileData);
        }



        $recs = $this->exercise_model->update($this->input->post('updateid'), $data);

        if(is_numeric($recs) && $recs>0){
            $this->session->set_flashdata('success','Data was saved successfully!');
            redirect('plan/step6/3');
        }
        else{
            $this->session->set_flashdata('error','Update failed!');
            redirect('plan/step6/3');
        }

    }

    public function delete(){
        if($this->input->post('ajax')){
            $id = $this->input->post('id');
            $exercise = $this->exercise_model->getExercise($id);

            if($exercise){
                $fileData = json_decode($exercise[0]['file'], true);
                if($fileData && is_array($fileData) && count($fileData)>0)
                    unlink($fileData['full_path']);
            }

            $affectedRecs = $this->exercise_model->deleteExercise($id);

            if(is_numeric($affectedRecs) && $affectedRecs>0){
                $this->session->set_flashdata('success','Data was deleted successfully!');
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
        }else{
            redirect('plan/step6/3');
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


}