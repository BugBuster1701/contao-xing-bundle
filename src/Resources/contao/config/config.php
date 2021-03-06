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
$GLOBALS['FE_MOD']['xing'] = array
(
	'xinglist'   => 'BugBuster\Xing\ModuleXingList'
);
