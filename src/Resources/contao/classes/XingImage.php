<?php 

/**
 * Contao Open Source CMS, Copyright (C) 2005-2015 Leo Feyer
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
 * Class XingImage 
 *
 */
class XingImage
{
    protected $image_file  = '';
    protected $image_size  = 'width="0" height="0"';
    protected $image_title = '404, wrong xing image id';

	/**
	 * get Image Link
	 */
	public function getXingImageLink($xinglayout)
	{
	    $arrXingImageDefinitions= array();
	    
	    if (file_exists(TL_ROOT . "/system/modules/xing/config/xing_image_definitions.php"))
	    {
	        include(TL_ROOT . "/system/modules/xing/config/xing_image_definitions.php");
	    }
	    
	    if (isset($arrXingImageDefinitions[$xinglayout])) 
	    {
            $this->image_file  = $arrXingImageDefinitions[$xinglayout]['image_file'];
    		$this->image_size  = $arrXingImageDefinitions[$xinglayout]['image_size'];
    		$this->image_title = $arrXingImageDefinitions[$xinglayout]['image_title'];
	    }

    	if ($xinglayout < 999) 
    	{
    	    $xing_images = '<img src="http://www.xing.com/img/buttons/'.$this->image_file.'" '.$this->image_size.' alt="XING" title="'.$this->image_title.'" />';
    	}
    	else
    	{
    	    $xing_images = '<img src="http://www.xing.com/img/xing/xe/corporate_pages/'.$this->image_file.'" '.$this->image_size.' alt="XING" title="'.$this->image_title.'" />';
    	}
        return $xing_images;
	} // getXingImageLink
	
} // class

