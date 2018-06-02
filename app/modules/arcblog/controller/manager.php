<?php

system\Helper::arcCheckSettingExists("ARC_BLOG_NOLATEST", "10");
system\Helper::arcCheckSettingExists("ARC_BLOG_CHAR_LIMIT", "400");

system\Helper::arcAddFooter("js", system\Helper::arcGetModulePath() . "js/manager.js");

//http://www.malot.fr/bootstrap-datetimepicker/
system\Helper::arcAddFooter("js", system\Helper::arcGetModulePath() . "js/bootstrap-datetimepicker.min.js");
system\Helper::arcAddHeader("css", system\Helper::arcGetModulePath() . "css/bootstrap-datetimepicker.min.css");


//summernote
system\Helper::arcAddFooter("js", system\Helper::arcGetPath() . "vendor/codemirror/codemirror.js");
system\Helper::arcAddFooter("js", system\Helper::arcGetPath() . "vendor/codemirror/xml.js");
system\Helper::arcAddFooter("js", system\Helper::arcGetPath() . "vendor/summernote/summernote-bs4.min.js");


system\Helper::arcAddHeader("css", system\Helper::arcGetPath() . "vendor/codemirror/codemirror.css");
system\Helper::arcAddHeader("css", system\Helper::arcGetPath() . "vendor/codemirror/monokai.css");
system\Helper::arcAddHeader("css", system\Helper::arcGetPath() . "vendor/summernote/summernote-bs4.css");
