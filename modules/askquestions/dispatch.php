<?php

require_once "../../system/bootstrap.php";

if ($_POST["action"] == "answerquestion") {
    
    $count = 1;
    $xml = "<results>";
    while (isset($_POST["Q" . $count])) {
        $xml .= "<result question=\"Q" . $count . "\" answer=\"" . $_POST["Q" . $count] . "\"></result>";
        $count++;
    }
    $xml .= "</results>";
    
    $result = new Result();
    $result->groupid = $_POST["groupid"];
    $result->userid = $_POST["userid"];
    $time = $_POST["time"];
    $result->timetaken = time() - $time;
    $result->result = $xml;
    $result->update();
    
    echo "success|Results saved";
    
}

?>