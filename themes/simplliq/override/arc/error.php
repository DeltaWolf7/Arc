<div class="container">
<div class="row justify-content-center">
            <div class="col-md-6">
                <div class="clearfix">
                    <h1 class="float-left display-3 mr-2"><?php echo http_response_code(); ?></h1>
                    <h4 class="pt-1">Houston, we have a problem!</h4>
                    <p class="text-muted">
                            <?php
                            switch (http_response_code()) {
                                case "404":
                                    echo "The resource you're looking for cannot be found.<br />
                <br />Request URL: " . system\Helper::arcGetURI();
                                    break;
                                case "403":
                                    echo "You do not have permission to access this resource.";
                                    break;
                                case "401":
                                    echo "Your session has expired. Please login and try again.";
                                    break;
                                case "419":
                                    echo "Your authentication has expired. Please <a href=\"" . system\Helper::arcGetPath() . "login" . "\">login</a>.";
                                    break;
                                default:
                                    echo "Unhandled error occured: " . http_response_code();
                                    break;
                            }
            ?>
                    </p>
                </div>
            </div>
        </div>
        </div>