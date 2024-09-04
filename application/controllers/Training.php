<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Training Controller Class
 *
 * Developed by Synergy Enterprises, Inc. for the U.S. Department of Education
 *
 * Training Responsible for:
 *
 * - Managing Trainings
 *
 *
 * Date: 7/22/20 12:00 PM
 *
 * (c) 2020 United States Department of Education
 */

/**
 * Created by PhpStorm.
 * User: godfreymajwega
 * Date: 7/22/20
 * Time: 11:59 AM
 */
class Training extends CI_Controller{

    public function __construct(){
        parent::__construct();

        if($this->session->userdata('is_logged_in')){
            $this->load->model('training_model');
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
            'name'          =>  $this->input->post('txtName'),
            'topic'         =>  $this->input->post('txtTopic'),
            'format'        =>  $this->input->post('txtFormat'),
            'date'          =>  $this->input->post('txtDate'),
            'location'      =>  $this->input->post('txtLocation'),
            'participants'  =>  $this->input->post('txtParticipants'),
            'personnel'     =>  implode ("," , $this->input->post('checkPersonnel', true) ),
            'score'         =>  $this->input->post('txtScore'),
            'description'   =>  $this->input->post('txtDescription'),
            'provider'      =>  $this->input->post('providedBy', true),
            'schools'       =>  $this->input->post('txtSchools', true),
            'leas'          =>  $this->input->post('txtLEAs', true),
            'rleas'         =>  $this->input->post('txtRLEAs', true),
            'owner'         =>  $this->session->userdata('user_id'),
            'file'          =>  json_encode($fileData)
        );

        $otherTopic    =  $this->input->post('txtOtherTopic');

        if($data['topic'] == 'Other related emergency management topic'){
            $data['topic'] = $otherTopic;
        }

        if(isset($this->session->userdata['loaded_school']['id']) && null != $this->session->userdata['loaded_school']['id']){
            $data['sid']    = $this->session->userdata['loaded_school']['id'];
        }

        if(isset($this->session->userdata['loaded_school']['district_id']) && null != $this->session->userdata['loaded_school']['district_id']){
            $data['did']    = $this->session->userdata['loaded_school']['district_id'];
        }else if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL){
            $data['did'] = $this->session->userdata['loaded_district']['id'];
        }elseif($this->session->userdata['role']['level'] == STATE_ADMIN_LEVEL){
            $data['provider'] = 'state-provided';
        }

        $savedRecs = $this->training_model->addTraining($data);

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

        redirect('/plan/step6/2');
    }

    /**
     * Show Action
     * Returns all trainings that satisfy certain criteria
     * @method show
     * @param string param all|id of training being requested
     *
     */
    public function show(){
        if($this->input->post('ajax')){

            $trainingData =null;
            $param = $this->input->post('param');
            $schoolCondition = '';


            if(isset($this->session->userdata['loaded_school']['id'])){
                $schoolCondition = array('sid'=>$this->session->userdata['loaded_school']['id']);
            }

            $trainingData = $this->training_model->getTrainings($schoolCondition);
            $custom_topics = $this->training_model->getCustomTrainingTopics();


            $data= array(
                'trainingData'  => $trainingData,
                'custom_topics' => $custom_topics
            );

            $this->load->view('ajax/training', $data);


        }else{
            redirect('plan/step6/2');
        }
    }


    /**
     *  Edit Action
     * @method update This method enables updates/edits of the training
     *
     */

    public function update(){

        $data = array(
            
            'name'          =>  $this->input->post('updateTxtName'),
            'topic'         =>  $this->input->post('updateTxtTopic'),
            'format'        =>  $this->input->post('updateTxtFormat'),
            'date'          =>  $this->input->post('updateTxtDate'),
            'location'      =>  $this->input->post('updateTxtLocation'),
            'participants'  =>  $this->input->post('updateTxtParticipants'),
            'personnel'     =>  implode ("," , $this->input->post('updateCheckPersonnel', true) ),
            'score'         =>  $this->input->post('updateTxtScore'),
            'description'   =>  $this->input->post('updateTxtDescription'),
            'provider'      =>  $this->input->post('updateProvidedBy', true),
            'schools'       =>  $this->input->post('updateTxtSchools', true),
            'leas'          =>  $this->input->post('updateTxtLEAs', true),
            'rleas'         =>  $this->input->post('updateTxtRLEAs', true),
            'owner'         =>  $this->session->userdata('user_id')
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

            if($this->upload->do_upload('updateFileupload')) {
                $fileData = $this->upload->data();
            }else{
                $training = $this->training_model->getTraining($this->input->post('updateid'));

                if($training){
                    $fData = json_decode($training[0]['file'], true);
                    if($fData && is_array($fData) && count($fData)>0)
                        unlink($fData['full_path']);
                }
            }

            $data['file'] = json_encode($fileData);
        }



        $recs = $this->training_model->update($this->input->post('updateid'), $data);

        if(is_numeric($recs) && $recs>0){
            $this->session->set_flashdata('success','Data was saved successfully!');
            redirect('plan/step6/2');
        }
        else{
            $this->session->set_flashdata('error','Update failed!');
            redirect('plan/step6/2');
        }

    }

    public function delete(){
        if($this->input->post('ajax')){
            $id = $this->input->post('id');
            $training = $this->training_model->getTraining($id);

            if($training){
                $fileData = json_decode($training[0]['file'], true);
                if($fileData && is_array($fileData) && count($fileData)>0)
                    unlink($fileData['full_path']);
            }

            $affectedRecs = $this->training_model->deleteTraining($id);

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
            redirect('plan/step6/2');
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