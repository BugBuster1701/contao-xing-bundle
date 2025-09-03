<?php

declare(strict_types=1);

namespace BugBuster\XingBundle\Controller\ContentElement;

use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\CoreBundle\Routing\ScopeMatcher;
use Contao\CoreBundle\Security\Authentication\Token\TokenChecker;
use Contao\StringUtil;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\DBAL\Connection;

#[AsContentElement(category: 'media')]
class XingListController extends AbstractContentElementController
{
    /**
	 * Template
	 * @var string
	 */
	protected $xing_template = 'xing_list';

    /**
	 * Xing Image Link
	 * @var string
	 */
	protected $xing_images = '';

    /**
	 * Category
	 * @var array
	 */
	protected $xing_category = array();


    public function __construct(
        private readonly Connection $connection,
        private readonly ScopeMatcher $scopeMatcher,
        private readonly TokenChecker $tokenChecker
        )
    {
    }

    protected function getResponse(FragmentTemplate $template, ContentModel $model, Request $request): Response
    {
        if ($this->scopeMatcher->isBackendRequest($request)) 
        {
            $template->set('wildcard', '### XING LIST ###');

            return $template->getResponse();
        }
        //dump($model);
        
        //$this->xing_category = StringUtil::deserialize($model->xing_categories, true);
        $this->xing_category = $model->xing_categories;
        if ($model->customTpl != '')
        {
            $this->xing_template = $model->customTpl;
        }

        if ($this->tokenChecker->hasBackendUser())
        {
            $arrXings = $this->connection->fetchAllAssociative("SELECT tl_xing.id AS id, xingprofil, xinglayout, xingtarget, title"
												. " FROM tl_xing LEFT JOIN tl_xing_category ON (tl_xing_category.id=tl_xing.pid)"
												. " WHERE pid = " . $this->xing_category . ""
												. " ORDER BY title, sorting");
        } else
        {
            $arrXings = $this->connection->fetchAllAssociative("SELECT tl_xing.id AS id, xingprofil, xinglayout, xingtarget, title"
												. " FROM tl_xing LEFT JOIN tl_xing_category ON (tl_xing_category.id=tl_xing.pid)"
												. " WHERE pid = " . $this->xing_category . " AND published=1"
												. " ORDER BY title, sorting");
        }
        $arrXing = array();
		$XingImage = new \BugBuster\Xing\XingImage(); // classes/XingImage.php
        $template->set('category', '');
        
        foreach ($arrXings as $xingRow) {
            $this->xing_images = $XingImage->getXingImageLink($xingRow['xinglayout'], 'xing_local');
            if (str_contains($this->xing_template,'xing_list_company'))
			{
				$this->xing_images = preg_replace('/title="[^"]*"/', 'title="Company"', $this->xing_images);
			}
            $arrXing[] = array
			(
				'xingprofil' => trim($xingRow['xingprofil']),
				'xinglayout' => $this->xing_images,
				'xingtarget' => ($xingRow['xingtarget'] == '1') ? '' : ' target="_blank"'
			);
            $template->set('category', $xingRow['title']);
        }
        
		$template->set('xing', $arrXing);            
        
        return $template->getResponse();
    }
}
