<?php
if (!isset($_SESSION['user'])) {
    echo "<script type=\"text/javascript\">window.location=\"/accounts/denied\"</script>";
} else {
    $user = new user();
    $user->getUserByID($_SESSION['user']);
    if ($user->isadmin == false) {
        echo "<script type=\"text/javascript\">window.location=\"/accounts/denied\"</script>";
    }
}

include('/templates/admin_menu.php');
?>
<p class="lead">Last 100 Results</p>
<div class="row">
    <div class="col-md-3">
        <p class="lead">Quick Fire</p>
        <?php Doughnut('d1', 'Quick Fire') ?>
    </div>
  <div class="col-md-3">
        <p class="lead">Multi Stage</p>
        <?php Doughnut('d2', 'Multi Stage') ?>
    </div>
    <div class="col-md-3">
        <p class="lead">Antonyms</p>
        <?php Doughnut('d3', 'Antonyms') ?>
    </div>
    <div class="col-md-3">
        <p class="lead">Synonyms</p>
        <?php Doughnut('d4', 'Synonyms') ?>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <p class="lead">Shuffled Sentences</p>
        <?php Doughnut('d5', 'Shuffled Sentences') ?>
    </div>
  <div class="col-md-3">
        <p class="lead">Odd One Out</p>
        <?php Doughnut('d6', 'Odd One Out') ?>
    </div>
    <div class="col-md-3">
       
    </div>
    <div class="col-md-3">
        
    </div>
</div>



<?php

function Doughnut($name, $type) {
    echo "<canvas id=\"" . $name . "\"/>";
    echo "<script>var " . $name . "Data = [";

    $results = new results();
            $results->getResultsLast(100, $type);
            
            $pass = 0;
            $fail = 0;
            
            foreach ($results->results as $result)
            {
                if ((int)$result->correct == 1) {
                    $pass++;
                }
                else {
                    $fail++;
                }
            }
            
            echo "{ value: " . $pass . ", color:\"#6BE03D\",highlight: \"#7EE058\",label: \"Correct\"},";
            echo "{ value: " . $fail . ", color:\"#F7464A\",highlight: \"#FF5A5E\",label: \"Incorrect\"}";

            echo "];";
            
            echo "var " . $name . "ctx = document.getElementById(\"" . $name . "\").getContext(\"2d\");";
            echo "var " . $name . "Doughnut = new Chart(" . $name . "ctx).Doughnut(" . $name . "Data, {responsive : true});";
            echo "</script>";
}

        			

			
				
				
			


