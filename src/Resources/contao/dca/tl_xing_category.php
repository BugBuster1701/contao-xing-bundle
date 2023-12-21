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
use Contao\DataContainer;

/**
 * Table tl_xing_category 
 */
$GLOBALS['TL_DCA']['tl_xing_category'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => DC_Table::class,
		'ctable'                      => array('tl_xing'),
		'switchToEdit'                => true,
		'enableVersioning'            => true,
        'sql' => array
        (
            'keys' => array
            (
                'id'    => 'primary'
            )
        ),
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => DataContainer::MODE_SORTED,
			'fields'                  => array('title'),
			'flag'                    => DataContainer::SORT_INITIAL_LETTER_ASC,
			'panelLayout'             => 'search,limit'
		),
		'label' => array
		(
			'fields'                  => array('title'),
			'format'                  => '%s' 
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
				'label'               => &$GLOBALS['TL_LANG']['tl_xing_category']['edit'],
				'href'                => 'table=tl_xing',
				'icon'                => 'edit.svg'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_xing_category']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.svg'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_xing_category']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.svg',
				'attributes'          => 'onclick="if (!confirm(\'' . ($GLOBALS['TL_LANG']['tl_xing_category']['deleteConfirm'] ?? null) . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_xing_category']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.svg'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => '{title_legend},title'
	),

	// Fields
	'fields' => array
	(
    	'id' => array
    	(
	        'sql'                     => "int(10) unsigned NOT NULL auto_increment"
    	),
    	'tstamp' => array
    	(
	        'sql'                     => "int(10) unsigned NOT NULL default '0'"
    	),
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_xing_category']['title'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'sql'                     => "varchar(255) NOT NULL default ''",
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50')
		),
	)
);

