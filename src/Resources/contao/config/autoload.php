<?php

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2015 Leo Feyer
 * 
 * @package Xing
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'BugBuster',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Modules
	'BugBuster\Xing\ModuleXingList'  => 'vendor/bugbuster/xing_contao_bundle/src/Resources/contao/modules/ModuleXingList.php',

	// Classes
	'BugBuster\Xing\XingImage'     => 'vendor/bugbuster/xing_contao_bundle/src/Resources/contao/classes/XingImage.php',
	'BugBuster\Xing\DcaXing'       => 'vendor/bugbuster/xing_contao_bundle/src/Resources/contao/classes/DcaXing.php',
	'BugBuster\Xing\DcaModuleXing' => 'vendor/bugbuster/xing_contao_bundle/src/Resources/contao/classes/DcaModuleXing.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_xing_list'         => 'vendor/bugbuster/xing_contao_bundle/src/Resources/contao/templates',
	'mod_xing_list_company' => 'vendor/bugbuster/xing_contao_bundle/src/Resources/contao/templates',
	'mod_xing_list_team'    => 'vendor/bugbuster/xing_contao_bundle/src/Resources/contao/templates',
	'mod_xing_empty'        => 'vendor/bugbuster/xing_contao_bundle/src/Resources/contao/templates',
	'mod_xing_list_profile' => 'vendor/bugbuster/xing_contao_bundle/src/Resources/contao/templates',
));
