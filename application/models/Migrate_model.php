<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: GMajwega
 * Date: 5/8/15
 * Time: 1:03 PM
 */

class Migrate_model extends CI_Model {

    public function __construct(){
        parent::__construct();
        $this->load->dbforge();

    }

    /**
     *
     * @param $db_obj
     * @return mixed
     */
    public function getObsoleteUsers($db_obj){

        $db_obj->select('A.*, C.code AS district, E.code school')
            ->from('tbl_user A')
            ->join('tbl_user_district B',       'A.id = B.user_id',         'left')
            ->join('tbl_district C',            'B.district_id = C.id',     'left')
            ->join('tbl_user_sub_district D',   'A.id = D.user_id',         'left')
            ->join('tbl_sub_district E',        'D.sub_district_id = E.id', 'left');

        $query = $db_obj->get();

        return $query->result_array();
    }

    public function getObsoleteDistricts($db_obj){

        $query = $db_obj->get('tbl_district');

        return $query->result_array();
    }

    public function getObsoleteSchools($db_obj){

        $db_obj->select('A.*, B.code AS district')
            ->from('tbl_sub_district A')
            ->join('tbl_district B', 'A.district_id = B.id');

        $query = $db_obj->get();

        return $query->result_array();
    }

    public function getObsoleteTeamMembers($db_obj){

        /**
         * SELECT A.*, C.code AS school FROM tbl_team A join tbl_user_sub_district B ON A.modified_by=B.user_id
        join tbl_sub_district C ON B.sub_district_id=C.id;
         */
        $db_obj->select('A.*, C.code AS school')
            ->from('tbl_team A')
            ->join('tbl_user_sub_district B', 'A.modified_by=B.user_id')
            ->join('tbl_sub_district C', 'B.sub_district_id=C.id');

        $query = $db_obj->get();

        return $query->result_array();
    }

    public function getObsoleteCalendarEvents($db_obj){

        /**
         * SELECT A.*, C.code AS school FROM tbl_event_calendar A join tbl_user_sub_district B ON A.modified_by=B.user_id
        join tbl_sub_district C ON B.sub_district_id=C.id;
         */
        $db_obj->select('A.*, C.code AS school')
            ->from('tbl_event_calendar A')
            ->join('tbl_user_sub_district B', 'A.modified_by=B.user_id')
            ->join('tbl_sub_district C', 'B.sub_district_id=C.id');

        $query = $db_obj->get();

        return $query->result_array();
    }

    public function getObsoleteThs($db_obj){

        $db_obj->select('A.*, C.code AS school')
            ->from('tbl_th A')
            ->join('tbl_user_sub_district B', 'A.modified_by = B.user_id')
            ->join('tbl_sub_district C', 'B.sub_district_id = C.id');

        $query = $db_obj->get();

        return $query->result_array();
    }


    public function getObsoleteFns($db_obj){

        $db_obj->select('B.id, A.fn_name, E.code AS school')
            ->from('tbl_fn A')
            ->join('tbl_goal_second_fn B', 'A.id=B.fn_id')
            ->join('tbl_goal_second C', 'C.id=B.goal_second_id')
            ->join ('tbl_user_sub_district D', 'C.modified_by=D.user_id')
            ->join('tbl_sub_district E', 'D.sub_district_id=E.id');

        $query = $db_obj->get();

        return $query->result_array();

    }

    public function getObsoleteForm1Data($db_obj){
        /**
         * SELECT A.*, C.code AS school FROM tbl_form_2 A join tbl_user_sub_district B ON A.modified_by=B.user_id
        join tbl_sub_district C ON B.sub_district_id=C.id;
         */
        $db_obj->select('A.*, C.code AS school')
            ->from('tbl_form_1 A')
            ->join('tbl_user_sub_district B', 'A.modified_by=B.user_id')
            ->join('tbl_sub_district C', 'B.sub_district_id=C.id');

        $query = $db_obj->get();

        return $query->result_array();
    }

    public function getObsoleteForm2Data($db_obj){
        /**
         * SELECT A.*, C.code AS school FROM tbl_form_2 A join tbl_user_sub_district B ON A.modified_by=B.user_id
        join tbl_sub_district C ON B.sub_district_id=C.id;
         */
        $db_obj->select('A.*, C.code AS school')
            ->from('tbl_form_2 A')
            ->join('tbl_user_sub_district B', 'A.modified_by=B.user_id')
            ->join('tbl_sub_district C', 'B.sub_district_id=C.id');

        $query = $db_obj->get();

        return $query->result_array();
    }

