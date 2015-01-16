<?php

if (system\Helper::arcGetURLData("action") == null) {
    system\Helper::arcAddHeader("title", "Store");
    system\Helper::arcOverrideView("store");
}