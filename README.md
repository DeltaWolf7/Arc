Arc
===

Arc Web Application Framework
Written by Craig Longford (DeltaWolf7)
Email: deltawolf7@gmail.com
WWW: www.deltasblog.co.uk


Bootstrap                   3.2.0                 http://getbootstrap.com/
Boostrap Date Picker        12/3/2013             http://www.eyecon.ro/bootstrap-datepicker/
JQuery                      2.1.1                 http://jquery.com/download/
Font Awesome                4.2.0                 http://fortawesome.github.io/Font-Awesome/


0.0.0.7
-------
+ Added permission system.
+ Added user groups.
/ Changed all icons to Font Awesome.
/ Changed all modules to use new classes.
/ Changed how all classes function.
/ Changed how classes are loaded.
- Removed 404 and 403 modules for replacement.
+ Added new error module.
+ Added module information support.
* Fixed input styles in messages module.
* Fixed input styles in theme module.
/ Changed style of message in messages module.
+ Added support for dynamic menus and dropdowns.
* Fixed the minutes in times throughout the classes.
/ Changed logout to unset session.
+ Added session timeout support and config option.
+ Added support to error module to handle session timeouts.

0.0.0.6
-------
* Cleaned up the functions code.
* Fixed user class not saving (missing property).
+ Added support for object collections.
* Improved the handling of data for single objects.
* Improved the way objects are filled.

0.0.0.5
-------
+ Added support for database table prefixes for Arc classes.

0.0.0.4
-------
+ Added support for disabling accounts.
+ Added support for user to user messages.
+ Added Font Awesome.
/ Changed index page to use Font Awesome.

0.0.0.3
-------
+ Added support for bootstrap CSS themes.
+ Added support for user settings.
/ Changed the way users are stored in session.
- Removed the requires login to across the whole site.
+ Added support for protecting pages and modules individually.
+ Added support for any default page or module.
+ Added support for database debug information.
* Fixed a bug where objects where not updated in the database.
* Fixed a bug where the root path was incorrect.

0.0.0.2
-------
+ Added support for using sub-directory as root.

0.0.0.1
-------
Initial release
