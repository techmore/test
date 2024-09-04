<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Database Management Helper functions
 */


/**
 *  Helpers for Database Tables and Fields
 */
if ( ! function_exists('get_table_fields')) {
	function get_table_fields() {

        $fields = array(
            'eop_access_log'    =>  array(

                'id' => array(
                    'type'              => 'INT',
                    'constraint'        => 11,
                    'null'              => FALSE,
                    'auto_increment'    => TRUE
                ),
                'timestamp timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
                'body'      =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  256,
                    'default'       =>  NULL
                )
            ),
            'eop_activity_log'  =>  array(

                'id'    =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  11,
                    'null'              =>  FALSE,
                    'auto_increment'    =>  TRUE
                ),
                'timestamp timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
                'uid'           =>  array(
                    'type'          =>  'INT',
                    'constraint'    =>  32,
                    'null'          =>  TRUE
                ),
                'entity_id'     =>  array(
                    'type'          =>  'INT',
                    'constraint'    =>  32,
                    'null'          =>  TRUE
                ),
                'field_id'      =>  array(
                    'type'          =>  'INT',
                    'constraint'    =>  32,
                    'null'          =>  TRUE
                ),
                'activity'      =>  array(
                    'type'          =>  'INT',
                    'constraint'    =>  45,
                    'null'          =>  TRUE
                ),
                'body'          =>  array(
                    'type'          =>  'text',
                    'null'          =>  TRUE
                ),
                'description'   =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  128,
                    'null'          =>  TRUE
                )
            ),
            'eop_calendar'      =>  array(
                'id'            =>  array(
                    'type'          =>  'INT',
                    'constraint'    =>  11,
                    'null'          =>  FALSE,
                    'auto_increment'=>  TRUE
                ),
                'title'         =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  255,
                    'null'          =>  FALSE
                ),
                'body'          =>  array(
                    'type'          =>  'text',
                    'null'          =>  FALSE
                ),
                'start_time'    =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  100,
                    'null'          =>  FALSE,
                ),
                'end_time'      =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  100,
                    'null'          =>  FALSE
                ),
                'location'      =>  array(
                    'type'          =>  'text',
                    'null'          =>  FALSE
                ),
                'modified_by'   =>  array(
                    'type'          =>  'INT',
                    'constraint'    =>  11,
                    'null'          =>  FALSE
                ),
                'modification_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
                'allDay'        =>  array(
                    'type'          =>  'INT',
                    'constraint'    =>  2,
                    'default'       => 0
                ),
                'url'           =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  255,
                    'null'          =>  TRUE
                ),
                'className'     =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  32,
                    'null'          =>  TRUE
                ),
                'editable'      =>  array(
                    'type'          =>  'INT',
                    'constraint'    =>  2,
                    'default'       =>  0
                ),
                'startEditable'=>   array(
                    'type'          =>  'INT',
                    'constraint'    =>  2,
                    'default'       =>  0
                ),
                'durationEditable'=> array(
                    'type'          =>  'INT',
                    'constraint'    =>  2,
                    'default'       =>  0
                ),
                'rendering'     =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  255,
                    'null'          =>  TRUE
                ),
                'overlap'       =>  array(
                    'type'          =>  'INT',
                    'constraint'    =>  2,
                    'default'       =>  0
                ),
                'source'        =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  64,
                    'null'          =>  TRUE
                ),
                'color'         =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  32,
                    'null'          =>  TRUE
                ),
                'backgroundColor'=> array(
                    'type'          =>  'varchar',
                    'constraint'    =>  32,
                    'null'          =>  TRUE
                ),
                'borderColor'   =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  32,
                    'null'          =>  TRUE
                ),
                'textColor'     =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  32,
                    'null'          =>  TRUE
                ),
                'sid'           =>  array(
                    'type'          =>  'INT',
                    'constraint'    =>  32,
                    'null'          =>  TRUE
                ),
            ),
            'eop_district'      =>  array(
                'id'            =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  11,
                    'null'              =>  FALSE,
                    'auto_increment'    =>  TRUE
                ),
                'name'          =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  128,
                    'null'              =>  FALSE
                ),
                'screen_name'   =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  128,
                    'null'              =>  TRUE
                ),
                'description'   =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  128,
                    'null'              =>  TRUE
                ),
                'state_val'     =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  8,
                    'null'              =>  TRUE
                ),
                'modified_date timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
                'owner'         =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  32,
                    'null'              =>  TRUE
                ),
                'state_permission'=>array(
                    'type'              =>  'varchar',
                    'constraint'        =>  45,
                    'default'           =>  'deny'
                )
            ),
            'eop_entity'    =>  array(
                'id'            =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  11,
                    'null'              =>  FALSE,
                    'auto_increment'    =>  TRUE
                ),
                'type_id'       =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  32,
                    'null'              =>  TRUE
                ),
                'sid'           =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  32,
                    'null'              =>  TRUE
                ),
                'name'          =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  128,
                    'null'              =>  TRUE
                ),
                'title'         =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  128,
                    'null'              =>  TRUE
                ),
                'owner'         =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  32,
                    'null'              =>  TRUE
                ),
                'parent'        =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  32,
                    'null'              =>  TRUE
                ),
                'weight'        =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  8,
                    'null'              =>  TRUE
                ),
                'created datetime NULL DEFAULT CURRENT_TIMESTAMP',
                'timestamp timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
                'description'   =>  array(
                    'type'              =>  'longtext',
                    'null'              =>  TRUE
                ),
                'mandate'       =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  16,
                    'default'           =>  'school',
                    'null'              =>  TRUE
                ),
                'ref_key'       =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  TRUE
                ),
                'copy'          =>  array(
                    'type'              =>  'int',
                    'constraint'        =>  2,
                    'default'           =>  0,
                    'null'              =>  FALSE
                )
            ),
            'eop_entity_types'  =>  array(
                'id'    =>  array(
                    'type'          =>  'INT',
                    'constraint'    =>  11,
                    'null'          =>  FALSE,
                    'auto_increment'=>  TRUE
                ),
                'name'  =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  64,
                    'null'          =>  TRUE
                ),
                'title' =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  128,
                    'null'          =>  TRUE
                )
            ),
            'eop_field'     =>  array(
                'id'            =>  array(
                    'type'          =>  'INT',
                    'constraint'    =>  11,
                    'null'          =>  FALSE,
                    'auto_increment'=>  TRUE
                ),
                'entity_id'     =>  array(
                    'type'          =>  'INT',
                    'constraint'    =>  32,
                    'null'          =>  TRUE
                ),
                'name'          =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  128,
                    'null'          =>  TRUE
                ),
                'title'         =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  128,
                    'null'          =>  TRUE
                ),
                'weight'        =>  array(
                    'type'          =>  'INT',
                    'constraint'    =>  8,
                    'null'          =>  TRUE
                ),
                'created datetime NULL DEFAULT CURRENT_TIMESTAMP',
                'timestamp timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
                'type'          =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  45,
                    'null'          =>  TRUE
                ),
                'body'          =>  array(
                    'type'          =>  'longtext',
                    'null'          =>  TRUE
                )
            ),
            'eop_registry'      =>  array(
                'id'        =>  array(
                    'type'          =>  'INT',
                    'constraint'    =>  11,
                    'null'          =>  FALSE,
                    'auto_increment'=>  TRUE
                ),
                'rkey'      =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  32,
                    'null'          =>  FALSE
                ),
                'value'     =>  array(
                    'type'          =>  'longtext',
                    'null'          =>  FALSE
                ),
                'timestamp timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
            ),
            'eop_role_permission'       =>  array(
                'id'        =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  11,
                    'null'              =>  FALSE,
                    'auto_increment'    =>  TRUE
                ),
                'rid'       =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  32,
                    'null'              =>  TRUE
                ),
                'uid'       =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  32,
                    'null'              =>  TRUE
                ),
                'entity_id' =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  32,
                    'null'              =>  TRUE
                ),
                'field_id'  =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  32,
                    'null'              =>  TRUE
                ),
                'permissions'=> array(
                    'type'              =>  'varchar',
                    'constraint'        =>  45,
                    'null'              =>  TRUE
                ),
            ),
            'eop_school'    =>  array(
                'id'            =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  11,
                    'null'              =>  FALSE,
                    'auto_increment'    =>  TRUE
                ),
                'district_id'   =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  32,
                    'null'              =>  FALSE,
                    'default'           =>  0
                ),
                'state_val'     =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  8,
                    'null'              =>  TRUE
                ),
                'name'          =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  128,
                    'null'              =>  TRUE
                ),
                'screen_name'   =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  256,
                    'null'              =>  TRUE
                ),
                'description'   =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  256,
                    'null'              =>  TRUE
                ),
                'created_date datetime NULL DEFAULT CURRENT_TIMESTAMP',
                'modified_date timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
                'owner'         =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  32,
                    'null'              =>  TRUE
                ),
                'state_permission'=>    array(
                    'type'              =>  'varchar',
                    'constraint'        =>  45,
                    'default'           =>  'deny'
                ),
                'sys_preferences'   =>  array(
                    'type'              =>  'longtext',
                    'null'              =>  TRUE
                ),
            ),
            'eop_state'     =>  array(
                'id'        =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  11,
                    'null'              =>  FALSE,
                    'auto_increment'    =>  TRUE
                ),
                'val'       =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  8,
                    'null'              =>  FALSE
                ),
                'name'      =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  64,
                    'null'              =>  FALSE
                ),
                'screen_name'   =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  128,
                    'null'              =>  TRUE
                )
            ),
            'eop_team'      =>  array(
                'id'            =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  11,
                    'null'              =>  FALSE,
                    'auto_increment'    =>  TRUE
                ),
                'name'          =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  FALSE
                ),
                'title'         =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  TRUE
                ),
                'organization'  =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  TRUE
                ),
                'email'         =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  TRUE
                ),
                'phone'         =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  32,
                    'null'              =>  TRUE
                ),
                'interest'      =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  TRUE
                ),
                'timestamp timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
                'created datetime NULL DEFAULT CURRENT_TIMESTAMP',
                'owner'         =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  32,
                    'null'              =>  FALSE
                ),
                'sid'           =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  32,
                    'null'              =>  TRUE
                ),
                'did'           =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  32,
                    'null'              =>  TRUE
                )
            ),
            'eop_user'      =>  array(
                'user_id'       =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  11,
                    'null'              =>  FALSE,
                    'auto_increment'    =>  TRUE
                ),
                'role_id'       =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  11,
                    'null'              =>  FALSE,
                ),
                'first_name'    =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  TRUE
                ),
                'last_name'     =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  TRUE
                ),
                'email'         =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  128,
                    'null'              =>  FALSE
                ),
                'username'      =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  FALSE
                ),
                'password'      =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  FALSE
                ),
                'phone'         =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  30,
                    'null'              =>  TRUE
                ),
                'status'        =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  24,
                    'null'              =>  TRUE
                ),
                'join_date datetime NULL DEFAULT CURRENT_TIMESTAMP',
                'modified timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
                'read_only'     =>  array(
                    'type'              =>  'char',
                    'constraint'        =>  1,
                    'null'              =>  FALSE,
                    'default'           =>  'n'
                )
            ),
            'eop_user2district'     =>  array(
                'id'        =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  11,
                    'null'              =>  FALSE,
                    'auto_increment'    =>  TRUE
                ),
                'uid'       =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  32,
                    'null'              =>  TRUE
                ),
                'did'       =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  32,
                    'null'              =>  TRUE
                ),
                'timestamp timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
            ),
            'eop_user2school'     =>  array(
                'id'        =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  11,
                    'null'              =>  FALSE,
                    'auto_increment'    =>  TRUE
                ),
                'uid'       =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  32,
                    'null'              =>  TRUE
                ),
                'sid'       =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  32,
                    'null'              =>  TRUE
                ),
                'timestamp timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
            ),
            'eop_user_access'       =>  array(
                'id'        =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  11,
                    'null'              =>  FALSE,
                    'auto_increment'    =>  TRUE
                ),
                'uid'       =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  32,
                    'null'              =>  TRUE
                ),
                'entity_id' =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  32,
                    'null'              =>  TRUE
                ),
                'field_id'  =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  32,
                    'null'              =>  TRUE
                ),
                'permissions'   =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  45,
                    'null'              =>  TRUE
                ),
            ),
            'eop_user_roles'    =>  array(
                'role_id'       =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  11,
                    'null'              =>  FALSE,
                    'auto_increment'    =>  TRUE
                ),
                'title'         =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  100,
                    'null'              =>  FALSE
                ),
                'screen_name'   =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  32,
                    'null'              =>  TRUE
                ),
                'description'   =>  array(
                    'type'              =>  'text'
                ),
                'is_locked'     =>  array(
                    'type'              =>  'char',
                    'constraint'        =>  1,
                    'null'              =>  FALSE,
                    'default'           =>  'n'
                ),
                'can_view'      =>  array(
                    'type'              =>  'char',
                    'constraint'        =>  1,
                    'null'              =>  FALSE,
                    'default'           =>  'y'
                ),
                'can_edit'      =>  array(
                    'type'              =>  'char',
                    'constraint'        =>  1,
                    'null'              =>  FALSE,
                    'default'           =>  'y'
                ),
                'create_district'=> array(
                    'type'              =>  'char',
                    'constraint'        =>  1,
                    'null'              =>  FALSE,
                    'default'           =>  'n'
                ),
                'edit_district' =>  array(
                    'type'              =>  'char',
                    'constraint'        =>  1,
                    'null'              =>  FALSE,
                    'default'           =>  'n'
                ),
                'create_school' =>  array(
                    'type'              =>  'char',
                    'constraint'        =>  1,
                    'null'              =>  FALSE,
                    'default'           =>  'n'
                ),
                'edit_school'   =>  array(
                    'type'              =>  'char',
                    'constraint'        =>  1,
                    'null'              =>  FALSE,
                    'default'           =>  'n'
                ),
                'create_user'   =>  array(
                    'type'              =>  'char',
                    'constraint'        =>  1,
                    'null'              =>  FALSE,
                    'default'           =>  'y'
                ),
                'edit_user'     =>  array(
                    'type'              =>  'char',
                    'constraint'        =>  1,
                    'null'              =>  FALSE,
                    'default'           =>  'y'
                ),
                'alter_state_access'=>  array(
                    'type'              =>  'char',
                    'constraint'        =>  1,
                    'null'              =>  FALSE,
                    'default'           =>  'n'
                ),
                'edit_entity'   =>  array(
                    'type'              =>  'char',
                    'constraint'        =>  1,
                    'null'              =>  FALSE,
                    'default'           =>  'y'
                ),
                'level' =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  8,
                    'null'              =>  TRUE
                )
            ),
            'eop_page'      =>  array(
                'id'            =>  array(
                    'type'              =>  'int',
                    'constraint'        =>  11,
                    'null'              =>  FALSE,
                    'auto_increment'    =>  TRUE
                ),
                'name'          =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  FALSE
                ),
                'title'         =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  FALSE
                ),
                'content'       =>  array(
                    'type'              =>  'longtext',
                    'null'              =>  TRUE
                ),
                'url'           =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  TRUE
                ),
                'timestamp TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
                'url_alias'     =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  TRUE
                )
            ),
            'eop_resource'      => array(
                'id'                => array(
                    'type'              =>  'int',
                    'constraint'        =>  11,
                    'null'              =>  FALSE,
                    'auto_increment'    =>  TRUE
                ),
                'name'              =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  500,
                    'null'              =>  TRUE
                ),
                'url'               =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  500,
                    'null'              =>  TRUE,
                ),
                'section'           =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  TRUE
                ),
                'shared'            =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  32,
                    'default'           =>  'default'
                ),
                'timestamp TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
                'district_id'       =>  array(
                    'type'              =>  'int',
                    'constraint'        =>  11,
                    'null'              =>  TRUE
                ),
                'school_id'         =>  array(
                    'type'              =>  'int',
                    'constraint'        =>  11,
                    'null'              =>  TRUE
                )
            ),
            'eop_resource2page' =>  array(
                'id'                =>  array(
                    'type'              =>  'int',
                    'constraint'        =>  11,
                    'null'              =>  FALSE,
                    'auto_increment'    =>  TRUE
                ),
                'resource_id'       =>  array(
                    'type'              =>  'int',
                    'constraint'        =>  11,
                    'null'              =>  FALSE
                ),
                'page_id'           =>  array(
                    'type'              =>  'int',
                    'constraint'        =>  11,
                    'null'              =>  FALSE
                ),
                'timestamp TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            ),
            'eop_sessions'  =>  array(
                'id'            =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  128,
                    'null'          =>  FALSE
                ),
                'ip_address'    =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  45,
                    'null'          =>  FALSE
                ),
                'timestamp'     =>  array(
                    'type'          =>  'int',
                    'constraint'    =>  11,
                    'null'          =>  FALSE,
                    'default'       =>  0
                ),
                'data'          =>  array(
                    'type'          =>  'blob',
                    'null'          =>  FALSE
                )
            ),
            'eop_files' =>  array(
                'id'                =>  array(
                    'type'              =>  'int',
                    'constraint'        =>  11,
                    'null'              =>  FALSE,
                    'auto_increment'    =>  TRUE
                ),
                'name'              =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  FALSE
                ),
                'created DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP',
                'data'              => array(
                    'type'              => 'longtext',
                    'null'              => TRUE,

                ),
                'owner'         =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  11,
                    'null'              =>  TRUE
                ),
                'sid'           =>  array(
                    'type'          =>  'INT',
                    'constraint'    =>  32,
                    'null'          =>  TRUE
                ),
                'did'           =>  array(
                    'type'          =>  'INT',
                    'constraint'    =>  32,
                    'null'          =>  TRUE
                )
            ),
            'eop_exercise' =>  array(
                'id'                =>  array(
                    'type'              =>  'int',
                    'constraint'        =>  11,
                    'null'              =>  FALSE,
                    'auto_increment'    =>  TRUE
                ),
                'name'              =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  FALSE
                ),
                'type'              =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  TRUE
                ),
                'location'              =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  TRUE
                ),
                'contact'           =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  TRUE
                ),
                'description'       =>  array(
                    'type'              =>  'text',
                    'null'              =>  TRUE
                ),
                'date'           =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  TRUE
                ),
                'timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
                'created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
                'owner'         =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  32,
                    'null'              =>  FALSE
                ),
                'sid'           =>  array(
                    'type'          =>  'INT',
                    'constraint'    =>  32,
                    'null'          =>  TRUE
                ),
                'did'           =>  array(
                    'type'          =>  'INT',
                    'constraint'    =>  32,
                    'null'          =>  TRUE
                ),
                'file'          => array(
                    'type'          => 'text',
                    'null'          => TRUE
                ),
                'host'          => array(
                    'type'          =>  'varchar',
                    'constraint'    =>  16,
                    'null'          =>  true
                )
            ),
            'eop_training' =>  array(
                'id'                =>  array(
                    'type'              =>  'int',
                    'constraint'        =>  11,
                    'null'              =>  FALSE,
                    'auto_increment'    =>  TRUE
                ),
                'name'              =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  FALSE
                ),
                'topic'              =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  TRUE
                ),
                'location'              =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  TRUE
                ),
                'format'           =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  TRUE
                ),
                'description'       =>  array(
                    'type'              =>  'text',
                    'null'              =>  TRUE
                ),
                'date'           =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  TRUE
                ),
                'participants'  =>  array(
                    'type'              => 'INT',
                    'constraint'        =>  32,
                    'null'              =>  TRUE
                ),
                'personnel'     =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              => TRUE
                ),
                'score'         =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  64,
                    'null'              =>  TRUE
                ),
                'provider'      =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  32,
                    'null'              =>  FALSE,
                    'default'           =>  'school-provided'
                ),
                'schools'       =>  array(
                    'type'              => 'INT',
                    'constraint'        =>  32,
                    'null'              =>  TRUE
                ),
                'leas'          =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  32,
                    'null'              =>  TRUE
                ),
                'rleas'          =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  32,
                    'null'              =>  TRUE
                ),
                'timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
                'created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
                'owner'         =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  32,
                    'null'              =>  FALSE
                ),
                'sid'           =>  array(
                    'type'          =>  'INT',
                    'constraint'    =>  32,
                    'null'          =>  TRUE
                ),
                'did'           =>  array(
                    'type'          =>  'INT',
                    'constraint'    =>  32,
                    'null'          =>  TRUE
                ),
                'file'          => array(
                    'type'          => 'text',
                    'null'          => TRUE
                )
            )
        );

        return $fields;

	}
}

