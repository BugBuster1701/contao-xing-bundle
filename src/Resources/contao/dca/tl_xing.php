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
 * Load tl_content language file
 */

/**
 * Table tl_xing 
 */
$GLOBALS['TL_DCA']['tl_xing'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
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
			'panelLayout'             => 'search,filter,limit',
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
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_xing']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_xing']['copy'],
				'href'                => 'act=paste&amp;mode=copy',
				'icon'                => 'copy.gif'
			),
			'cut' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_xing']['cut'],
				'href'                => 'act=paste&amp;mode=cut',
				'icon'                => 'cut.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_xing']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'toggle' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_xing']['toggle'],
				'icon'                => 'visible.gif',
				//'attributes'          => 'onclick="Backend.getScrollOffset();"',
				'attributes'          => 'onclick="Backend.getScrollOffset(); return AjaxRequest.toggleVisibility(this, %s);"',
				'button_callback'     => array('BugBuster\Xing\DcaXing', 'toggleIcon')
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_xing']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => 'xingprofil,xinglayout,xingtarget;published'
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
			                                   , '17' ,'18' ,'19' ,'20' ,'21' ,'22' ,'23'        // FR
			                                   , '24' ,'25' ,'26' ,'27' ,'28' ,'29' ,'30' ,'31'  // PL
			                                   , '41' ,'42' ,'43' ,'44' ,'45' ,'46' ,'47' ,'48'  // SV
			                                   , '62' ,'63' ,'64' ,'65' ,'66' ,'67' ,'68' ,'69'  // JP
			                                   , '71' ,'72' ,'73' ,'74' ,'75' ,'76' ,'77'        // PT
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
