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

use Contao\System;

/**
 * Class XingImage
 */
class XingImage
{
	protected $image_file  = '';

	protected $image_size  = 'width="0" height="0"';

	protected $image_title = '404, wrong xing image id';

	/**
	 * get Image Link
	 */
	public function getXingImageLink($xinglayout, $xing_source = 'xing_local')
	{
		$arrXingImageDefinitions= array();
		$xingSrcProfile = '//www.xing.com/img/buttons/';
		$xingSrcCompany = '//www.xing.com/img/xing/xe/corporate_pages/';
		$xingSrcLocal   = '/bundles/bugbusterxing/';

		$rootDir = System::getContainer()->getParameter('kernel.project_dir');
		if (file_exists($rootDir . "/vendor/bugbuster/contao-xing-bundle/contao/config/xing_image_definitions.php"))
		{
			include $rootDir . "/vendor/bugbuster/contao-xing-bundle/contao/config/xing_image_definitions.php";
		}

		if (isset($arrXingImageDefinitions[$xinglayout]))
		{
			$this->image_file  = $arrXingImageDefinitions[$xinglayout]['image_file'];
			$this->image_size  = $arrXingImageDefinitions[$xinglayout]['image_size'];
			$this->image_title = $arrXingImageDefinitions[$xinglayout]['image_title'];
		}

		if ('xing_local' == $xing_source || !$xing_source)
		{
			$xingSrcProfile = $xingSrcLocal;
			$xingSrcCompany = $xingSrcLocal;
		}

		if ($xinglayout < 999)
		{
			$xing_images = '<img src="' . $xingSrcProfile . $this->image_file . '" ' . $this->image_size . ' alt="XING" title="' . $this->image_title . '">';
		}
		else
		{
			$xing_images = '<img src="' . $xingSrcCompany . $this->image_file . '" ' . $this->image_size . ' alt="XING" title="' . $this->image_title . '">';
		}

		return $xing_images;
	} // getXingImageLink
} // class
