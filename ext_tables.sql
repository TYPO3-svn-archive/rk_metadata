#
# Table structure for table 'pages'
#
CREATE TABLE pages (
	tx_rkmetadata_titletag varchar(255) DEFAULT '' NOT NULL
	tx_rkmetadata_keywords_layout varchar(255) DEFAULT '' NOT NULL
	tx_rkmetadata_descriptions_layout varchar(255) DEFAULT '' NOT NULL
	tx_rkmetadata_seo int(11) DEFAULT '0' NOT NULL
);



#
# Table structure for table 'pages_language_overlay'
#
CREATE TABLE pages_language_overlay (
	tx_rkmetadata_titletag varchar(255) DEFAULT '' NOT NULL
	tx_rkmetadata_keywords_layout varchar(255) DEFAULT '' NOT NULL
	tx_rkmetadata_descriptions_layout varchar(255) DEFAULT '' NOT NULL
	tx_rkmetadata_seo int(11) DEFAULT '0' NOT NULL
);