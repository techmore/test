<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: GMajwega
 * Date: 7/28/15
 * Time: 9:14 AM
 */


if(!function_exists('read_docx')){
    function read_docx($fileData = array()){

        $text = '';
        $xml_content = '';

        $zip  = zip_open($fileData['full_path']);

        if(!$zip || is_numeric($zip))
            return false;

        while($zip_entry = zip_read($zip)){

            if(zip_entry_open($zip, $zip_entry) == FALSE)
                continue;

            if(zip_entry_name($zip_entry) == "word/document.xml"){
                $xml_content = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
                zip_entry_close($zip_entry);
                break;
            }else{
                continue;
            }
        }



        $reader = new XMLReader;
        $reader->xml($xml_content); // Set the XML content source in form of a string
        //$reader->open($fileData['file_path'].'document.xml'); // Reads XML directly from file

        // set up variables for formatting
        $formatting['bold'] = 'closed';
        $formatting['italic'] = 'closed';
        $formatting['underline'] = 'closed';
        $formatting['header'] = 0;

        // loop through docx xml dom
        while ($reader->read()){
            // look for new paragraphs

            if ($reader->nodeType == XMLREADER::ELEMENT && $reader->name === 'w:p'){
                // set up new instance of XMLReader for parsing paragraph independantly
                $paragraph = new XMLReader;
                $p = $reader->readOuterXML();
                $paragraph->xml($p);

                // search for heading
                preg_match('/<w:pStyle w:val="(Heading.*?[1-6])"/',$p,$matches);

                if(is_array($matches) && count($matches)) {
                    switch ($matches[1]) {
                        case 'Heading1':
                            $formatting['header'] = 1;
                            break;
                        case 'Heading2':
                            $formatting['header'] = 2;
                            break;
                        case 'Heading3':
                            $formatting['header'] = 3;
                            break;
                        case 'Heading4':
                            $formatting['header'] = 4;
                            break;
                        case 'Heading5':
                            $formatting['header'] = 5;
                            break;
                        case 'Heading6':
                            $formatting['header'] = 6;
                            break;
                        default:
                            $formatting['header'] = 0;
                            break;
                    }
                }

                // open h-tag or paragraph
                $text .= ($formatting['header'] > 0) ? '<h'.$formatting['header'].'>' : '<p>';

                // loop through paragraph dom
                while ($paragraph->read()){
                    // look for elements
                    if ($paragraph->nodeType == XMLREADER::ELEMENT && $paragraph->name === 'w:r'){
                        $node = trim($paragraph->readInnerXML());

                        // add <br> tags
                        if (strstr($node,'<w:br ')) $text .= '<br>';

                        // look for formatting tags
                        $formatting['bold'] = (strstr($node,'<w:b/>')) ? (($formatting['bold'] == 'closed') ? 'open' : $formatting['bold']) : (($formatting['bold'] == 'opened') ? 'close' : $formatting['bold']);
                        $formatting['italic'] = (strstr($node,'<w:i/>')) ? (($formatting['italic'] == 'closed') ? 'open' : $formatting['italic']) : (($formatting['italic'] == 'opened') ? 'close' : $formatting['italic']);
                        $formatting['underline'] = (strstr($node,'<w:u ')) ? (($formatting['underline'] == 'closed') ? 'open' : $formatting['underline']) : (($formatting['underline'] == 'opened') ? 'close' : $formatting['underline']);

                        // build text string of doc
                        $text .=     (($formatting['bold'] == 'open') ? '<strong>' : '').
                            (($formatting['italic'] == 'open') ? '<em>' : '').
                            (($formatting['underline'] == 'open') ? '<u>' : '').
                            htmlentities(iconv('UTF-8', 'ASCII//TRANSLIT',$paragraph->expand()->textContent)).
                            (($formatting['underline'] == 'close') ? '</u>' : '').
                            (($formatting['italic'] == 'close') ? '</em>' : '').
                            (($formatting['bold'] == 'close') ? '</strong>' : '');

                        // reset formatting variables
                        foreach ($formatting as $key=>$format){
                            if ($format == 'open') $formatting[$key] = 'opened';
                            if ($format == 'close') $formatting[$key] = 'closed';
                        }
                    }
                }
                $text .= ($formatting['header'] > 0) ? '</h'.$formatting['header'].'>' : '</p>';
            }

        }
        $reader->close();

        return $text;

    }
}

if(!function_exists('read_doc')){
    function read_doc($fileData = array()){

        $fileHandle =fopen($fileData['full_path'], "r");
        $line = @fread($fileHandle, filesize($fileData['full_path']));
        $lines = explode(chr(0x0D), $line);

        $outtext ="";

        foreach($lines as $thisline){

            $pos = strpos($thisline, chr(0x00));

            if(($pos !== FALSE) || (strlen($thisline) == 0)){
                //DO nothing
            }else{
                $outtext .= $thisline . " ";
            }

        }

        $outtext = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/","",$outtext);

        return $outtext;
    }
}