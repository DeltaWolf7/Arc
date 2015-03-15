<script>
    function PageLoaded()
    {
    processResultTable('<?php echo $_SESSION['user']; ?>','All');
    }
    window.onload = PageLoaded;
</script>

<p class="lead">Results from your activities.</p>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <form class="navbar-form navbar-left">
            <div class="form-group">
                When
                <input id="dateText" type="text" class="form-control" style="width: 110px;" placeholder="dd-mm-yyyy">
            </div>
            <div class="form-group">
                Rows
                <input id="showCount" type="text" class="form-control" style="width: 50px;" placeholder="25" value="25">
            </div>
            <button type="button" class="btn btn-default" onclick="processResultTable('<?php echo $_SESSION['user']; ?>','All')">Show</button>
        </form>
        <ul class="nav navbar-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Type <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#" onclick="processResultTable('<?php echo $_SESSION['user']; ?>','All')">All</a></li>
                    <li class="divider"></li>
                    <li><a href="#" onclick="processResultTable('<?php echo $_SESSION['user']; ?>','Tests')">Tests</a></li>
                    <li class="divider"></li>
                    <li><a href="#" onclick="processResultTable('<?php echo $_SESSION['user']; ?>','Multi Stage')">Multi Stage</a></li>
                    <li><a href="#" onclick="processResultTable('<?php echo $_SESSION['user']; ?>','Quick Fire')">Quick Fire</a></li>
                    <li class="divider"></li>
                    <li><a href="#" onclick="processResultTable('<?php echo $_SESSION['user']; ?>','Word Bank')">Word Bank</a></li>
                    <li><a href="#" onclick="processResultTable('<?php echo $_SESSION['user']; ?>','Multiple Choice')">Multiple Choice</a></li>
                    <li><a href="#" onclick="processResultTable('<?php echo $_SESSION['user']; ?>','Partial Words')">Partial Words</a></li>
                    <li><a href="#" onclick="processResultTable('<?php echo $_SESSION['user']; ?>','Comprehension')">Comprehension</a></li>
                    <li><a href="#" onclick="processResultTable('<?php echo $_SESSION['user']; ?>','Odd One Out')">Odd One Out</a></li>
                    <li><a href="#" onclick="processResultTable('<?php echo $_SESSION['user']; ?>','Antonyms')">Antonyms</a></li>
                    <li><a href="#" onclick="processResultTable('<?php echo $_SESSION['user']; ?>','Synonyms')">Synonyms</a></li>
                    <li><a href="#" onclick="processResultTable('<?php echo $_SESSION['user']; ?>','Shuffled Sentences')">Shuffled Sentences</a></li>
                    <li class="divider"></li>
                    <li><a href="#" onclick="processResultTable('<?php echo $_SESSION['user']; ?>','2D Conventional')">2D Conventional</a></li>
                    <li><a href="#" onclick="processResultTable('<?php echo $_SESSION['user']; ?>','3D')">3D</a></li>
                </ul>
            </li>
        </ul>
    </div><!-- /.container-fluid -->
</nav>

<div id="dataTable"></div>


<div class="modal fade" id="resultsModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Activity Details</h4>
            </div>
            <div class="modal-body">
                <p id="dataPlaceholder">
                    Loading..
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