if ( ! function_exists('get_sqlsrv_table_fields')) {
    function get_sqlsrv_table_fields() {

        $fields = array(
            'eop_access_log'    =>  array(

                'id' => array(
                    'type'              => 'INT',
                    'null'              => FALSE,
                    'auto_increment'    => TRUE
                ),
                'timestamp DATETIME NULL DEFAULT GETDATE()',
                'body'      =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  256,
                    'default'       =>  NULL
                )
            ),
            'eop_activity_log'  =>  array(

                'id'    =>  array(
                    'type'              =>  'INT',
                    'null'              =>  FALSE,
                    'auto_increment'    =>  TRUE
                ),
                'timestamp DATETIME NULL DEFAULT GETDATE()',
                'uid'           =>  array(
                    'type'          =>  'INT',
                    'null'          =>  TRUE
                ),
                'entity_id'     =>  array(
                    'type'          =>  'INT',
                    'null'          =>  TRUE
                ),
                'field_id'      =>  array(
                    'type'          =>  'INT',
                    'null'          =>  TRUE
                ),
                'activity'      =>  array(
                    'type'          =>  'INT',
                    'null'          =>  TRUE
                ),
                'body'          =>  array(
                    'type'          =>  'text',
                    'null'          =>  TRUE
                ),
                'description'   =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  128,
                    'null'          =>  TRUE
                )
            ),
            'eop_calendar'      =>  array(
                'id'            =>  array(
                    'type'          =>  'INT',
                    'null'          =>  FALSE,
                    'auto_increment'=>  TRUE
                ),
                'title'         =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  255,
                    'null'          =>  FALSE
                ),
                'body'          =>  array(
                    'type'          =>  'text',
                    'null'          =>  FALSE
                ),
                'start_time'    =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  100,
                    'null'          =>  FALSE,
                ),
                'end_time'      =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  100,
                    'null'          =>  FALSE
                ),
                'location'      =>  array(
                    'type'          =>  'text',
                    'null'          =>  FALSE
                ),
                'modified_by'   =>  array(
                    'type'          =>  'INT',
                    'null'          =>  FALSE
                ),
                'modification_date DATETIME NOT NULL DEFAULT GETDATE()',
                'allDay'        =>  array(
                    'type'          =>  'INT',
                    'default'       => 0
                ),
                'url'           =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  255,
                    'null'          =>  TRUE
                ),
                'className'     =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  32,
                    'null'          =>  TRUE
                ),
                'editable'      =>  array(
                    'type'          =>  'INT',
                    'default'       =>  0
                ),
                'startEditable'=>   array(
                    'type'          =>  'INT',
                    'default'       =>  0
                ),
                'durationEditable'=> array(
                    'type'          =>  'INT',
                    'default'       =>  0
                ),
                'rendering'     =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  255,
                    'null'          =>  TRUE
                ),
                'overlap'       =>  array(
                    'type'          =>  'INT',
                    'default'       =>  0
                ),
                'source'        =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  64,
                    'null'          =>  TRUE
                ),
                'color'         =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  32,
                    'null'          =>  TRUE
                ),
                'backgroundColor'=> array(
                    'type'          =>  'varchar',
                    'constraint'    =>  32,
                    'null'          =>  TRUE
                ),
                'borderColor'   =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  32,
                    'null'          =>  TRUE
                ),
                'textColor'     =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  32,
                    'null'          =>  TRUE
                ),
                'sid'           =>  array(
                    'type'          =>  'INT',
                    'null'          =>  TRUE
                ),
            ),
            'eop_district'      =>  array(
                'id'            =>  array(
                    'type'              =>  'INT',
                    'null'              =>  FALSE,
                    'auto_increment'    =>  TRUE
                ),
                'name'          =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  128,
                    'null'              =>  FALSE
                ),
                'screen_name'   =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  128,
                    'null'              =>  TRUE
                ),
                'description'   =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  128,
                    'null'              =>  TRUE
                ),
                'state_val'     =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  8,
                    'null'              =>  TRUE
                ),
                'modified_date DATETIME NULL DEFAULT GETDATE()',
                'owner'         =>  array(
                    'type'              =>  'INT',
                    'null'              =>  TRUE
                ),
                'state_permission'=>array(
                    'type'              =>  'varchar',
                    'constraint'        =>  45,
                    'default'           =>  'deny'
                )
            ),
            'eop_entity'    =>  array(
                'id'            =>  array(
                    'type'              =>  'INT',
                    'null'              =>  FALSE,
                    'auto_increment'    =>  TRUE
                ),
                'type_id'       =>  array(
                    'type'              =>  'INT',
                    'null'              =>  TRUE
                ),
                'sid'           =>  array(
                    'type'              =>  'INT',
                    'null'              =>  TRUE
                ),
                'name'          =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  128,
                    'null'              =>  TRUE
                ),
                'title'         =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  128,
                    'null'              =>  TRUE
                ),
                'owner'         =>  array(
                    'type'              =>  'INT',
                    'null'              =>  TRUE
                ),
                'parent'        =>  array(
                    'type'              =>  'INT',
                    'null'              =>  TRUE
                ),
                'weight'        =>  array(
                    'type'              =>  'INT',
                    'null'              =>  TRUE
                ),
                'created datetime DEFAULT GETDATE()',
                'timestamp DATETIME NULL DEFAULT GETDATE()',
                'description'   =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  'MAX',
                    'null'              =>  TRUE
                ),
                'mandate'       =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  16,
                    'null'              =>  TRUE,
                    'default'           =>  'school'
                ),
                'ref_key'       =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  TRUE
                ),
                'copy'          =>  array(
                    'type'              =>  'INT',
                    'null'              =>  FALSE,
                    'default'           =>  0
                )
            ),
            'eop_entity_types'  =>  array(
                'id'    =>  array(
                    'type'          =>  'INT',
                    'null'          =>  FALSE,
                    'auto_increment'=>  TRUE
                ),
                'name'  =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  64,
                    'null'          =>  TRUE
                ),
                'title' =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  128,
                    'null'          =>  TRUE
                )
            ),
            'eop_field'     =>  array(
                'id'            =>  array(
                    'type'          =>  'INT',
                    'null'          =>  FALSE,
                    'auto_increment'=>  TRUE
                ),
                'entity_id'     =>  array(
                    'type'          =>  'INT',
                    'null'          =>  TRUE
                ),
                'name'          =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  128,
                    'null'          =>  TRUE
                ),
                'title'         =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  128,
                    'null'          =>  TRUE
                ),
                'weight'        =>  array(
                    'type'          =>  'INT',
                    'null'          =>  TRUE
                ),
                'created datetime DEFAULT GETDATE()',
                'timestamp DATETIME NULL DEFAULT GETDATE()',
                'type'          =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  45,
                    'null'          =>  TRUE
                ),
                'body'          =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  'MAX',
                    'null'          =>  TRUE
                )
            ),
            'eop_registry'      =>  array(
                'id'        =>  array(
                    'type'          =>  'INT',
                    'null'          =>  FALSE,
                    'auto_increment'=>  TRUE
                ),
                'rkey'      =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  32,
                    'null'          =>  FALSE
                ),
                'value'     =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  'MAX',
                    'null'          =>  FALSE
                ),
                'timestamp DATETIME NULL DEFAULT GETDATE()'
            ),
            'eop_role_permission'       =>  array(
                'id'        =>  array(
                    'type'              =>  'INT',
                    'null'              =>  FALSE,
                    'auto_increment'    =>  TRUE
                ),
                'rid'       =>  array(
                    'type'              =>  'INT',
                    'null'              =>  TRUE
                ),
                'uid'       =>  array(
                    'type'              =>  'INT',
                    'null'              =>  TRUE
                ),
                'entity_id' =>  array(
                    'type'              =>  'INT',
                    'null'              =>  TRUE
                ),
                'field_id'  =>  array(
                    'type'              =>  'INT',
                    'null'              =>  TRUE
                ),
                'permissions'=> array(
                    'type'              =>  'varchar',
                    'constraint'        =>  45,
                    'null'              =>  TRUE
                ),
            ),
            'eop_school'    =>  array(
                'id'            =>  array(
                    'type'              =>  'INT',
                    'null'              =>  FALSE,
                    'auto_increment'    =>  TRUE
                ),
                'district_id'   =>  array(
                    'type'              =>  'INT',
                    'null'              =>  FALSE,
                    'default'           =>  0
                ),
                'state_val'     =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  8,
                    'null'              =>  TRUE
                ),
                'name'          =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  128,
                    'null'              =>  TRUE
                ),
                'screen_name'   =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  256,
                    'null'              =>  TRUE
                ),
                'description'   =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  256,
                    'null'              =>  TRUE
                ),
                'created_date datetime DEFAULT GETDATE()',
                'modified_date DATETIME NULL DEFAULT GETDATE()',
                'owner'         =>  array(
                    'type'              =>  'INT',
                    'null'              =>  TRUE
                ),
                'state_permission'=>    array(
                    'type'              =>  'varchar',
                    'constraint'        =>  45,
                    'default'           =>  'deny'
                ),
                'sys_preferences'   =>  array(
                    'type'              =>  'varchar',
                    'constant'          =>  'MAX',
                    'null'              =>  TRUE
                ),
            ),
            'eop_state'     =>  array(
                'id'        =>  array(
                    'type'              =>  'INT',
                    'null'              =>  FALSE,
                    'auto_increment'    =>  TRUE
                ),
                'val'       =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  8,
                    'null'              =>  FALSE
                ),
                'name'      =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  64,
                    'null'              =>  FALSE
                ),
                'screen_name'   =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  128,
                    'null'              =>  TRUE
                )
            ),
            'eop_team'      =>  array(
                'id'            =>  array(
                    'type'              =>  'INT',
                    'null'              =>  FALSE,
                    'auto_increment'    =>  TRUE
                ),
                'name'          =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  FALSE
                ),
                'title'         =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  TRUE
                ),
                'organization'  =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  TRUE
                ),
                'email'         =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  TRUE
                ),
                'phone'         =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  32,
                    'null'              =>  TRUE
                ),
                'interest'      =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  TRUE
                ),
                'timestamp DATETIME DEFAULT GETDATE()',
                'created datetime DEFAULT GETDATE()',
                'owner'         =>  array(
                    'type'              =>  'INT',
                    'null'              =>  FALSE
                ),
                'sid'           =>  array(
                    'type'              =>  'INT',
                    'null'              =>  TRUE
                ),
                'did'           =>  array(
                    'type'              =>  'INT',
                    'null'              =>  TRUE
                )
            ),
            'eop_user'      =>  array(
                'user_id'       =>  array(
                    'type'              =>  'INT',
                    'null'              =>  FALSE,
                    'auto_increment'    =>  TRUE
                ),
                'role_id'       =>  array(
                    'type'              =>  'INT',
                    'null'              =>  FALSE,
                ),
                'first_name'    =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  TRUE
                ),
                'last_name'     =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  TRUE
                ),
                'email'         =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  128,
                    'null'              =>  FALSE
                ),
                'username'      =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  FALSE
                ),
                'password'      =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  FALSE
                ),
                'phone'         =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  30,
                    'null'              =>  TRUE
                ),
                'status'        =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  24,
                    'null'              =>  TRUE
                ),
                'join_date datetime  NULL DEFAULT GETDATE()',
                'modified DATETIME NULL DEFAULT GETDATE()',
                'read_only'     =>  array(
                    'type'              =>  'char',
                    'constraint'        =>  1,
                    'null'              =>  FALSE,
                    'default'           =>  'n'
                )
            ),
            'eop_user2district'     =>  array(
                'id'        =>  array(
                    'type'              =>  'INT',
                    'null'              =>  FALSE,
                    'auto_increment'    =>  TRUE
                ),
                'uid'       =>  array(
                    'type'              =>  'INT',
                    'null'              =>  TRUE
                ),
                'did'       =>  array(
                    'type'              =>  'INT',
                    'null'              =>  TRUE
                ),
                'timestamp DATETIME NULL DEFAULT GETDATE()'
            ),
            'eop_user2school'     =>  array(
                'id'        =>  array(
                    'type'              =>  'INT',
                    'null'              =>  FALSE,
                    'auto_increment'    =>  TRUE
                ),
                'uid'       =>  array(
                    'type'              =>  'INT',
                    'null'              =>  TRUE
                ),
                'sid'       =>  array(
                    'type'              =>  'INT',
                    'null'              =>  TRUE
                ),
                'timestamp DATETIME NULL DEFAULT GETDATE()'
            ),
            'eop_user_access'       =>  array(
                'id'        =>  array(
                    'type'              =>  'INT',
                    'null'              =>  FALSE,
                    'auto_increment'    =>  TRUE
                ),
                'uid'       =>  array(
                    'type'              =>  'INT',
                    'null'              =>  TRUE
                ),
                'entity_id' =>  array(
                    'type'              =>  'INT',
                    'null'              =>  TRUE
                ),
                'field_id'  =>  array(
                    'type'              =>  'INT',
                    'null'              =>  TRUE
                ),
                'permissions'   =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  45,
                    'null'              =>  TRUE
                ),
            ),
            'eop_user_roles'    =>  array(
                'role_id'       =>  array(
                    'type'              =>  'INT',
                    'null'              =>  FALSE,
                    'auto_increment'    =>  TRUE
                ),
                'title'         =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  100,
                    'null'              =>  FALSE
                ),
                'screen_name'   =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  32,
                    'null'              =>  TRUE
                ),
                'description'   =>  array(
                    'type'              =>  'text'
                ),
                'is_locked'     =>  array(
                    'type'              =>  'char',
                    'constraint'        =>  1,
                    'null'              =>  FALSE,
                    'default'           =>  'n'
                ),
                'can_view'      =>  array(
                    'type'              =>  'char',
                    'constraint'        =>  1,
                    'null'              =>  FALSE,
                    'default'           =>  'y'
                ),
                'can_edit'      =>  array(
                    'type'              =>  'char',
                    'constraint'        =>  1,
                    'null'              =>  FALSE,
                    'default'           =>  'y'
                ),
                'create_district'=> array(
                    'type'              =>  'char',
                    'constraint'        =>  1,
                    'null'              =>  FALSE,
                    'default'           =>  'n'
                ),
                'edit_district' =>  array(
                    'type'              =>  'char',
                    'constraint'        =>  1,
                    'null'              =>  FALSE,
                    'default'           =>  'n'
                ),
                'create_school' =>  array(
                    'type'              =>  'char',
                    'constraint'        =>  1,
                    'null'              =>  FALSE,
                    'default'           =>  'n'
                ),
                'edit_school'   =>  array(
                    'type'              =>  'char',
                    'constraint'        =>  1,
                    'null'              =>  FALSE,
                    'default'           =>  'n'
                ),
                'create_user'   =>  array(
                    'type'              =>  'char',
                    'constraint'        =>  1,
                    'null'              =>  FALSE,
                    'default'           =>  'y'
                ),
                'edit_user'     =>  array(
                    'type'              =>  'char',
                    'constraint'        =>  1,
                    'null'              =>  FALSE,
                    'default'           =>  'y'
                ),
                'alter_state_access'=>  array(
                    'type'              =>  'char',
                    'constraint'        =>  1,
                    'null'              =>  FALSE,
                    'default'           =>  'n'
                ),
                'edit_entity'   =>  array(
                    'type'              =>  'char',
                    'constraint'        =>  1,
                    'null'              =>  FALSE,
                    'default'           =>  'y'
                ),
                'level' =>  array(
                    'type'              =>  'INT',
                    'null'              =>  TRUE
                )
            ),
            'eop_page'      =>  array(
                'id'            =>  array(
                    'type'              =>  'int',
                    'null'              =>  FALSE,
                    'auto_increment'    =>  TRUE
                ),
                'name'          =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  FALSE
                ),
                'title'         =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  FALSE
                ),
                'content'       =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  'MAX',
                    'null'              =>  TRUE
                ),
                'url'           =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  TRUE
                ),
                'timestamp DATETIME NULL DEFAULT GETDATE()',
                'url_alias'     =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  TRUE
                )
            ),
            'eop_resource'      => array(
                'id'                => array(
                    'type'              =>  'int',
                    'null'              =>  FALSE,
                    'auto_increment'    =>  TRUE
                ),
                'name'              =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  500,
                    'null'              =>  TRUE
                ),
                'url'               =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  500,
                    'null'              =>  TRUE,
                ),
                'section'           =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  TRUE
                ),
                'shared'            =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  32,
                    'default'           =>  'default'
                ),
                'timestamp DATETIME NULL DEFAULT GETDATE()',
                'district_id'       =>  array(
                    'type'              =>  'int',
                    'null'              =>  TRUE
                ),
                'school_id'         =>  array(
                    'type'              =>  'int',
                    'null'              =>  TRUE
                )
            ),
            'eop_resource2page' =>  array(
                'id'                =>  array(
                    'type'              =>  'int',
                    'null'              =>  FALSE,
                    'auto_increment'    =>  TRUE
                ),
                'resource_id'       =>  array(
                    'type'              =>  'int',
                    'null'              =>  FALSE
                ),
                'page_id'           =>  array(
                    'type'              =>  'int',
                    'null'              =>  FALSE
                ),
                'timestamp DATETIME NULL DEFAULT GETDATE()',
            ),
            'eop_sessions'  =>  array(
                'id'            =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  128,
                    'null'          =>  FALSE
                ),
                'ip_address'    =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  45,
                    'null'          =>  FALSE
                ),
                'timestamp'     =>  array(
                    'type'          =>  'int',
                    'null'          =>  FALSE,
                    'default'       =>  0
                ),
                'data'          =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  'max',
                    'null'          =>  FALSE
                )
            ),
            'eop_files' =>  array(
                'id'                =>  array(
                    'type'              =>  'int',
                    'null'              =>  FALSE,
                    'auto_increment'    =>  TRUE
                ),
                'name'              =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  FALSE
                ),
                'created DATETIME NULL DEFAULT GETDATE()',
                'data'              => array(
                    'type'              => 'text',
                    'null'              => TRUE,

                ),
                'owner'         =>  array(
                    'type'              =>  'INT',
                    'null'              =>  TRUE
                ),
                'sid'           =>  array(
                    'type'          =>  'INT',
                    'null'          =>  TRUE
                ),
                'did'           =>  array(
                    'type'          =>  'INT',
                    'null'          =>  TRUE
                )
            ),
            'eop_exercise' =>  array(
                'id'                =>  array(
                    'type'              =>  'int',
                    'null'              =>  FALSE,
                    'auto_increment'    =>  TRUE
                ),
                'name'              =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  FALSE
                ),
                'type'              =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  TRUE
                ),
                'location'              =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  TRUE
                ),
                'contact'           =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  TRUE
                ),
                'description'       =>  array(
                    'type'              =>  'text',
                    'null'              =>  TRUE
                ),
                'date'           =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  TRUE
                ),
                'timestamp DATETIME NULL DEFAULT GETDATE()',
                'created DATETIME  NULL DEFAULT GETDATE()',
                'owner'         =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  32,
                    'null'              =>  FALSE
                ),
                'sid'           =>  array(
                    'type'          =>  'INT',
                    'null'          =>  TRUE
                ),
                'did'           =>  array(
                    'type'          =>  'INT',
                    'null'          =>  TRUE
                ),
                'file'          => array(
                    'type'          => 'text',
                    'null'          => TRUE
                )
            ),
            'eop_training' =>  array(
                'id'                =>  array(
                    'type'              =>  'int',
                    'constraint'        =>  11,
                    'null'              =>  FALSE,
                    'auto_increment'    =>  TRUE
                ),
                'name'              =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  FALSE
                ),
                'topic'              =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  TRUE
                ),
                'location'              =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  TRUE
                ),
                'format'           =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  TRUE
                ),
                'description'       =>  array(
                    'type'              =>  'text',
                    'null'              =>  TRUE
                ),
                'date'           =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              =>  TRUE
                ),
                'participants'  =>  array(
                    'type'              => 'INT',
                    'constraint'        =>  32,
                    'null'              =>  TRUE
                ),
                'personnel'     =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  255,
                    'null'              => TRUE
                ),
                'score'         =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  64,
                    'null'              =>  TRUE
                ),
                'provider'      =>  array(
                    'type'              =>  'varchar',
                    'constraint'        =>  32,
                    'null'              =>  FALSE,
                    'default'           =>  'school-provided'
                ),
                'schools'       =>  array(
                    'type'              => 'INT',
                    'constraint'        =>  32,
                    'null'              =>  TRUE
                ),
                'leas'          =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  32,
                    'null'              =>  TRUE
                ),
                'rleas'          =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  32,
                    'null'              =>  TRUE
                ),
                'timestamp DATETIME NULL DEFAULT GETDATE()',
                'created DATETIME NULL DEFAULT GETDATE()',
                'owner'         =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  32,
                    'null'              =>  FALSE
                ),
                'sid'           =>  array(
                    'type'          =>  'INT',
                    'constraint'    =>  32,
                    'null'          =>  TRUE
                ),
                'did'           =>  array(
                    'type'          =>  'INT',
                    'constraint'    =>  32,
                    'null'          =>  TRUE
                ),
                'file'          => array(
                    'type'          => 'text',
                    'null'          => TRUE
                )
            )
        );

        return $fields;

    }
}