    public function getObsoleteForm3Data($db_obj){
        /**
         * SELECT A.*, C.code AS school FROM tbl_form_3 A join tbl_user_sub_district B ON A.modified_by=B.user_id
        join tbl_sub_district C ON B.sub_district_id=C.id;
         */
        $db_obj->select('A.*, C.code AS school')
            ->from('tbl_form_3 A')
            ->join('tbl_user_sub_district B', 'A.modified_by=B.user_id')
            ->join('tbl_sub_district C', 'B.sub_district_id=C.id');

        $query = $db_obj->get();

        return $query->result_array();
    }

    public function getObsoleteForm4Data($db_obj){
        /**
         * SELECT A.*, C.code AS school FROM tbl_form_4 A join tbl_user_sub_district B ON A.modified_by=B.user_id
        join tbl_sub_district C ON B.sub_district_id=C.id;
         */
        $db_obj->select('A.*, C.code AS school')
            ->from('tbl_form_4 A')
            ->join('tbl_user_sub_district B', 'A.modified_by=B.user_id')
            ->join('tbl_sub_district C', 'B.sub_district_id=C.id');

        $query = $db_obj->get();

        return $query->result_array();
    }

    public function getObsoleteForm5Data($db_obj){
        /**
         * SELECT A.*, C.code AS school FROM tbl_form_5 A join tbl_user_sub_district B ON A.modified_by=B.user_id
        join tbl_sub_district C ON B.sub_district_id=C.id;
         */
        $db_obj->select('A.*, C.code AS school')
            ->from('tbl_form_5 A')
            ->join('tbl_user_sub_district B', 'A.modified_by=B.user_id')
            ->join('tbl_sub_district C', 'B.sub_district_id=C.id');

        $query = $db_obj->get();

        return $query->result_array();
    }

    public function getObsoleteForm6Data($db_obj){
        /**
         * SELECT A.*, C.code AS school FROM tbl_form_6 A join tbl_user_sub_district B ON A.modified_by=B.user_id
        join tbl_sub_district C ON B.sub_district_id=C.id;
         */
        $db_obj->select('A.*, C.code AS school')
            ->from('tbl_form_6 A')
            ->join('tbl_user_sub_district B', 'A.modified_by=B.user_id')
            ->join('tbl_sub_district C', 'B.sub_district_id=C.id');

        $query = $db_obj->get();

        return $query->result_array();
    }

    public function getObsoleteForm7Data($db_obj){
        /**
         * SELECT A.*, C.code AS school FROM tbl_form_7 A join tbl_user_sub_district B ON A.modified_by=B.user_id
        join tbl_sub_district C ON B.sub_district_id=C.id;
         */
        $db_obj->select('A.*, C.code AS school')
            ->from('tbl_form_7 A')
            ->join('tbl_user_sub_district B', 'A.modified_by=B.user_id')
            ->join('tbl_sub_district C', 'B.sub_district_id=C.id');

        $query = $db_obj->get();

        return $query->result_array();
    }

    public function getObsoleteForm8Data($db_obj){
        /**
         * SELECT A.*, C.code AS school FROM tbl_form_8 A join tbl_user_sub_district B ON A.modified_by=B.user_id
        join tbl_sub_district C ON B.sub_district_id=C.id;
         */
        $db_obj->select('A.*, C.code AS school')
            ->from('tbl_form_8 A')
            ->join('tbl_user_sub_district B', 'A.modified_by=B.user_id')
            ->join('tbl_sub_district C', 'B.sub_district_id=C.id');

        $query = $db_obj->get();

        return $query->result_array();
    }

    public function getObsoleteForm9Data($db_obj){
        /**
         * SELECT A.*, C.code AS school FROM tbl_form_9 A join tbl_user_sub_district B ON A.modified_by=B.user_id
        join tbl_sub_district C ON B.sub_district_id=C.id;
         */
        $db_obj->select('A.*, C.code AS school')
            ->from('tbl_form_9 A')
            ->join('tbl_user_sub_district B', 'A.modified_by=B.user_id')
            ->join('tbl_sub_district C', 'B.sub_district_id=C.id');

        $query = $db_obj->get();

        return $query->result_array();
    }

    public function getObsoleteForm10Data($db_obj){
        /**
         * SELECT A.*, C.code AS school FROM tbl_form_10 A join tbl_user_sub_district B ON A.modified_by=B.user_id
        join tbl_sub_district C ON B.sub_district_id=C.id;
         */
        $db_obj->select('A.*, C.code AS school')
            ->from('tbl_form_10 A')
            ->join('tbl_user_sub_district B', 'A.modified_by=B.user_id')
            ->join('tbl_sub_district C', 'B.sub_district_id=C.id');

        $query = $db_obj->get();

        return $query->result_array();
    }






