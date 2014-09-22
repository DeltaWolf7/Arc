# Arc
=====
Arc Web Application Framework
Written by Craig Longford (DeltaWolf7)
Email: deltawolf7@gmail.com
WWW: www.deltasblog.co.uk

Installation
============
1. Place all the files on your server.
2. Import the provided sql/arc.sql file into your MySQL database.
3. Modify the config.php.dist file change the database settings.
4. Rename the config.php.dist to config.php.

Default username/password
=========================
Username: user@localhost
Password: password

HTACCESS note
=============
You may need to modify the the final line of the .htaccess file for subdirectories.
This is only required if you have not installed Arc in the root of your site.

Original line: 'RewriteRule ^(.*)$ /index.php?url=$1 [L,QSA]'
Change: 'RewriteRule ^(.*)$ /mydirectory/index.php?url=$1 [L,QSA]'
