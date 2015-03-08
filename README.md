Arc
=====

Arc Web Application Framework
 - Written by Craig Longford (DeltaWolf7)
 - Email: deltawolf7@gmail.com
 - WWW: www.deltasblog.co.uk


Default Login
=============

- Email: admin@server.local
- Password: password


What is Arc
===========

Arc is a framework designed to facilitate the rapid development of web applications. 
This is achieved through the use of self loading modules.

Based on the BootStrap design framework, JQuery, Medoo, Font Awesome and SummerNote.

Arc Features
- User management system
- Group based permission system
- Dynamic page creation
- SEO Friendly URL construction throughout
- Simplified AJAX commands for rapid development
- Support for CSS based themes
- Intelligent 404, 403 and 419 handling
- Module system and rapid development structure
- Easy to learn, hard to forget
- Ultra fast design


Module Design
=============

Modules must contain several important files to allow the module to function.

- info.json (JSON file containing 'name', 'description', 'version', 'author', 'email', 'www')
- module.php (PHP boot file, normally defined menu items or initialisation logic)
- view (Folder, contains the visual files for the module, can have matching controller)
- controller (Folder, contains the module logic files, can have matching view)
- controller >  controller.php (PHP file, master logic file always called with module)
- administration (Folder, optional if the module has administrator tool, folder construction
    is the same as a module without the info.json only called by administrators)
- css (Folder, optional if module has custom CSS)
- js (Folder, optional if module has custom JavaScript)
- classes (Folder, optional but required if the module has custom class that require autoloading)

*Other folders and files can be kept with module for better organisation.


Arc System Methods
==================

Internal Methods (Not normally called outside of Arc)
-----------------------------------------------------
- arcGetDatabase() returns the database connector object
- arcGetView() builds the view based on data and selected options 
- arcGetURLData(name) returns a value from the url by name
- arcProcessMenuItems(menus) processes the menu items
- arcGetModuleDetails(file, module) return details about a module
- arcIsAjaxRequest() checks if request is AJAX

General Methods
---------------
- arcAddHeader(type, content) used to add html elements to page headers
    (accepted types: title, description, keywords, author, alternate, canonical, css, js, favicon, and raw)
- arcAddFooter(type, content) used to add html elements to the page footer
    (accepted types: css, js, raw)
- arcGetPath(filesystem) return the url of Arc or path of Arc if filesystem is true
- arcGetHeader() returns an array containing all the current header information
- arcGetFooter() returns an array containing all the current footer information
- arcGetTemplatePath(filesystem) returns the url of the template or the path if filesystem is true
- arcForceView(module, action, administration, data) force a view to be used, overrides all other views
    (module: name of module, action: view of module, administration: is admin, data: data to pass as array)
- arcClearStatus() clears all status messages from system
- arcGetStatus() returns all status messages
- arcGetUser() returns the logged in user or null if none
- arcSetUser(user) sets the user currently logged in
- arcIsUserInGroup(group) return true if user is in group or false if not
- arcIsUserAdmin() returns true if user is admin and false if not
- arcRedirect(destination) force a redirect to destination
- arcGetDispatch() returns the logic file used by a module view, handy for AJAX
- arcAddMenuItem(name, icon, divider, url, group) adds an item to the menu
- arcGetMenu(menuItems) return the menu item html, can be given custom menus (option)
- arcGetModulePath(filesystem) return the url of the module or path of module if true
- arcGetModules() returns array of usable modules
- arcSendMail(to, subject, message, attachments) sends an email, with optional attachments
- arcUKDateToSql(date) return a date in the UK format suitable for SQL queries
- arcPagination(objects, page, amount) returns a collection of objects ready for pagination
- arcGetPaginationView(objects, page, amount, simple, baseurl) returns pagination links to navigate pages
- arcGetThumbImage(image, width) return the url of the thumb of an image and create the thumb if not found
- arcOverrideView(action, administration, data) overrides a view
- arcAddMessage(status, data) adds a status message to the collection