/**
 * Helpers for initial Database Data
 */
if(!function_exists('get_default_states')){
    function get_default_states(){
        $states = array(

            array('val'	=>	'AL', 'name'	=>	'Alabama',	            'screen_name'	=>	'Alabama' ),
            array('val'	=>	'AK', 'name'	=>	'Alaska',	            'screen_name'	=>	'Alaska' ),
            array('val'	=>	'AZ', 'name'	=>	'Arizona',	            'screen_name'	=>	'Arizona' ),
            array('val'	=>	'AR', 'name'	=>	'Arkansas',	            'screen_name'	=>	'Arkansas' ),
            array('val'	=>	'CA', 'name'	=>	'California',	        'screen_name'	=>	'California' ),
            array('val'	=>	'CO', 'name'	=>	'Colorado',	            'screen_name'	=>	'Colorado' ),
            array('val'	=>	'CT', 'name'	=>	'Connecticut',	        'screen_name'	=>	'Connecticut' ),
            array('val'	=>	'DE', 'name'	=>	'Delaware',	            'screen_name'	=>	'Delaware' ),
            array('val'	=>	'DC', 'name'	=>	'District Of Columbia',	'screen_name'	=>	'DC' ),
            array('val'	=>	'FL', 'name'	=>	'Florida',	            'screen_name'	=>	'Florida' ),
            array('val'	=>	'GA', 'name'	=>	'Georgia',	            'screen_name'	=>	'Georgia' ),
            array('val'	=>	'HI', 'name'	=>	'Hawaii',	            'screen_name'	=>	'Hawaii' ),
            array('val'	=>	'ID', 'name'	=>	'Idaho',	            'screen_name'	=>	'Idaho' ),
            array('val'	=>	'IL', 'name'	=>	'Illinois',	            'screen_name'	=>	'Illinois' ),
            array('val'	=>	'IN', 'name'	=>	'Indiana',	            'screen_name'	=>	'Indiana' ),
            array('val'	=>	'IA', 'name'	=>	'Iowa',	                'screen_name'	=>	'Iowa' ),
            array('val'	=>	'KS', 'name'	=>	'Kansas',	            'screen_name'	=>	'Kansas' ),
            array('val'	=>	'KY', 'name'	=>	'Kentucky',	            'screen_name'	=>	'Kentucky' ),
            array('val'	=>	'LA', 'name'	=>	'Louisiana',	        'screen_name'	=>	'Louisiana' ),
            array('val'	=>	'ME', 'name'	=>	'Maine',	            'screen_name'	=>	'Maine' ),
            array('val'	=>	'MD', 'name'	=>	'Maryland',	            'screen_name'	=>	'Maryland' ),
            array('val'	=>	'MA', 'name'	=>	'Massachusetts',        'screen_name'	=>	'Massachusetts' ),
            array('val'	=>	'MI', 'name'	=>	'Michigan',	            'screen_name'	=>	'Michigan' ),
            array('val'	=>	'MN', 'name'	=>	'Minnesota',	        'screen_name'	=>	'Minnesota' ),
            array('val'	=>	'MS', 'name'	=>	'Mississippi',	        'screen_name'	=>	'Mississippi' ),
            array('val'	=>	'MO', 'name'	=>	'Missouri',	            'screen_name'	=>	'Missouri' ),
            array('val'	=>	'MT', 'name'	=>	'Montana',	            'screen_name'	=>	'Montana' ),
            array('val'	=>	'NE', 'name'	=>	'Nebraska',	            'screen_name'	=>	'Nebraska' ),
            array('val'	=>	'NV', 'name'	=>	'Nevada',	            'screen_name'	=>	'Nevada' ),
            array('val'	=>	'NH', 'name'	=>	'New Hampshire',        'screen_name'	=>	'New Hampshire' ),
            array('val'	=>	'NJ', 'name'	=>	'New Jersey',	        'screen_name'	=>	'New Jersey' ),
            array('val'	=>	'NM', 'name'	=>	'New Mexico',	        'screen_name'	=>	'New Mexico' ),
            array('val'	=>	'NY', 'name'	=>	'New York',	            'screen_name'	=>	'New York' ),
            array('val'	=>	'NC', 'name'	=>	'North Carolina',       'screen_name'	=>	'North Carolina' ),
            array('val'	=>	'ND', 'name'	=>	'North Dakota',	        'screen_name'	=>	'North Dakota' ),
            array('val'	=>	'OH', 'name'	=>	'Ohio',	                'screen_name'	=>	'Ohio' ),
            array('val'	=>	'OK', 'name'	=>	'Oklahoma',	            'screen_name'	=>	'Oklahoma' ),
            array('val'	=>	'OR', 'name'	=>	'Oregon',	            'screen_name'	=>	'Oregon' ),
            array('val'	=>	'PA', 'name'	=>	'Pennsylvania',	        'screen_name'	=>	'Pennsylvania' ),
            array('val'	=>	'RI', 'name'	=>	'Rhode Island',	        'screen_name'	=>	'Rhode Island' ),
            array('val'	=>	'SC', 'name'	=>	'South Carolina',       'screen_name'	=>	'South Carolina' ),
            array('val'	=>	'SD', 'name'	=>	'South Dakota',	        'screen_name'	=>	'South Dakota' ),
            array('val'	=>	'TN', 'name'	=>	'Tennessee',	        'screen_name'	=>	'Tennessee' ),
            array('val'	=>	'TX', 'name'	=>	'Texas',	            'screen_name'	=>	'Texas' ),
            array('val'	=>	'UT', 'name'	=>	'Utah',	                'screen_name'	=>	'Utah' ),
            array('val'	=>	'VT', 'name'	=>	'Vermont',	            'screen_name'	=>	'Vermont' ),
            array('val'	=>	'VA', 'name'	=>	'Virginia',	            'screen_name'	=>	'Virginia' ),
            array('val'	=>	'WA', 'name'	=>	'Washington',	        'screen_name'	=>	'Washington' ),
            array('val'	=>	'WV', 'name'	=>	'West Virginia',	    'screen_name'	=>	'West Virginia' ),
            array('val'	=>	'WI', 'name'	=>	'Wisconsin',	        'screen_name'	=>	'Wisconsin' ),
            array('val'	=>	'WY', 'name'	=>	'Wyoming',	            'screen_name'	=>	'Wyoming' )
        );

        return $states;
    }
}


