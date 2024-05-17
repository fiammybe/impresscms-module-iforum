<?php
$constpref = '_AM_IFORUM';

	define("_AM_IFORUM_FORUMCONF", "Forum Configuratie");
	define("_AM_IFORUM_ADDAFORUM", "Voeg een Forum toe");
	define("_AM_IFORUM_SYNCFORUM", "Synchroniseer forums");
	define("_AM_IFORUM_REORDERFORUM", "Herordenen");
	define("_AM_IFORUM_FORUM_MANAGER", "Forums");
	define("_AM_IFORUM_PRUNE_TITLE", "Opschonen");
	define("_AM_IFORUM_CATADMIN", "Categorieën");
	define("_AM_IFORUM_GENERALSET", "Voorkeuren" );
	define("_AM_IFORUM_MODULEADMIN", "Module Beheerder:");
	define("_AM_IFORUM_HELP", "Hulp");
	define("_AM_IFORUM_ABOUT", "Over");
	define("_AM_IFORUM_BOARDSUMMARY", "Bord statistieken");
	define("_AM_IFORUM_PENDING_POSTS_FOR_AUTH", "Berichten in afwachting van autorisatie");
	define("_AM_IFORUM_POSTID", "Bericht ID");
	define("_AM_IFORUM_POSTDATE", "Bericht datum");
	define("_AM_IFORUM_POSTER", "Poster");
	define("_AM_IFORUM_TOPICS", "Onderwerpen");
	define("_AM_IFORUM_SHORTSUMMARY", "Samenvatting bord");
	define("_AM_IFORUM_TOTALPOSTS", "Totaal aantal berichten");
	define("_AM_IFORUM_TOTALTOPICS", "Totaal Aantal Onderwerpen");
	define("_AM_IFORUM_TOTALVIEWS", "Totale weergaven");
	define("_AM_IFORUM_BLOCKS", "Blokken");
	define("_AM_IFORUM_SUBJECT", "Onderwerp");
	define("_AM_IFORUM_APPROVE", "Bericht goedkeuren");
	define("_AM_IFORUM_APPROVETEXT", "Inhoud van dit bericht");
	define("_AM_IFORUM_POSTAPPROVED", "Bericht is goedgekeurd");
	define("_AM_IFORUM_POSTNOTAPPROVED", "Bericht is NIET goedgekeurd");
	define("_AM_IFORUM_POSTSAVED", "Bericht is opgeslagen");
	define("_AM_IFORUM_POSTNOTSAVED", "Bericht is NIET opgeslagen");

	define("_AM_IFORUM_TOPICAPPROVED", "Onderwerp is goedgekeurd");
	define("_AM_IFORUM_TOPICNOTAPPROVED", "Onderwerp is NIET goedgekeurd");
	define("_AM_IFORUM_TOPICID", "Onderwerp ID");
	define("_AM_IFORUM_ORPHAN_TOPICS_FOR_AUTH", "Niet-goedgekeurde onderwerpen authorisatie");

	define($constpref.'_DEL_ONE', 'Alleen dit bericht verwijderen');
	define($constpref.'_POSTSDELETED', 'Geselecteerde bericht verwijderd.');
	define($constpref.'_NOAPPROVEPOST', 'Er zijn momenteel geen berichten die wachten op goedkeuring.');
	define($constpref.'_SUBJECTC', 'Onderwerp:');
	define($constpref.'_MESSAGEICON', 'Bericht icoon:');
	define($constpref.'_MESSAGEC', 'Bericht:');
	define($constpref.'_CANCELPOST', 'Bericht annuleren');
	define($constpref.'_GOTOMOD', 'Ga naar de module');

	define($constpref.'_PREFERENCES', 'Module voorkeuren');
	define($constpref.'_POLLMODULE', 'Enquete Module');
	define($constpref.'_POLL_OK', 'Klaar voor gebruik');
	define($constpref.'_GDLIB1', 'GD1 bibliotheek:');
	define($constpref.'_GDLIB2', 'GD2 bibliotheek:');
	define($constpref.'_AUTODETECTED', 'Autodetectie: ');
	define($constpref.'_AVAILABLE', 'Beschikbaar');
	define($constpref.'_NOTAVAILABLE', '<span style="color: red; ">Niet beschikbaar</span>');
	define($constpref.'_NOTWRITABLE', '<span style="color: red; ">Niet schrijfbaar</span>');
	define($constpref.'_IMAGEMAGICK', 'ImageMagicK:');
	define($constpref.'_IMAGEMAGICK_NOTSET', 'Niet ingesteld');
	define($constpref.'_ATTACHPATH', 'Pad voor het opslaan van bijlagen');
	define($constpref.'_THUMBPATH', 'Pad voor de miniatuur van bijlage');
	//define($constpref.'_RSSPATH','Path for RSS feed');
	define($constpref.'_REPORT', 'Gerapporteerde berichten');
	define($constpref.'_REPORT_PENDING', 'In afwachting van rapport');
	define($constpref.'_REPORT_PROCESSED', 'verwerkt rapport');

	define($constpref.'_CREATETHEDIR', 'Maak het aan');
	define($constpref.'_SETMPERM', 'Stel de rechten in');
	define($constpref.'_DIRCREATED', 'De map is aangemaakt');
	define($constpref.'_DIRNOTCREATED', 'De map kan niet worden aangemaakt');
	define($constpref.'_PERMSET', 'De machtiging is ingesteld');
	define($constpref.'_PERMNOTSET', 'De machtiging kan niet worden ingesteld');

	define($constpref.'_DIGEST', 'Samenvatting melding');
	define($constpref.'_DIGEST_PAST', '<span style="color: red; ">Moet %d minuten geleden verstuurd worden</span>');
	define($constpref.'_DIGEST_NEXT', 'Moet verzonden worden binnen %d minuten');
	define($constpref.'_DIGEST_ARCHIVE', 'Samenvatting archief');
	define($constpref.'_DIGEST_SENT', 'Samenvatting verwerkt');
	define($constpref.'_DIGEST_FAILED', 'Samenvatting NIET verwerkt');

	// admin_forum_manager.php
	define("_AM_IFORUM_NAME", "Naam");
	define("_AM_IFORUM_CREATEFORUM", "Forum aanmaken");
	define("_AM_IFORUM_EDIT", "Bewerken");
	define("_AM_IFORUM_CLEAR", "Opruimen");
	define("_AM_IFORUM_DELETE", "Verwijderen");
	define("_AM_IFORUM_ADD", "Toevoegen");
	define("_AM_IFORUM_MOVE", "Verplaatsen");
	define("_AM_IFORUM_ORDER", "Volgorde");
	define("_AM_IFORUM_TWDAFAP", "Opmerking: Dit zal het forum en alle berichten erin verwijderen.<br /><br />WAARSCHUWING: Weet u zeker dat u dit forum wilt verwijderen?");
	define("_AM_IFORUM_FORUMREMOVED", "Forum verwijderd.");
	define("_AM_IFORUM_CREATENEWFORUM", "Maak een nieuw forum aan");
	define("_AM_IFORUM_EDITTHISFORUM", "Forum bewerken:");
	define("_AM_IFORUM_SET_FORUMORDER", "Stel forumpositie in:");
	define("_AM_IFORUM_ALLOWPOLLS", "Enquêtes toestaan:");
	define("_AM_IFORUM_ATTACHMENT_SIZE" , "Maximale grootte in KB:");
	define("_AM_IFORUM_ALLOWED_EXTENSIONS", "Toegestane extensies:<span style='font-size: xx-small; font-weight: normal; display: block;'>'*' geeft geen beperkingen aan.<br /> Extensies afgebakend door '×'</span>");
	define("_AM_IFORUM_ALLOW_ATTACHMENTS", "Bijlagen toestaan:");
	define("_AM_IFORUM_ALLOWHTML", "HTML Toestaan:");
	define("_AM_IFORUM_YES", "ja");
	define("_AM_IFORUM_NO", "Neen");
	define("_AM_IFORUM_ALLOWSIGNATURES", "Handtekeningen toestaan:");
	define("_AM_IFORUM_HOTTOPICTHRESHOLD", "Populaire onderwerp grens:");
	define("_AM_IFORUM_POSTPERPAGE","Berichten per pagina:<span style='font-size: xx-small; font-weight: normal; display: block;'>(Dit is het aantal berichten<br /> per topic dat<br /> per pagina wordt getoond.)</span>");
	define("_AM_IFORUM_TOPICPERFORUM","Onderwerpen per forum:<span style='font-size: xx-small; font-weight: normal; display: block;'>(Dit is het aantal topics<br /> per forum dat<br /> per pagina wordt getoond.)</span>");
	define("_AM_IFORUM_SHOWNAME","Vervang de naam van gebruiker door echte naam:");
	define("_AM_IFORUM_SHOWICONSPANEL","Toon pictogrammen paneel:");
	define("_AM_IFORUM_SHOWSMILIESPANEL","Toon Smilies Paneel:");
	define("_AM_IFORUM_MODERATOR_REMOVE", "Huidige moderatoren verwijderen");
	define("_AM_IFORUM_MODERATOR_ADD", "Moderatoren toevoegen");
	define("_AM_IFORUM_ALLOW_SUBJECT_PREFIX", "Voorvoegsel voor de onderwerpen toestaan");
	define("_AM_IFORUM_ALLOW_SUBJECT_PREFIX_DESC", "Dit staat een voorvoegsel toe, dat zal worden toegevoegd aan de titel van het onderwerp");


	// admin_cat_manager.php

	define("_AM_IFORUM_SETCATEGORYORDER", "Categorie Positie instellen:");
	define("_AM_IFORUM_ACTIVE", "Actief");
	define("_AM_IFORUM_INACTIVE", "Inactief");
	define("_AM_IFORUM_STATE", "Status:");
	define("_AM_IFORUM_CATEGORYDESC", "Categorie omschrijving:");
	define("_AM_IFORUM_SHOWDESC", "Beschrijving weergeven?");
	define("_AM_IFORUM_IMAGE", "Afbeelding:");
	define("_AM_IFORUM_SPONSORIMAGE","Sponsor afbeelding:");
	define("_AM_IFORUM_SPONSORLINK", "Sponsor Link:");
	define("_AM_IFORUM_DELCAT", "Categorie verwijderen");
	define("_AM_IFORUM_WAYSYWTDTTAL", "Opmerking: Dit zal de forums in de categorie NIET verwijderen, dat moet u doen via het Forum bewerken.<br /><br />WAARSCHUWING: Weet u zeker dat u deze categorie wilt verwijderen?");



	//%%%%%%        File Name  admin_forums.php           %%%%%
	define("_AM_IFORUM_FORUMNAME", "Forum naam:");
	define("_AM_IFORUM_FORUMDESCRIPTION", "Forum omschrijving:");
	define("_AM_IFORUM_MODERATOR", "Moderator(s):");
	define("_AM_IFORUM_REMOVE", "Verwijderen");
	define("_AM_IFORUM_CATEGORY", "Categorie:");
	define("_AM_IFORUM_DATABASEERROR", "Database Fout");
	define("_AM_IFORUM_CATEGORYUPDATED", "Categorie bijgewerkt.");
	define("_AM_IFORUM_EDITCATEGORY", "Categorie bewerken:");
	define("_AM_IFORUM_CATEGORYTITLE", "Categorie Titel:");
	define("_AM_IFORUM_CATEGORYCREATED", "Categorie aangemaakt.");
	define("_AM_IFORUM_CREATENEWCATEGORY", "Maak een nieuwe categorie aan");
	define("_AM_IFORUM_FORUMCREATED", "Forum aangemaakt.");
	define("_AM_IFORUM_ACCESSLEVEL", "Algemeen toegangsniveau:");
	define("_AM_IFORUM_CATEGORY1", "Categorie");
	define("_AM_IFORUM_FORUMUPDATE", "Foruminstellingen bijgewerkt");
	define("_AM_IFORUM_FORUM_ERROR", "FOUT: Foruminstelling fout");
	define("_AM_IFORUM_CLICKBELOWSYNC", "Door op de knop hieronder te drukken synchroniseer je forums en onderwerpen pagina's met de juiste gegevens uit de database. Gebruik deze sectie wanneer u fouten in de onderwerpen en forums ziet.");
	define("_AM_IFORUM_SYNCHING", "Forumindex en onderwerpen synchroniseren (dit kan even duren)");
	define("_AM_IFORUM_CATEGORYDELETED", "Categorie verwijderd.");
	define("_AM_IFORUM_MOVE2CAT", "Verplaats naar categorie:");
	define("_AM_IFORUM_MAKE_SUBFORUM_OF", "Maak een sub-forum van:");
	define("_AM_IFORUM_MSG_FORUM_MOVED", "Forum verplaatst!");
	define("_AM_IFORUM_MSG_ERR_FORUM_MOVED", "Forum verplaatsen mislukt.");
	define("_AM_IFORUM_SELECT", "< Selecteer >");
	define("_AM_IFORUM_MOVETHISFORUM", "Dit forum verplaatsen");
	define("_AM_IFORUM_MERGE", "Samenvoegen");
	define("_AM_IFORUM_MERGETHISFORUM", "Forum samenvoegen");
	define("_AM_IFORUM_MERGETO_FORUM", "Dit forum samenvoegen met:");
	define("_AM_IFORUM_MSG_FORUM_MERGED", "Forum samengevoegd!");
	define("_AM_IFORUM_MSG_ERR_FORUM_MERGED", "Formulier samenvoegen mislukt.");

	//%%%%%%        File Name  admin_forum_reorder.php           %%%%%
	define("_AM_IFORUM_REORDERID", "ID");
	define("_AM_IFORUM_REORDERTITLE", "Aanspreektitel");
	define("_AM_IFORUM_REORDERWEIGHT", "Positie");
	define("_AM_IFORUM_SETFORUMORDER", "Stel bord volgorde in");
	define("_AM_IFORUM_BOARDREORDER", "Het bord is herordend volgens jouw specificatie");

	// admin_permission.php
	define("_AM_IFORUM_PERMISSIONS_TO_THIS_FORUM", "Onderwerp-rechten voor dit Forum");
	define("_AM_IFORUM_CAT_ACCESS", "Categorie toegang");
	define("_AM_IFORUM_CAN_ACCESS", "Heeft toegang");
	define("_AM_IFORUM_CAN_VIEW", "Kan bekijken");
	define("_AM_IFORUM_CAN_POST", "Kan nieuwe onderwerpen starten");
	define("_AM_IFORUM_CAN_REPLY", "Kan reageren");
	define("_AM_IFORUM_CAN_EDIT", "Kan bewerken");
	define("_AM_IFORUM_CAN_DELETE", "Kan verwijderen");
	define("_AM_IFORUM_CAN_ADDPOLL", "Kan peiling toevoegen");
	define("_AM_IFORUM_CAN_VOTE", "Kan stemmen");
	define("_AM_IFORUM_CAN_ATTACH", "Kan bijlage toevoegen");
	define("_AM_IFORUM_CAN_NOAPPROVE", "Kan posten zonder goedkeuring");
	define("_AM_IFORUM_ACTION", "Actie");

	define("_AM_IFORUM_PERM_TEMPLATE", "Stel standaard rechtensjabloon in");
	define("_AM_IFORUM_PERM_TEMPLATE_DESC", "Bewerk het volgende rechtensjabloon zodat het kan worden toegepast op een of meerdere forums");
	define("_AM_IFORUM_PERM_FORUMS", "Selecteer fora");
	define("_AM_IFORUM_PERM_TEMPLATE_CREATED", "Het rechtensjabloon werd aangemaakt");
	define("_AM_IFORUM_PERM_TEMPLATE_ERROR", "Er is een fout opgetreden tijdens het aanmaken van het rechtensjabloon");
	define("_AM_IFORUM_PERM_TEMPLATEAPP", "Standaard rechten toepassen");
	define("_AM_IFORUM_PERM_TEMPLATE_APPLIED", "Standaard rechten zijn toegepast op fora");
	define("_AM_IFORUM_PERM_ACTION", "Rechten beheer tools");
	define("_AM_IFORUM_PERM_SETBYGROUP", "Rechten rechtstreeks per groep instellen");
	define("_AM_IFORUM_PERM_PERMISSIONS", "Rechten");

	// admin_forum_prune.php

	define("_AM_IFORUM_PRUNE_RESULTS_TITLE", "Opkuisen resultaten");
	define("_AM_IFORUM_PRUNE_RESULTS_TOPICS", "Opgekuiste onderwerpen");
	define("_AM_IFORUM_PRUNE_RESULTS_POSTS", "Opgekuiste berichten");
	define("_AM_IFORUM_PRUNE_RESULTS_FORUMS", "Opgekuiste fora");
	define("_AM_IFORUM_PRUNE_STORE", "Sla berichten op in dit forum in plaats van ze te verwijderen");
	define("_AM_IFORUM_PRUNE_ARCHIVE", "Maak een kopie van berichten naar archief");
	define("_AM_IFORUM_PRUNE_FORUMSELERROR", "U bent vergeten fora te selecteren om op te kuisen");

	define("_AM_IFORUM_PRUNE_DAYS", "Verwijder onderwerpen zonder reacties in:");
	define("_AM_IFORUM_PRUNE_FORUMS", "Op te kuisen fora");
	define("_AM_IFORUM_PRUNE_STICKY", "Behoud Sticky onderwerpen");
	define("_AM_IFORUM_PRUNE_DIGEST", "Behoud samengevatte onderwerpen");
	define("_AM_IFORUM_PRUNE_LOCK", "Behoud vergrendelde onderwerpen");
	define("_AM_IFORUM_PRUNE_HOT", "Behoud onderwerpen met meer dan dit aantal reacties");
	define("_AM_IFORUM_PRUNE_SUBMIT", "Ok");
	define("_AM_IFORUM_PRUNE_RESET", "Opnieuw instellen");
	define("_AM_IFORUM_PRUNE_YES", "Ja");
	define("_AM_IFORUM_PRUNE_NO", "Neen");
	define("_AM_IFORUM_PRUNE_WEEK", "Een week");
	define("_AM_IFORUM_PRUNE_2WEEKS", "Twee weken");
	define("_AM_IFORUM_PRUNE_MONTH", "Een maand");
	define("_AM_IFORUM_PRUNE_2MONTH", "Twee maanden");
	define("_AM_IFORUM_PRUNE_4MONTH", "Vier maanden");
	define("_AM_IFORUM_PRUNE_YEAR", "Een jaar");
	define("_AM_IFORUM_PRUNE_2YEARS", "2 jaar");

	// About.php constants
	define($constpref.'_AUTHOR_INFO', "Auteur informatie");
	define($constpref.'_AUTHOR_NAME', "Auteur");
	define($constpref.'_AUTHOR_WEBSITE', "Website auteur");
	define($constpref.'_AUTHOR_EMAIL', "E-mailadres auteur");
	define($constpref.'_AUTHOR_CREDITS', "Credits");
	define($constpref.'_MODULE_INFO', "Module Ontwikkeling Informatie");
	define($constpref.'_MODULE_STATUS', "Status");
	define($constpref.'_MODULE_DEMO', "Demo website");
	define($constpref.'_MODULE_SUPPORT', "Officiële site voor ondersteuning");
	define($constpref.'_MODULE_BUG', "Meld een bug voor deze module");
	define($constpref.'_MODULE_FEATURE', "Een nieuwe functionaliteit voorstellen voor deze module");
	define($constpref.'_MODULE_DISCLAIMER', "Disclaimer");
	define($constpref.'_AUTHOR_WORD', "Het woord van de auteur");
	define($constpref.'_BY', 'Door');
	define($constpref.'_AUTHOR_WORD_EXTRA', "		");

	// admin_report.php
	define("_AM_IFORUM_REPORTADMIN", "Gerapporteerde berichten beheerder");
	define("_AM_IFORUM_PROCESSEDREPORT", "Bekijk verwerkte rapporten");
	define("_AM_IFORUM_PROCESSREPORT", "Verwerkingsrapport");
	define("_AM_IFORUM_REPORTTITLE", "Rapport titel");
	define("_AM_IFORUM_REPORTEXTRA", "Extra");
	define("_AM_IFORUM_REPORTPOST", "Gerapporteerd bericht");
	define("_AM_IFORUM_REPORTTEXT", "Rapporteer tekst");
	define("_AM_IFORUM_REPORTMEMO", "Verwerk memo");

	// admin_report.php
	define("_AM_IFORUM_DIGESTADMIN", "Samenvatting beheerder");
	define("_AM_IFORUM_DIGESTCONTENT", "Inhoud samenvatten");

	// admin_votedata.php
	define("_AM_IFORUM_VOTE_RATINGINFOMATION", "Stemmen informatie");
	define("_AM_IFORUM_VOTE_TOTALVOTES", "Totaal aantal stemmen: ");
	define("_AM_IFORUM_VOTE_REGUSERVOTES", "Stemmen van geregistreerde gebruikers: %s");
	define("_AM_IFORUM_VOTE_ANONUSERVOTES", "Stemmen anonieme gebruikers: %s");
	define("_AM_IFORUM_VOTE_USER", "Gebruiker");
	define("_AM_IFORUM_VOTE_IP", "IP adres");
	define("_AM_IFORUM_VOTE_USERAVG", "Gemiddelde gebruikersbeoordeling");
	define("_AM_IFORUM_VOTE_TOTALRATE", "Totaal aantal beoordelingen");
	define("_AM_IFORUM_VOTE_DATE", "Ingezonden");
	define("_AM_IFORUM_VOTE_RATING", "Beoordeling");
	define("_AM_IFORUM_VOTE_NOREGVOTES", "Geen geregistreerde gebruikersstemmen");
	define("_AM_IFORUM_VOTE_NOUNREGVOTES", "Geen stemmen van ongeregistreerde gebruikers");
	define("_AM_IFORUM_VOTEDELETED", "Stemgegevens verwijderd.");
	define("_AM_IFORUM_VOTE_ID", "ID");
	define("_AM_IFORUM_VOTE_FILETITLE", "Discussie titel");
	define("_AM_IFORUM_VOTE_DISPLAYVOTES", "Voting Data Information");
	define("_AM_IFORUM_VOTE_NOVOTES", "No User Votes to display");
	define("_AM_IFORUM_VOTE_DELETE", "No User Votes to display");
	define("_AM_IFORUM_VOTE_DELETEDSC", "<strong>Deletes</strong> the chosen vote information from the database.");
