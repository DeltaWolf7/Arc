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
    require "../../../system/bootstrap.php";
    if ($_POST["action"] == "antonyms") {
        $question = $_POST['question'];
        $clicked = $_POST['clicked'];
        $id = $_POST['id'];
        $time = $_POST['time'];
        $taken = time() - $time;
        $resultid = $_POST['result'];


        $data = explode("|", $question);

        $correct = false;
        $correctWord = "?";

        if ($data[$clicked * 2] == "1") {
            $correct = true;
        }

        if ($data[0] == "1") {
            $correctWord = $data[1];
        } elseif ($data[2] == "1") {
            $correctWord = $data[3];
        } elseif ($data[4] == "1") {
            $correctWord = $data[5];
        } elseif ($data[6] == "1") {
            $correctWord = $data[7];
        } elseif ($data[8] == "1") {
            $correctWord = $data[9];
        }

        $result = new result();
        $result->getResult($resultid);
        $result->type = "Antonyms";
        $result->time = $taken;
        $result->correct = $correct;
        $xml = '<result chosen="' . $data[$clicked * 2 + 1] . '">'
                . '<word correct="' . $data[0] . '">' . $data[1] . '</word>'
                . '<word correct="' . $data[2] . '">' . $data[3] . '</word>'
                . '<word correct="' . $data[4] . '">' . $data[5] . '</word>'
                . '<word correct="' . $data[6] . '">' . $data[7] . '</word>'
                . '<word correct="' . $data[8] . '">' . $data[9] . '</word>'
                . '</result>';

        $result->data = $xml;
        $result->updateResult();

        if ($correct) {
            echo "0|Great job! That's correct.<br />Time taken: " . $taken . " seconds.<br /><a href=\"/lessons/verbal-reasoning-antonyms\">Try another question</a>";
        } else {
            echo "1|Sorry, don't give up.<br />The correct answer is <strong>'" . $correctWord . "'</strong>.<br />Time taken: " . $taken . " seconds.<br /><a href=\"/lessons/verbal-reasoning-antonyms\">Try another question</a>";
        }
    } elseif ($_POST["action"] == "multistage") {
        
    } elseif ($_POST["action"] == "oddoneout") {
        $question = $_POST['question'];
        $clicked = $_POST['clicked'];
        $id = $_POST['id'];
        $time = $_POST['time'];
        $resultid = $_POST['result'];
        $taken = time() - $time;


        $data = explode("|", $question);

        $correct = false;
        $correctWord = "?";

        if ($data[$clicked * 2] == "1") {
            $correct = true;
        }

        if ($data[0] == "1") {
            $correctWord = $data[1];
        } elseif ($data[2] == "1") {
            $correctWord = $data[3];
        } elseif ($data[4] == "1") {
            $correctWord = $data[5];
        } elseif ($data[6] == "1") {
            $correctWord = $data[7];
        }

        $result = new result();
        $result->getResult($resultid);
        $result->type = "Odd One Out";
        $result->time = $taken;
        $result->correct = $correct;
        $xml = '<result chosen="' . $data[$clicked * 2 + 1] . '">'
                . '<word correct="' . $data[0] . '">' . $data[1] . '</word>'
                . '<word correct="' . $data[2] . '">' . $data[3] . '</word>'
                . '<word correct="' . $data[4] . '">' . $data[5] . '</word>'
                . '<word correct="' . $data[6] . '">' . $data[7] . '</word>'
                . '</result>';

        $result->data = $xml;
        $result->updateResult();

        if ($correct) {
            echo "0|Great job! That's correct.<br />Time taken: " . $taken . " seconds.<br /><a href=\"/lessons/verbal-reasoning-odd-one-out\">Try another question</a>";
        } else {
            echo "1|Sorry, don't give up.<br />The correct answer is <strong>'" . $correctWord . "'</strong>.<br />Time taken: " . $taken . " seconds.<br /><a href=\"/lessons/verbal-reasoning-odd-one-out\">Try another question</a>";
        }
    } elseif ($_POST["action"] == "quickfire") {
        $question = $_POST['question'];
        $answer = cleanInput($_POST['answer']);
        $time = $_POST['time'];
        $taken = time() - $time;
        $resultid = $_POST['result'];


        $data = explode("|", $question);

        $correct = false;

//$answer = number_format((float)$answer, 2, '.', '');

        if ($answer == $data[1]) {
            $correct = true;
        }

        $result = new Result();
        $result->getByID($resultid);
        $result->type = "Quick Fire";
        $result->time = $taken;
        $result->correct = $correct;
        $xml = '<result chosen="' . $answer . '">'
                . '<question><![CDATA[' . $data[0] . ']]></question>'
                . '<answer>' . $data[1] . '</answer>'
                . '</result>';

        $result->data = $xml;
        $result->update();

        if ($correct) {
            echo "success|Great job! That's correct.<br />Time taken: " . $taken . " seconds.<br /><a href=\"" . arcGetModulePath() . "quickfire" . "\">Try another question</a>";
        } else {
            echo "danger|Sorry, don't give up.<br />The correct answer is <strong>'" . $data[1] . "'</strong>.<br />Time taken: " . $taken . " seconds.<br /><a href=\"" . arcGetModulePath() . "quickfire" . "\">Try another question</a>";
        }
    } elseif ($_POST["action"] == "shuffled") {
        $question = $_POST['question'];
        $clicked = $_POST['clicked'];
        $id = $_POST['id'];
        $time = $_POST['time'];
        $resultid = $_POST['result'];
        $taken = time() - $time;


        $data = explode("|", $question);

        $correct = false;
        $correctWord = "?";

        if ($data[$clicked * 2] == "1") {
            $correct = true;
        }

        $xml = '<result chosen="' . $data[$clicked * 2 + 1] . '">';

        $count = 0;
        $switch = false;
        foreach ($data as $wrd) {
            if ($wrd == "1") {
                $correctWord = $data[$count + 1];
            }

            if ($switch) {
                $switch = false;
                $xml .= '<word correct="' . $data[$count - 1] . '">' . $wrd . '</word>';
            } else {
                $switch = true;
            }

            $count++;
        }

        $xml .= '</result>';

        $result = new result();
        $result->getResult($resultid);
        $result->type = "Shuffled Sentences";
        $result->data = $xml;
        $result->time = $taken;
        $result->correct = $correct;
        $result->updateResult();

        if ($correct) {
            echo "0|Great job! That's correct.<br />Time taken: " . $taken . " seconds.<br /><a href=\"/lessons/shuffled-sentences\">Try another question</a>";
        } else {
            echo "1|Sorry, don't give up.<br />The correct answer is <strong>'" . $correctWord . "'</strong>.<br />Time taken: " . $taken . " seconds.<br /><a href=\"/lessons/shuffled-sentences\">Try another question</a>";
        }
    } elseif ($_POST["action"] == "synonyms") {
        $question = strtolower($_POST['question']);
        $answer = strtolower($_POST['answer']);
        $id = $_POST['id'];
        $time = $_POST['time'];
        $taken = time() - $time;
        $resultID = $_POST['result'];


        $data = explode("|", $question);

        $correct = false;

        if ($data[1] == $answer) {
            $correct = true;
        }

        $result = new result();
        $result->getResult($resultID);
        $result->time = $taken;
        $result->type = "Synonyms";
        $result->correct = $correct;
        $xml = '<result chosen="' . $answer . '">'
                . '<word>' . $data[0] . '</word>'
                . '<word>' . $data[1] . '</word>'
                . '</result>';

        $result->data = $xml;
        $result->updateResult();

        if ($correct) {
            echo "0|Great job! That's correct.<br />Time taken: " . $taken . " seconds.<br /><a href=\"/lessons/verbal-reasoning-synonyms\">Try another question</a>";
        } else {
            echo "1|Sorry, don't give up.<br />The correct answer is <strong>'" . $data[1] . "'</strong>.<br />Time taken: " . $taken . " seconds.<br /><a href=\"/lessons/verbal-reasoning-synonyms\">Try another question</a>";
        }
    }
}

function cleanInput($data) {
    $data = str_replace(' ', '', $data);
    $data = str_replace('£', '', $data);
    $data = str_replace('cm', '', $data);
    $data = str_replace('"', '', $data);
    $data = str_replace('mm', '', $data);
    $data = str_replace('tonnes', '', $data);
    $data = str_replace('ml', '', $data);
    $data = str_replace('cl', '', $data);
    $data = str_replace('g', '', $data);
    $data = str_replace('grams', '', $data);
    $data = str_replace('km', '', $data);
    $data = str_replace('m', '', $data);
    $data = str_replace('tonne', '', $data);
    $data = str_replace('kg', '', $data);
    $data = str_replace('mg', '', $data);
    $data = str_replace('l', '', $data);
    $data = str_replace('litre', '', $data);
    $data = str_replace('litres', '', $data);
    $data = str_replace('km/h', '', $data);
    $data = str_replace('m/h', '', $data);
    $data = str_replace('mph', '', $data);
    return $data;
}
