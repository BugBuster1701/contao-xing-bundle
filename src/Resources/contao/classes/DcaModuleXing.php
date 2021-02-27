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
 * Run in a custom namespace, so the class can be replaced
 */

namespace BugBuster\Xing;

/**
 * DCA Helper Class DcaModuleXing
 *
 * @copyright  Glen Langer 2008..2019 <http://contao.ninja>
 * @author     Glen Langer (BugBuster)
 */
class DcaModuleXing extends \Backend 
{
	public function getXingTemplates()
	{
	    return $this->getTemplateGroup('mod_xing_list');
	}  
}
