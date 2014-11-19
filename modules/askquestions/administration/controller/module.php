<?php

/*
 * The MIT License
 *
 * Copyright 2014 Craig Longford.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * AJAX data dispatch handler
 *
 * @author Craig Longford
 */
if (isset($_POST["action"])) {
    
    require "../../../../system/bootstrap.php";

    if ($_POST["action"] == "savequestion") {

        $question = new Question();
        if (!empty($_POST["questionid"])) {
            $question->getByID($_POST["questionid"]);
        }
        $question->groupid = $_POST["group"];
        $question->question = $_POST["question"];

        $xml = "<answers>";
        $count = 1;
        while ($count <= 5) {
            if (isset($_POST["answer" . $count])) {
                $xml .= "<answer text=\"" . $_POST["answer" . $count] . "\"";
                if ($_POST["answer"] == $count) {
                    $xml .= " correct=\"true\"";
                }
                $xml .= "></answer>";
            }
            $count++;
        }
        $xml .= "</answers>";
        $question->answer = $xml;
        $question->update();

        echo "success|Question saved";
    } else if ($_POST["action"] == "savegroup") {
        $group = new Group();
        $group->name = $_POST["name"];
        $group->update();
        echo "success|Group saved";
    }
}