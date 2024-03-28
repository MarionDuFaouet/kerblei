<?php

// is the (or a) user already logged ?
if (!((isset($_SESSION['admin'])) && $_SESSION['admin'])) {
    $_SESSION['msg']=['level'=> 'warning', 'content' => 'You must be an administrator to reach this page'];

    /* It should not occurs if all restricted accesses are hidden or disable.
       If it does, it means that routes are being violated.
       Thus, forbidden routes must be closed as soon as possible : the router is probably the best place to do
       that and redirection to the home page is appropriate.
    */
    
    header("Location: ?action=home");   // access forbidden; immediatly redirected to home page
    exit;                               // mandatory to abort the current script and update the $_SESSION 
}

else require "./views/admin.php";    // access allowed; go to the requested page
?>
