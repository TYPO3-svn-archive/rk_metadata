<?php
/**
* Default TCA_DESCR for tx_rkmetadata_titletag field in the "pages" table
*/

$LOCAL_LANG = Array (
	'default' => Array (
		'tx_rkmetadata_keywords_layout.description' => 'Enter the format of the keywordsfield',
		'tx_rkmetadata_keywords_layout.details' => 'This field is for setting the keywords tag for the page. It\'s possible to use any field from the page, just by wrapping it in &#60; &#62;. Defaults to use the keywords of the current page or rootpage if there are non in the current page.
		
		<b>Example:</b>
		Welcome at &#60;website&#62; - &#60;title&#62; - additional text
		
		<b>Possible values:</b>
		&#60;website&#62;, insert the name of the site set with typoscript constants ( config.website.name )
		&#60;pagefield&#62;, set any field from the page or it\'s language overlay (fi: &#60;title&#62;, &#60;subtitle&#62;
		&#60;{table,GPvar,dbField}&#62;, to set a field from any databasetable
		
		<b>Extra\'s</b>
		You can use // to set a alternative for if a field is not set. (fi: &#60;subtitle//title&#62;, use title if subtitle is empty).
		This also works in combination with the database field setup (fi: &#60;{tt_news,tx_ttnews|tt_news,title}//title&#62; )
		',
		
		'tx_rkmetadata_descriptions_layout.description' => 'Enter the format of the descriptionfield',
		'tx_rkmetadata_descriptions_layout.details' => 'This field is for setting the description tag for the page. It\'s possible to use any field from the page, just by wrapping it in &#60; &#62;.  Defaults to use the description of the current page or rootpage if there are non in the current page.
		
		<b>Example:</b>
		Welcome at &#60;website&#62; - &#60;title&#62; - additional text
		
		<b>Possible values:</b>
		&#60;website&#62;, insert the name of the site set with typoscript constants ( config.website.name )
		&#60;pagefield&#62;, set any field from the page or it\'s language overlay (fi: &#60;title&#62;, &#60;subtitle&#62;
		&#60;{table,GPvar,dbField}&#62;, to set a field from any databasetable
		
		<b>Extra\'s</b>
		You can use // to set a alternative for if a field is not set. (fi: &#60;subtitle//title&#62;, use title if subtitle is empty).
		This also works in combination with the database field setup (fi: &#60;{tt_news,tx_ttnews|tt_news,title}//title&#62; )
		',
		
		'tx_rkmetadata_titletag.description' => 'Enter the format of the title tag',
		'tx_rkmetadata_titletag.details' => 'This field is for setting the title tag for the page. It\'s possible to use any field from the page, just by wrapping it in &#60; &#62;.
		
		<b>Example:</b>
		Welcome at &#60;website&#62; - &#60;title&#62; - additional text
		
		<b>Possible values:</b>
		&#60;website&#62;, insert the name of the site set with typoscript constants ( config.website.name )
		&#60;pagefield&#62;, set any field from the page or it\'s language overlay (fi: &#60;title&#62;, &#60;subtitle&#62;
		&#60;{table,GPvar,dbField}&#62;, to set a field from any databasetable
		
		<b>Extra\'s</b>
		You can use // to set a alternative for if a field is not set. (fi: &#60;subtitle//title&#62;, use title if subtitle is empty).
		This also works in combination with the database field setup (fi: &#60;{tt_news,tx_ttnews|tt_news,title}//title&#62; )
		',
	)
);
?>