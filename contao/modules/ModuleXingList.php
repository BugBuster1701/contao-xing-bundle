<?php

/*
 * This file is part of a BugBuster Contao Bundle.
 *
 * @copyright  Glen Langer 2025 <http://contao.ninja>
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

use Contao\BackendTemplate;
use Contao\CoreBundle\Monolog\ContaoContext;
use Contao\FrontendTemplate;
use Contao\Module;
use Contao\StringUtil;
use Contao\System;
use Psr\Log\LogLevel;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ModuleXingList
 */
class ModuleXingList extends Module
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
	const XINGLIST_VERSION = '1.4.1';

	/**
	 * Display a wildcard in the back end
	 * @return string
	 */
	public function generate()
	{
		if (
			System::getContainer()->get('contao.routing.scope_matcher')
				->isBackendRequest(System::getContainer()->get('request_stack')
				->getCurrentRequest() ?? Request::create(''))
		) {
			$objTemplate = new BackendTemplate('be_wildcard');
			$objTemplate->wildcard = '### XING LIST ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = StringUtil::specialcharsUrl(System::getContainer()->get('router')->generate('contao_backend', array('do'=>'themes', 'table'=>'tl_module', 'act'=>'edit', 'id'=>$this->id)));

			return $objTemplate->parse();
		}

		$this->xing_category = StringUtil::deserialize($this->xing_categories, true);

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
		if ($hasBackendUser)
		{
			$objXing = $this->Database->prepare("SELECT tl_xing.id AS id, xingprofil, xinglayout, xingtarget, title"
												. " FROM tl_xing LEFT JOIN tl_xing_category ON (tl_xing_category.id=tl_xing.pid)"
												. " WHERE pid IN(" . implode(',', $this->xing_category) . ")"
												. " ORDER BY title, sorting")
										->execute();
		}
		else
		{
			$objXing = $this->Database->prepare("SELECT tl_xing.id AS id, xingprofil, xinglayout, xingtarget, title"
										  . " FROM tl_xing LEFT JOIN tl_xing_category ON (tl_xing_category.id=tl_xing.pid)"
										  . " WHERE pid IN(" . implode(',', $this->xing_category) . ") AND published=?"
										  . " ORDER BY title, sorting")
										->execute(1);
		}

		if ($objXing->numRows < 1)
		{
			// mod_xing_empty
			$this->strTemplate = 'mod_xing_empty';
			$this->Template = new FrontendTemplate($this->strTemplate);

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

			// $this->xing_images = \Contao\StringUtil::toHtml5($this->xing_images);
			$arrXing[] = array
			(
				'xingprofil' => trim($objXing->xingprofil),
				'xinglayout' => $this->xing_images,
				'xingtarget' => ($objXing->xingtarget == '1') ? '' : ' target="_blank"'
			);
		} // while
		if (($this->xing_template != $this->strTemplate) && $this->xing_template)
		{
			$this->strTemplate = $this->xing_template;
			$this->Template = new FrontendTemplate($this->strTemplate);
		}
		$this->Template->category = $objXing->title;
		$this->Template->xing = $arrXing;
		trigger_deprecation('bugbuster/contao-xing-bundle', '2.0', 'FE module is deprecated and will no longer work in Contao 6. Use the Content Element instead.');
	} // compile
} // class
