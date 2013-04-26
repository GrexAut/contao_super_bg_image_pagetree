<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * @package super_bg_image_pagetree
 * @author	2create.at 2012 <leo.unglaub@2create.at>
 * @link    http://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_page']['palettes']['__selector__'][] = 'super_bg_image_pagetree_enable';
$GLOBALS['TL_DCA']['tl_page']['palettes']['regular'] = str_replace
(
	'{cache_legend:hide}',
	'{super_bg_image_pagetree_legend},super_bg_image_pagetree_enable;{cache_legend:hide}',
	$GLOBALS['TL_DCA']['tl_page']['palettes']['regular']
);


/**
 * Subpalettes
 */
$GLOBALS['TL_DCA']['tl_page']['subpalettes']['super_bg_image_pagetree_enable'] = 'super_bg_image_pagetree_images';


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_page']['fields']['super_bg_image_pagetree_enable'] = array
(
	'label'			=> &$GLOBALS['TL_LANG']['tl_page']['super_bg_image_pagetree_enable'],
	'exclude'		=> true,
	'inputType'		=> 'checkbox',
	'filter'		=> true,
	'eval'			=> array
	(
		'tl_class'			=> 'w50',
		'submitOnChange'	=> true
	)
);

$GLOBALS['TL_DCA']['tl_page']['fields']['super_bg_image_pagetree_images'] = array
(
	'label'			=> &$GLOBALS['TL_LANG']['tl_page']['super_bg_image_pagetree_images'],
	'exclude'		=> true,
	'inputType'		=> 'fileTree',
	'search'		=> true,
	'eval'			=> array
	(
		'tl_class'			=> 'long clr',
		'files'				=> true,
		'filesOnly'			=> true,
		'fieldType'			=> 'checkbox',
		'orderField'		=> 'super_bg_image_pagetree_order',
		'multiple'			=> true,
		'extensions'		=> $GLOBALS['TL_CONFIG']['validImageTypes']
	)
);

$GLOBALS['TL_DCA']['tl_page']['fields']['super_bg_image_pagetree_order'] = array
(
	'label'			=> &$GLOBALS['TL_LANG']['tl_page']['super_bg_image_pagetree_order']
);

?>
