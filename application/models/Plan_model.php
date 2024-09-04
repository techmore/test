<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plan_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }


    public function addEntity($data){

        $this->db->insert('eop_entity', $data);
        return $this->db->insert_id();
    }

    public function removeObjective($id){

        if(is_numeric($id)){
            $this->db->delete('eop_entity', array('id' => $id));
            $this->db->delete('eop_field', array('entity_id' => $id));
            $this->db->delete('eop_entity', array('parent' => $id));
        }else{
            //do nothing
        }
    }

    public function removeEntity($id){

        if(is_numeric($id)){
            $this->db->delete('eop_entity', array('id' => $id));
            $this->db->delete('eop_field', array('entity_id' => $id));
            $this->db->delete('eop_entity', array('parent' => $id));
        }else{
            //do nothing
        }
    }

    public function deleteEntity($data){

        $this->db->delete('eop_entity', $data);
    }

    public function addThreatAndHazard($data, &$entityIds=array(), &$field_ids=array(), $school_id=null){

        $this->db->insert('eop_entity', $data);
        $insertedId = $this->db->insert_id();
        $affected_rows = $this->db->affected_rows();

        /**
         * Add the default goal 1, 2 and 3 objectives as children to the new Threat & Hazard
         */
        $this->saveDefaultTHGoals($insertedId, $entityIds, $field_ids, $school_id, $data['mandate']);

        return $affected_rows;

    }


    public function addTHFn($data, &$fn_id = 0){

        //Check if there is a top level function with the same name, if not create one before adding the current function
        $query = $this->db->get_where('eop_entity', array('type_id'=>$data['type_id'], 'name'=>$data['name'],'parent'=>null));
        $result = $query->result_array();
        $affected_rows =0;

        if(count($result)<=0){
            $this->db->insert('eop_entity', $data);
            $affected_rows = $this->db->affected_rows();
        }

        if($data['parent']!=null) {
            $this->db->insert('eop_entity', $data);
            $fn_id = $this->db->insert_id();
            $affected_rows = $this->db->affected_rows();
        }

        return $affected_rows;

    }

    public function addFn($data/*, &$fn_id =0*/){

        $affected_rows = 0;

        if(is_array($data) and count($data)>0){

            $this->db->insert('eop_entity', $data);
            //$fn_id = $this->db->insert_id();
            $affected_rows = $this->db->affected_rows();
        }

        return $affected_rows;
    }

    public function getEntityTypeId($param, $use='name'){
        $condition= array();
        if($use=='title'){
            $condition['title'] = $param;
        }else{
            $condition['name'] = $param;
        }

        $query = $this->db->get_where('eop_entity_types', $condition);

        $resultsArray = $query->result_array();

        return $resultsArray[0]['id'];
    }

    /**
     * @method getEntities
     * @param $type the type of the entity to retrieve
     * @param string $data array of criteria
     * @param bool $recursive Defines whether to return entities recursively structured or to return simple entities list
     * @return associative array of entities array('orderby'=>'column_name', 'type'=>'ASC|DESC')
     */
    public function getEntities($type, $data='', $recursive=false, $sortOrder=array()){
        $conditions = array();

        if($type!='' || $type !='all'){
            $conditions['type_id'] = $this->getEntityTypeId($type);
        }

        if(is_array($data) && count($data)>0){
            $conditions = array_merge($conditions, $data);
        }
        

        if(is_array($data)){
            
            if(count($sortOrder)>0){
                $orderBy = $sortOrder['orderby'];
                $sortType = $sortOrder['type'];
                $this->db->order_by($orderBy, $sortType);
            }
            $query = $this->db->get_where('eop_view_entities', $conditions);
        }else{

            if(count($sortOrder)>0){
                $orderBy = $sortOrder['orderby'];
                $sortType = $sortOrder['type'];
                $data .= " ORDER BY " . $orderBy . " " . $sortType;

            }
            $query = $this->db->query($data);
        }

        $resultsArray = $query->result_array();
        

        if($recursive){ // If recursive entity requested

            if(is_array($resultsArray) && count($resultsArray) >0){
                 return $this->arrangeEntities($resultsArray);
            }else{
                return array();
            }

        }else{ // Return simple array list of entities
            return $resultsArray;
        }

    }


    /**
     * @method getEntity
     * @param int $entry_id
     * @param bool $recursive Defines whether to return entities recursively structured or to return simple entities list
     *
     * @return associative array of entry
     */
    public function getEntity($entity_id, $recursive=false){

        $query = $this->db->get_where('eop_view_entities', array('id'=>$entity_id));
        $resultsArray = $query->result_array();


        if($recursive){ // If recursive entity requested

            if(is_array($resultsArray) && count($resultsArray) >0){
                return $this->arrangeEntities($resultsArray);
            }else{
                return array();
            }

        }else{ // Return simple array list of entities
            return $resultsArray;
        }
    }


    public function getFunctionEntities($sid){
        $type = $this->getEntityTypeId('fn');

        $sidStmt = ($sid) ? "sid = {$sid}" : "sid IS NULL AND district_id IS NULL";
        $query =  "SELECT * FROM eop_view_entities WHERE (type_id={$type} AND parent IS NULL AND $sidStmt) OR ( type_id={$type} AND parent IS NULL AND sid IS NULL AND owner IS NULL)";
        $query .= " OR (type_id={$type} AND parent IS NULL AND sid IS NULL AND mandate='state' AND owner_role_level=". STATE_ADMIN_LEVEL ." AND district_id IS NULL AND copy=0)";
        if($sid){
            $query .= " OR (type_id={$type} AND parent IS NULL AND sid IS NULL AND mandate='district' AND owner_role_level=". DISTRICT_ADMIN_LEVEL ." AND district_id ={$this->session->userdata['loaded_school']['district_id']} AND copy=0)";
        }elseif(isset($this->session->userdata['loaded_district'])){
            $query .= " OR (type_id={$type} AND parent IS NULL AND sid IS NULL AND mandate='district' AND owner_role_level=". DISTRICT_ADMIN_LEVEL ." AND district_id ={$this->session->userdata['loaded_district']['id']} AND copy=0)";
        }

        /*$query1 = $this->db->get_where('eop_view_entities', array('type_id'=>$type, 'parent'=>null, 'sid'=>null, 'owner'=>Null));
        $res1 = $query1->result_array();
        $ids = array();
        foreach($res1 as $resultRow){
            $ids[] = $resultRow['id'];
        }

        $this->db->select('*')
                    ->from('eop_view_entities')
                    ->where(array('type_id'=>$type, 'parent'=>null, 'sid'=>$sid))
                    ->or_where_in('id', $ids)
                    ->order_by('name', 'ASC');

        $query = $this->db->get();*/

        $query .=" ORDER BY name ASC";

        $data = $this->db->query($query);
        
        return $this->removeFunctionDuplicates($data->result_array());
    }

    private function removeFunctionDuplicates($arrays){
        $newArrays= array();

        if(is_array($arrays)){
            foreach ($arrays as $array){
                if(isset($array['name'])){
                    $has = false;
                    if(count($newArrays)>0){
                        foreach ($newArrays as $newArray){
                            if($newArray['name']==$array['name']){
                                $has = true;
                                break;
                            }
                        }
                    }

                    if(!$has){
                        array_push($newArrays, $array);
                    }
                }
            }
        }

        return $newArrays;
    }
    

    /**
     * Function to copy state and district mandated entries to a respective school
     *
     * @param $sid
     */
    public function copyDefaults($sid){
        $this->load->model('school_model');

        $user_district = $this->school_model->getSchoolDistrict($sid);

        $mandatedEntries = $this->db->select('id, ref_key, type_id, mandate, district_id, copy')
                            ->from('eop_view_entities')
                            ->where("(mandate in('state', 'district') AND type_id in(2,3)) AND (district_id = $user_district OR district_id is null) AND copy = 0")
                            /*->where_in('type_id', array(2, 3))*/
                            /*->where(array('district_id'=> $user_district))*/
                            ->get()
                            ->result_array();

        print_r($mandatedEntries);
        if(is_array($mandatedEntries) && count($mandatedEntries)>0){

            $schoolEntries = $this->db->select('id, ref_key, type_id, sid')
                ->from('eop_entity')
                ->where(array('sid'=>$sid))
                ->where_in('type_id', array(2, 3))
                ->get()
                ->result_array();

            if(is_array($schoolEntries) && count($schoolEntries)>0){

                foreach ($mandatedEntries as $mandatedEntry){
                    $in_array = false;

                    foreach ($schoolEntries as $schoolEntry){
                        if($mandatedEntry['ref_key'] == $schoolEntry['ref_key']){
                            $in_array = true;
                            break;
                        }
                    }

                    if(!$in_array){
                        $this->copyEntry($mandatedEntry['id'], $sid);
                    }
                }
            }else{ //copy all mandated entries to the school

                foreach ($mandatedEntries as $mandatedEntry){
                    $this->copyEntry($mandatedEntry['id'], $sid);
                }
            }
        }
    }

    /**
     * Private method copies an entity recursively to a given school
     *
     * @param $entry_id -- the id of the entry to copy
     * @param $sid      -- the id of the school where the entity will be copied to
     */
    public function copyEntry($entry_id, $sid){

        $entry = $this->getEntity($entry_id, true);

        if(is_array($entry) && count($entry)>0){

            $data = array(
                'type_id'       =>  $entry[0]['type_id'],
                'sid'           =>  $sid,
                'name'          =>  $entry[0]['name'],
                'title'         =>  $entry[0]['title'],
                'owner'         =>  $entry[0]['owner'],
                'parent'        =>  $entry[0]['parent'],
                'weight'        =>  $entry[0]['weight'],
                'description'   =>  $entry[0]['description'],
                'mandate'       =>  ($this->session->userdata['role']['level'] >= DISTRICT_ADMIN_LEVEL) ? 'school' : ((!$sid) ? 'school' : $entry[0]['mandate']),
                'ref_key'       =>  $entry[0]['ref_key'],
                'copy'          =>  1
            );

            $this->db->insert('eop_entity', $data);
            $insertedId = $this->db->insert_id();

            if(is_array($entry[0]['fields']) && count($entry[0]['fields'])>0){
                foreach($entry[0]['fields'] as $field){
                    $field_data = array(
                        'entity_id'     =>  $insertedId,
                        'name'          =>  $field['name'],
                        'title'         =>  $field['title'],
                        'weight'        =>  $field['weight'],
                        'type'          =>  $field['type'],
                        'body'          =>  $field['body']
                    );

                    $this->db->insert('eop_field', $field_data);
                }
            }


            if(is_array($entry[0]['children']) && count($entry[0]['children'])>0){
                $this->copyChildren($entry[0]['children'], $insertedId, $sid);
            }
        }
    }

    private function copyChildren($children, $parent_id, $sid){

        foreach ($children as $child){
            $data = array(
                'type_id'       =>  $child['type_id'],
                'sid'           =>  $sid,
                'name'          =>  $child['name'],
                'title'         =>  $child['title'],
                'owner'         =>  $child['owner'],
                'parent'        =>  $parent_id,
                'weight'        =>  $child['weight'],
                'description'   =>  $child['description'],
                'mandate'       =>  $child['mandate'],
                'copy'          =>  1
            );

            $this->db->insert('eop_entity', $data);
            $insertedId = $this->db->insert_id();

            if(is_array($child['fields']) && count($child['fields'])>0){
                foreach($child['fields'] as $field){
                    $field_data = array(
                        'entity_id'     =>  $insertedId,
                        'name'          =>  $field['name'],
                        'title'         =>  $field['title'],
                        'weight'        =>  $field['weight'],
                        'type'          =>  $field['type'],
                        'body'          =>  $field['body']
                    );

                    $this->db->insert('eop_field', $field_data);
                }
            }

            if(is_array($child['children']) && count($child['children'])>0){
                $this->copyChildren($child['children'], $insertedId, $sid);
            }
        }
    }


    /**
     * @param array $entityRowsArray simple list array of entities
     * @return array recursively structured array of entities
     */
    private function arrangeEntities(&$entityRowsArray){


        //For each Entity record, get its children and organise array into proper hierarchy
        //Recursively arrange the directory structure of elements...
        foreach($entityRowsArray as $key => &$entityRow){
            $children = $this->getChildren($entityRow['id']);
            $fields = $this->getFields($entityRow['id']);

            if(!array_key_exists('children', $entityRow)){
                $entityRow['children'] = $children;
            }
            if(!array_key_exists('fields', $entityRow)){
                $entityRow['fields'] = $fields;
            }else{
                $entityRow['fields'] .= $fields;
            }
        }
        return $entityRowsArray;
    }


    private function getChildren($id){
        $children = array();

        $this->db->select('*')
            ->from('eop_view_entities')
            ->where(array('parent'=>$id));

        $query = $this->db->get();

        $resultArray = $query->result_array();

        foreach($resultArray as $value){

            if(!array_key_exists('children', $value)){
                $value['children'] = $this->getChildren($value['id']);
                $value['fields'] = $this->getFields($value['id']);
            }
            array_push($children, $value);
        }
        return $children;
    }

    /*private function getChildren($id){
        $children = array();

        $query = $this->db->get('eop_view_entities');

        $resultArray = $query->result_array();

        foreach($resultArray as $value){
            if($value['parent']==$id){

                if(!array_key_exists('children', $value)){
                    $value['children'] = $this->getChildren($value['id']);
                    $value['fields'] = $this->getFields($value['id']);
                }

                array_push($children, $value);
            }
        }
        return $children;
    }*/

    public function getFields($id){

        $query = $this->db->get_where('eop_field', array('entity_id'=>$id));
        return $query->result_array();
    }

    public function update($id, $data){
        $this->db->where('id', $id);
        $this->db->update('eop_entity', $data);

        return $this->db->affected_rows();

    }

    public function updateFn($parent, $fnData){
        $type = $this->getEntityTypeId('fn');

        $data['name'] = $fnData['name'];
        $data['title'] = $fnData['title'];

        $this->db->update('eop_entity', $data, array('parent'=>$parent, 'type_id'=>$type));
        return $this->db->affected_rows();
    }


    public function exists($entity_id){
        $query = $this->db->get_where('eop_entity', array('id'=>$entity_id));
        $result = $query->result_array();

        if(count($result)>0){
            return true;
        }else{
            return false;
        }
    }


    public function fieldExists($id){
        $query = $this->db->get_where('eop_field', array('id'=>$id));
        $result = $query->result_array();

        if(count($result)>0){
            return true;
        }else{
            return false;
        }
    }

    public function updateField($id, $data){
        $this->db->where('id', $id);
        $this->db->update('eop_field', $data);

        return $this->db->affected_rows();
    }

    public function addField($data){
        $this->db->insert('eop_field', $data);
        $affected_rows = $this->db->affected_rows();

        return $affected_rows;
    }

    public function deleteFields($data){

        $this->db->delete('eop_field', $data);
        $affected_rows = $this->db->affected_rows();

        return $affected_rows;
    }

    /**
     * Saves the default TH Goals and their respective Objectives
     * @method saveDefaultTHGoals
     * @param int parent entity ID
     * @param [array] by ref. holds newly created entity ids
     * @param [array] by ref. holds newly created field ids
     * @param int optional school_id
     * @return void
     */
    private function saveDefaultTHGoals($parent_id, &$entityIds=array(), &$field_ids = array(), $school_id = null, $mandate='school'){
        $goalData = array(
            array(
                'name'      =>      'Goal 1',
                'title'     =>      'Goal 1 (Before)',
                'owner'     =>      $this->session->userdata('user_id'),
                'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : (($school_id != null) ? $school_id : null),
                'type_id'   =>      $this->getEntityTypeId('g1', 'name'),
                'parent'    =>      $parent_id,
                'weight'    =>      1,
                'mandate'   =>      $mandate
            ),
            array(
                'name'      =>      'Goal 2',
                'title'     =>      'Goal 2 (During)',
                'owner'     =>      $this->session->userdata('user_id'),
                'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : (($school_id != null) ? $school_id : null),
                'type_id'   =>      $this->getEntityTypeId('g2', 'name'),
                'parent'    =>      $parent_id,
                'weight'    =>      2,
                'mandate'   =>      $mandate
            ),
            array(
                'name'      =>      'Goal 3',
                'title'     =>      'Goal 3 (After)',
                'owner'     =>      $this->session->userdata('user_id'),
                'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : (($school_id != null) ? $school_id : null),
                'type_id'   =>      $this->getEntityTypeId('g3', 'name'),
                'parent'    =>      $parent_id,
                'weight'    =>      3,
                'mandate'   =>      $mandate
            )
        );

        foreach($goalData as $key=> $goal){

            $this->db->insert('eop_entity', $goal);
            $inserted_id = $this->db->insert_id();
            $count = $key +1;
            $entityIds["g{$count}"] = $inserted_id;

            $objectiveData = array(
                'name'      =>      'Goal '.$count.' Objective',
                'title'     =>      'Objective',
                'owner'     =>      $this->session->userdata('user_id'),
                'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : (($school_id != null) ? $school_id : null),
                'type_id'   =>      $this->getEntityTypeId('obj', 'name'),
                'parent'    =>      $inserted_id,
                'weight'    =>      $key,
                'mandate'   =>      $mandate
            );

            $courseOfActionData = array(
                'name'      =>      'Goal '.$count.' Course of Action',
                'title'     =>      'Course of Action',
                'owner'     =>      $this->session->userdata('user_id'),
                'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : (($school_id != null) ? $school_id : null),
                'type_id'   =>      $this->getEntityTypeId('ca', 'name'),
                'parent'    =>      $inserted_id,
                'weight'    =>      $key,
                'mandate'   =>      $mandate
            );

            $fieldData = array( //Field for the goal item
                'entity_id' =>      $inserted_id,
                'name'      =>      'Goal '.$count.' Field',
                'title'     =>      'Goal '.$count.' Field',
                'weight'    =>      1,
                'type'      =>      'text',
                'body'      =>      ''
            );

            $this->db->insert('eop_field', $fieldData);
            $inserted_field_id = $this->db->insert_id();
            $field_ids["g{$count}"]['goal'] = $inserted_field_id;


            //Insert Objective Entity and field
            $this->db->insert('eop_entity', $objectiveData);
            $insertedObjective_id = $this->db->insert_id();
            $entityIds["g{$count}Obj"] = $insertedObjective_id;
            $fieldData = array( //Field for the goal's objective item
                'entity_id' =>      $insertedObjective_id,
                'name'      =>      'Goal '.$count.' Objective Field',
                'title'     =>      'Goal '.$count.' Objective Field',
                'weight'    =>      1,
                'type'      =>      'text',
                'body'      =>      ''
            );
            $this->db->insert('eop_field', $fieldData);
            $inserted_field_id = $this->db->insert_id();
            $field_ids["g{$count}"]['objective'] = $inserted_field_id;


            //Insert Course of Action Entity and field
            $this->db->insert('eop_entity', $courseOfActionData);
            $insertedCourseofAction_id = $this->db->insert_id();
            $entityIds["g{$count}ca"] = $insertedCourseofAction_id;
            $fieldData = array( //Field for the goal's objective item
                'entity_id' =>      $insertedCourseofAction_id,
                'name'      =>      'Goal '.$count.' TH Course of Action Field',
                'title'     =>      'Goal '.$count.' TH Course of Action Field',
                'weight'    =>      1,
                'type'      =>      'text',
                'body'      =>      ''
            );
            $this->db->insert('eop_field', $fieldData);
            $inserted_field_id = $this->db->insert_id();
            $field_ids["g{$count}"]['course_of_action'] = $inserted_field_id;

        }

    }


    public function checkEntityName($name, $type='fn'){
        $this->db->select('name');
        $query = $this->db->get_where('eop_view_entities', array('name'=>$name, 'type'=>$type));
        $recs = $query->num_rows();

        if(is_numeric($recs) && $recs >0){
            return true;
        }
        else{
            return false;
        }
    }
}