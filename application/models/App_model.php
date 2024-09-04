<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: GMajwega
 * Date: 5/8/15
 * Time: 1:03 PM
 */

class App_model extends CI_Model {

    var $tableFields = array();

    public function __construct(){
        parent::__construct();
        $this->load->dbforge();
        $this->load->helper('database');

        $this->tableFields = get_table_fields();
    }
    
    public function addFields($table_name, $fields, $dbdriver = 'mysql'){
        if(empty($dbdriver) || $dbdriver=='')
            $dbdriver = 'mysqli';
        
        $this->dbforge->add_column($table_name, $fields);
    }

    /**
     *
     * @return mixed
     */
    public function createTable($table_name, $dbdriver = 'mysqli'){
        if(empty($dbdriver) || $dbdriver=='')
            $dbdriver = 'mysqli';

        if($dbdriver == 'sqlsrv')
            $this->tableFields = get_sqlsrv_table_fields();

        switch ($table_name){

            case 'eop_access_log':
                $fields = $this->tableFields[$table_name];
                $this->dbforge->add_field($fields);
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table($table_name, TRUE);
                break;
            case 'eop_activity_log':
                $fields = $this->tableFields[$table_name];
                $this->dbforge->add_field($fields);
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table($table_name, TRUE);
                break;
            case 'eop_calendar':
                $fields = $this->tableFields[$table_name];
                $this->dbforge->add_field($fields);
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table($table_name, TRUE);
                break;
            case 'eop_district':
                $fields = $this->tableFields[$table_name];
                $this->dbforge->add_field($fields);
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table($table_name, TRUE);
                break;
            case 'eop_entity':
                $fields = $this->tableFields[$table_name];
                $this->dbforge->add_field($fields);
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table($table_name, TRUE);
                break;
            case 'eop_entity_types':
                $fields = $this->tableFields[$table_name];
                $this->dbforge->add_field($fields);
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table($table_name, TRUE);
                break;
            case 'eop_field':
                $fields = $this->tableFields[$table_name];
                $this->dbforge->add_field($fields);
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table($table_name, TRUE);
                break;
            case 'eop_registry':
                $fields = $this->tableFields[$table_name];
                $this->dbforge->add_field($fields);
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table($table_name, TRUE);
                break;
            case 'eop_role_permission':
                $fields = $this->tableFields[$table_name];
                $this->dbforge->add_field($fields);
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table($table_name, TRUE);
                break;
            case 'eop_school':
                $fields = $this->tableFields[$table_name];
                $this->dbforge->add_field($fields);
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table($table_name, TRUE);
                break;
            case 'eop_state':
                $fields = $this->tableFields[$table_name];
                $this->dbforge->add_field($fields);
                $this->dbforge->add_key('id', TRUE);
                if($dbdriver != 'sqlsrv') {
                    $this->dbforge->add_key('val');
                }
                $this->dbforge->create_table($table_name, TRUE);
                break;
            case 'eop_team':
                $fields = $this->tableFields[$table_name];
                $this->dbforge->add_field($fields);
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table($table_name, TRUE);
                break;
            case 'eop_user':
                $fields = $this->tableFields[$table_name];
                $this->dbforge->add_field($fields);
                $this->dbforge->add_key('user_id', TRUE);
                $this->dbforge->create_table($table_name, TRUE);
                if($dbdriver == 'mysqli') {
                    $this->db->query('ALTER TABLE eop_user ADD UNIQUE INDEX (email)');
                    $this->db->query('ALTER TABLE eop_user ADD UNIQUE INDEX (username)');
                }elseif($dbdriver == 'sqlsrv') {
                    $this->db->query('ALTER TABLE eop_user ADD UNIQUE  (email)');
                    $this->db->query('ALTER TABLE eop_user ADD UNIQUE  (username)');
                }
                break;
            case 'eop_user2district':
                $fields = $this->tableFields[$table_name];
                $this->dbforge->add_field($fields);
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table($table_name, TRUE);
                break;
            case 'eop_user2school':
                $fields = $this->tableFields[$table_name];
                $this->dbforge->add_field($fields);
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table($table_name, TRUE);
                break;
            case 'eop_user_access':
                $fields = $this->tableFields[$table_name];
                $this->dbforge->add_field($fields);
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table($table_name, TRUE);
                break;
            case 'eop_user_roles':
                $fields = $this->tableFields[$table_name];
                $this->dbforge->add_field($fields);
                $this->dbforge->add_key('role_id', TRUE);
                $this->dbforge->create_table($table_name, TRUE);
                if($dbdriver == 'mysqli') {
                    $this->db->query('ALTER TABLE eop_user_roles ADD UNIQUE INDEX (title)');
                }elseif($dbdriver == 'sqlsrv') {
                    $this->db->query('ALTER TABLE eop_user_roles ADD UNIQUE  (title)');
                }
                break;
            case 'eop_page':
                $fields = $this->tableFields[$table_name];
                $this->dbforge->add_field($fields);
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table($table_name, TRUE);
                break;
            case 'eop_resource':
                $fields = $this->tableFields[$table_name];
                $this->dbforge->add_field($fields);
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table($table_name, TRUE);
                break;
            case 'eop_resource2page':
                $fields = $this->tableFields[$table_name];
                $this->dbforge->add_field($fields);
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table($table_name, TRUE);
                break;
            case 'eop_sessions':
                $fields = $this->tableFields[$table_name];
                $this->dbforge->add_field($fields);
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table($table_name, TRUE);
                break;
            case 'eop_files':
                $fields = $this->tableFields[$table_name];
                $this->dbforge->add_field($fields);
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table($table_name, TRUE);
                break;
            case 'eop_exercise':
                $fields = $this->tableFields[$table_name];
                $this->dbforge->add_field($fields);
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table($table_name, TRUE);
                break;
            case 'eop_training':
                $fields = $this->tableFields[$table_name];
                $this->dbforge->add_field($fields);
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table($table_name, TRUE);
                break;
        }
    }

