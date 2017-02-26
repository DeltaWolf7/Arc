<?php

system\Helper::arcAddFooter("js", system\Helper::arcGetModulePath() . "js/pagemanager.js");

//summernote
system\Helper::arcAddFooter("js", system\Helper::arcGetPath() . "vendor/codemirror/lib/codemirror.js");
system\Helper::arcAddFooter("js", system\Helper::arcGetPath() . "vendor/codemirror/mode/xml/xml.js");
system\Helper::arcAddFooter("js", system\Helper::arcGetPath() . "vendor/summernote/summernote.min.js");


system\Helper::arcAddHeader("css", system\Helper::arcGetPath() . "vendor/codemirror/lib/codemirror.css");
system\Helper::arcAddHeader("css", system\Helper::arcGetPath() . "vendor/codemirror/theme/monokai.css");
system\Helper::arcAddHeader("css", system\Helper::arcGetPath() . "vendor/summernote/summernote.css");
