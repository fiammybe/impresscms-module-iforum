//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
//  Author: phppp (D.J., infomax@gmail.com)                                  //
//  URL: http://xoopsforge.com, http://xoops.org.cn                          //
//  Project: Article Project                                                 //
//  ------------------------------------------------------------------------ //

iForum is now being developed by Sina Asghari (stranger), this module has earlier been developed by
Marko Schmuck (predator) and D.J. (phppp) under the name of newbb (CBB).
==========================================================

CBB

XOOPS Community Bulletin Board

Changelog 3.08
Jan 3rd, 2007 
=============
1 Bugfix for user stats (jorff, agl)
2 Bugfix for reading new posts


Changelog 3.07
October 29th, 2006 
=============
1 Bugfix for permission template (js related)
2 Added support for FCKeditor upload
3 Added support for extended xcode which allows flash/wmplayer/...
4 Fix for XSS reported by bubuche93


Changelog 3.06
October 8th, 2006 
=============
Bugfix version


Changelog 3.05
July 22nd, 2006 
=============
1 Bugfix for notifying new replies for a specific topic
2 Bugfix for permission check when moving a post
3 Removed inherition of view mode and post order from system-wide preference
4 Added editor parameter control based on plugin'ed configs
5 Bugfix for xhtml compliance in forum selection box (reported by skalpa)
6 Bugfix for update scripts for newbb 2.2
7 Bugfix for category name display in permission admin
8 Bugfix for view_level check in viewforum template (reported by topmuzik.com)

Changelog 3.04 Final
June 3rd, 2006 
=============
1 MySQL syntax for data synchronization for different versions
2 xhtml fixes
3 bugfix for group permission check form (reported by Aries)

Changelog 3.04 RC4
May 27th, 2006 
=============
1 Bugfix for topic title transfered from post subject
2 Added topic check before storing post (reported by marco)
3 Removed unnecessary forum option 'allow_attachments' 
4 Other minor fixes

Changelog 3.04 RC3
May 20th, 2006 
=============
1 Fixed bugs in print.php (reported by ideiafacil)
2 Code correction for performance and cleaning up
3 Partial improvement on permission precision
4 Improvement on category/forum structured display for permission admin and block edit pages
5 Improvement on compliant xhtml

Changelog 3.04 RC2
May 9th, 2006 
=============
1 Fixed bugs reported on xoops.org
2 Created object handler for post_text
3 Changed fields in TABLE bb_forums
4 Changed testing post message in language file

Changelog 3.04 RC
May 8th, 2006 
=============
1 category, forum, topic, post, report, rate refactoring
2 Added reading records options: cookie, database (inspired by Ajout Gizmhail)
3 Added data synchronization
4 Added missing "previous/next topic"
5 Modified database structure for query optimization
6 Fixed bug in templates for file inclusion: for both update from file and from db modes 

Changelog 3.03
Apr 26th, 2006 
=============
1 Fixed rss+xml rel link (by CeBepuH)
2 Fixed typo in "pm" path for "transfer" (by CeBepuH)
3 Fixed clear property in newbb.css (by CeBepuH)
4 Fixed undefined method "setMessage" for module which could lead to newbb 2.* upgrade failure 
5 Split functions.php


Changelog 3.02
Apr 23rd, 2006 
=============
1 Fixed URL iteration for menumode (reported by genetailor)
2 Skip cache for edit pages
3 Charset completeness for PDF maker (reported by domecc)
4 Performance improvement, including PHP scripting and MySQL db structure
5 Added action request detection in xoops_version.php so that some useful features are reactived including "welcome forum"
6 Bugfix for "sort by rating" URL (reported by Mowaffak)
7 Added time limit to "recent replied topic" block
8 Bugfix for signature setting (removed unnecessary user setting check)

Changelog 3.01
Feb 22th, 2006 
=============
Fixed bugs in permission management
Fixed bugs in formloader

Changelog 3.0 RC2
Feb 10th, 2006 
=============
Fixed bugs in user select
Fixed bugs in permission management

Changelog 3.0 RC1
Jan 29th, 2006 
=============
Compatible with XOOPS 2.0, 2.2, 2.3


Changelog 2.32
=============
1 DB query optimization


Changelog 2.31
=============
1 bugfixes
2 speed improvement


Changelog 2.3
=============
1 moderator accessible distributed batch threads/posts management (approval, edit, move, delete, merge, split)
2 moderator accessible distributed user/IP suspension management
3 trashcan implemented
4 user-based post search and management
5 plugable module bridging handler implemented


