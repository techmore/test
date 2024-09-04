<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: GMajwega
 * Date: 7/31/15
 * Time: 10:27 AM
 */
if(!function_exists('objectToArray')){
    function objectToArray($d){
        if(is_object($d)){
            $d = get_object_vars($d);
            foreach($d as &$value){
                if(is_object($value)){
                    $value = get_object_vars($value);
                }
            }
            return $d;
        }else{
            return $d;
        }
    }
}

if(!function_exists('escapeFieldName')){
    function escapeFieldName($fieldName, $driver='mysqli'){
        if($driver == 'mysqli' || $driver == 'mysql'){
            return "`$fieldName`";
        }else{
            return "[$fieldName]";
        }
    }
}

/**
 * Custom function to write config file 'settings.php'
 */
if(! function_exists('make_config_file')){

    function make_config_file($data="", $file="", $mode="w"){

        $returnMsg = array();

        $fileInformation = get_file_info('./application/config/settings.php');

        if($fileInformation !== FALSE){

            if($data!=""){ // Check if there is Data to write to the config file
                $configOutput = generateConfigOutput($data);

                if ( ! write_file('./application/config/settings.php', $configOutput, $mode))
                {
                    $returnMsg['msg'] = 'Unable to write the file: '. $fileInformation['server_path'] . ' Make sure its writable!';
                    $returnMsg['error'] = true;
                }
                else
                {
                    $returnMsg['msg'] = 'File written!';
                    $returnMsg['error'] = false;
                }
            }
            else{ // There is no data to write

                $returnMsg['msg'] = 'No config settings sent for writing';
                $returnMsg['error'] = true;
            }

        }
        else{ // The settings.php file or the custom file name stated does not exist

            $returnMsg['msg'] = 'The file: '.$fileInformation['server_path'] . ' does not exist!';
            $returnMsg['error'] = true;
        }

        return $returnMsg;
    }
}

if(! function_exists('generateConfigOutput')){

    function generateConfigOutput($parsedArray){

        // General first line in the config file
        $data = "<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');\n\n";

        /**
         * First deal with the database settings
         */
        $data .=    "/*\n";
        $data .=    "|---------------------------------------------------------------------\n";
        $data .=    "|----------------   DATABASE CONNECTIVITY SETTINGS  ------------------\n";
        $data .=    "|---------------------------------------------------------------------\n";
        $data .=    "|\n";
        $data .=    "| These are the settings needed to access your database.\n";
        $data .=    "| For complete instructions please consult comments in the 'database.php' file under the config directory\n";
        $data .=    "|\n";
        $data .=    "*/\n";
        $data .=    "\n";
        $data .=    "\$config['db']['hostname'] = '"   	. (isset($parsedArray['database']['hostname'])? $parsedArray['database']['hostname'] :  '')  					."';\n";
        $data .=    "\$config['db']['username'] = '"   	. (isset($parsedArray['database']['username'])? $parsedArray['database']['username'] :  '')     				."';\n";
        $data .=    "\$config['db']['password'] = '"   	. (isset($parsedArray['database']['password'])? $parsedArray['database']['password'] :  '')      				."';\n";
        $data .=    "\$config['db']['database'] = '"   	. (isset($parsedArray['database']['database'])? $parsedArray['database']['database'] :  '')    					."';\n";
        $data .=    "\$config['db']['dbdriver'] = '"   	. (isset($parsedArray['database']['dbdriver'])? $parsedArray['database']['dbdriver'] :  'mysqli')   			."';\n";
        $data .=    "\$config['sess_expiration']=  "	. 3600																											.";\n";

        if(isset($parsedArray['database']['dbdriver']) && $parsedArray['database']['dbdriver'] == 'sqlsrv'){
            $data .=    "\$config['db']['pconnect'] = FALSE;\n";
        }

        $data .=    "if(\$config['db']['username'] && \$config['db']['password']){"                                                                                      ."\n";
        $data .=    "    \$CI = get_instance();"                                                                                                                         ."\n";
        $data .=    "    \$CI->load->database(\$config['db']);"                                                                                                          ."\n";
        $data .=    "}"                                                                                                                                                  ."\n";

        return $data;
    }
}

if(! function_exists('updateConfig')){

    function updateConfig($configFile='settings.php', $setting, $newValue){
        $out = '';
        $pattern = '$config'.$setting;
        $found = false;

        $fileName = "./application/config/".$configFile;

        if(file_exists($fileName)) {
            $file = fopen($fileName,'r+');
            while(!feof($file)) {
                $line = fgets($file);
                if(strpos($line, $pattern) !== false){
                    $found = true;
                    if(is_numeric($newValue))
                        $out .= $pattern . " = ". $newValue . ";";
                    else
                        $out .= $pattern . " = '". $newValue . "';";
                }else{
                    $out .= $line;
                }
            }

            //If the setting does not exist already, then add it to the file
            if(!$found){
                if(is_numeric($newValue))
                    $out .= "\n" . $pattern . " = " . $newValue . ";";
                else
                    $out .= "\n" . $pattern . " = " . $newValue . ";";
            }

            file_put_contents($fileName, $out);
            fclose($file);
        }
    }
}

if(! function_exists('phone_number_format')) {
    function phone_number_format($number)
    {
        // Allow only Digits, remove all other characters.
        $number = preg_replace("/[^\d]/", "", $number);

        // get number length.
        $length = strlen($number);

        // if number = 10
        if ($length == 10) {
            $number = preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "($1) $2-$3", $number);
        }

        return $number;

    }
}