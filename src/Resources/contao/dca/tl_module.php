<?php 

/**
 * Contao Open Source CMS, Copyright (C) 2005-2015 Leo Feyer
 *
 * @copyright  Glen Langer 2008..2015 <http://contao.ninja>
 * @author     Glen Langer (BugBuster)
 * @package    Xing
 * @license    LGPL
 * @filesource
 * @see	       https://github.com/BugBuster1701/contao_xing
 */


/**
 * Add palettes to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['xinglist']   = 'name,type,headline;xing_categories,xing_template;guests,protected;align,space,cssID';

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
    'eval'                    => array('helpwizard'=>true,'tl_class'=>'w50')
);
