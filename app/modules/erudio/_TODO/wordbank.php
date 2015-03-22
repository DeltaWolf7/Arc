<div class="well">
    <p class="lead">Synopsis</p>
    <p>This section will improve your ??</p>
</div>

<?php
$excerpt = Excerpt::getRandom();

function cutText($text) {
    $data = explode("\r\n", $text);
    return $data[0] . "\r\n\r\n" . $data[1] . "\r\n\r\n" . $data[2];
}
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="well">
                    <div class="lead">
                        <?php echo $excerpt->name; ?>
                    </div>
                    <?php echo nl2br(cutText($excerpt->content)); ?>
                </div>
            </div>

            <div class="panel-body">
                <form class="form-inline">
                    <div class="form-group">
                        <label for="word1">Word 1</label>
                        <select id="word1" class="form-control">
                            <option>test test test</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="word2">Word 2</label>
                        <select id="word2" class="form-control">
                            <option>test test test</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="word3">Word 3</label>
                        <select id="word3" class="form-control">
                            <option>test test test</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="word4">Word 4</label>
                        <select id="word4" class="form-control">
                            <option>test test test</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="word5">Word 5</label>
                        <select id="word5" class="form-control">
                            <option>test test test</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="word6">Word 6</label>
                        <select id="word6" class="form-control">
                            <option>test test test</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="word7">Word 7</label>
                        <select id="word7" class="form-control">
                            <option>test test test</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="word8">Word 8</label>
                        <select id="word8" class="form-control">
                            <option>test test test</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="word9">Word 9</label>
                        <select id="word9" class="form-control">
                            <option>test test test</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="word10">Word 10</label>
                        <select id="word10" class="form-control">
                            <option>test test test</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