if(!function_exists('get_default_functions')) {
    function get_default_functions(){

        $functions = array(
            array(
                'id'        =>  8,
                'type_id'   =>  2,
                'name'      =>  'Communications and Warning'
            ),
            array(
                'id'        =>  9,
                'type_id'   =>  2,
                'name'      =>  'Evacuation'
            ),
            array(
                'id'        =>  10,
                'type_id'   =>  2,
                'name'      =>  'Shelter-in-Place'
            ),
            array(
                'id'        =>  11,
                'type_id'   =>  2,
                'name'      =>  'Lockdown'
            ),
            array(
                'id'        =>  12,
                'type_id'   =>  2,
                'name'      =>  'Accounting for All Persons'
            ),
            array(
                'id'        =>  13,
                'type_id'   =>  2,
                'name'      =>  'Family Reunification'
            ),
            array(
                'id'        =>  14,
                'type_id'   =>  2,
                'name'      =>  'Continuity of Operations (COOP)'
            ),
            array(
                'id'        =>  15,
                'type_id'   =>  2,
                'name'      =>  'Security'
            ),
            array(
                'id'        =>  16,
                'type_id'   =>  2,
                'name'      =>  'Public Health, Medical, and Mental Health'
            ),
            array(
                'id'        =>  17,
                'type_id'   =>  2,
                'name'      =>  'None'
            ),
            array(
                'id'        =>  18,
                'type_id'   =>  2,
                'name'      =>  'Recovery'
            ),

        );

        return $functions;
    }
}


