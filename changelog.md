# IFORUM

ImpressCMS bulletin Board, for ImpressCMS >= 1.2


## 2.0
released on 29 November 2017
### New 
* Lightbox for images within the postings added (sato-san)
* Japanese translation files (sato-san)

### Improvement
* Made the usebar lighter. Uniform icons (sato-san)
* Userbar in Text version with better design (sato-san)
* Some parts of templates redesigned (sato-san)
* Mousepointer for the category icons for a better usability (sato-san)
* updated version number format to string and corrected several URLs in icms_version (fiammybe)
* Replace all all TYPE=MyISAM to ENGINE=MyISAM (sato-san)

### Bugfix  
* Link for ICQ fixed (sato-san)
* Position from "document icons" and "post icon" optimized for a better view (sato-san)
* Editor selection dissabled, because the admin has to setup this function (sato-san)
* If a forum has subforum, the numbers for topics and posts are not longer dispalyed, since the summery of numbers are not available (sato-san)
* The navigation on top in the search template is available now (sato-san)
* Error in PM fixed (sato-san)

## 1.0
18 Sept 2011

### New
* _MD_UP on language/english/main.php (sato-san)
* _MD_POSTTIME on language/english/main.php (sato-san)
* German files with UTF-8  (sato-san)
* the module create the upload-folders automatically (sato-san)
* Spanish files with UTF-8  (juancj)
* Portuguesebr files with UTF-8  (Gibaphp)
* French files with UTF-8  (FaYsSaL)
* Russian files with UTF-8  (algalochkin)
* smarty modulename (in blocks)
* div class="comUserImg for avatars (Knallkopp_02)
* Finished Implementing easy-renaming
* New template set (MrTheme)
* Added icons instead of transfer text
* Added Captcha Control option
* Added Captcha Control for posts
* Added Control for wysiwyg editors
* Added Tagging options (partly, it is not finished yet)
* implemented icms updating methods
* Added Built in RTL support
* Implemented (partly, it is not finished yet) easy-renaming
* Added xoops-magazine image set as default
* New icons (thanks McDonald And http://dryicons.com/)

### Improved
* &newbb_displayTarea (to use icms purifier)
* Removed need to have frameworks
* Changed PDF generator to TCPDF for UTF-8 languages
* changed from mod_isModuleAction to icms_moduleAction (sato-san)
* changed from formcaptcha.php to captcha.php (sato-san)

### Bugfix
* Bugfix for allowed editors in ICMS 1.1
* Bugfix for fast-reply in IE (McDonald)
* Bugfix: for newbb_rtl.css
* Bugfix: date&time.
* Bugfix: PDF issues
* issues with RTL
* if no editor is allowed, the form no longer disappears
* Bugfix: with FCKEDITOR paths
* xoopseditor path changed to editors
* need for xoops_local
* Bugfix for user signatures in ICMS 1.1
