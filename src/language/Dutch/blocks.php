<?php
	// $Id$
	// Blocks
	if (defined('_MB_IFORUM_DEFINED')) return;
	else define('_MB_IFORUM_DEFINED', true);
	//$constpref = '_MB_' . strtoupper( basename( dirname(  dirname(  dirname( __FILE__ ) ) ) ) ) ;
	$constpref = '_MB_IFORUM';
	 
	define($constpref."_FORUM", "Forum");
	define($constpref."_TOPIC", "Onderwerp");
	define($constpref."_RPLS", "Reacties");
	define($constpref."_VIEWS", "Weergaven");
	define($constpref."_LPOST", "Laatste bericht");
	define($constpref."_VSTFRMS", "Forums");
	define($constpref."_DISPLAY", "Aantal berichten: ");
	define($constpref."_DISPLAYMODE", "Weergavemodus: ");
	define($constpref."_DISPLAYMODE_FULL", "Volledig");
	define($constpref."_DISPLAYMODE_COMPACT", "Compact");
	define($constpref."_DISPLAYMODE_LITE", "Minimalistisch");
	define($constpref."_FORUMLIST", "Toegestane forumlijst: ");
	//define($constpref."_FORUMLIST_DESC","Forums allowed to display in the block");
	//define($constpref."_FORUMLIST_ID","ID");
	//define($constpref."_FORUMLIST_NAME","Forum name");
	define($constpref."_ALLTOPICS", "Onderwerpen");
	define($constpref."_ALLPOSTS", "Berichten");
	 
	define($constpref."_CRITERIA", "Criteria weergeven");
	define($constpref."_CRITERIA_TOPIC", "Onderwerpen");
	define($constpref."_CRITERIA_POST", "Berichten");
	define($constpref."_CRITERIA_TIME", "Meest recente");
	define($constpref."_CRITERIA_TITLE", "Bericht titel");
	define($constpref."_CRITERIA_TEXT", "Bericht tekst");
	define($constpref."_CRITERIA_VIEWS", "Meeste weergaven");
	define($constpref."_CRITERIA_REPLIES", "Meeste reacties");
	define($constpref."_CRITERIA_DIGEST", "Nieuwste samenvatting");
	define($constpref."_CRITERIA_STICKY", "Nieuwste sticky");
	define($constpref."_CRITERIA_DIGESTS", "Meeste samenvattingen");
	define($constpref."_CRITERIA_STICKYS", "Meeste sticky topics");
	define($constpref."_TIME", "Tijd periode");
	define($constpref."_TIME_DESC", "Positief voor dagen en negatief voor uren");
	 
	define($constpref."_TITLE", "Aanspreektitel");
	define($constpref."_AUTHOR", "Auteur");
	define($constpref."_COUNT", "Aantal");
	define($constpref."_INDEXNAV", "Navigator weergeven");
	 
	define($constpref."_TITLE_LENGTH", "Titel/Bericht lengte");
?>