<?php

system\Helper::arcAddFooter("js", system\Helper::arcGetModulePath() . "js/pagemanager.js");

//summernote
system\Helper::arcAddFooter("js", system\Helper::arcGetPath() . "js/codemirror/codemirror.js");
system\Helper::arcAddFooter("js", system\Helper::arcGetPath() . "js/codemirror/xml.js");
system\Helper::arcAddFooter("js", system\Helper::arcGetPath() . "js/summernote.min.js");


system\Helper::arcAddHeader("css", system\Helper::arcGetPath() . "css/codemirror/codemirror.css");
system\Helper::arcAddHeader("css", system\Helper::arcGetPath() . "css/codemirror/monokai.css");
system\Helper::arcAddHeader("css", system\Helper::arcGetPath() . "css/summernote.css");
