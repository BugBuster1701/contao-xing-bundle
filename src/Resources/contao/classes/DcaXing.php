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
use Contao\CoreBundle\Security\ContaoCorePermissions;
use Contao\Image;
use Contao\StringUtil;
use Contao\System;

/**
 * DCA Helper Class DcaXing
 *
 * @copyright  Glen Langer 2008..2018 <http://contao.ninja>
 * @author     Glen Langer (BugBuster)
 */
class DcaXing extends \Contao\Backend
{
    /**
     * Import the back end user object
     */
    public function __construct()
    {
            parent::__construct();
    }

	public function listProfiles($arrRow)
	{
        $style = 'style="font-size:11px;margin-bottom:10px;"';

		$key = $arrRow['published'] ? 'published' : 'unpublished';
		$date = date($GLOBALS['TL_CONFIG']['datimFormat'], (int) $arrRow['tstamp']);

		$XingImage = new XingImage(); // classes/XingImage.php
		$xing_images = $XingImage->getXingImageLink($arrRow['xinglayout']);

		return '
<div class="cte_type ' . $key . '" ' . $style . '><strong>' . $arrRow['xingprofil'] . '</strong> - ' . $date . '</div>' 
		.$xing_images;

	}

	/**
	 * Return the "toggle visibility" button
	 *
	 * @param array  $row
	 * @param string $href
	 * @param string $label
	 * @param string $title
	 * @param string $icon
	 * @param string $attributes
	 *
	 * @return string
	 */
	public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
	{
		// Check permissions AFTER checking the tid, so hacking attempts are logged
		if (!System::getContainer()->get('security.helper')->isGranted(ContaoCorePermissions::USER_CAN_EDIT_FIELD_OF_TABLE, 'tl_xing::published'))
		{
			return '';
		}

		$href .= '&amp;id=' . $row['id'];

		if (!$row['published'])
		{
			$icon = 'invisible.svg';
		}

		$titleDisabled = (is_array($GLOBALS['TL_DCA']['tl_xing']['list']['operations']['toggle']['label']) && isset($GLOBALS['TL_DCA']['tl_xing']['list']['operations']['toggle']['label'][2])) ? sprintf($GLOBALS['TL_DCA']['tl_xing']['list']['operations']['toggle']['label'][2], $row['id']) : $title;

		return '<a href="' . $this->addToUrl($href) . '" title="' . StringUtil::specialchars($row['published'] ? $title : $titleDisabled) . '" data-title="' . StringUtil::specialchars($title) . '" data-title-disabled="' . StringUtil::specialchars($titleDisabled) . '" onclick="Backend.getScrollOffset();return AjaxRequest.toggleField(this,true)">' . Image::getHtml($icon, $label, 'data-icon="visible.svg" data-icon-disabled="invisible.svg" data-state="' . ($row['published'] ? 1 : 0) . '"') . '</a> ';
	}

}
