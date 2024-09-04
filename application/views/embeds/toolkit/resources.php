<?php
/**
 * Compiles a page's resources from the system
 * 
 * Date: 11/22/16
 * Time: 10:45 AM
 */
$guidanceGrp = array();
$resourceGrp = array();
$examplesGrp = array();
$currentURL = $this->uri->uri_string();
//($this->uri->segment(3, 0) ==0) ? $this->uri->uri_string()."/1" :


foreach($resources as $key=>$resource){
    switch($resource['section']){
        case 'Guidance':
            if(is_array($resource['pages']) && count($resource['pages']) >0){
                foreach ($resource['pages'] as $_page){
                    if($currentURL == $_page['url'] || $currentURL == $_page['url_alias']){
                        array_push($guidanceGrp, $resource);
                        break;
                    }
                }
            }
            break;
        case 'Resources':
            if(is_array($resource['pages']) && count($resource['pages']) >0){
                foreach ($resource['pages'] as $_page){
                    if($currentURL == $_page['url'] || $currentURL == $_page['url_alias']){
                        array_push($resourceGrp, $resource);
                        break;
                    }
                }
            }
            break;
        case 'Examples':
            if(is_array($resource['pages']) && count($resource['pages']) >0){
                foreach ($resource['pages'] as $_page){
                    if($currentURL == $_page['url'] || $currentURL == $_page['url_alias']){
                        array_push($examplesGrp, $resource);
                        break;
                    }
                }
            }
            break;
    }
}
