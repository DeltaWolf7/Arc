<?php

system\Helper::arcAddMenuItem("Questions", "fa-question", false, system\Helper::arcGetPath() . "askquestions/questions", "Applications");
system\Helper::arcAddMenuItem("Submit Game", "fa-gamepad", false, system\Helper::arcGetPath() . "askquestions/submit", "Applications");
system\Helper::arcAddMenuItem("Skype Booking", "fa-skype", false, system\Helper::arcGetPath() . "askquestions/skype", "Applications");

$group = UserGroup::getByName("Students");
if ($group->id == 0) {
    $group->name = "Students";
    $group->description = "Students Group";
    $group->update();
}