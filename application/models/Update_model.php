<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: GMajwega
 * Date: 5/8/15
 * Time: 1:03 PM
 */

class Update_model extends CI_Model {

    var $tableFields = array();

    public function __construct(){
        parent::__construct();
        $this->load->dbforge();
        $this->load->helper('database');

        $this->tableFields = get_table_fields();
    }

    public function dropTable($table_name){

        $this->dbforge->drop_table($table_name, TRUE);
    }


    public function populatePages($dbdriver='mysqli'){
        if(empty($dbdriver) || $dbdriver=='')
            $dbdriver = 'mysqli';

        switch($dbdriver){
            case 'mysqli':

                //Initialize pages table
                $data = get_default_pages();
                $this->db->insert_batch('eop_page', $data);

                break;

            case 'sqlsrv':

                //Initialize pages table
                $data = get_default_pages();
                foreach ($data as $key => $record) {
                    $this->db->insert('eop_page', $record);
                }

                break;

        }

    }

    public function updateEntityTable(){

        switch ($this->config->item('db')['dbdriver']){

            case 'mysqli':

                $query=<<<EOF
ALTER TABLE eop_entity 
ADD COLUMN mandate VARCHAR(16) NULL DEFAULT 'school',
ADD COLUMN ref_key VARCHAR(255) NULL DEFAULT NULL,
ADD COLUMN copy INT(2) NOT NULL DEFAULT 0;
EOF;
                
                if($this->db->query($query)){
                    $this->db->query("UPDATE eop_entity SET copy=0");
                }else{ }


                break;

            case 'sqlsrv':

                $query=<<<EOF
ALTER TABLE eop_entity ADD  
    mandate VARCHAR(16) NULL DEFAULT 'school',
    ref_key VARCHAR(255) NULL DEFAULT NULL,
    copy INT NOT NULL DEFAULT 0;
EOF;
                if($this->db->query($query)){

                }
                break;
        }
    }

    public function updateViews($dbdriver='mysqli'){

        $orderby = ($dbdriver == 'mysqli') ? " ORDER BY A.name " : " ";

        $this->db->query("DROP VIEW eop_view_entities");

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
        LEFT JOIN eop_user_roles F ON ((E.role_id = F.role_id))) ". $orderby
        );

    }
}