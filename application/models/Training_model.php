<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Training_model extends CI_Model {

    public function __construct(){
        parent::__construct();

        $this->load->model('user_model');
        $this->load->model('school_model');
    }


    function addTraining($data){

        $this->db->insert('eop_training', $data);
        $affected_rows = $this->db->affected_rows();

        return $affected_rows;
    }

    function deleteTraining($id){
        $this->db->delete('eop_training', array('id'=>$id));
        return $this->db->affected_rows();
    }

    function update($id, $data){
        $this->db->where('id', $id);
        $this->db->update('eop_training', $data);

        return $this->db->affected_rows();

    }


    /**
     * Function to return a training by its id
     *
     * @method getTraining
     * @param $p The training id
     * @return mixed Returns an associative array containing the training information from the database
     */
    function getTraining($p){

        $conditions = array('id'=>$p);

        $query = $this->db->limit(1)->get_where('eop_training', $conditions);

        return $query->result_array();
    }
    
    function getCustomTrainingTopics(){
        
        if($this->session->userdata['role']['level']>= SCHOOL_ADMIN_LEVEL) { //School Admins and Users
            $sid = $this->session->userdata['loaded_school']['id'];
            $query = $this->db->query("SELECT DISTINCT topic FROM eop_training WHERE sid=$sid AND topic NOT IN('Developing high-quality EOPs', 'Developing and enhancing memoranda of understanding with community partners', 'Supporting the implementation of the National Incident Management System','Access and functional needs')");
        }elseif($this->session->userdata['role']['level']== DISTRICT_ADMIN_LEVEL) { //District admin
            //Load trainings for all schools in the district
            $district = $this->user_model->getUserDistrict($this->session->userdata('user_id'));
            $districtId = $district[0]['did'];
            $schools = $this->school_model->getDistrictSchools($districtId);
            $schoolIds = array();
            foreach($schools as $school){
                $schoolIds[] = $school['id'];
            }
            
            $schools = implode(",", $schoolIds);

            $did = $this->session->userdata['loaded_district']['id'];
            $query = $this->db->query("SELECT DISTINCT topic FROM eop_training WHERE (did=$did OR sid IN($schools)) AND topic NOT IN('Developing high-quality EOPs', 'Developing and enhancing memoranda of understanding with community partners', 'Supporting the implementation of the National Incident Management System','Access and functional needs')");
            
        }elseif($this->session->userdata['role']['level']== STATE_ADMIN_LEVEL){ //State admin
            
            $query = $this->db->query("SELECT DISTINCT topic FROM eop_training WHERE topic NOT IN('Developing high-quality EOPs', 'Developing and enhancing memoranda of understanding with community partners', 'Supporting the implementation of the National Incident Management System','Access and functional needs')");
        }else{
            $query = $this->db->query("SELECT DISTINCT topic FROM eop_training WHERE topic NOT IN('Developing high-quality EOPs', 'Developing and enhancing memoranda of understanding with community partners', 'Supporting the implementation of the National Incident Management System','Access and functional needs')");
        }

        return $query->result_array();
    }

    function getTrainings($data='', $advanced_search=false){
        if($data ==''){

            if($this->session->userdata['role']['level']>= SCHOOL_ADMIN_LEVEL){ //School Admins and Users

                //Load trainings for their respective school only
                $conditions['sid'] = $this->session->userdata['loaded_school']['id'];
                $this->db->order_by('name', 'ASC');
                $query = $this->db->get_where('eop_training', $conditions);

            }elseif($this->session->userdata['role']['level']== DISTRICT_ADMIN_LEVEL){ //District admin

                //Load trainings for all schools in the district
                /*$district = $this->user_model->getUserDistrict($this->session->userdata('user_id'));
                $districtId = $district[0]['did'];
                $schools = $this->school_model->getDistrictSchools($districtId);
                $schoolIds = array();
                foreach($schools as $school){
                    $schoolIds[] = $school['id'];
                }*/

                $this->db->select("*")
                    ->from('eop_training')
                    ->order_by('name', 'ASC')
                    ->where(array('did'=>$this->session->userdata['loaded_district']['id'], 'sid'=>NULL));


                $query = $this->db->get();

                
            }elseif($this->session->userdata['role']['level']== STATE_ADMIN_LEVEL){ //State admin
                $this->db->order_by('name', 'ASC');
                $query = $this->db->get('eop_training');
            }else{

                $this->db->order_by('name', 'ASC');
                $query = $this->db->get('eop_training');
            }


            return $query->result_array();

        }elseif($advanced_search){

            if($this->session->userdata['role']['level']>= SCHOOL_ADMIN_LEVEL) { //School Admins and Users
                $this->db->select("*")
                    ->from('eop_training')
                    ->order_by('name', 'ASC')
                    ->where('sid', $this->session->userdata['loaded_school']['id']);
                if($data['topic'])
                    $this->db->where('topic', $data['topic']);
                if($data['to'] && $data['from'])
                    $this->db->where("date BETWEEN '". $data['from'] ."' AND '". $data['to'] ."'");

                $query = $this->db->get();

                return $query->result_array();
            }elseif($this->session->userdata['role']['level']== DISTRICT_ADMIN_LEVEL) { //District admin

                $this->db->select("*")
                    ->from('eop_training')
                    ->order_by('name', 'ASC')
                    ->where('did', $this->session->userdata['loaded_district']['id']);

                if($data['topic'])
                    $this->db->where('topic', $data['topic']);
                if($data['to'] && $data['from'])
                    $this->db->where("date BETWEEN '". $data['from'] ."' AND '". $data['to'] ."'");

                if($data['school_id']){
                    $this->db->where('sid', $data['school_id']);
                }

                if($data['host'])
                    $this->db->where('provider', $data['host']);

                $query = $this->db->get();

                return $query->result_array();


            }else{

                $this->db->select("*")
                    ->from('eop_training')
                    ->order_by('name', 'ASC');


                if($data['topic'])
                    $this->db->where('topic', $data['topic']);
                if($data['to'] && $data['from'])
                    $this->db->where("date BETWEEN '". $data['from'] ."' AND '". $data['to'] ."'");

                if($data['school_id']){
                    $this->db->where('sid', $data['school_id']);
                }

                if($data['host'])
                    $this->db->where('provider', $data['host']);

                $query = $this->db->get();

                return $query->result_array();
            }

        }else{

            $conditions=$data;
            $this->db->order_by('name', 'ASC');
            $query = $this->db->get_where('eop_training', $conditions);

            return $query->result_array();

        }

    }

}