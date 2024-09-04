<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."/third_party/PhpWord/Autoloader.php";
require_once APPPATH."/third_party/PhpWord/Common/Autoloader.php";


use PhpOffice\Common\Autoloader as CommonAutoloader;
use PhpOffice\PhpWord\Autoloader as Autoloader;

CommonAutoloader::register();
Autoloader::register();


class Word extends PhpOffice\PhpWord\PhpWord {

    public function __construct(){
        parent::__construct();
    }

}