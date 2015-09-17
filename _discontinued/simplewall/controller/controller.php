<?php

if (system\Helper::arcGetURLData("action") == null) {
    system\helper::arcOverrideView("wall");
}