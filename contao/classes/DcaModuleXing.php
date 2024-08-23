<?php

/*
 * This file is part of a BugBuster Contao Bundle.
 *
 * @copyright  Glen Langer 2024 <http://contao.ninja>
 * @author     Glen Langer (BugBuster)
 * @package    Contao Xing Bundle
 * @link       https://github.com/BugBuster1701/contao-xing-bundle
 *
 * @license    LGPL-3.0-or-later
 */

/**
 * Run in a custom namespace, so the class can be replaced
 */

namespace BugBuster\Xing;

use Contao\Backend;

/**
 * DCA Helper Class DcaModuleXing
 */
class DcaModuleXing extends Backend
{
	public function getXingTemplates()
	{
		return $this->getTemplateGroup('mod_xing_list');
	}
}