Changelog 2.2
=============
1 block/profile/css/adminmenu/encoding related content upgraded to XOOPS 2.2
2 XOOPS editor framework implemented
3 permission management separated from forum/category and default permission set and management added
4 category/forum creation on module installation
5 send PM with quoted post content
6 embedded upgrade: any version of newbb/cbb could be updated to up-to-date CBB by updating module
7 forum queries in xoops_version.php moved to save db query
8 change relative path to full path for some images
9 change forum list in jumpbox and topicmanager to a more clear style
10 moderator management merged into forum admin form with xoopsuserselect form


Changelog 1.15
==============
1 fix for aged security problem (XSS)


Changelog 1.14
==============
1 bugfix for inactive user posting (Reported by Aries @ xoops.org.cn)
2 bugfix for deleting topic with poll (Reported by gropius @ xoops.org.cn)
3 change default value for displaying forum topic time duration (Reported by Zjerre @ xoops.org)
4 change formselectuser.php for XOOPS 2.2


Changelog 1.13
==============
1 bugfix for IP recording (Reported by alitan @ xoops.org)
2 changing time display for "Today/yesterday ..." (Reported by alitan @ xoops.org)
3 adding post link (Preliminary solution by ackbarr && Suggested by Peekay @ xoops.org)
4 further cleaning "Compact mode" (Suggested by Rou4 @ XOOPS CHINA)
5 adding new block "recent post text"
6 bugfix for function newbb_admin_mkdir
7 bugfix for permission table of locked topic
8 adding indication for locked topic in view topic (Requested by SuperVoley @ xoops.org)
9 bugfix for category management (Reported by chia @ xoops.tnc.edu.tw)
10 bugfix for subject sanitizing problem (Reported by CeBepuH @ xoops.org)
11 rolling back signature to pure xcode format (comprehensive improvement is expected after XOOPS 2.2)
12 bugfix for empty message check in quick reply
13 template validation on XHTML 1.0 (not complete yet)
14 compatible with news 1.30+ for posttonews (reported by cosmodrum @ xoops.org)


Changelog 1.12
==============
1 login on-fly in "quick reply" (requested by Rou4 @ XOOPS CHINA)
2 sort order in viewpost.php (reported by kmac @ XOOPS CHINA)
3 bugfix for time display (reported by kmac @ XOOPS CHINA)
4 clean display of regist date (requested by kmac @ XOOPS CHINA)
5 bugfix for forum selection in "advanced search" (reported by kmac @ XOOPS CHINA)
6 rolling back missed disclaimer (reported by kmac @ XOOPS CHINA)
7 bugfix for duplicated security check and post_time_limit check (reported by kmac @ XOOPS CHINA)
8 permission check for poll management (reported by karuna @ XOOPS CHINA)


Changelog 1.11
==============
1 re-write user info renderer
2 bugfix for poster display in thread mode (reported by iamtj @ XOOPS CHINA)
3 correction of deleting post message (reported by iamtj @ XOOPS CHINA)
4 post backup if submission exceeds session limit or time limit
5 correction of encoding problem in XOOPS function formatTimestamp($time, 'rss') (reported by chia @ XOOPS CHINA)


Changelog 1.10
==============
1 bugfix and layout improvement (suggested by iamtj @ XOOPS CHINA, fast reply in thread mode, anonymous button, register to post ...)
2 rolling back "RSS enable" (requested by Aries @ XOOPS CHINA, CeBepuH @ XOOPS)
3 bugfix for template dir in rss.php (reported by jodn007 @ XOOPS CHINA)
4 bugfix for caching in rss.php
5 bugfix for rss encoding conversion (reported by chia @ XOOPS CHINA)
6 read new posts since last visit (Tuning suggested by Peekay @ XOOPS)
7 enable 'delete top post' (requested by iamtj @ XOOPS CHINA)
8 bugfix for Last Visit recording
9 bugfix/improvement for "move forum"
10 adding "merge forum"
11 post date / poster ip display changed
12 options for user level bar
13 backward/forward compatible with XOOPS 2.0*


Changelog 1.00
==============

Changelog over NewBB 2.02:
1 CBB uses the same DB stucture/data with NewBB 2, it is convenient to switch between current CBB and current NewBB 2.
2 bugfixes for NewBB 2.02
3 clean/correct NewBB 2 templates

Major new features ( most suggested by XOOPS CHINA users)
1 dropdown menu selectable for end users: SELECT BOX, CLICK, HOVER
2 multi-attachments upload
3 RSS improvement, individual RSS Feeds for each category, each forum and the global module
4 FPDF improvement, UTF-8 encoding is now working
5 user friendly time display, four types: Today, Yesterday, this year and longer than one year
6 block handler: recent posts, recent topics, most views, most replies, recent digest, recent sticky, most valuable posters
7 time periods for blocks, you could have most views in last 24 hours, most views in this week, most views in this month
8 new page: view all posts, view new posts since last visit
9 "New member": an introduction thead will be posted automatically when a user logs on for the first time (if enabled)
10 adding dobr parameter
