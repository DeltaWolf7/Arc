<?php

if (isset($_POST["action"])) {
    if ($_POST["action"] == "savequestion") {

        $question = new Question();
        if (!empty($_POST["questionid"])) {
            $question->getByID($_POST["questionid"]);
        }
        $question->groupid = $_POST["group"];
        $question->question = htmlentities($_POST["question"]);

        $xml = new SimpleXMLElement("<answers></answers>");
        $count = 1;
        while ($count <= 5) {
            if (isset($_POST["answer" . $count])) {
                $xmlItem = $xml->addChild("answer");
                $xmlItem->addAttribute("text", $_POST["answer" . $count]);         
                if ($_POST["answer"] == $count) {
                    $xml .= " correct=\"true\"";
                    $xmlItem->addAttribute("correct", "true"); 
                }  
            }
            $count++;
        }
        $question->answer = $xml->asXML();
        $question->update();

        echo "success|Question saved";
    } else if ($_POST["action"] == "savegroup") {
        $group = new Group();
        $group->name = $_POST["name"];
        $group->update();
        echo "success|Group saved";
    } else if ($_POST["action"] == "editgroup") {
        $group = new Group();
        $group->getByID($_POST["id"]);
        $group->name = $_POST["name"];
        $group->update();
        echo "success|Group saved";
    }
}