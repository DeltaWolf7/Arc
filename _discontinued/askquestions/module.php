<?php

system\Helper::arcAddMenuItem("Questions", "fa-question", false, system\Helper::arcGetPath() . "askquestions/questions", "Applications");

$group = UserGroup::getByName("Students");
if ($group->id == 0) {
    $group->name = "Students";
    $group->description = "Students Group";
    $group->update();
}