<?php
if ($_GET['randomId'] != "GYeepNGSAUqqldW5cwGYx6eZQqrMowGHSRcregGmUIzAkXAE6RbabvBosnTO8UZD") {
    echo "Access Denied";
    exit();
}

// display the HTML code:
echo stripslashes($_POST['wproPreviewHTML']);

?>  
