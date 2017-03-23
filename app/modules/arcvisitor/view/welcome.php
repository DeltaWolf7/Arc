<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img class="visitor-logo" src="{{arc:sitelogo}}">
        </div>
        <div class="col-md-6">
            <div class="visitor-menu">
                <i id="vStart" class="btn btn-success">Start Again</i>
                <i id="vFire" class="btn btn-danger"><i class="fa fa-fire"></i></i>
            </div>
        </div>
    </div>
    <?php if (!isset($_SESSION["stage"])) { ?>
        <div class="visitor-center visitor-header">
            Welcome
        </div>
        <div class="visitor-center visitor-buttons">
            <i id="vVisitor" class="btn btn-primary btn-xl vistor-btn">Visitor</i>
            <i id="vContractor" class="btn btn-primary btn-xl vistor-btn">Contractor</i>
            <i id="vEmployee" class="btn btn-primary btn-xl vistor-btn">Employee</i>
        </div>
    <?php } ?>
</div>
<div class="visitor-footer">
    <!--<div class="row">
        <div class="col-md-2">
            <i id="vPrevious" class="btn btn-warning btn-xl btn-block"><i class="fa fa-chevron-left"></i> Previous</i>
        </div>
        <div class="col-md-8">
        </div>
        <div class="col-md-2 text-right">
            <i id="vNext" class="btn btn-warning btn-xl btn-block"><i class="fa fa-chevron-right"></i> Next</i>
        </div>
    </div>/-->
</div>