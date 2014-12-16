<?php

session_destroy();
echo "<script>window.location='" . system\Helper::arcGetPath() . "'</script>";