if(!function_exists('get_default_entity_types')){
    function get_default_entity_types(){


        $entity_types = array(
            array(
                'id'        =>  1,
                'name'      =>  'bp',
                'title'     =>  'Basic Plan'
            ),
            array(
                'id'        =>  2,
                'name'      =>  'fn',
                'title'     =>  'Functional Annex'
            ),
            array(
                'id'        =>  3,
                'name'      =>  'th',
                'title'     =>  'Threat- and Hazard-Specific Annex'
            ),
            array(
                'id'        =>  4,
                'name'      =>  'g1',
                'title'     =>  'Goal 1 (Before)'
            ),
            array(
                'id'        =>  5,
                'name'      =>  'g2',
                'title'     =>  'Goal 2 (During)'
            ),
            array(
                'id'        =>  6,
                'name'      =>  'g3',
                'title'     =>  'Goal 3 (After)'
            ),
            array(
                'id'        =>  7,
                'name'      =>  'obj',
                'title'     =>  'Objective'
            ),
            array(
                'id'        =>  8,
                'name'      =>  'ca',
                'title'     =>  'Course of Action'
            ),
            array(
                'id'        =>  9,
                'name'      =>  'file',
                'title'     =>  'Uploaded File'
            )
        );

        return $entity_types;
    }
}


