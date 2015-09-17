<?php

require_once('/bootstrap.php');
$id = $_POST['id'];

$result = new Result();
$result->getResult($id);

$xml = new SimpleXMLElement($result->data);

echo "<h4>" . $result->type . " (" . date("d-m-Y", strtotime($result->date)) . ")</h4><p>";
echo "<div class=\"well\">";
echo "<table class=\"table\">";



if ($result->type == "Odd One Out" || $result->type == "Shuffled Sentences") {
    echo "<tr><th>Word</th><th>Tags</th></tr>";

    foreach ($xml->word as $word) {

        echo "<tr>";
        echo "<td>";
        echo $word;
        echo "</td>";

        echo "<td>";
        if ($word['correct'] == "1") {
            echo " <span class=\"label label-success\">Correct Answer</span>";
        } else {
            echo " <span class=\"label label-danger\">Incorrect Answer</span>";
        }

        if ((string) $xml->attributes()->chosen == (string) $word) {
            echo " <span class=\"label label-default\">Chosen Answer</span>";
        }
        
        echo "</td>";
        echo "</tr>";
    }
    
    if ((string) $xml->attributes()->chosen == "") {
            echo "<tr><td></td><td><span class=\"label label-default\">This question was not completed</span></td></tr>";
        }

    echo "</table>";
}
elseif ($result->type == "Antonyms")
{
    echo "<tr><th>Word</th><th>Tags</th></tr>";
    $wrdCount = 0;
    foreach ($xml->word as $word) {

        echo "<tr>";
        echo "<td>";
        echo $word;
        echo "</td>";

        echo "<td>";
        if ($wrdCount > 0)
        {
            if ($word['correct'] == "1") {
                echo " <span class=\"label label-success\">Correct Answer</span>";
            } else {
                echo " <span class=\"label label-danger\">Incorrect Answer</span>";
            }
        }
        else
        {
            echo " <span class=\"label label-warning\">Given Word</span>";
        }

        if ((string) $xml->attributes()->chosen == (string) $word) {
            echo " <span class=\"label label-default\">Chosen Answer</span>";
        }
        
        

        echo "</td>";
        echo "</tr>";
        
        $wrdCount++;
    }
    
    if ((string) $xml->attributes()->chosen == "") {
            echo "<tr><td></td><td><span class=\"label label-default\">This question was not completed</span></td></tr>";
        }

    echo "</table>";
}
elseif ($result->type == "Synonyms")
{
    echo "<tr><th>Word</th><th>Tags</th></tr>";
    echo "<tr><td>" . $xml->word[0] . "</td><td><span class=\"label label-warning\">Given Word</span></td></tr>";
    
    if ((string)$xml->word[1] == (string)$xml->attributes()->chosen)
    {
        echo "<tr><td>" . $xml->word[1] . "</td><td><span class=\"label label-success\">Correct Word</span> <span class=\"label label-info\">Entered Word</span></td></tr>";
    }
    else if ((string)$xml->attributes()->chosen == "") {
        echo "<tr><td>" . $xml->word[1] . "</td><td><span class=\"label label-success\">Correct Word</span></td></tr>";
        echo "<tr><td></td><td><span class=\"label label-default\">This question was not completed</span></td></tr>";
    }
    else
    {
        echo "<tr><td>" . $xml->word[1] . "</td><td><span class=\"label label-success\">Correct Word</span></td></tr>";
        echo "<tr><td>" . $xml->attributes()->chosen . "</td><td><span class=\"label label-info\">Entered Word</span></td></tr>";
    }
    echo "</table>";
}
elseif ($result->type == "Quick Fire")
{
    echo "<tr><th>Question</th><th>Tags</th></tr>";
    echo "<tr><td>" . $xml->question . "</td><td><span class=\"label label-warning\">Given Question</span></td></tr>";
    
    if ((string)$xml->answer == (string)$xml->attributes()->chosen)
    {
        echo "<tr><td>" . $xml->answer . "</td><td><span class=\"label label-success\">Correct Answer</span> <span class=\"label label-info\">Entered Answer</span></td></tr>";
    }
    else if ((string)$xml->attributes()->chosen == "")
    {
        echo "<tr><td>" . $xml->answer . "</td><td><span class=\"label label-success\">Correct Answer</span></td></tr>";
        echo "<tr><td></td><td><span class=\"label label-default\">This question was not completed</span></td></tr>";
    }
    else
    {
        echo "<tr><td>" . $xml->answer . "</td><td><span class=\"label label-success\">Correct Answer</span></td></tr>";
        echo "<tr><td>" . $xml->attributes()->chosen . "</td><td><span class=\"label label-info\">Entered Answer</span></td></tr>";
    }
    echo "</table>";
}
elseif ($result->type == "Multi Stage")
{
    echo "<tr><th>Question</th><th>Tags</th></tr>";
    echo "<tr><td>" . $xml->question[0] . "</td><td><span class=\"label label-warning\">Question 1</span></td></tr>";
    echo "<tr><td>" . $xml->question[0]->attributes()->answer . "</td><td><span class=\"label label-default\">Answer 1</span></td></tr>";
    if ((string)$xml->question[0]->attributes()->answer == (string)$xml->question[0]->attributes()->entered) {
        echo "<tr><td>" . $xml->question[0]->attributes()->entered . "</td><td><span class=\"label label-info\">Entered Answer</span> <span class=\"label label-success\">Correct Answer</span></td></tr>";
    } else if ((string)$xml->question[0]->attributes()->entered == '') {
        echo "<tr><td>" . $xml->question[0]->attributes()->entered . "</td><td><span class=\"label label-default\">This question was not completed</span></td></tr>";
    } else {
        echo "<tr><td>" . $xml->question[0]->attributes()->entered . "</td><td><span class=\"label label-info\">Entered Answer</span> <span class=\"label label-danger\">Incorrect Answer</span></td></tr>";
    }
    echo "<tr><td>" . $xml->question[1] . "</td><td><span class=\"label label-warning\">Question 2</span></td></tr>";
    echo "<tr><td>" . $xml->question[1]->attributes()->answer . "</td><td><span class=\"label label-default\">Answer 2</span></td></tr>";
    if ((string)$xml->question[1]->attributes()->answer == (string)$xml->question[1]->attributes()->entered) {
        echo "<tr><td>" . $xml->question[1]->attributes()->entered . "</td><td><span class=\"label label-info\">Entered Answer</span> <span class=\"label label-success\">Correct Answer</span></td></tr>";
    } else if ((string)$xml->question[1]->attributes()->entered == '') {
        echo "<tr><td>" . $xml->question[1]->attributes()->entered . "</td><td><span class=\"label label-default\">This question was not completed</span></td></tr>";
    } else {
        echo "<tr><td>" . $xml->question[1]->attributes()->entered . "</td><td><span class=\"label label-info\">Entered Answer</span> <span class=\"label label-danger\">Incorrect Answer</span></td></tr>";
    }
    
    echo "<tr><td>" . $xml->question[2] . "</td><td><span class=\"label label-warning\">Question 3</span></td></tr>";
    echo "<tr><td>" . $xml->question[2]->attributes()->answer . "</td><td><span class=\"label label-default\">Answer 3</span></td></tr>";
    if ((string)$xml->question[2]->attributes()->answer == (string)$xml->question[2]->attributes()->entered) {
        echo "<tr><td>" . $xml->question[2]->attributes()->entered . "</td><td><span class=\"label label-info\">Entered Answer</span> <span class=\"label label-success\">Correct Answer</span></td></tr>";
    } else if ((string)$xml->question[2]->attributes()->entered == '') {
        echo "<tr><td>" . $xml->question[2]->attributes()->entered . "</td><td><span class=\"label label-default\">This question was not completed</span></td></tr>";
    } else {
        echo "<tr><td>" . $xml->question[2]->attributes()->entered . "</td><td><span class=\"label label-info\">Entered Answer</span> <span class=\"label label-danger\">Incorrect Answer</span></td></tr>";
    }
    
    echo "<tr><td>" . $xml->question[3] . "</td><td><span class=\"label label-warning\">Question 4</span></td></tr>";
    echo "<tr><td>" . $xml->question[3]->attributes()->answer . "</td><td><span class=\"label label-default\">Answer 4</span></td></tr>";
    if ((string)$xml->question[3]->attributes()->answer == (string)$xml->question[3]->attributes()->entered) {
        echo "<tr><td>" . $xml->question[3]->attributes()->entered . "</td><td><span class=\"label label-info\">Entered Answer</span> <span class=\"label label-success\">Correct Answer</span></td></tr>";
    } else if ((string)$xml->question[3]->attributes()->entered == '') {
        echo "<tr><td>" . $xml->question[3]->attributes()->entered . "</td><td><span class=\"label label-default\">This question was not completed</span></td></tr>";
    } else {
        echo "<tr><td>" . $xml->question[3]->attributes()->entered . "</td><td><span class=\"label label-info\">Entered Answer</span> <span class=\"label label-danger\">Incorrect Answer</span></td></tr>";
    }
    
    echo "<tr><td>" . $xml->question[4] . "</td><td><span class=\"label label-warning\">Question 5</span></td></tr>";
    echo "<tr><td>" . $xml->question[4]->attributes()->answer . "</td><td><span class=\"label label-default\">Answer 5</span></td></tr>";
    if ((string)$xml->question[4]->attributes()->answer == (string)$xml->question[4]->attributes()->entered) {
        echo "<tr><td>" . $xml->question[4]->attributes()->entered . "</td><td><span class=\"label label-info\">Entered Answer</span> <span class=\"label label-success\">Correct Answer</span></td></tr>";
    } else if ((string)$xml->question[4]->attributes()->entered == '') {
        echo "<tr><td>" . $xml->question[4]->attributes()->entered . "</td><td><span class=\"label label-default\">This question was not completed</span></td></tr>";
    } else {
        echo "<tr><td>" . $xml->question[4]->attributes()->entered . "</td><td><span class=\"label label-info\">Entered Answer</span> <span class=\"label label-danger\">Incorrect Answer</span></td></tr>";
    }
    
    echo "</table>";
}

echo "</div>";

echo "<ul class=\"nav nav-pills nav-stacked\"><li class=\"active\"><a href=\"#\">";
echo "<span class=\"badge pull-right\">";
if ($result->time < 1) {
    echo "< 1";
} else {
    echo $result->time;
}
echo "</span>Time taken (seconds): ";
echo "</a></li></ul><br />";

if ($result->correct == "1") {
    echo "<div class=\"alert alert-success\" role=\"alert\">You answered this question correctly. <span class=\"glyphicon glyphicon-ok\"></span></div>";
} else {
    echo "<div class=\"alert alert-danger\" role=\"alert\">You answered this question incorrectly. <span class=\"glyphicon glyphicon-remove\"></span></div>";
}