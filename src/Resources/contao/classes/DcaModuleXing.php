<?php

/**
 * Contao Open Source CMS, Copyright (C) 2005-2018 Leo Feyer
 *
 * Contao Module "Xing" - DCA Helper Class DcaModuleXing
 *
 * @copyright  Glen Langer 2008..2018 <http://contao.ninja>
 * @author     Glen Langer (BugBuster)
 * @license    LGPL
 * @filesource
 * @see	       https://github.com/BugBuster1701/contao-xing-bundle
 */

/**
 * Run in a custom namespace, so the class can be replaced
 */

namespace BugBuster\Xing;

/**
 * DCA Helper Class DcaModuleXing
 *
 * @copyright  Glen Langer 2008..2018 <http://contao.ninja>
 * @author     Glen Langer (BugBuster)
 */
class DcaModuleXing extends \Backend 
{
	public function getXingTemplates($dc)
	{
	    return $this->getTemplateGroup('mod_xing_list', $dc->activeRecord->pid);
	}  
}