if(!function_exists('get_default_pages')){

    function get_default_pages(){
        $pages  =   array(
            array( 'name' => 'home',    'title' => 'Before Using EOP ASSIST',                                                                           'url' => 'home/step/1',  'url_alias' => 'home'),
            array( 'name' => 'step_2',  'title' => 'How Teams Can Use EOP ASSIST',                                                                      'url' => 'home/step/2',  'url_alias' => NULL),
            array( 'name' => 'step_3',  'title' => 'Introduction to the Planning Process',                                                              'url' => 'home/step/3',  'url_alias' => NULL),
            array( 'name' => 'step1_1', 'title' => 'Overview of Step 1: Form a Collaborative Planning Team',                                            'url' => 'plan/step1/1', 'url_alias' => 'plan/step1'),
            array( 'name' => 'step1_2', 'title' => 'Identify a Core Planning Team',                                                                     'url' => 'plan/step1/2', 'url_alias' => NULL),
            array( 'name' => 'step1_3', 'title' => 'Form a Common Framework and Define and Assign Roles and Responsibilities',                          'url' => 'plan/step1/3', 'url_alias' => NULL),
            array( 'name' => 'step1_4', 'title' => 'Determine a Regular Schedule of Meetings',                                                          'url' => 'plan/step1/4', 'url_alias' => NULL),
            array( 'name' => 'step2_1', 'title' => 'Overview of Step 2: Understand the Situation',                                                      'url' => 'plan/step2/1', 'url_alias' => 'plan/step2'),
            array( 'name' => 'step2_2', 'title' => 'Develop a Comprehensive List of Possible Threats and Hazards Using a Variety of Data Sources',      'url' => 'plan/step2/2', 'url_alias' => NULL),
            array( 'name' => 'step2_3', 'title' => 'Evaluate Risks and Vulnerabilities of Threats and Hazards and Then Prioritize',                     'url' => 'plan/step2/3', 'url_alias' => NULL),
            array( 'name' => 'step3_1', 'title' => 'Overview of Step 3: Determine Goals and Objectives',                                                'url' => 'plan/step3/1', 'url_alias' => 'plan/step3'),
            array( 'name' => 'step3_2', 'title' => 'Select Threats and Hazards to Address in the School EOP',                                           'url' => 'plan/step3/2', 'url_alias' => NULL),
            array( 'name' => 'step3_3', 'title' => 'Develop Goals and Objectives for Threats and Hazards',                                              'url' => 'plan/step3/3', 'url_alias' => NULL),
            array( 'name' => 'step3_4', 'title' => 'Develop Goals and Objectives for Functions',                                                        'url' => 'plan/step3/4', 'url_alias' => NULL),
            array( 'name' => 'step4_1', 'title' => 'Overview of Step 4: Plan Development (Identify Courses of Action)',                                 'url' => 'plan/step4/1', 'url_alias' => 'plan/step4'),
            array( 'name' => 'step4_2', 'title' => 'Use Scenario-Based Planning',                                                                       'url' => 'plan/step4/2', 'url_alias' => NULL),
            array( 'name' => 'step4_3', 'title' => 'Develop Courses of Action for Threats and Hazards',                                                 'url' => 'plan/step4/3', 'url_alias' => NULL),
            array( 'name' => 'step4_4', 'title' => 'Develop Courses of Action for Functions',                                                           'url' => 'plan/step4/4', 'url_alias' => NULL),
            array( 'name' => 'step5_1', 'title' => 'Overview of Step 5: Plan Preparation, Review, and Approval',                                        'url' => 'plan/step5/1', 'url_alias' => 'plan/step5'),
            array( 'name' => 'step5_2', 'title' => 'Prepare the Draft EOP: Threat- and Hazard-Specific Annexes',                                        'url' => 'plan/step5/2', 'url_alias' => NULL),
            array( 'name' => 'step5_3', 'title' => 'Prepare the Draft EOP: Functional Annexes',                                                         'url' => 'plan/step5/3', 'url_alias' => NULL),
            array( 'name' => 'step5_4', 'title' => 'Prepare the Draft EOP: Basic Plan',                                                                 'url' => 'plan/step5/4', 'url_alias' => NULL),
            array( 'name' => 'step5_5', 'title' => 'Review, Approve, and Share the Plan',                                                               'url' => 'plan/step5/5', 'url_alias' => NULL),
            array( 'name' => 'step6_1', 'title' => 'Overview of Step 6: Plan Implementation and Maintenance',                                           'url' => 'plan/step6/1', 'url_alias' => 'plan/step6'),
            array( 'name' => 'step6_2', 'title' => 'Train Stakeholders on the Plan',                                                                    'url' => 'plan/step6/2', 'url_alias' => NULL),
            array( 'name' => 'step6_3', 'title' => 'Exercise the Plan',                                                                                 'url' => 'plan/step6/3', 'url_alias' => NULL),
            array( 'name' => 'step6_4', 'title' => 'Review, Revise, and Maintain the Plan',                                                             'url' => 'plan/step6/4', 'url_alias' => NULL),
            array( 'name' => 'step6_5', 'title' => 'Thank You for Using EOP ASSIST',                                                                    'url' => 'plan/step6/5', 'url_alias' => NULL)
        );

        return $pages;
    }
}
