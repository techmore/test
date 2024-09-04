<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DocStyles {

    var $titleStyles = array(
        1 =>    array('name' => 'HELVETICA NEUE CONDENSED BLACK', 'size'=>33, 'color'=>'000000', 'bold'=>true, 'allCaps' => true),
        2 =>    array('name' => 'Helvetica', 'size'=>18, 'color'=>'000000', 'bold'=>false, 'allCaps'=> false),
        3 =>    array('name' => 'HELVETICA NEUE CONDENSED', 'size'=>11, 'color'=>'000000', 'bold'=>false),
        4 =>    array('name' => 'Helvetica', 'size'=>12, 'color'=>'666666'),
        5 =>    array('name' => 'Helvetica', 'size'=>12, 'color'=>'666666')
    );

    var  $fontStyles = array(
        'Goal'          =>  array(
                                    'name'      =>'HELVETICA NEUE CONDENSED',
                                    'size'      =>15,
                                    'color'     =>'000000',
                                    'bold'      => false
                                ),
        'Objective'     =>  array(
                                    'bold'          =>true,
                                    'name'          =>'HELVETICA NEUE CONDENSED',
                                    'size'          =>11,
                                    'color'         =>'000000',
                                    'underline'     => true
                                ),
        'Function'      =>  array(
                                    'name'      =>'Arial',
                                    'size'      =>12,
                                    'color'     =>'1B2232'
                                ),
        'COA'           =>  array(
                                    'name'=>'HELVETICA NEUE CONDENSED',
                                    'size'=>11,
                                    'color'=>'000000',
                                    'bold' => true
                                ),
        'Head_1'        =>  array(
                                    'name'=>'Helvetica',
                                    'size'=>18,
                                    'allCaps' => true,
                                    'bold' => true
                                ),
        'docTitle'      =>  array(
                                    'bold'      => true,
                                    'name'      => 'Helvetica',
                                    'size'      => 38,
                                    'color'     => 'FFFFFF',
                                    'allCaps' => true
                                ),
        'coverDateText' =>  array(
                                    'bold'      => true,
                                    'name'      => 'Helvetica',
                                    'size'      => 20,
                                    'color'     => 'FFFFFF',
                                    'allCaps'   => true
                                ),
        'coverText' =>  array(
                                    'bold'      => false,
                                    'name'      => 'Helvetica',
                                    'size'      => 11,
                                    'color'     => 'FFFFFF',
                                    'allCaps'   => false
                                ),
        'TOCTitle'  =>  array(
                                    'bold'      => true,
                                    'name'      => 'HELVETICA NEUE CONDENSED',
                                    'size'      => 72,
                                    'color'     => '0172B8',
                                    'allCaps' => true
                                ),
        'Headers_1'    => array(
                                    'bold'  => false,
                                    'name'  => 'HELVETICA NEUE CONDENSED',
                                    'color' => 'FFFFFF',
                                    'size'  => 10
                            )
    );

    var  $paragraphStyles = array(
        'docTitleParagraph'         => array('align' => 'center', 'spaceAfter' => 300, 'keepLines'=>true),
        'cover'                     => array('size' =>11,'align' => 'both', 'spaceAfter' => 100),
        'coverDateParagraph'        => array('size' =>20,'align' => 'center', 'spaceAfter' => 100),
        'standardParagraph'         => array('size' =>12,'align' => 'left', 'spaceAfter' => 100, 'hanging'=>0),
        'objectiveParagraph'        => array('size' =>12,'align' => 'left', 'spaceAfter' => 100,'indent' =>  0, 'hanging'=>0),
        'actionParagraph'           => array('size' =>12,'align' => 'left', 'spaceAfter' => 100)
    );

    var $linkStyles = array(
        'default'   =>  array('name'=>'Calibri', 'size'=>11, 'color'=>'blue')
    );


    var $tableStyles = array(
        'defaultTableStyle'   =>  array(
                                        array('borderSize'=>6, 'borderColor'=>'006699', 'cellMargin'=>80),
                                        array('borderBottomSize'=>18, 'borderBottomColor'=>'0000FF', 'bgColor'=>'66BBFF')
                                    )
    );

}