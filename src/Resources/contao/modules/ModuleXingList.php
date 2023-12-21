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

use BugBuster\Xing\XingImage;
use Contao\CoreBundle\Monolog\ContaoContext;
use Psr\Log\LogLevel;
use Contao\System;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ModuleXingList
 *
 * @copyright  Glen Langer 2008..2018
 * @author     Glen Langer (BugBuster)
 */
class ModuleXingList extends \Contao\Module
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_xing_list';

	/**
	 * Category
	 * @var array
	 */
	protected $xing_category = array();

	/**
	 * Xing Image Link
	 * @var string
	 */
	protected $xing_images = '';

	/**
	 * Current version of the class.
	 */
	const XINGLIST_VERSION = '1.3.0';

	const LINK_BLUR = ' onclick="this.blur();"';
	const LINK_NEW_WINDOW = ' onclick="window.open(this.href); return false;"';

	/**
	 * Display a wildcard in the back end
	 * @return string
	 */
	public function generate()
	{
		if (System::getContainer()->get('contao.routing.scope_matcher')
				->isBackendRequest(System::getContainer()->get('request_stack')
				->getCurrentRequest() ?? Request::create('')))
		{
			$objTemplate = new \Contao\BackendTemplate('be_wildcard');
			$objTemplate->wildcard = '### XING LIST ###';
			$objTemplate->title = $this->headline;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            // Code für Versionen ab 3.0.0
            $objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}

		$this->xing_category = \Contao\StringUtil::deserialize($this->xing_categories, true);

		// Return if there are no categories
		if (!\is_array($this->xing_category) || !is_numeric($this->xing_category[0]))
		{
			return '';
		}

		return parent::generate();
	}

	/**
	 * Generate module
	 */
	protected function compile()
	{
		$hasBackendUser = System::getContainer()->get('contao.security.token_checker')->hasBackendUser();

		$objXing = $this->Database->prepare("SELECT tl_xing.id AS id, xingprofil, xinglayout, xingtarget, title"
		                                  ." FROM tl_xing LEFT JOIN tl_xing_category ON (tl_xing_category.id=tl_xing.pid)"
		                                  ." WHERE pid IN(" . implode(',', $this->xing_category) . ")" . (!$hasBackendUser ? " AND published=?" : "")
		                                  ." ORDER BY title, sorting")
								  ->execute(1);
		if ($objXing->numRows < 1)
		{
			//mod_xing_empty
			$this->strTemplate = 'mod_xing_empty';
            $this->Template = new \Contao\FrontendTemplate($this->strTemplate);

            $strText = 'mod_xing_empty, numRows < 1';
            $logger = static::getContainer()->get('monolog.logger.contao');
            $logger->log(LogLevel::ERROR, $strText, array('contao' => new ContaoContext('XingList', ContaoContext::ERROR)));

			return;
		}

		$arrXing = array();
		$XingImage = new XingImage(); // classes/XingImage.php

		while ($objXing->next())
		{
		    $this->xing_images = $XingImage->getXingImageLink($objXing->xinglayout, $this->xing_source);

    		if (($this->xing_template != $this->strTemplate) && ($this->xing_template == 'mod_xing_list_company'))
    		{
    			$this->xing_images = preg_replace('/title="[^"]*"/', 'title="Company"', $this->xing_images);
    		}

			if ($GLOBALS['objPage']->outputFormat == 'html5')
			{
				// $this->xing_images = \Contao\StringUtil::toHtml5($this->xing_images);
				$arrXing[] = array
				(
	                'xingprofil' => trim($objXing->xingprofil),
					'xinglayout' => $this->xing_images,
					'xingtarget' => ($objXing->xingtarget == '1') ? '' : ' target="_blank"'
				);
			}
			else
			{
				$arrXing[] = array
				(
	                'xingprofil' => trim($objXing->xingprofil),
					'xinglayout' => $this->xing_images,
					'xingtarget' => ($objXing->xingtarget == '1') ? $this->LINK_BLUR : $this->LINK_NEW_WINDOW
				);
			}
		} // while
		if (($this->xing_template != $this->strTemplate) && ($this->xing_template))
		{
	        $this->strTemplate = $this->xing_template;
	        $this->Template = new \Contao\FrontendTemplate($this->strTemplate);
		}
		$this->Template->category = $objXing->title;
		$this->Template->xing = $arrXing;
	} // compile
} // class
