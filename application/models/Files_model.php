<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Files_model extends CI_Model {

    private $dataTable = 'eop_files';

    public function __construct(){
        parent::__construct();

        $this->load->model('user_model');
        $this->load->model('school_model');
    }


    function addFile($data){

        $this->db->insert($this->dataTable, $data);
        $affected_rows = $this->db->affected_rows();

        return $affected_rows;
    }

    function deleteFile($id){
        $this->db->delete($this->dataTable, array('id'=>$id));
        return $this->db->affected_rows();
    }

    function update($id, $data){
        $this->db->where('id', $id);
        $this->db->update('eop_files', $data);

        return $this->db->affected_rows();

    }


    /**
     * Function to return a file by its id
     *
     * @method getFile
     * @param $p The file id
     * @return mixed Returns an associative array containing the file information from the database
     */
    function getFile($p){

        $conditions = array('id'=>$p);

        $query = $this->db->limit(1)->get_where($this->dataTable, $conditions);

        return $query->result_array();
    }

    function getFiles($data=''){
        if($data ==''){

            if(isset($this->session->userdata['loaded_school']['id']) && $this->session->userdata['loaded_school']['id']>0){
                //Load members for their respective school only
                $conditions['sid'] = $this->session->userdata['loaded_school']['id'];
                $this->db->order_by('created', 'DESC');
                $query = $this->db->get_where($this->dataTable, $conditions);
            }elseif($this->session->userdata['role']['level']>=4){ //School Admins and Users

                //Load members for their respective school only
                $conditions['sid'] = $this->session->userdata['loaded_school']['id'];
                $this->db->order_by('created', 'DESC');
                $query = $this->db->get_where($this->dataTable, $conditions);

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
                    ->from($this->dataTable)
                    ->order_by('created', 'DESC')
                    ->where_in('sid', $schoolIds);
                $query = $this->db->get();

            }else{

                $this->db->order_by('created', 'DESC');
                $query = $this->db->get($this->dataTable);
            }

            if($query !== FALSE && $query->num_rows() >0){
                return $query->result_array();
            }else{
                return array();
            }


        }else{

            $conditions=$data;
            $this->db->order_by('created', 'DESC');
            $query = $this->db->get_where($this->dataTable, $conditions);
            if($query !== FALSE && $query->num_rows() >0){
                return $query->result_array();
            }else{
                return array();
            }


        }
    }

}