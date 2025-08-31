<?php

declare(strict_types=1);

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