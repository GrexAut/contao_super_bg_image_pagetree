<?php

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2012 Leo Feyer
 * 
 * @package Super_bg_image_pagetree
 * @link    http://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'SuperBgImagePagetree' => 'system/modules/super_bg_image_pagetree/classes/SuperBgImagePagetree.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'j_super_bg_image' => 'system/modules/super_bg_image_pagetree/templates',
));
