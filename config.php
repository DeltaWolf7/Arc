<?php

/*
 * The MIT License
 *
 * Copyright 2014 Craig Longford.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * Application configuration
 *
 * @author Craig Longford
 */
/*
 *  Database Configuration
 */

// Database server
DEFINE('ARCDBSERVER', 'localhost');

// Database name
DEFINE('ARCDBNAME', 'arc');

// Database username
DEFINE('ARCDBUSER', 'arc');

// Database password
DEFINE('ARCDBPASSWORD', 'mypassword');

// Database type (MySQL, MariaDB, MSSQL, Sybase, PostgreSQL, Oracle)
DEFINE('ARCDBTYPE', 'mysql');

// Database prefix
DEFINE('ARCDBPREFIX', 'arc_');

/*
 * Server Configuration
 */

// Web path
DEFINE('ARCWWW', '/');

// FS path
DEFINE('ARCFS', '/');

/*
 * Project Configuration
 */

// Project title
DEFINE('ARCTITLE', 'Project Arc');

// Project description
DEFINE('ARCDESCRIPTION', '');

// Project author
DEFINE('ARCAUTHOR', 'Arc');

// Project fav icon
DEFINE('ARCFAVICON', '');

// Project keywords
DEFINE('ARCKEYWORDS', '');

// Project version
DEFINE('ARCVERSION', '0.0.0.7');

// Project debug mode
DEFINE('ARCDEBUG', true);

// Project default page type (page or module)
DEFINE('ARCDEFAULTTYPE', 'page');

// Project default page
DEFINE('ARCDEFAULTPAGE', 'test');

// Session Timeout (minutes)
DEFINE('ARCSESSIONTIMEOUT', 30);
