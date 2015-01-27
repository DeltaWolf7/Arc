<div class="page-header">
    <h1>Issue Tracker</h1>
</div>

<div class="table-responsive">
    <table class="table table-condensed">
        <tr>
            <th>Status</th>
            <th>Description</th>
            <th>Comments</th>
        </tr>
        <?php
        $issues = Issue::getAllIssues();
        foreach ($issues as $issue) {
            echo "<tr><td>";
            echo "<i class=\"badge badge-";
            switch ($issue->status) {
                case 0:
                    echo "primary";
                    break;
                case 1:
                    echo "success";
                    break;
                case 2:
                    echo "warning";
                    break;
                case 3:
                    echo "danger";
                    break;
                case 4:
                    echo "default";
                    break;
            }
            echo "\">";
            echo "<i class=\"fa-stack fa-lg\"><i class=\"fa fa-circle-thin fa-stack-2x\"></i><i class=\"fa fa-info fa-stack-1x\"></i></i>";
            switch ($issue->status) {
                case 0:
                    echo " New";
                    break;
                case 1:
                    echo " Resolved";
                    break;
                case 2:
                    echo " Minor";
                    break;
                case 3:
                    echo " Major";
                    break;
                case 4:
                    echo " Unconfirmed";
                    break;
            }
            echo "</i>";
            echo "</td><td>{$issue->description}<br />";
            $labels = json_decode($issue->labels);
            foreach ($labels as $label) {
                echo "<i class=\"label label-default\">" . $label . "</i> ";
            }
            echo "</td><td>";
            $comments = Comment::getByIssueID($issue->id);
            echo "<i class=\"fa fa-comment\"></i> " . count($comments);
            echo "</td></tr>";
        }
        ?>
    </table>
</div>