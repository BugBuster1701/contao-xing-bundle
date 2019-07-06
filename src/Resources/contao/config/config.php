<?php

/**
 * Contao Open Source CMS, Copyright (C) 2005-2018 Leo Feyer
 *
 * @copyright  Glen Langer 2008..2018 <http://contao.ninja>
 * @author     Glen Langer (BugBuster)
 * @license    LGPL
 * @filesource
 * @see	       https://github.com/BugBuster1701/contao-xing-bundle
 */

/**
 * Add back end modules
 */
$GLOBALS['BE_MOD']['content']['xing'] = array
(
	'tables' => array('tl_xing_category', 'tl_xing'),
	'icon'   => 'bundles/bugbusterxing/icon.gif'
);

/**
 * Front end modules
 */
array_insert($GLOBALS['FE_MOD'], 4, array
(
	'xing' => array
	(
		'xinglist'   => 'BugBuster\Xing\ModuleXingList'
	)
));
