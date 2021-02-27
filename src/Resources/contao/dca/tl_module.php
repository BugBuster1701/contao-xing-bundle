<?php

/*
 * Extension for Contao Open Source CMS.
 *
 * This file is part of a BugBuster Contao Bundle
 *
 * @copyright  Glen Langer 2021 <http://contao.ninja>
 * @author     Glen Langer (BugBuster)
 * @package    Xing
 * @license    LGPL-3.0-or-later
 * @see        https://github.com/BugBuster1701/contao-xing-bundle
 */

/**
 * Add palettes to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['xinglist']   = 'name,type,headline;xing_categories,xing_template,xing_source;guests,protected;align,space,cssID';

/**
 * Add fields to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['xing_categories'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['xing_categories'],
	'exclude'                 => true,
	'inputType'               => 'radio',
	'foreignKey'              => 'tl_xing_category.title',
    'sql'                     => "varchar(255) NOT NULL default ''",
	'eval'                    => array('multiple'=>false, 'mandatory'=>true, 'tl_class'=>'w50')
);
$GLOBALS['TL_DCA']['tl_module']['fields']['xing_template'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['xing_template'],
    'default'                 => 'mod_xing_list',
    'exclude'                 => true,
    'inputType'               => 'select',
    'options_callback'        => array('BugBuster\Xing\DcaModuleXing', 'getXingTemplates'), 
    'explanation'	          => 'xing_help_template',
    'sql'                     => "varchar(32) NOT NULL default ''",
    'eval'                    => array('helpwizard'=>true, 'tl_class'=>'w50')
);
$GLOBALS['TL_DCA']['tl_module']['fields']['xing_source'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['xing_source'],
    'exclude'                 => true,
    'inputType'               => 'select',
    'options'                 => array('xing_local', 'xing_server'),
    'reference'               => &$GLOBALS['TL_LANG']['tl_module'],
    //'explanation'	          => 'xing_help_source',
    'sql'                     => "varchar(32) NOT NULL default 'xing_local'",
    'eval'                    => array('helpwizard'=>false, 'tl_class'=>'w50')
);
