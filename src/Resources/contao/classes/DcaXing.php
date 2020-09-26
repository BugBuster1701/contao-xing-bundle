<?php

/*
 * Extension for Contao Open Source CMS.
 *
 * This file is part of a BugBuster Contao Bundle
 *
 * @copyright  Glen Langer 2020 <http://contao.ninja>
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
            $this->import('BackendUser', 'User');
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
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
	{
		if (\strlen(\Contao\Input::get('tid')))
		{
			$this->toggleVisibility(\Contao\Input::get('tid'), ((int) \Contao\Input::get('state') == 1));
			$this->redirect($this->getReferer());
		}

		// Check permissions AFTER checking the tid, so hacking attempts are logged
        if (!$this->User->isAdmin && !$this->User->hasAccess('tl_xing::published', 'alexf'))
        {
                return '';
        }

		$href .= '&amp;tid='.$row['id'].'&amp;state='. ($row['published'] ? '' : 1);

		if (!$row['published'])
		{
			$icon = 'invisible.gif';
		}		

		return '<a href="'.$this->addToUrl($href.'&amp;id='.\Contao\Input::get('id')).'" title="'.\Contao\StringUtil::specialchars($title).'"'.$attributes.'>'.\Contao\Image::getHtml($icon, $label).'</a> ';
	}

	/**
	 * Disable/enable xing profile
	 * @param integer
	 * @param boolean
	 */
	public function toggleVisibility($intId, $blnVisible)
	{
	    // Check permissions to publish	    
        if (!$this->User->isAdmin && !$this->User->hasAccess('tl_xing::published', 'alexf'))
        {
			$strText = 'Not enough permissions to publish/unpublish Xing Profile ID "'.$intId.'"';

			$logger = \Contao\System::getContainer()->get('monolog.logger.contao');
			$logger->log(LogLevel::ERROR, $strText, array('contao' => new ContaoContext('tl_xing toggleVisibility', TL_ERROR)));

			$this->redirect('contao/main.php?act=error');
        }
		// Update database
		$this->Database->prepare("UPDATE tl_xing SET published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
					   ->execute($intId);
	}
}

