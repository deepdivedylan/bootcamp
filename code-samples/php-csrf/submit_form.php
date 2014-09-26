<?php
// start the session and require the CSRF verifier
session_start();
require_once("csrf.php");

// verify the CSRF data
try {
    $verified = verifyCsrf($_POST["csrfName"], $_POST["csrfToken"]);
    if($verified === true) {
        echo "CSRF verified OK.";
    }
    else {
        echo "CSRF verification failed.";
    }
} catch(RuntimeException $runtime) {
    echo "Unable to verify CSRF token: " . $runtime->getMessage();
}
?>
