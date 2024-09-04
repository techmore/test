<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: vkothale
 * Date: 10/24/2016
 * Time: 11:35 AM
 */

class Resource_model extends CI_Model
{

    public function __construct(){
        parent::__construct();
    }

    /**
     * Function returns array of resources that conforms to given criteria or all if no criteria is passed
     *
     * @param $data mixed array of criteria
     * @return mixed
     */
    function get($data = 'all'){

        $criteria = array();

        if(is_array($data) && count($data)>0){

            if(array_key_exists('id', $data)){
                $criteria['id'] = $data['id'];
            }else{
                $criteria = $data;
            }


            $query = $this->db->get_where('eop_resource', $criteria);
        }else{

            if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL){
                $criteria['district_id']    =   $this->session->userdata['loaded_district']['id'];
            }elseif($this->session->userdata['role']['level'] == SCHOOL_ADMIN_LEVEL){
                $criteria['school_id']      =   $this->session->userdata['loaded_school']['id'];
            }

            //$this->db->where('district_id', $criteria['district_id']);

            $query = $this->db->order_by('name', 'ASC')->get_where('eop_resource', $criteria);
        }
        $results_array = $query->result_array();

        if(is_array($results_array) && count($results_array)>0){

            foreach ($results_array as $key=>&$result){
                $result['pages'] = array();
                $query = $this->db->get_where('eop_resource2page', array('resource_id' => $result['id']));
                $resource2page_array = $query->result_array();
                if(is_array($resource2page_array) && count($resource2page_array)>0){
                    foreach($resource2page_array as $resource2page){
                        $page = $this->page_model->get(array('id' => $resource2page['page_id']));
                        if(is_array($page) && count($page)>0){
                            $tempVar['id']          = $page[0]['id'];
                            $tempVar['name']        = $page[0]['name'];
                            $tempVar['title']       = $page[0]['title'];
                            $tempVar['content']     = $page[0]['content'];
                            $tempVar['url']         = $page[0]['url'];
                            $tempVar['url_alias']   = $page[0]['url_alias'];

                            array_push($result['pages'], $tempVar);
                        }
                    }
                }
            }
        }

        return $results_array;
    }

    function getCompiledResources(){

        $district_resources = array();
        $school_resources = array();

        $default_resources = $this->get(array('shared'=>'default'));

        if(isset($this->session->userdata['loaded_school']['district_id']) && is_numeric($this->session->userdata['loaded_school']['district_id'])){
            $district_resources = $this->get(array('shared'=>'district', 'district_id'=>$this->session->userdata['loaded_school']['district_id']));
        }

        if(isset($this->session->userdata['loaded_school']['id']) && is_numeric($this->session->userdata['loaded_school']['id'])){
            //$school_resources = $this->get(array('shared'=>'school', 'school_id'=>$this->session->userdata['loaded_school']['id']));
        }

        return array_merge($default_resources, $district_resources, $school_resources);

    }

    /**
     * Function adds new resource records to the database
     *
     * @param $resourceData
     * @return bool
     */
    function add($resourceData){

        if(is_array($resourceData) && count($resourceData) > 0){

            $data['name']           =   $resourceData['name'];
            $data['url']            =   $resourceData['url'];
            $data['section']        =   $resourceData['section'];
            $data['shared']         =   $resourceData['shared'];
            $data['district_id']    =   $resourceData['district_id'];
            $data['school_id']      =   $resourceData['school_id'];

            $this->db->insert('eop_resource', $data);
            $resource_id = $this->db->insert_id();
            $affected_rows = $this->db->affected_rows();

            if(is_numeric($resource_id) && $resource_id > 0) { //Insert corresponding page data

                if (is_array($resourceData['pages']) && count($resourceData['pages']) > 0) {
                    foreach ($resourceData['pages'] as $key => $page) {
                        $pageData['resource_id']    = $resource_id;
                        $pageData['page_id']        =   $page;

                        $this->db->insert('eop_resource2page', $pageData);
                    }
                }
            }

            return $affected_rows;

        }else{

            return false;
        }
    }


    function delete($data){

        $criteria = array();

        if(is_array($data) && count($data)>0){

            if(array_key_exists('id', $data))
                $criteria['id'] = $data['id'];
        }

        $this->db->delete('eop_resource', $criteria);
        $affected_rows = $this->db->affected_rows();

        if(is_numeric($affected_rows) && $affected_rows>0){ //Remove the page references
            $this->db->delete('eop_resource2page', array('resource_id' => $criteria['id']));
        }

        return $affected_rows;
    }

    function update($id, $data){


        if(is_array($data) && count($data)>0){

            $resourceData= array(
                'name'      =>  $data['name'],
                'url'       =>  $data['url'],
                'section'   =>  $data['section'],
                'shared'    =>  $data['shared']
            );

            $this->db->where('id', $id);
            $this->db->update('eop_resource', $resourceData);


            //Remove all references from the eop_resource2page table before adding new ones
            $this->db->where('resource_id', $id);
            $this->db->delete('eop_resource2page');


            //Add new Selected pages
            if (is_array($data['pages']) && count($data['pages']) > 0) {
                foreach ($data['pages'] as $key => $page) {
                    $pageData['resource_id']    = $id;
                    $pageData['page_id']        =   $page;

                    $this->db->insert('eop_resource2page', $pageData);
                }
            }

            return $this->db->affected_rows();
        } else{
            return 0;
        }
    }

}