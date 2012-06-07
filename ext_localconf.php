<?php
if (!defined ('TYPO3_MODE')) {
 	die ('Access denied.');
}

t3lib_extMgm::addPItoST43($_EXTKEY, 'pi1/class.tx_rkmetadata_pi1.php', '_pi1', '', 1);

$TYPO3_CONF_VARS['FE']['addRootLineFields'] .= ',tx_rkmetadata_titletag,tx_rkmetadata_keywords_layout,tx_rkmetadata_descriptions_layout,tx_rkmetadata_seo'; 
$TYPO3_CONF_VARS['FE']['pageOverlayFields'] .= ',tx_rkmetadata_titletag,tx_rkmetadata_keywords_layout,tx_rkmetadata_descriptions_layout,tx_rkmetadata_seo';

?>