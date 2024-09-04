<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: GMajwega
 * Date: 5/8/15
 * Time: 1:03 PM
 */

class District_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }


    function addDistrict($districtData){


        $this->db->insert('eop_district', $districtData);
        return $this->db->affected_rows();

    }
 
    function update($data=array()){

        $updateData = array(
            'name'           =>  $data['name'],
            'screen_name'    =>  $data['screen_name']
        );

        $this->db->where('id', $data['id']);
        $this->db->update('eop_district', $updateData);

        return $this->db->affected_rows();
    }

    function updateDistrict($did, $data){
        
        $this->db->where('id', $did);
        $this->db->update('eop_district', $data);

        return $this->db->affected_rows();
    }

    function deleteDistrict($did){

        $this->db->delete('eop_district', array('id'=>$did));
        $deletedDistricts = $this->db->affected_rows();


        if(is_numeric($deletedDistricts) && $deletedDistricts>0){

            $this->load->model('school_model');
            $districtSchools = $this->school_model->getDistrictSchools($did);
            if(is_array($districtSchools) && count($districtSchools)>0){

                foreach($districtSchools as $school){
                    $this->school_model->deleteSchool($school['id']);
                }
            }

            $districtUsers = $this->getDistrictUsers($did);
            if(count($districtUsers) > 0){

                //Disassociate the district from its users
                $this->db->delete('eop_user2district', array('did'=>$did));

                foreach ($districtUsers as $user_id){
                    $this->db->delete('eop_user', array('user_id' => $user_id));
                }
            }
        }

        return  $deletedDistricts;

    }

    /**
     * Function getDistricts
     * Returns all districts available in a particular state
     *
     * @param string $state   The state to which the districts belongs
     *
     *  If returns all districts if requested by super or state admins but it will return only the districts associated
     *  with other users when requested by district or school admins or school users
     */
    function getDistricts($state=''){
        if($state ==''){
            $conditions = array();
        }
        else{
            $conditions = array('state_val' => $state);
        }

        //For District admin, School admin and School user, return districts associated with the user
        if($this->session->userdata['role']['level'] >= 3 ){

            $this->db->select('A.*, B.uid')
                        ->from('eop_district A')
                        ->join('eop_user2district B', 'A.id = B.did')
                        ->order_by('A.name', 'ASC')
                        ->where(array('uid'=> $this->session->userdata('user_id')));

            $query = $this->db->get();

            return $query->result_array();
        }
        // For Super and State admins return all districts in the state or EOP installation
        else{
            $query = $this->db->order_by('name', 'ASC')->get_where('eop_district', $conditions);
            return $query->result_array();
        }
    }

    function getDistrict($district_id){
        $conditions = array('id'=>$district_id);

        $query = $this->db->get_where('eop_district', $conditions);

        return $query->result_array();

    }

    function getDistrictByName($name){

        $conditions = array('name'=>$name);

        $query = $this->db->get_where('eop_district', $conditions);

        return $query->result_array();

    }

    /**
     * Function getDistrictUsers
     * Returns an array of ids for users associated with a given district
     *
     * @param string $district_id
     * @return array
     */
    function getDistrictUsers($district_id){
        $condition = array('did' => $district_id);
        $ret = array();
        $query = $this->db->get_where('eop_user2district', $condition);
        if($query){
            foreach($query->result_array() as $rows){
                $ret[] = $rows['uid'];
            }
        }

        return $ret;
    }


    /**
     *  Function attaches a district to the session object
     * @method attach_to_session
     * @param int district_id The district id
     * @return void
     */
    public function attach_to_session($district_id){

        //Clear loaded_district session data
        $this->session->unset_userdata('loaded_district');

        $districtData = $this->getDistrict($district_id);
        $data = array(
            'loaded_district' => array(
                'id'                =>  $districtData[0]['id'],
                'name'              =>  $districtData[0]['name'],
                'screen_name'       =>  $districtData[0]['screen_name'],
                'description'       =>  $districtData[0]['description'],
                'modified_date'     =>  $districtData[0]['modified_date'],
                'owner'             =>  $districtData[0]['owner']
            )

        );

        $this->session->set_userdata($data);
    }

}