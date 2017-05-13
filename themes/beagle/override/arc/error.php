<div class="be-error">
    <div class="error-container">
        <div class="error-number"><?php echo http_response_code(); ?></div>
        <div class="error-description">
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
        </div>
        <div class="error-goback-text">Would you like to go home?</div>
        <div class="error-goback-button"><button id="btnHome" class="btn btn-xl btn-primary">Let's go home</button></div>
        <div class="footer">{{arc:sitetitle}}</div>
    </div>
</div>





