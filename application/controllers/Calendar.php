<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Calendar Controller Class
 *
 * Developed by Synergy Enterprises, Inc. for the U.S. Department of Education
 *
 * Team Responsible for:
 *
 * - Managing Events calendar operations
 *
 *
 * Date: 6/02/15 02:34 PM
 *
 * (c) 2015 United States Department of Education
 */

class Calendar extends CI_Controller{


    public function __construct(){
        parent::__construct();

        if($this->session->userdata('is_logged_in')){
            $this->load->model('calendar_model');
            $this->load->model('school_model');

            $this->load->helper('calendar_helper');
        }
        else{
            redirect('/login');
        }
    }

    public function index(){

       $this->authenticate();

        $templateData = array(
            'page'          =>  'calendar',
            'step'          =>  'calendar',
            'page_title'    =>  'Calendar',
            'step_title'    =>  'Calendar'
        );
        $this->template->load('template', 'calendar_screen', $templateData);
    }


    public function read(){
        if($this->input->post('ajax')){

            $eventsData = $this->calendar_model->getEvents();

            $this->output->set_output(json_encode($eventsData));
        }else{
            redirect('/calendar');
        }
    }

    public function listTime(){
        if($this->input->post('ajax')){
            $eventId = $this->input->post('event_id');

            $eventData = $this->calendar_model->getEvent($eventId);
            $selectedDate = $eventData['start_time'];
            $startDate = $eventData['start_time'];
            $endDate = $eventData['end_time'];
            $data = list_time( $selectedDate, $startDate, $endDate );

            $this->output->set_output($data);

        }else{
            redirect('/calendar');
        }
    }

    public function makeTime(){
        if($this->input->post('ajax')){
            $selectedDate = $this->input->post('selectedDate');
            $data = list_time ( $selectedDate );

            $this->output->set_output($data);

        }else{
            redirect('/calendar');
        }
    }

    public function add(){

        if($this->input->post('ajax')){

            $data = array(
                'title'         =>  $this->input->post('title'),
                'start_time'    =>  $this->input->post('start'),
                'end_time'      =>  $this->input->post('end'),
                'location'      =>  $this->input->post('location'),
                'body'          =>  $this->input->post('body'),
                'modified_by'   =>  $this->session->userdata('user_id'),
                'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null
            );

            $savedRecs = $this->calendar_model->addEvent($data);
        }
        else{
            redirect('/calendar');
        }

    }

    public function update(){

        if($this->input->post('ajax')){
            $id = $this->input->post('id');
            $data = array(
                'title'         =>  $this->input->post('title'),
                'start_time'    =>  $this->input->post('start'),
                'end_time'      =>  $this->input->post('end'),
                'location'      =>  $this->input->post('location'),
                'body'          =>  $this->input->post('body')
            );

            $savedRecs = $this->calendar_model->updateEvent($id, $data);
        }
        else{
            redirect('/calendar');
        }

    }

    public function updateEventDate(){
        if($this->input->post('ajax')){
            $id = $this->input->post('id');

            $data = array(
                'start_time'    =>  convertToCalendarEvent($this->input->post('start')),
                'end_time'      =>  convertToCalendarEvent($this->input->post('end'))
            );

            $savedRecs = $this->calendar_model->updateEvent($id, $data);
        }
        else{
            redirect('/calendar');
        }
    }

    public function delete(){

        if($this->input->post('ajax')){
            $id = $this->input->post('id');

            $savedRecs = $this->calendar_model->deleteEvent($id);
        }
        else{
            redirect('/calendar');
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