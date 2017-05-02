<?php

system\Helper::arcCheckSettingExists("ARC_BLOG_NOLATEST", "20");
system\Helper::arcCheckSettingExists("ARC_BLOG_CHAR_LIMIT", "150");

system\Helper::arcAddFooter("js", system\Helper::arcGetModulePath() . "js/manager.js");


//summernote
system\Helper::arcAddFooter("js", system\Helper::arcGetPath() . "vendor/codemirror/codemirror.js");
system\Helper::arcAddFooter("js", system\Helper::arcGetPath() . "vendor/codemirror/xml.js");
system\Helper::arcAddFooter("js", system\Helper::arcGetPath() . "vendor/summernote/summernote.min.js");


system\Helper::arcAddHeader("css", system\Helper::arcGetPath() . "vendor/codemirror/codemirror.css");
system\Helper::arcAddHeader("css", system\Helper::arcGetPath() . "vendor/codemirror/monokai.css");
system\Helper::arcAddHeader("css", system\Helper::arcGetPath() . "vendor/summernote/summernote.css");
