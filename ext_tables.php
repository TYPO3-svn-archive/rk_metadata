<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

t3lib_extMgm::addStaticFile($_EXTKEY, 'static/ts/', 'rk_metadata Static');

$tempColumns = array (
	'tx_rkmetadata_titletag' => array (
		'exclude' => 1,
		'label' => 'LLL:EXT:rk_metadata/locallang_db.xml:pages.tx_rkmetadata_titletag',
		'config' => array (
			'type' => 'input',
			'size' => '30',
			'eval' => 'trim',
		)
	),
	'tx_rkmetadata_keywords_layout' => array (
		'exclude' => 1,
		'label' => 'LLL:EXT:rk_metadata/locallang_db.xml:pages.tx_rkmetadata_keywords_layout',
		'config' => array (
			'type' => 'input',
			'size' => '30',
			'eval' => 'trim',
		)
	),
	'tx_rkmetadata_descriptions_layout' => array (
		'exclude' => 1,
		'label' => 'LLL:EXT:rk_metadata/locallang_db.xml:pages.tx_rkmetadata_descriptions_layout',
		'config' => array (
			'type' => 'input',
			'size' => '30',
			'eval' => 'trim',
		)
	),
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
t3lib_extMgm::addTCAcolumns('pages',$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes('pages','--div--;LLL:EXT:cms/locallang_tca.xml:pages.tabs.metadata,keywords,description,','4','after:subtitle,');
t3lib_extMgm::addToAllTCAtypes('pages','tx_rkmetadata_seo,tx_rkmetadata_titletag;;;;1-1-1','','after:description,');
t3lib_extMgm::addToAllTCAtypes('pages','tx_rkmetadata_keywords_layout;;;;1-1-1','','before:keywords,');
t3lib_extMgm::addToAllTCAtypes('pages','tx_rkmetadata_descriptions_layout;;;;1-1-1','','before:description,');
t3lib_extMgm::addLLrefForTCAdescr('pages','EXT:rk_metadata/locallang_csh_pages.php');

$tempColumns = array (
	'tx_rkmetadata_titletag' => array (
		'exclude' => 1,
		'label' => 'LLL:EXT:rk_metadata/locallang_db.xml:pages_language_overlay.tx_rkmetadata_titletag',
		'config' => array (
			'type' => 'input',
			'size' => '30',
		)
	),
	'tx_rkmetadata_keywords_layout' => array (
		'exclude' => 1,
		'label' => 'LLL:EXT:rk_metadata/locallang_db.xml:pages_language_overlay.tx_rkmetadata_keywords_layout',
		'config' => array (
			'type' => 'input',
			'size' => '30',
			'eval' => 'trim',
		)
	),
	'tx_rkmetadata_descriptions_layout' => array (
		'exclude' => 1,
		'label' => 'LLL:EXT:rk_metadata/locallang_db.xml:pages_language_overlay.tx_rkmetadata_descriptions_layout',
		'config' => array (
			'type' => 'input',
			'size' => '30',
			'eval' => 'trim',
		)
	),
	'tx_rkmetadata_seo' => array (
		'exclude' => 1,
		'label' => 'LLL:EXT:rk_metadata/locallang_db.xml:pages_language_overlay.tx_rkmetadata_seo',
		'config' => array (
			'type' => 'select',
			'items' => array (
				array('LLL:EXT:rk_metadata/locallang_db.xml:pages_language_overlay.tx_rkmetadata_seo.I.0', '0'),
				array('LLL:EXT:rk_metadata/locallang_db.xml:pages_language_overlay.tx_rkmetadata_seo.I.1', '1'),
				array('LLL:EXT:rk_metadata/locallang_db.xml:pages_language_overlay.tx_rkmetadata_seo.I.2', '2'),
				array('LLL:EXT:rk_metadata/locallang_db.xml:pages_language_overlay.tx_rkmetadata_seo.I.3', '3'),
				array('LLL:EXT:rk_metadata/locallang_db.xml:pages_language_overlay.tx_rkmetadata_seo.I.4', '4'),
			),
			'size' => 1,
			'maxitems' => 1,
		)
	),
);


t3lib_div::loadTCA('pages_language_overlay');
t3lib_extMgm::addTCAcolumns('pages_language_overlay',$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes('pages_language_overlay','--div--;LLL:EXT:cms/locallang_tca.xml:pages.tabs.metadata,keywords,description,','4','after:subtitle,');
t3lib_extMgm::addToAllTCAtypes('pages_language_overlay','tx_rkmetadata_seo,tx_rkmetadata_titletag;;;;1-1-1','','after:description,');
t3lib_extMgm::addToAllTCAtypes('pages_language_overlay','tx_rkmetadata_keywords_layout;;;;1-1-1','','before:keywords,');
t3lib_extMgm::addToAllTCAtypes('pages_language_overlay','tx_rkmetadata_descriptions_layout;;;;1-1-1','','before:description,');
t3lib_extMgm::addLLrefForTCAdescr('pages_language_overlay','EXT:rk_metadata/locallang_csh_pages.php');
?>