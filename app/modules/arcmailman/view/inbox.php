<div class="card">
    <div class="card-body">


        <!-- `.messages-wrapper` fills all available space of container -->
        <div class="row">

            <!-- Messages sidebox -->
            <div class="col-md-3">

                <div class="py-3 px-4">
                    <div class="media align-items-center">
                    <div class="media-body">
                        <button type="button" class="btn btn-primary btn-block">Compose</button>
                    </div>
                    <a href="javascript:void(0)" class="messages-sidebox-toggler d-lg-none d-block text-muted text-large font-weight-light pl-4">&times;</a>
                    </div>
                </div>
                <hr class="border-light mx-4 mt-0 mb-4">

                <!-- Mail boxes -->
                <?php

                    

                        echo "<a href=\"\" class=\"d-flex justify-content-between align-items-center text-dark font-weight-bold py-2 px-4\">"
                            . "<div>"
                            . "<i class=\"fa fa-{$icon}\"></i> &nbsp; {$name}"
                            . "</div>"
                            . "</a>";

                    

                ?>
                <!-- / Mail boxes -->

            </div>
            <!-- / Messages sidebox -->


            <!-- Messages content wrapper -->
            <div class="col-md-9">

                <!-- Header -->
                <div class="flex-grow-0">

                    <h4 class="media align-items-center font-weight-bold container-p-x py-3 py-lg-4 m-0">
                    <a href="javascript:void(0)" class="messages-sidebox-toggler d-lg-none d-block align-self-center text-muted px-3 mr-3">
                        <i class="ion ion-md-more"></i>
                    </a>
                    <div class="media-body">
                        <i class="fa fa-inbox"></i> &nbsp; Inbox
                    </div>
                    </h4>
                    <hr class="border-light m-0">

                    <!-- Controls -->
                    <div class="media flex-wrap align-items-center py-1 px-1 px-lg-4">
                    <div class="media-body d-flex flex-wrap flex-basis-100 flex-basis-sm-auto">
                        <button type="button" class="btn btn-default borderless md-btn-flat icon-btn messages-tooltip text-muted" title="Refresh">
                        <i class="fa fa-sync"></i>
                        </button>
                        <button type="button" class="btn btn-default borderless md-btn-flat icon-btn messages-tooltip text-muted" title="Mark as unread">
                        <i class="fa fa-envelope"></i>
                        </button>
                        <button type="button" class="btn btn-default borderless md-btn-flat icon-btn messages-tooltip text-muted" title="Mark as important">
                        <i class="fa fa-info-circle"></i>
                        </button>
                        <button type="button" class="btn btn-default borderless md-btn-flat icon-btn messages-tooltip text-muted" title="Move to spam">
                        <i class="fa fa-folder"></i>
                        </button>
                        <button type="button" class="btn btn-default borderless md-btn-flat icon-btn messages-tooltip text-muted" title="Move to trash">
                        <i class="fa fa-trash"></i>
                        </button>
                    </div>

                    <div class="text-muted mr-3 ml-auto">1-25 of 91</div>

                    <div class="d-flex flex-wrap">
                        <button type="button" class="btn btn-default borderless md-btn-flat icon-btn text-muted">
                        <i class="fa fa-angle-left"></i>
                        </button>
                        <button type="button" class="btn btn-default borderless md-btn-flat icon-btn text-muted">
                        <i class="fa fa-angle-right"></i>
                        </button>
                    </div>
                    </div>
                    <hr class="border-light m-0">
                    <!-- / Controls -->

                </div>
                <!-- / Header -->

                <!-- Wrap `.messages-scroll` to properly position scroll area. Remove this wrapper if you don't need scroll -->
                <div class="flex-grow-1 position-relative">

                    <!-- Remove `.messages-scroll` and add `.flex-grow-1` if you don't need scroll -->
                    <div class="messages-content messages-scroll">

                    <ul class="list-group messages-list">

                        <li class="list-group-item container-p-x">
                            <div class="row">
                                <div class="col-md-1">
                                    <div class="message-checkbox mr-1">
                                        <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <a href="javascript:void(0)" class="message-sender flex-shrink-1 d-block text-dark">
                                        <span class="badge badge-dot badge-info mr-1"></span>
                                        Sender
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="javascript:void(0)" class="message-subject flex-shrink-1 d-block text-dark">
                                        Subject
                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <div class="message-date text-muted">1d ago</div>
                                </div>
                            </div>
                        </li>

                    </ul>

                    </div>
                    <!-- / .messages-content -->
                </div>

            </div>
        </div>
        <!-- / .messages-wrapper -->

    </div>
</div>