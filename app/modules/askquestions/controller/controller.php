<?php
if (system\Helper::arcGetURLData("action") == null) {
    system\Helper::arcOverrideView("questions");
}