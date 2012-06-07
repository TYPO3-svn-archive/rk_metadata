<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

t3lib_extMgm::addStaticFile($_EXTKEY, 'static/ts/', 'rk_metadata Static');

$tempColumns = array (
	'tx_rkmetadata_seo' => array (
		'exclude' => 1,
		'label' => 'LLL:EXT:rk_metadata/locallang_db.xml:pages.tx_rkmetadata_seo',
		'config' => array (
			'type' => 'select',
			'items' => array (
				array('LLL:EXT:rk_metadata/locallang_db.xml:pages.tx_rkmetadata_seo.I.0', '0'),
				array('LLL:EXT:rk_metadata/locallang_db.xml:pages.tx_rkmetadata_seo.I.1', '1'),
				array('LLL:EXT:rk_metadata/locallang_db.xml:pages.tx_rkmetadata_seo.I.2', '2'),
				array('LLL:EXT:rk_metadata/locallang_db.xml:pages.tx_rkmetadata_seo.I.3', '3'),
				array('LLL:EXT:rk_metadata/locallang_db.xml:pages.tx_rkmetadata_seo.I.4', '4'),
			),
			'size' => 1,
			'maxitems' => 1,
		)
	),
);


t3lib_div::loadTCA('pages');
t3lib_extMgm::addTCAcolumns('pages', $tempColumns, 1);
t3lib_extMgm::addToAllTCAtypes('pages','keywords,description','4','after:abstract');
t3lib_extMgm::addToAllTCAtypes('pages','tx_rkmetadata_seo', '', 'after:abstract');

t3lib_extMgm::addLLrefForTCAdescr('pages','EXT:rk_metadata/locallang_csh_pages.php');

t3lib_div::loadTCA('pages_language_overlay');
t3lib_extMgm::addTCAcolumns('pages_language_overlay', $tempColumns, 1);
t3lib_extMgm::addToAllTCAtypes('pages_language_overlay','keywords,description,','4','after:abstract,');
t3lib_extMgm::addToAllTCAtypes('pages_language_overlay','tx_rkmetadata_seo','','after:abstract,');
t3lib_extMgm::addLLrefForTCAdescr('pages_language_overlay','EXT:rk_metadata/locallang_csh_pages.php');
?>