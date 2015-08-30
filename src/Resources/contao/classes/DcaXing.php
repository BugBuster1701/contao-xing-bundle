<?php 

/**
 * Contao Open Source CMS, Copyright (C) 2005-2015 Leo Feyer
 * 
 * Contao Module "Xing" - DCA Helper Class DcaXing
 * 
 * @copyright  Glen Langer 2008..2015 <http://contao.ninja>
 * @author     Glen Langer (BugBuster)
 * @package    Xing
 * @license    LGPL
 * @filesource
 * @see	       https://github.com/BugBuster1701/contao_xing
 */

/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace BugBuster\Xing;

/**
 * DCA Helper Class DcaXing
 *
 * @copyright  Glen Langer 2008..2015 <http://contao.ninja>
 * @author     Glen Langer (BugBuster)
 * @package    Xing
 *
 */
class DcaXing extends \Backend
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
		$date = date($GLOBALS['TL_CONFIG']['datimFormat'], $arrRow['tstamp']);
		//$XingImage = new XingImage(); // classes/XingImage.php
		$this->import('\Xing\XingImage','XingImage');
		$xing_images = $this->XingImage->getXingImageLink($arrRow['xinglayout']);

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
		if (strlen(\Input::get('tid')))
		{
			$this->toggleVisibility(\Input::get('tid'), (\Input::get('state') == 1));
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

		return '<a href="'.$this->addToUrl($href.'&amp;id='.\Input::get('id')).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
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
			$this->log('Not enough permissions to publish/unpublish Xing Profile ID "'.$intId.'"', 'tl_xing toggleVisibility', TL_ERROR);
			$this->redirect('contao/main.php?act=error');
        }
		// Update database
		$this->Database->prepare("UPDATE tl_xing SET published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
					   ->execute($intId);
	}
}

