-- ********************************************************
-- *                                                      *
-- * IMPORTANT NOTE                                       *
-- *                                                      *
-- * Do not import this file manually but use the Contao  *
-- * install tool to create and maintain database tables! *
-- *                                                      *
-- ********************************************************

--
-- Table `tl_page`
--

CREATE TABLE `tl_page` (
  `super_bg_image_pagetree_enable` char(1) NOT NULL default '',
  `super_bg_image_pagetree_images` blob NOT NULL,
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