    public function initializeTables($dbdriver='mysqli'){
        if(empty($dbdriver) || $dbdriver=='')
            $dbdriver = 'mysqli';

        switch($dbdriver){
            case 'mysqli':
                //Initialize entity_types master table
                $data = get_default_entity_types();
                $this->db->insert_batch('eop_entity_types', $data);

                //Initialize functions in the entity table
                $data = get_default_functions();
                $this->db->insert_batch('eop_entity', $data);

                //Initialize states table
                $data = get_default_states();
                $this->db->insert_batch('eop_state', $data);


                //Initialize pages table
                $data = get_default_pages();
                $this->db->insert_batch('eop_page', $data);

                //Initialize user roles master table

                $this->db->query("INSERT INTO eop_user_roles VALUES (1,'Super Admin','Super Administrator','Super Administrator','n','y','y','y','y','n','n','y','y','y','y',1),(2,'State Administrator','State Administrator','State Administrator','n','y','y','y','y','n','n','y','y','y','y',2),(3,'District Administrator','District Administrator','District Administrator','n','y','y','n','n','n','n','y','y','y','y',3),(4,'School Administrator','School Administrator','School Administrator','n','y','y','n','n','n','n','y','y','y','y',4),(5,'School User','School User','School User','n','y','y','n','n','n','n','y','y','n','y',5)");
                break;

            case 'sqlsrv':
                //Initialize entity_types master table
                $data = get_default_entity_types();
                foreach ($data as $record) {
                    array_shift($record);
                    $this->db->insert('eop_entity_types', $record);
                }


                //Initialize functions in the entity table
                $data = get_default_functions();
                foreach ($data as $record) {
                    array_shift($record);
                    $this->db->insert('eop_entity', $record);
                }


                //Initialize states table
                $data = get_default_states();
                foreach ($data as $key => $record) {
                    $this->db->insert('eop_state', $record);
                }


                //Initialize pages table
                $data = get_default_pages();
                foreach ($data as $key => $record) {
                    $this->db->insert('eop_page', $record);
                }

                //Initialize user roles master table

                $this->db->query("INSERT INTO eop_user_roles VALUES ('Super Admin','Super Administrator','Super Administrator','n','y','y','y','y','n','n','y','y','y','y',1)");
                $this->db->query("INSERT INTO eop_user_roles VALUES ('State Administrator','State Administrator','State Administrator','n','y','y','y','y','n','n','y','y','y','y',2)");
                $this->db->query("INSERT INTO eop_user_roles VALUES ('District Administrator','District Administrator','District Administrator','n','y','y','n','n','n','n','y','y','y','y',3)");
                $this->db->query("INSERT INTO eop_user_roles VALUES ('School Administrator','School Administrator','School Administrator','n','y','y','n','n','n','n','y','y','y','y',4)");
                $this->db->query("INSERT INTO eop_user_roles VALUES ('School User','School User','School User','n','y','y','n','n','n','n','y','y','n','y',5)");
                break;

        }

    }

