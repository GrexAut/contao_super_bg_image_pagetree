<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * @package	super_bg_image_pagetree
 * @author	2create.at 2012 <leo.unglaub@2create.at>
 * @link	http://contao.org
 * @license	http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Class SuperBgImagePagetree
 * Contains methods to add the javascript "SuperBGImage" to the frontend
 */
class SuperBgImagePagetree extends Frontend
{
	/**
	 * Add all images to the frontend
	 *
	 * @param	string	$strContent		The content of the template
	 * @param	string	$strTemplate	The name of the content
	 * @return	string					Return the modified template
	 */
	public function addImagesToHtml($strContent, $strTemplate)
	{
		// get the global page object
		global $objPage;

		// add the images only to the fe_page* template
		if ($strTemplate === $objPage->template && $objPage->super_bg_image_pagetree_enable == 1)
		{
			// add the new code on the bottom of the fe_page* template
			$strContent = str_replace('</body>', $this->generateHtmlCode() . '</body>', $strContent);
		}

		// return the modified content
		return $strContent;
	}


	/**
	 * Add the needed js files to the header.
	 *
	 * Note:
	 * In 2.11 you can't use the addImageToHtml method for that because
	 * it's triggered way to late.
	 *
	 * @param	$objPage
	 * @param	$objLayout
	 * @param	$objPageRegular
	 * @return	void
	 */
	public function addJsToHeader($objPage, $objLayout, $objPageRegular)
	{
		// only add the files if the super_bg_image is enabled
		if ($objPage->super_bg_image_pagetree_enable == 1)
		{
			// add the required .js files to the template
			$GLOBALS['TL_JAVASCRIPT'][] = 'plugins/super_bg_image/jquery.effects.core.min.js';
			$GLOBALS['TL_JAVASCRIPT'][] = 'plugins/super_bg_image/jquery.effects.slide.min.js';
			$GLOBALS['TL_JAVASCRIPT'][] = 'plugins/super_bg_image/jquery.effects.blind.min.js';
			$GLOBALS['TL_JAVASCRIPT'][] = 'plugins/super_bg_image/jquery.superbgimage.min.js';
		}
	}


	/**
	 * Build the needed html code for the javascript
	 *
	 * Note: We don't have to use models here, because
	 * we only need the current site. So we can use $objPage
	 * directly.
	 *
	 * @param	void
	 * @return	string		The generated html code with all selected images in it
	 */
	public function generateHtmlCode()
	{
		// get the global page object
		global $objPage;


		// define some variables
		$strHtml = '';
		$arrImages = (array) deserialize($objPage->super_bg_image_pagetree_images);

		// stop if there are no files
		if (count($arrImages) < 1 || $objPage->super_bg_image_pagetree_enable != 1)
		{
			return '';
		}


		// start the html container
		$strHtml .= '<div id="contao-thumbs">';

		// walk over all files and create the html image
		foreach ($arrImages as $v)
		{
			// read the meta.txt for the current directory
			$arrMeta = (array) $this->parseMetaFile(dirname($v));

			// build the html string with the image as contant
			$strHtml .= '<a href="' . $v . '" title="' . $this->arrMeta[basename($v)][2] . '" alt="' . $this->arrMeta[basename($v)][0] . '"></a>';
		}

		// close the html container
		$strHtml .= '</div>';

		return $strHtml;
	}
}

?>