    public function getTHData($db_obj, $th_id){

        $data = array();

        //Get goal data
        for($i=1; $i<=3; $i++){

            $data[$i-1] = array();

            $db_obj ->select("A.id, A.g{$i}, C.fn_name, B.th_id")
                ->from("tbl_goal_first_g{$i} A")
                ->join("tbl_goal_first_th B", "A.goal_first_th_id = B.id")
                ->join("tbl_fn C", "A.fn_id = C.id")
                ->where(array("th_id" => $th_id));

            $query = $db_obj->get();

            $results = $query->result_array();


            if(count($results)>0){
                foreach($results as $key => $row){
                    $data[$i-1]['parent'][] = $row;

                    $db_obj -> select("A.*, B.fn_name")
                        ->from("tbl_goal_first_g{$i}_obj_fn A")
                        ->join("tbl_fn B", "A.fn_id = B.id")
                        ->where( array("goal_first_g{$i}_id" => $row['id']));

                    $q = $db_obj ->get();

                    $res = $q->result_array();

                    if(is_array($res) && count($res) > 0){
                        $data[$i-1]['objectives'] = $res;
                    }else{
                        $data[$i-1]['objectives'] = array();
                    }
                }
            }
        }

        //Get course of action data

        $query = $db_obj ->get_where('tbl_th_action', array('th_id' => $th_id));
        $action_data = $query->result_array();


        return array('g1'=>$data[0], 'g2'=>$data[1], 'g3'=>$data[2], 'ca'=>$action_data);

    }


    public function getFNData($db_obj, $fn_id){

        $data = array();

        //Get goal data
        for($i=1; $i<=3; $i++){

            $data[$i-1] = array();

            $db_obj->select("A.id, B.g{$i}, C.fn_name, B.id as goal_id")
                ->from('tbl_goal_second_fn A')
                ->join("tbl_goal_second_g{$i} B", 'A.id = B.goal_second_fn_id')
                ->join('tbl_fn C', 'A.fn_id = C.id')
                ->where(array('A.id'=>$fn_id));


            $query = $db_obj->get();

            $results = $query->result_array();


            if(is_array($results) && count($results)>0){
                foreach($results as $key => $row){
                    $data[$i-1]['parent'][] = $row;

                    $db_obj -> select("*")
                        ->from("tbl_goal_second_g{$i}_obj ")
                        ->where( array("goal_second_g{$i}_id" => $row['goal_id']));

                    $q = $db_obj ->get();

                    $res = $q->result_array();

                    if(is_array($res) && count($res) > 0){
                        $data[$i-1]['objectives'] = $res;
                    }else{
                        $data[$i-1]['objectives'] = array();
                    }
                }
            }
        }

        //Get course of action data
        //select A.*, C.id from tbl_fn_action A join tbl_goal_second B on A.goal_second_id=B.id join tbl_goal_second_fn C ON C.goal_second_id=B.id
        /*$db_obj->select('A.*, C.id')
            ->from('tbl_fn_action A')
            ->join('tbl_goal_second B', 'A.goal_second_id=B.id')
            ->join('tbl_goal_second_fn C', 'C.goal_second_id=B.id')
            ->where(array('C.id'=>$fn_id, 'C.fn_id'=>'A.fn_id'));*/


        $query = $db_obj->query("select A.*, C.id, C.fn_id from tbl_fn_action A join tbl_goal_second B on
A.goal_second_id=B.id join tbl_goal_second_fn C ON C.goal_second_id=B.id where C.id=$fn_id and C.fn_id=A.fn_id");

        $action_data = $query->result_array();


        return array('g1'=>$data[0], 'g2'=>$data[1], 'g3'=>$data[2], 'ca'=>$action_data);

    }

    public function getRecordOfChanges($db_obj, $form1_id){

        $query = $db_obj->get_where('tbl_form_1_q3', array('form_1_id'=>$form1_id));

        $result = $query->result_array();

        if(is_array($result) && count($result)>0){
            return $result;
        }else{
            return array();
        }
    }

    public function getRecordOfDistribution($db_obj, $form1_id){

        $query = $db_obj->get_where('tbl_form_1_q4', array('form_1_id'=>$form1_id));

        $result = $query->result_array();

        if(is_array($result) && count($result)>0){
            return $result;
        }else{
            return array();
        }
    }

    public function test($db_obj){
        /*$db_obj->select('A.*, C.id, C.fn_id as ddd')
            ->from('tbl_fn_action A')
            ->join('tbl_goal_second B', 'A.goal_second_id=B.id')
            ->join('tbl_goal_second_fn C', 'C.goal_second_id=B.id')
            ->where('C.id=2 AND ddd = fn_id');*/
        $query = $db_obj->query("select A.*, C.id, C.fn_id from tbl_fn_action A join tbl_goal_second B on
A.goal_second_id=B.id join tbl_goal_second_fn C ON C.goal_second_id=B.id where C.id=3 and C.fn_id=A.fn_id");

        //$query = $db_obj ->get();
        return  $query->result_array();
    }

}