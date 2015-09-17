<?php

if (system\Helper::arcGetURLData("action") == null) {
    system\helper::arcOverrideView("wall", true, []);
} elseif (system\Helper::arcGetURLData("action") == "delete") {
    $post = new Post();
    $post->delete(system\Helper::arcGetURLData("data1"));
    system\helper::arcOverrideView("wall", true, []);
}