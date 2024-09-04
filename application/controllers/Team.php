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

class Team extends CI_Controller{


    public function __construct(){
        parent::__construct();

        if($this->session->userdata('is_logged_in')){
            $this->load->model('team_model');

        }
        else{
            redirect('/login');
        }
    }

    public function index(){

       $this->authenticate();
    }


    public function add(){
        if($this->input->post('ajax')){

            $data = array(
                'name'          =>  $this->input->post('name'),
                'title'         =>  $this->input->post('title'),
                'organization'  =>  $this->input->post('organization'),
                'email'         =>  $this->input->post('email'),
                'phone'         =>  $this->input->post('phone'),
                'interest'      =>  $this->input->post('interest'),
                'owner'         =>  $this->session->userdata('user_id')
            );


            if(isset($this->session->userdata['loaded_school']['id']) && null != $this->session->userdata['loaded_school']['id']){
                $data['sid']    = $this->session->userdata['loaded_school']['id'];
            }

            if(isset($this->session->userdata['loaded_school']['district_id']) && null != $this->session->userdata['loaded_school']['district_id']){
                $data['did']    = $this->session->userdata['loaded_school']['district_id'];
            }

            $savedRecs = $this->team_model->addMember($data);

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

        }else{ // Redirect to plan step1_2
            redirect('plan/step1/2');
        }


    }

    public function delete(){
        if($this->input->post('ajax')){
            $id = $this->input->post('id');
            $affectedRecs = $this->team_model->deleteMember($id);

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
            redirect('plan/step1/2');
        }
    }

    /**
     * Show Action
     * Returns all team members that satisfy a given criteria
     * @method show
     * @param string param all|id of team member being requested
     *
     */
    public function show(){
        if($this->input->post('ajax')){

            $memberData =null;
            $param = $this->input->post('param');
            $schoolCondition = '';


            if(isset($this->session->userdata['loaded_school']['id'])){
                $schoolCondition = array('sid'=>$this->session->userdata['loaded_school']['id']);
            }

            $memberData = $this->team_model->getMembers($schoolCondition);


            $data= array(
                'memberData' => $memberData
            );

            $this->load->view('ajax/team_members', $data);


        }else{
            redirect('plan/step1/2');
        }
    }

    /**
     *  Edit Action
     * @method update This method enables updates/edits of the user information
     *
     */
  
    public function update(){

        $data = array(
            'name'          =>  $this->input->post('updatetxtname'),
            'title'         =>  $this->input->post('updatetxttitle'),
            'organization'  =>  $this->input->post('updatetxtorganization'),
            'email'         =>  $this->input->post('updatetxtemail'),
            'phone'         =>  $this->input->post('updatetxtphone'),
            'interest'      =>  implode(", ", $this->input->post('updateinterests'))
        );

        $recs = $this->team_model->update($this->input->post('updateid'), $data);

        if(is_numeric($recs) && $recs>0){
            $this->session->set_flashdata('success','Data was saved successfully!');
            redirect('plan/step1/2');
        }
        else{
            $this->session->set_flashdata('error','Update failed!');
            redirect('plan/step1/2');
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