<?php
if (!defined ('TYPO3_MODE')) {
 	die ('Access denied.');
}

$TYPO3_CONF_VARS['FE']['addRootLineFields'] .= ',tx_rkmetadata_titletag,tx_rkmetadata_keywords_layout,tx_rkmetadata_descriptions_layout,tx_rkmetadata_seo';
$TYPO3_CONF_VARS['FE']['pageOverlayFields'] .= ',tx_rkmetadata_titletag,tx_rkmetadata_keywords_layout,tx_rkmetadata_descriptions_layout,tx_rkmetadata_seo';

?>