<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2009 Pim Broens <extensions@redkiwi.nl>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

require_once(PATH_tslib.'class.tslib_pibase.php');

/**
 * Plugin 'rk_metadata' for the 'rk_metadata' extension.
 *
 * @author Pim Broens <extensions@redkiwi.nl>
 * @package TYPO3
 * @subpackage tx_rkmetadata
 */
class tx_rkmetadata_user extends tslib_pibase {

	/**
	 * Same as class name
	 *
	 * @var string
	 */
	var $prefixId = 'tx_rkmetadata_user';

	/**
	 * Path to this script relative to the extension dir.
	 *
	 * @var string
	 */
	var $scriptRelPath = 'user/class.tx_rkmetadata_user.php';

	/**
	 * The extension key.
	 *
	 * @var string
	 */
	var $extKey = 'rk_metadata';

	/**
	 * @var boolean
	 */
	var $pi_checkCHash = true;

	/**
	 * The main method of the PlugIn
	 *
	 * @param string $content: The PlugIn content
	 * @param array $configuration: The PlugIn configuration
	 * @return string The content that is displayed on the website
	 */
	function renderMetadata($content, $configuration) {
		$this->conf = $configuration;
		$this->sys_page = t3lib_div::makeInstance('t3lib_pageSelect');
		$this->sys_page->init($GLOBALS['TSFE']->showHiddenPage);

		$templateLayouts = array (
			'title' => $configuration['layouts.']['title'],
			'description' => $configuration['layouts.']['description'],
			'keywords' => $configuration['layouts.']['keywords']
		);
		$a_alternativePageContent = $this->getAlternativePageContent();

		// Set index/follow of page
		$a_indexFollow = array( 1 => 'noindex, nofollow', 2 => 'index, follow', 3 => 'noindex, follow', 4 => 'index, nofollow' );
		$GLOBALS['TSFE']->pSetup['meta.']['robots'] = $a_indexFollow[ $a_alternativePageContent['tx_rkmetadata_seo'] ];

		// Get the MetaData (keywords, description || get from rootLine when not available)
		$this->s_keyWords = $this->cleanForKeywords( $a_alternativePageContent['keywords'] );
		$this->s_description = $this->cleanForKeywords( $a_alternativePageContent['description'] );

		$this->s_keyWords = $this->replaceDynamicData( $templateLayouts['keywords'] ); // Get the dynamic page keywords
		$this->s_description = $this->replaceDynamicData( $templateLayouts['description'] ); // Get the dynamic page description
		$this->s_title = $this->replaceDynamicData( $templateLayouts['title'] ); // Get the dynamic page title

		// Set the MetaData (keywords, description and title)
		$GLOBALS['TSFE']->pSetup['meta.']['keywords'] = $this->s_keyWords;
		$GLOBALS['TSFE']->pSetup['meta.']['description'] = $this->s_description;

		return('<title>'.$this->s_title.'</title>');
	}

	/**
	 * Get page information from the parent uid
	 *
	 * @param $uid
	 * @return mixed
	 */
	function getPageData($uid) {
		return $this->sys_page->getPageOverlay( $this->sys_page->getPage( $uid ), $GLOBALS['TSFE']->sys_language_uid );
	}

	/**
	 * Retrieve metadata from the current page
	 * If nothing, loop root line for information..
	 *
	 * @return array
	 */
	function getAlternativePageContent(){
		$a_alternativePageContent = array(
			'keywords' => $GLOBALS['TSFE']->page['keywords'],
			'description' => $GLOBALS['TSFE']->page['description'],
		);

		foreach($GLOBALS['TSFE']->rootLine as $a_page){
			$a_pageData = $this->getPageData($a_page['uid']);
			if ( empty($a_alternativePageContent['keywords']) ){ $a_alternativePageContent['keywords'] = $a_pageData['keywords']; }
			if ( empty($a_alternativePageContent['description']) ){ $a_alternativePageContent['description'] = $a_pageData['description']; }
			if ( empty($a_alternativePageContent['tx_rkmetadata_seo']) ){ $a_alternativePageContent['tx_rkmetadata_seo'] = $a_pageData['tx_rkmetadata_seo']; }
		}

		return $a_alternativePageContent;
	}

	/**
	 * Clean string for meta tag keywords
	 * @param $keyword
	 * @return mixed
	 */
	function cleanForKeywords($keyword){
		$a_strReplace = array(';',
			'...,',
			'...',
			'-,',
			'(',
			')',
			',,',
			', ,',
		);
		$keyword = str_replace($a_strReplace,', ',$keyword);
		return $keyword;
	}