    public function createViews($dbdriver='mysqli'){

        if(empty($dbdriver) || $dbdriver=='')
            $dbdriver = 'mysqli';

        $this->db->query(
            "CREATE
VIEW eop_view_entities AS
    SELECT
        A.id AS id,
        A.type_id AS type_id,
        A.sid AS sid,
        A.name AS name,
        A.title AS title,
        A.owner AS owner,
        A.parent AS parent,
        A.weight AS weight,
        A.ref_key AS ref_key,
        A.created AS created,
        A.timestamp AS timestamp,
        A.description AS description,
        A.mandate AS mandate,
        A.copy AS copy,
        B.name AS type,
        B.title AS type_title,
        C.name AS school,
        C.screen_name AS 'school screen name',
        D.did AS district_id,
        F.level AS owner_role_level
        
    FROM
        (((((eop_entity A
        LEFT JOIN eop_entity_types B ON ((A.type_id = B.id)))
        LEFT JOIN eop_school C ON ((A.sid = C.id)))
        LEFT JOIN eop_user2district D ON ((D.uid = A.owner)))
        LEFT JOIN eop_user E ON ((A.owner = E.user_id)))
        LEFT JOIN eop_user_roles F ON ((E.role_id = F.role_id)))"
        );
        $orderby = ($dbdriver == 'mysqli') ? " ORDER BY A.name " : " ";
        $this->db->query(
            "CREATE

VIEW eop_view_school AS
    SELECT
        A.id AS id,
        A.district_id AS district_id,
        A.state_val AS state_val,
        A.name AS name,
        A.screen_name AS screen_name,
        A.description AS description,
        A.created_date AS created_date,
        A.modified_date AS modified_date,
        A.sys_preferences AS preferences,
        A.owner AS owner,
        A.state_permission AS state_permission,
        B.name AS district,
        B.screen_name AS district_screen_name,
        C.name AS state
    FROM
        ((eop_school A
        LEFT JOIN eop_district B ON ((A.district_id = B.id)))
        LEFT JOIN eop_state C ON ((A.state_val = C.val))) " . $orderby
        );
        
        $this->db->query(
            "CREATE 
   
VIEW eop_view_school_user AS
    SELECT 
        A.user_id AS user_id,
        D.name AS school,
        D.id AS school_id,
        F.id AS district_id,
        F.name AS district
    FROM
        ((((eop_user A
        JOIN eop_user_roles B ON ((A.role_id = B.role_id)))
        LEFT JOIN eop_user2school C ON ((A.user_id = C.uid)))
        LEFT JOIN eop_school D ON ((C.sid = D.id)))
        LEFT JOIN eop_district F ON ((D.district_id = F.id)))
    WHERE
        (A.role_id >= 4)"
        );
        
        $this->db->query(
            "CREATE

VIEW eop_view_user AS
    SELECT 
        A.user_id AS user_id,
        A.role_id AS role_id,
        A.first_name AS first_name,
        A.last_name AS last_name,
        A.email AS email,
        A.username AS username,
        A.password AS password,
        A.phone AS phone,
        A.status AS status,
        A.join_date AS join_date,
        A.modified AS modified,
        A.read_only AS read_only,
        B.title AS role,
        D.name AS school,
        D.id AS school_id,
        F.id AS district_id,
        F.name AS district
    FROM
        (((((eop_user A
        JOIN eop_user_roles B ON ((A.role_id = B.role_id)))
        LEFT JOIN eop_user2school C ON ((A.user_id = C.uid)))
        LEFT JOIN eop_school D ON ((C.sid = D.id)))
        LEFT JOIN eop_user2district E ON ((A.user_id = E.uid)))
        LEFT JOIN eop_district F ON ((E.did = F.id)))"
        );
    }
}