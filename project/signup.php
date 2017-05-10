<?php
/**
 * Sign up page
 */

require_once('database.php');

$error = filter_input(INPUT_GET, 'error', FILTER_VALIDATE_INT);
if ($error == NULL || $error == FALSE) {
    $error = 0;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">

<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Registration</title>
<style>
    /* Layout */
    body {
    min-width: 630px;
    }

    #container {
    padding-left: 200px;
    padding-right: 190px;
    }

    #container .column {
    position: relative;
    float: left;
    }

    #center {
    padding: 10px 20px;
    width: 100%;
    align-content: center;
    }

    #left {
    width: 180px;
    padding: 0 10px;
    right: 240px;
    margin-left: -100%;
    height: 100vh;
    }

    #right {
    width: 130px;
    padding: 0 10px;
    margin-right: -100%;
    }

    #footer {
    clear: both;
    position: fixed;
    width:100%;
    bottom:0;
    }

    /* IE hack */
    * html #left {
    left: 150px;
    }

    /* Make the columns the same height as each other */
    #container {
    overflow: hidden;
    }

    #container .column {
    padding-bottom: 1001em;
    margin-bottom: -1000em;
    }

    /* Fix for the footer */
    * html body {
    overflow: hidden;
    }

    * html #footer-wrapper {
    float: left;
    position: relative;
    width: 100%;
    padding-bottom: 10010px;
    margin-bottom: -10000px;
    background: #fff;
    }

    /* Aesthetics */
    body {
    margin: 0;
    padding: 0;
    font-family:Sans-serif;
    line-height: 1.5em;
    }

    p {
    color: #555;
    }

    nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    }

    nav ul a {
    color: darkgreen;
    text-decoration: none;
    }

    #header, #footer {
    font-size: large;
    padding: 0.3em;
    background: #BCCE98;
    }

    #left {
    background: #DAE9BC;
    }

    #right {
    background: #DAE9BC;
    }

    #center {
    background: #ffd;
    }

    #container .column {
    padding-top: 1em;
    }
</style>

    <!-- Framework CSS -->
<!--    <link rel="stylesheet" href="stylesheet.css" type="text/css">
    <link rel="stylesheet" href="print.css" type="text/css" media="print">
    <link rel="stylesheet" href="ie.css" type="text/css" media="screen, projection">  -->
</head>
<body>
    <header id="header">
    <p>Registration Form</p>
    </header>

        <?php
        if($error == 1) {
            echo '<div class="error"> Email already used, please use another email.</div>';
        }

        elseif($error == 2) {
            echo '<div class="error"> Password should be at least 8 charaters, 1 upper case letter [A-Z], one special character !,#,@.</div>';
        }

        elseif($error == 3)  {
            echo '<div class="error"> Firstname and Lastname should only contain characters [A-Z] or [a-z].</div>';
        }

        elseif($error == 4) {
            echo '<div class="error"> Password and confirm password should match.</div>';
        }

        elseif($error == 5) {
            echo '<div class="error"> Please enter your UNCC email</div>';
        }

        else{
            echo '<div class="error" style="display:none"></div>';
        }

        ?>


        <form id="dummy" action="signupHandler.php" method="post" class="inline">
            <fieldset>
                <div id="container">
                    <main id="center" class="column">
                        <article>

                <div class="span-9">

                    <p>
                        <label for="firstname">Firstname</label><br>
                        <input type="text" class="text" id="firstname" name="firstname" value="">
                    </p>

                </div>

                <div class="span-8 last">

                    <p>
                        <label for="lastname">Lastname</label><br>
                        <input type="text" class="text" id="lastname" name="lastname" value="">
                    </p>

                    <p>
                        <label for="email">Email</label><br>
                        <input type="text" class="text" id="email" name="email" value="">
                    </p>

                    <p>
                        <label for="password">Password</label><br>
                        <input type="password" class="text" id="password" name="password" value="">
                    </p>

                    <p>
                        <label for="confirmpassword">Confirm Password</label><br>
                        <input type="password" class="text" id="confirmpassword" name="confirmpassword" value="">
                    </p>



                    <p>
                        <input type="Submit" value="Submit">
                        <input type="reset" value="Reset">
                    </p>

                </div>
                        </article>
                    </main>
                    <nav id="left" class="column">
                    </nav>
                    <div id="right" class="column">
                    </div>
                </div>
                <div id="footer-wrapper">
                    <footer id="footer"><p>Books by U! Copyright 2017 </p></footer>
                </div>
            </fieldset>
        </form>
    </div>

</div>
</body>
</html>
