<?php

$module_info["name"] = "Erudio Educational Platform";
$module_info["description"] = "Educational platform for Arc";
$module_info["version"] = "0.0.0.1";
$module_info["author"] = "Craig Longford";
$module_info["email"] = "deltawolf7@gmail.com";
$module_info["www"] = "http://www.deltasblog.co.uk";

arcAddMenuGroup("Erudio", "fa-book", false, "Applications");
arcAddMenuGroup("Lessons", "fa-book", false, "Erudio");

arcAddMenuItem("Multistage", "fa-book", false, "/multistage", "Lessons");
arcAddMenuItem("Quickfire", "fa-book", false, "/quickfire", "Lessons");

arcAddMenuItem("Antonyms", "fa-book", true, "/antonyms", "Lessons");
arcAddMenuItem("Synonyms", "fa-book", false, "/synonyms", "Lessons");
arcAddMenuItem("Shuffled Sentences", "fa-book", false, "/shuffled-sentences", "Lessons");
arcAddMenuItem("Comprehension", "fa-book", false, "/comprehension", "Lessons");
arcAddMenuItem("Odd One Out", "fa-book", false, "/odd-one-out", "Lessons");

arcAddMenuItem("Cloze Word Bank", "fa-book", true, "/cloze-word-bank", "Lessons");
arcAddMenuItem("Cloze Multiple Choice", "fa-book", false, "/cloze-multiple-choice", "Lessons");
arcAddMenuItem("Cloze Partial Words", "fa-book", false, "/cloze-partial-words", "Lessons");

arcAddMenuItem("2D Conventional", "fa-book", true, "/2d-conventional", "Lessons");
arcAddMenuItem("3D", "fa-book", false, "/3d", "Lessons");

arcAddMenuItem("Results", "fa-area-chart", true, "/results", "Account");

arcAddMenuGroup("Building Blocks", "fa-book", false, "Erudio");
arcAddMenuItem("Times Tables", "fa-book", false, "/times-tables", "Building Blocks");
arcAddMenuItem("Fractions", "fa-book", false, "/fractions", "Building Blocks");
arcAddMenuItem("Algebra", "fa-book", false, "/algebra", "Building Blocks");

arcAddMenuItem("Leaderboard", "fa-book", false, "/leaderboard", "Building Lessons");
?>