	/**
	 * Replace dynamic data based on the layouts
	 *
	 * @param $s_data
	 * @return mixed
	 */
	function replaceDynamicData($s_data){
		preg_match_all('/\<(.*?)\>/', $s_data, $a_replaceTitletagFields);

		foreach ($a_replaceTitletagFields[1] as $s_val){
			$a_val = explode('//',$s_val);
			if ( count($a_val) == '2' ){
				foreach ($a_val as $val){
					$s_replaceStr = '';
					if ($val == 'website' && !empty($this->conf['websiteName'])){
						$s_replaceStr = $this->conf['websiteName'];
						break;
					} elseif ($val == 'keywords' && !empty($this->s_keyWords)) {
						$s_replaceStr = $this->s_keyWords;
						break;
					} elseif ($val == 'description' && !empty($this->s_description)) {
						$s_replaceStr = $this->s_description;
						break;
					} elseif (!empty($val) && !empty($GLOBALS['TSFE']->page[$val])) {
						$s_replaceStr = $GLOBALS['TSFE']->page[$val];
						break;
					} elseif (preg_match('/\{(.*?)\}/', $val, $a_dbSelectConf)) {
						if( $this->getDBFieldValue($a_dbSelectConf[1]) ){
							$s_replaceStr = $this->getDBFieldValue($a_dbSelectConf[1]);
							break;
						}
					}
				}
				$s_data = str_replace('<'.$a_val[0].'//'.$a_val[1].'>',$s_replaceStr,$s_data);
				unset($s_replaceStr);
			} else {
				if ($a_val[0] == 'website' && !empty($this->conf['websiteName'])){
					$s_data = str_replace('<website>',$this->conf['websiteName'],$s_data);
				} elseif ($a_val[0] == 'keywords' && !empty($this->s_keyWords)) {
					$s_data = str_replace('<keywords>',$this->s_keyWords,$s_data);
				} elseif ($a_val[0] == 'description' && !empty($this->s_description)) {
					$s_data = str_replace('<description>',$this->s_description,$s_data);
				} elseif (!empty($a_val[0]) && !empty($GLOBALS['TSFE']->page[$a_val[0]])) {
					$s_data = str_replace('<'.$a_val[0].'>',$GLOBALS['TSFE']->page[$a_val[0]],$s_data);
				} elseif (preg_match('/\{(.*?)\}/', $a_val[0], $a_dbSelectConf)) {
					$s_replaceStr = $this->getDBFieldValue($a_dbSelectConf[1]);
					$s_data = str_replace('<'.$a_dbSelectConf[0].'>',$s_replaceStr,$s_data);
				}
			}
		}
		return $s_data;
	}

	/**
	 * Retrieve database field value based on configuration
	 *
	 * @param $s_dbSelectConf
	 * @return bool
	 */
	function getDBFieldValue($s_dbSelectConf){
		$a_excludeTables = array( 'be_users', 'be_groups', 'be_sessions' );

		$a_dbSelectConf = explode(',',$s_dbSelectConf);
		if ( in_array( $a_dbSelectConf[0], $a_excludeTables ) ){
			return FALSE;
		}

		if ( !is_numeric($a_dbSelectConf[1]) ){
			$a_GParray = explode('|',$a_dbSelectConf[1]);
			$a_GP = t3lib_div::_GP($a_GParray[0]);
			foreach ( $a_GParray as $v ){
				if ($v != $a_GParray[0]){
						/** @var $s_array array */
					$s_array = $s_array[ $v ];
				} else {
					$s_array = $a_GP;
				}
			}
		} else {
			$s_array = $a_dbSelectConf[1];
		}
		$s_addWhereClause = 'uid="' . intval($s_array) . '"' .$this->cObj->enableFields($a_dbSelectConf[0]);

		$a_fieldResult = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
												$a_dbSelectConf[2],
												$a_dbSelectConf[0],
												$s_addWhereClause,
												'',
												'',
												1
											);
		if ( !empty( $a_fieldResult[0][ $a_dbSelectConf[2] ] ) ){
			return $a_fieldResult[0][ $a_dbSelectConf[2] ];
		} else {
			return FALSE;
		}
	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/rk_metadata/user/class.tx_rkmetadata_user.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/rk_metadata/user/class.tx_rkmetadata_user.php']);
}

?>