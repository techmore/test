<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Team_model extends CI_Model {

    public function __construct(){
        parent::__construct();

        $this->load->model('user_model');
        $this->load->model('school_model');
    }


    function addMember($data){

        $this->db->insert('eop_team', $data);
        $affected_rows = $this->db->affected_rows();

        return $affected_rows;
    }

    function deleteMember($id){
        $this->db->delete('eop_team', array('id'=>$id));
        return $this->db->affected_rows();
    }
 
    function update($id, $data){
        $this->db->where('id', $id);
        $this->db->update('eop_team', $data);

        return $this->db->affected_rows();

    }


    /**
     * Function to return a member by their member_id
     *
     * @method getMember
     * @param $p The member_id
     * @return mixed Returns an associative array of containing the user information from the database
     */
    function getMember($p, $key=''){

        $conditions = array('id'=>$p);

        $query = $this->db->get_where('eop_team', $conditions);

        return $query->result_array();
    }

    function getMembers($data=''){
        if($data ==''){

            if($this->session->userdata['role']['level']>=4){ //School Admins and Users

                //Load members for their respective school only
                $conditions['sid'] = $this->session->userdata['loaded_school']['id'];
                $this->db->order_by('name', 'ASC');
                $query = $this->db->get_where('eop_team', $conditions);

            }elseif($this->session->userdata['role']['level']==3){ //District admin

                //Load members for all schools in the district
                $district = $this->user_model->getUserDistrict($this->session->userdata('user_id'));
                $districtId = $district[0]['did'];
                $schools = $this->school_model->getDistrictSchools($districtId);
                $schoolIds = array();
                foreach($schools as $school){
                    $schoolIds[] = $school['id'];
                }

                $this->db->select("*")
                    ->from('eop_team')
                    ->order_by('name', 'ASC')
                    ->where_in('sid', $schoolIds);
                $query = $this->db->get();

            }else{

                $this->db->order_by('name', 'ASC');
                $query = $this->db->get('eop_team');
            }


            return $query->result_array();

        }else{

            $conditions=$data;
            $this->db->order_by('name', 'ASC');
            $query = $this->db->get_where('eop_team', $conditions);

            return $query->result_array();

        }

    }

}