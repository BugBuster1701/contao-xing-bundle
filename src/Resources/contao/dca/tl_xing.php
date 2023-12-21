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

use Contao\DC_Table;

/**
 * Table tl_xing 
 */
$GLOBALS['TL_DCA']['tl_xing'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => DC_Table::class,
		'ptable'                      => 'tl_xing_category',
		'enableVersioning'            => true,
        'sql' => array
        (
            'keys' => array
            (
                'id'    => 'primary',
                'pid'   => 'index'
            )
        ),
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 4,
			'filter'                  => true,
			'fields'                  => array('sorting'),
			'panelLayout'             => 'filter;search,limit',
			//'headerFields'            => array('title', 'headline', 'tstamp'),
			'headerFields'            => array('title', 'tstamp'),
			'child_record_callback'   => array('BugBuster\Xing\DcaXing', 'listProfiles')
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();"'
			)
		),
		'operations' => array
		(
			'edit',
			'copy',
			'cut',
			'delete',
			'toggle' => array
			(
				'href'                => 'act=toggle&amp;field=published',
				'icon'                => 'visible.svg',
				'showInHeader'        => true
			),
			'show'
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => 'xingprofil,xinglayout;xingtarget;published'
	),

	// Fields
	'fields' => array
	(
    	'id' => array
    	(
    	        'sql'           => "int(10) unsigned NOT NULL auto_increment"
    	),
    	'pid' => array
    	(
    	        'sql'           => "int(10) unsigned NOT NULL default '0'"
    	),
    	'sorting' => array
    	(
    	        'sql'           => "int(10) unsigned NOT NULL default '0'"
    	),
    	'tstamp' => array
    	(
    	        'sql'           => "int(10) unsigned NOT NULL default '0'"
    	),
		'xingprofil' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_xing']['xingprofil'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
            'explanation'	          => 'xing_help_profile',
            'sql'                     => "varchar(64) NOT NULL default ''",
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'helpwizard'=>true, 'tl_class'=>'w50')
		),
		'xinglayout' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_xing']['xinglayout'],
			'default'                 => '2',
			'inputType'               => 'select',
			'options'                 => array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10' // DE
			                                   , '11', '12', '13', '14', '15', '16'              // EN
			                                   , '17', '18', '19', '20', '21', '22', '23'        // FR
			                                   , '24', '25', '26', '27', '28', '29', '30', '31'  // PL
			                                   , '41', '42', '43', '44', '45', '46', '47', '48'  // SV
			                                   , '62', '63', '64', '65', '66', '67', '68', '69'  // JP
			                                   , '71', '72', '73', '74', '75', '76', '77'        // PT
			                                   , '80', '81', '82', '83', '84', '85'              // ES
			                                   , '90', '91', '92', '93', '94', '95', '96'        // IT
			                                   , '999' // Company
			                                   ),
			'reference'               => &$GLOBALS['TL_LANG']['tl_xing'],
			'search'                  => true,
			'explanation'	          => 'xing_help_layout',
			'sql'                     => "smallint(3) unsigned NOT NULL default '2'",
			'eval'                    => array('mandatory'=>true, 'maxlength'=>3, 'rgxp'=>'digit', 'helpwizard'=>true, 'tl_class'=>'w50')
		),
        'xingtarget' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_xing']['xingtarget'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'sql'                     => "char(1) NOT NULL default ''",
			'eval'                    => array('tl_class'=>'clr')
		),
		'published' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_xing']['published'],
			'exclude'                 => true,
			'filter'                  => true,
			'flag'                    => 2,
			'inputType'               => 'checkbox',
			'sql'                     => "char(1) NOT NULL default ''",
			'eval'                    => array('doNotCopy'=>true)
		)
	)
);
