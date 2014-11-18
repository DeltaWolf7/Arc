<?php

if (is_numeric(arcGetURLData("data1"))) {
    http_response_code(arcGetURLData("data1"));
}
