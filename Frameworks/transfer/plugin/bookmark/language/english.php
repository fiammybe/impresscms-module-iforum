<?php
/**
 * Transfer handler for XOOPS
 *
 * This is intended to handle content intercommunication between modules as well as components
 * There might need to be a more explicit name for the handle since it is always confusing
 *
 * @copyright	The XOOPS project http://www.xoops.org/
 * @license		http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author		Taiwen Jiang (phppp or D.J.) <php_pp@hotmail.com>
 * @since		3.00
 * @version		$Id$
 * @package		Frameworks::transfer
 */
 
define("_MD_TRANSFER_BOOKMARK", "Bookmark");
define("_MD_TRANSFER_BOOKMARK_DESC", "Add the link to bookmarks");

/* English */
define("_MD_TRANSFER_BOOKMARK_ITEMS","
	[<a title=\"Delicious\" href=\"javascript:void(delicious=window.open('http://del.icio.us/post?url='+encodeURIComponent('%2\$s')+'&title='+encodeURIComponent('%1\$s'), 'delicious'));delicious.focus();\">Del.icio.us</a>]
	[<a title=\"Furl\" href=\"javascript:void(furl=window.open('http://www.furl.net/storeIt.jsp?t='+encodeURIComponent('%1\$s')+'&u='+encodeURIComponent('%2\$s'), 'furl'));furl.focus();\">Furl It</a>]
");
?>