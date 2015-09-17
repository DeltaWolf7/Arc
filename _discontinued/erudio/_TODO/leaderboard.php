<p class="lead">Personal Level</p>
<p>Personal level determines the difficulty of the questions. The better your level, the harder the questions.
    <br />Levels are based on correct answers vs incorrect answers over a hundred.
</p>

<?php

    $users = new users();
    $users->getUsers();

?>

<div class="row">
    <div class="col-md-6">

        <p class="lead">Quick Fire</p>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Who</th>
                    <th>Level</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $qfArray = Array();

                foreach ($users->users as $user) {
                    $qfResult = new result();
                    $poslv = (int) $qfResult->getQuickFireCount($user->id, 1);
                    $neglv = (int) $qfResult->getQuickFireCount($user->id, 0);
                    $lv = $poslv - $neglv;
                    if ($lv < 1)
                    {
                        $lv = 1;
                    }
                    $qfArray[$user->firstname] = $lv;
                }

                BuildTable($qfArray);
                ?>
            </tbody>
        </table>

    </div>
    <div class="col-md-6">
        <p class="lead">Multi Stage</p>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Who</th>
                    <th>Level</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $qfArray = Array();

                foreach ($users->users as $user) {
                    $qfResult = new result();
                    $poslv = (int) $qfResult->getMultiStageCount($user->id, 1);
                    $neglv = (int) $qfResult->getMultiStageCount($user->id, 0);
                    $lv = $poslv - $neglv;
                    if ($lv < 1)
                    {
                        $lv = 1;
                    }
                    $qfArray[$user->firstname] = $lv;
                }

                BuildTable($qfArray);
                ?>
            </tbody>
        </table>


    </div>
</div>



<div class="row">
    <div class="col-md-6">

        <p class="lead">Antonyms</p>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Who</th>
                    <th>Level</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $qfArray = Array();

                foreach ($users->users as $user) {
                    $qfResult = new result();
                    $poslv = (int) $qfResult->getAntonymsCount($user->id, 1);
                    $neglv = (int) $qfResult->getAntonymsCount($user->id, 0);
                    $lv = $poslv - $neglv;
                    $qfArray[$user->firstname] = $lv;
                }

                BuildTable($qfArray);
                ?>
            </tbody>
        </table>

    </div>
    <div class="col-md-6">

        <p class="lead">Synonyms</p>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Who</th>
                    <th>Level</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $qfArray = Array();
                foreach ($users->users as $user) {
                    $qfResult = new result();
                    $poslv = (int) $qfResult->getSynonymsCount($user->id, 1);
                    $neglv = (int) $qfResult->getSynonymsCount($user->id, 0);
                    $lv = $poslv - $neglv;
                    $qfArray[$user->firstname] = $lv;
                }

                BuildTable($qfArray);
                ?>

            </tbody>
        </table>

    </div>
</div>




<div class="row">
    <div class="col-md-6">

        <p class="lead">Shuffled Sentences</p>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Who</th>
                    <th>Level</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $qfArray = Array();
                foreach ($users->users as $user) {
                    $qfResult = new result();
                    $poslv = (int) $qfResult->getShuffledCount($user->id, 1);
                    $neglv = (int) $qfResult->getShuffledCount($user->id, 0);
                    $lv = $poslv - $neglv;
                    $qfArray[$user->firstname] = $lv;
                }

                BuildTable($qfArray);
                ?>
            </tbody>
        </table>

    </div>
    <div class="col-md-6">
        <p class="lead">Odd One Out</p>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Who</th>
                    <th>Level</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $qfArray = Array();
                foreach ($users->users as $user) {
                    $qfResult = new result();
                    $poslv = (int) $qfResult->getOddOneOutCount($user->id, 1);
                    $neglv = (int) $qfResult->getOddOneOutCount($user->id, 0);
                    $lv = $poslv - $neglv;
                    $qfArray[$user->firstname] = $lv;
                }

                BuildTable($qfArray);
                ?>

            </tbody>
        </table>
    </div>
</div>


<?php

function BuildTable($array) {

    $user = new user();
    $user->getUserByID($_SESSION['user']);

    arsort($array);
    $count = 0;

    foreach ($array as $key => $value) {
        if ($key == $user->firstname) {
            echo "<tr class=\"success\"><td>";
        } else {
            echo "<tr><td>";
        }
        echo $key;
        echo "</td><td>";
        echo "<span class=\"badge\">" . $value . "</span>";

        if ($count == 0) {
            echo " <span class=\"label label-success\">1st Place</span>";
        } elseif ($count == 1) {
            echo " <span class=\"label label-warning\">2nd Place</span>";
        } elseif ($count == 2) {
            echo " <span class=\"label label-primary\">3rd Place</span>";
        }

        echo "</td></tr>";
        $count++;
    }
}
?>