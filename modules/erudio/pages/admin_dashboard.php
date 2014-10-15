<?php
if (!isset($_SESSION['user'])) {
    echo "<script type=\"text/javascript\">window.location=\"/accounts/denied\"</script>";
}
 else {
     $user = new user();
     $user->getUserByID($_SESSION['user']);
     if ($user->isadmin == false)
     {
         echo "<script type=\"text/javascript\">window.location=\"/accounts/denied\"</script>";
     }
}

include('/templates/admin_menu.php');

?>

<p>
    
</p>



