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
class SuperBgImagePagetree extends Controller
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
			// add the required .js files to the template
			$GLOBALS['TL_JAVASCRIPT'][] = 'assets/super_bg_image/jquery.effects.core.min.js';
			$GLOBALS['TL_JAVASCRIPT'][] = 'assets/super_bg_image/jquery.effects.slide.min.js';
			$GLOBALS['TL_JAVASCRIPT'][] = 'assets/super_bg_image/jquery.effects.blind.min.js';
			$GLOBALS['TL_JAVASCRIPT'][] = 'assets/super_bg_image/jquery.superbgimage.min.js';


			// add the new code on the bottom of the fe_page* template
			$strContent = str_replace('</body>', $this->generateHtmlCode() . '</body>', $strContent);
		}

		// return the modified content
		return $strContent;
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
		$arrImageIds = (array) deserialize($objPage->super_bg_image_pagetree_images);
		$arrImageOrder = (array) trimsplit(',', $objPage->order);


		// get the file model
		$objFiles = FilesModel::findMultipleByIds($arrImageIds);

		// stop if there are no files
		if ($objFiles->count() < 1 || $objPage->super_bg_image_pagetree_enable != 1)
		{
			return '';
		}


		// start the html container
		$strHtml .= '<div id="contao-thumbs">';

		// walk over all files and create the html image
		while ($objFiles->next())
		{
			// extract all meta informations
			$arrMeta = (array) deserialize($objFiles->meta);

			// get the meta informations for the current language
			if (isset($arrMeta[$objPage->language]))
			{
				$arrMetaLang = $arrMeta[$objPage->language];
				$strChunk = '<a href="' . $objFiles->path . '" title="' . $arrMetaLang['title'] . '"></a>';
			}
			else
			{
				// add the new image to the buffer
				$strChunk = '<a href="' . $objFiles->path . '"></a>';
			}


			$strHtml .= $strChunk;
		}

		// close the html container
		$strHtml .= '</div>';

		return $strHtml;
	}
}

?>