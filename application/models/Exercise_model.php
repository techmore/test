<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exercise_model extends CI_Model {

    public function __construct(){
        parent::__construct();

        $this->load->model('user_model');
        $this->load->model('school_model');
    }


    function addExercise($data){

        $this->db->insert('eop_exercise', $data);
        $affected_rows = $this->db->affected_rows();

        return $affected_rows;
    }

    function deleteExercise($id){
        $this->db->delete('eop_exercise', array('id'=>$id));
        return $this->db->affected_rows();
    }
 
    function update($id, $data){
        $this->db->where('id', $id);
        $this->db->update('eop_exercise', $data);

        return $this->db->affected_rows();

    }


    /**
     * Function to return an exercise/drill by its id
     *
     * @method getExercise
     * @param $p The exercise id
     * @return mixed Returns an associative array containing the exercise information from the database
     */
    function getExercise($p){

        $conditions = array('id'=>$p);

        $query = $this->db->limit(1)->get_where('eop_exercise', $conditions);

        return $query->result_array();
    }

    function getExercises($data='', $advanced_search=false){
        if($data ==''){

            if($this->session->userdata['role']['level']>= SCHOOL_ADMIN_LEVEL){ //School Admins and Users

                //Load members for their respective school only
                $conditions['sid'] = $this->session->userdata['loaded_school']['id'];
                $this->db->order_by('name', 'ASC');
                $query = $this->db->get_where('eop_exercise', $conditions);

            }elseif($this->session->userdata['role']['level']== DISTRICT_ADMIN_LEVEL){ //District admin

                //Load members for all schools in the district
                /*$district = $this->user_model->getUserDistrict($this->session->userdata('user_id'));
                $districtId = $district[0]['did'];
                $schools = $this->school_model->getDistrictSchools($districtId);
                $schoolIds = array();
                foreach($schools as $school){
                    $schoolIds[] = $school['id'];
                }*/

                $this->db->select("*")
                    ->from('eop_exercise')
                    ->order_by('name', 'ASC')
                    ->where(array('did'=>$this->session->userdata['loaded_district']['id'], 'sid'=>NULL));
                    //->or_where_in('sid', $schoolIds);
                $query = $this->db->get();

            }elseif($this->session->userdata['role']['level']== STATE_ADMIN_LEVEL){ //State admin
                $this->db->order_by('name', 'ASC');
                $query = $this->db->get('eop_exercise');
            }else{

                $this->db->order_by('name', 'ASC');
                $query = $this->db->get('eop_exercise');
            }


            return $query->result_array();

        }elseif($advanced_search){

            if($this->session->userdata['role']['level']>= SCHOOL_ADMIN_LEVEL) { //School Admins and Users
                $this->db->select("*")
                    ->from('eop_exercise')
                    ->order_by('name', 'ASC')
                    ->where('sid', $this->session->userdata['loaded_school']['id']);
                if($data['type'])
                    $this->db->where('type', $data['type']);
                if($data['to'] && $data['from'])
                    $this->db->where("date BETWEEN '". $data['from'] ."' AND '". $data['to'] ."'");

                $query = $this->db->get();

                return $query->result_array();
            }elseif($this->session->userdata['role']['level']== DISTRICT_ADMIN_LEVEL) { //District admin


                $this->db->select("*")
                    ->from('eop_exercise')
                    ->order_by('name', 'ASC')
                    ->where('did', $this->session->userdata['loaded_district']['id']);

                if($data['type'])
                    $this->db->where('type', $data['type']);

                if($data['to'] && $data['from'])
                    $this->db->where("date BETWEEN '". $data['from'] ."' AND '". $data['to'] ."'");

                if($data['school_id']){
                    $this->db->where('sid', $data['school_id']);
                }

                if($data['host'])
                    $this->db->where('host', $data['host']);


                $query = $this->db->get();

                return $query->result_array();

            }else{ // State and Super Admins

                $this->db->select("*")
                    ->from('eop_exercise')
                    ->order_by('name', 'ASC');

                if($data['type'])
                    $this->db->where('type', $data['type']);

                if($data['to'] && $data['from'])
                    $this->db->where("date BETWEEN '". $data['from'] ."' AND '". $data['to'] ."'");

                if($data['school_id']){
                    $this->db->where('sid', $data['school_id']);
                }

                if($data['host'])
                    $this->db->where('host', $data['host']);

                if($data['district_id'])
                    $this->db->where('did', $data['district_id']);


                $query = $this->db->get();

                return $query->result_array();
            }

        }else{

            $conditions=$data;
            $this->db->order_by('name', 'ASC');
            $query = $this->db->get_where('eop_exercise', $conditions);

            return $query->result_array();

        }

    }

}