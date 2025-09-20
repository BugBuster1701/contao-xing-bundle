<?php

declare(strict_types=1);

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

$GLOBALS['TL_DCA']['tl_content']['palettes']['xing_list'] = '
    {type_legend},type,headline;
    {xingcat_legend},xing_categories;
    {template_legend:hide},customTpl;
    {protected_legend:hide},protected;
    {expert_legend:hide},cssID;
    {invisible_legend:hide},invisible,start,stop
';

$GLOBALS['TL_DCA']['tl_content']['fields']['xing_categories'] = array
(
	'label'     => &$GLOBALS['TL_LANG']['tl_content']['xing_categories'],
	'exclude'   => true,
	'inputType' => 'radio',
	'foreignKey'=> 'tl_xing_category.title',
	'eval'      => array('multiple'=>false, 'mandatory'=>true, 'tl_class'=>'w50 m12'),
	'sql'       => "varchar(255) NOT NULL default ''",
);
