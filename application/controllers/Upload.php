<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Team Controller Class
 *
 * Developed by Synergy Enterprises, Inc. for the U.S. Department of Education
 *
 * Team Responsible for:
 *
 * - Managing team members
 *
 *
 * Date: 6/02/15 02:34 PM
 *
 * (c) 2015 United States Department of Education
 */

class Upload extends CI_Controller{


    public function __construct(){
        parent::__construct();

        if($this->session->userdata('is_logged_in')){
            $this->load->library('upload');
            $this->load->helper('file');
        }
        else{
            redirect('/login');
        }
    }

    public function index(){
       $this->authenticate();

        $this->load->view('upload');
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
}