<section class="error">
    <div class="error__inner">
         <h1><?php echo http_response_code(); ?></h1>
             <?php
                switch (http_response_code()) {
                    case "404":
                        ?>
                        <h2>The page you were looking for doesn't exist!</h2>
                        <p>Requested Url: <?php echo system\Helper::arcGetURI(); ?></p>
                        <?php
                        break;
                    case "403":
                        ?>
                        <h2>You do not have permission to access this resource.</h2>
                        <?php
                        break;
                    case "401":
                        ?>
                        <h2>Your session has expired. Please login and try again.</h2>
                        <?php
                        break;
                    case "419":
                        ?>
                        <h2>Your authentication has expired. Please <a href="<?php echo system\Helper::arcGetPath() . "login"; ?>">login</a>.</h2>
                        
                        <?php
                        break;
                    default:
                        echo "<h2>Unhandled error occurred: " . http_response_code() . "</h2>";
                        break;
                }
            ?>
    </div>
</section>