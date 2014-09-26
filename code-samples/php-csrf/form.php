<?php
// start the session and require the CSRF verifier
session_start();
require_once("csrf.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Important Form</title>
    </head>
    <body>
        <form method="post" action="submit_form.php">
            <?php
                echo generateInputTags();
            ?>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" /><br />
            <label for="password">Password</label>
            <input type="password" name="password" id="password" /><br />
            <button type="submit">Submit</button>
        </form>
    </body>
</html>
