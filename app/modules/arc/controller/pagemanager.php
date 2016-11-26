<?php

system\Helper::arcAddFooter("js", system\Helper::arcGetModulePath() . "js/pagemanager.js");

//summernote
system\Helper::arcAddFooter("js", system\Helper::arcGetPath() . "vendor/codemirror/codemirror.js");
system\Helper::arcAddFooter("js", system\Helper::arcGetPath() . "vendor/codemirror/xml.js");
system\Helper::arcAddFooter("js", system\Helper::arcGetPath() . "vendor/summernote/summernote.min.js");


system\Helper::arcAddHeader("css", system\Helper::arcGetPath() . "vendor/codemirror/codemirror.css");
system\Helper::arcAddHeader("css", system\Helper::arcGetPath() . "vendor/codemirror/monokai.css");
system\Helper::arcAddHeader("css", system\Helper::arcGetPath() . "vendor/summernote/summernote.css");
